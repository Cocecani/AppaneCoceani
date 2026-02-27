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

            ?>
        </div>

    </div>

</body>

</html>