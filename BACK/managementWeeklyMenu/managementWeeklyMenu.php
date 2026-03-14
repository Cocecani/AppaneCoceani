<?php
session_start();

require('../../includes/db.php');
include('../header.php');

function creaProd( $nome, $ingredienti, $prezzo)
{
    // ingredienti is expected to be an array; join with commas for display
    $string_ingredienti = implode(', ', $ingredienti);
    return "<div class='prodotto'>
                <div>
                    <h2>$nome</h2>
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
    <div class="welcomeText">
        <h2>Benvenuto a il panificio di cui non potrai fare ammeno</h2>
    </div>
    <div class="main-content">
        <h1>Gestione di menu settimanale</h1>
        <div class="menu">
            <?php
            $sqlMenu = "SELECT idProdotto FROM tmenu";
            $resultMenu = $conn->query($sqlMenu);

            if ($resultMenu->num_rows > 0) {
                while($rowIdProd = $resultMenu->fetch_assoc()){

                    $stmtProd = $conn->prepare("SELECT nome, prezzo FROM tprodotto WHERE id = ?");
                    $stmtProd->bind_param("i", $rowIdProd["idProdotto"]);
                    $stmtProd->execute();
                    $resultProd = $stmtProd->get_result();

                    if($resultProd->num_rows===1){
                        $rowProd = $resultProd->fetch_assoc();
                        $stmtIng = $conn->prepare("SELECT idIngrediente FROM tricetta WHERE idProdotto = ?");
                        
                        $stmtIng->bind_param("i", $rowIdProd["idProdotto"]);
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
                        echo creaProd( $rowProd["nome"], $ingredienti,  $rowProd["prezzo"]);
                    } 
                    
                }
            } else {
                echo '<p > Il menu settimanale non è stato ancora creato </p>
                    <button  class="create-btn" title="Crea menu settimanale" 
                    onclick="openModal(\'modalCreateWeeklyMenu.php\')">CREARE MENU SETTIMANALE</button>';
            }
            ?>

            
        </div>

    </div>
    <div id="modal" class="modal">

    </div>

    <script src="../managementProducts.js?v=<?php echo time();?>"></script>
</body>

</html>