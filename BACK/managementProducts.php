<?php
session_start();

require('../includes/db.php');
include('header.php');

function creaProd($id, $nome, $ingredienti, $prezzo)
{
    // ingredienti is expected to be an array; join with commas for display
    $string_ingredienti = implode(', ', $ingredienti);
    return "<div class='prodotto' id=$id>
                <div>
                    <h2>$nome</h2>
                    <button class='cart-btn' style='float: right;' >
                        <img src='../grafica/img/pen.png' class='cart-icon' />
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
    <link rel="stylesheet" href="../grafica/style.css">
</head>

<body>
    <div class="welcomeText">
        <h2>Benvenuto a il panificio di cui non potrai fare ammeno</h2>
    </div>
    <div class="main-content">
        <h1>Gestione di prodotti</h1>
        <div class="menu">
            <?php
            $sqlMenu = "SELECT * FROM tprodotto";
            $resultMenu = $conn->query($sqlMenu);

            if ($resultMenu->num_rows > 0) {
                while ($rowProd = $resultMenu->fetch_assoc()) {
                    $stmtIng = $conn->prepare("SELECT ingrediente FROM tricetta WHERE idProdotto = ?");
                    
                    $stmtIng->bind_param("i", $rowProd["id"]);
                    $stmtIng->execute();
                    $resultI = $stmtIng->get_result();
                    $ingredienti = [];
                    while ($rowI = $resultI->fetch_assoc()) {
                        $ingredienti[] = $rowI['ingrediente'];
                    }
                    echo creaProd($rowProd["id"], $rowProd["nome"], $ingredienti,  $rowProd["prezzo"]);
                    
                }
            } else {
                echo '<p> Per ora non ci sono prodotti salvati </p>';
            }

            ?>

            
        </div>

    </div>
    <button class="add-btn" onclick="openModalAdd()">+</button>

    <div id="modal" class="modal">

    </div>

    <script src="managementProducts.js"></script>
</body>

</html>