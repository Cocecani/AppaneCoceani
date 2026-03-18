<?php

require('../../includes/db.php');
include('../header.php');

function creaProd($id, $nome, $ingredienti, $prezzo)
{
    // ingredienti is expected to be an array; join with commas for display
    $string_ingredienti = implode(', ', $ingredienti);
    return "<div class='prodotto'>
                <div class='level'>
                    <h2>$nome</h2>
                    <button class='cart-btn' style='float: right;' title='Modifica prodotto' 
                        onclick='openModal(\"modalModifyProduct.php?id=$id\")'>
                        <img src='../../grafica/img/pen.png' class='cart-icon' />
                    </button>
                </div>
                <p>$string_ingredienti</p>
                <p>€$prezzo</p>

            </div>";
}

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Appane</title>
    <link rel="stylesheet" href="../../grafica/style.css?v=<?php echo time();?>">
</head>

<body>
    <div class="main-content">
        <h1>Gestione di Prodotti</h1>
        <div class="menu">
            <?php
            $sqlMenu = "SELECT id, nome, prezzo FROM tprodotto ORDER BY nome";
            $resultMenu = $conn->query($sqlMenu);

            if ($resultMenu->num_rows > 0) {
                while ($rowProd = $resultMenu->fetch_assoc()) {
                    $stmtIng = $conn->prepare("SELECT idIngrediente FROM tricetta WHERE idProdotto = ?");
                    
                    $stmtIng->bind_param("i", $rowProd["id"]);
                    $stmtIng->execute();
                    $resultI = $stmtIng->get_result();
                    $ingredienti = [];
                    while ($rowI = $resultI->fetch_assoc()) {
                        $stmt = $conn->prepare("SELECT nome FROM tingrediente WHERE id = ?");
                        
                        $stmt->bind_param("i", $rowI['idIngrediente']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if($result->num_rows===1){
                            $ingredienti[] = $result->fetch_assoc()["nome"];
                        }
                    }
                    sort($ingredienti);
                    echo creaProd($rowProd["id"], $rowProd["nome"], $ingredienti,  $rowProd["prezzo"]);
                    
                }
            } else {
                echo '<p> Per ora non ci sono prodotti salvati </p>';
            }
            ?>

            
        </div>

    </div>
    <button class="add-btn" title="Aggiungi prodotto" onclick="openModal('modalAddProduct.php')">+</button>

    <div id="modal" class="modal">

    </div>

    <script src="../management.js?v=<?php echo time();?>"></script>
</body>

</html>