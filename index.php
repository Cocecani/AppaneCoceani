<?php
session_start();

require('db.php');
include('header.php');

function creaProd($nome, $ingredienti, $quantita, $prezzo)
{
    // ingredienti is expected to be an array; join with commas for display
    $string_ingredienti = implode(', ', $ingredienti);
    return "<div class='prodotto'>
                <h2>$nome</h2>
                <p>$string_ingredienti</p>
                <p>$quantita</p>
                <p>€$prezzo</p>
            </div>";
}

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Appane</title>
    <link rel="stylesheet" href="grafica/style.css">
</head>

<body>
    <div class="welcomeText">
        <h2>Benvenuto a il panificio di cui non potrai fare ammeno</h2>
    </div>
    <div class="main-content">
        <h1>Menù settimanale</h1>
        <div class="menu">
            <?php
            $sqlMenu = "SELECT * FROM tmenu";
            $resultMenu = $conn->query($sqlMenu);

            if ($resultMenu->num_rows > 0) {
                while ($rowMenu = $resultMenu->fetch_assoc()) {
                    $stmtProd = $conn->prepare("SELECT nome, prezzo, quantità FROM tprodotto WHERE id = ?");
                    $stmtProd->bind_param("i", $rowMenu["idprodotto"]);
                    $stmtProd->execute();
                    $resultProd = $stmtProd->get_result();
                    if ($resultProd->num_rows > 0) {
                        while ($rowProd = $resultProd->fetch_assoc()) {
                            $stmtIng = $conn->prepare("SELECT ingrediente FROM tricetta WHERE idProdotto = ?");
                            $stmtIng->bind_param("i", $rowMenu["idprodotto"]);
                            $stmtIng->execute();
                            $resultI = $stmtIng->get_result();
                            $ingredienti = [];
                            while ($rowI = $resultI->fetch_assoc()) {
                                $ingredienti[] = $rowI['ingrediente'];
                            }
                            echo creaProd($rowProd["nome"], $ingredienti, $rowProd["quantità"], $rowProd["prezzo"]);
                        }
                    }
                }
            } else {
                echo '<p> Non ci sono prodotti disponibili per l\'acquisto fino a giovedì</p>';
            }

/*
            $sql = "SELECT id, nome, prezzo, quantità FROM tprodotto";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stmt = $conn->prepare("SELECT ingrediente FROM tricetta WHERE idProdotto = ?");
                    $stmt->bind_param("i", $row["id"]);
                    $stmt->execute();
                    $resultI = $stmt->get_result();
                    $ingredienti = [];
                    while ($rowI = $resultI->fetch_assoc()) {
                        $ingredienti[] = $rowI['ingrediente'];
                    }
                    echo creaProd($row["nome"], $ingredienti, $row["quantità"], $row["prezzo"]);
                }
            } else {
                echo "non ci sono prodotti disponibili";
            }
*/

            ?>
        </div>

    </div>

</body>

</html>