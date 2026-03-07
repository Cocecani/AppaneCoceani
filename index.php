<?php
session_start();

require('includes/db.php');
include('includes/header.php');

$popup = $_GET['popup'] ?? null;
switch ($popup) {
    case 'registrationSuccess':
        echo "<script>alert('Registrazione avvenuta con successo!')</script>";
        break;
    case 'loginSuccess':
        echo "<script>alert('Login avvenuto con successo!')</script>";
        break;
    case 'mailDupe':
        echo "<script>alert('Email già in uso, prova a loggarti o usa un\\'altra email!')</script>";
        break;
    case 'fail':
        echo "<script>alert('Si è verificato un errore, riprova più tardi!')</script>";
        break;
    case 'noUser':
        echo "<script>alert('Utente con questa mail non esiste, provane un altra')</script>";
        break;
    case 'wrongPassword':
        echo "<script>alert('Password non corretta!')</script>";
        break;
    case 'logout_success':
        echo "<script>alert('Logout avvenuto con successo!')</script>";
        break;
}

function creaProd($id, $nome, $ingredienti, $prezzo)
{
    // ingredienti is expected to be an array; join with commas for display
    $string_ingredienti = implode(', ', $ingredienti);
    return "<div class='prodotto'>
                <h2>$nome</h2>
                <p>$string_ingredienti</p>
                <p>€$prezzo</p>
                <div class='counter'>
                    <button class='counter-btn' onclick='decrement($id)'>-</button>
                    <span class='counter-value' id=$id>1</span>
                    <button class='counter-btn' onclick='increment($id)'>+</button>
                    <button class='cart-btn' onclick='addToCart()'>
                        <img src='grafica/img/cart.png' alt='Add to cart' class='cart-icon' />
                    </button>
                </div>
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
    <script src="js.js"></script>
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
                    $stmtProd = $conn->prepare("SELECT nome, prezzo FROM tprodotto WHERE id = ?");
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
                            echo creaProd($rowMenu["idprodotto"], $rowProd["nome"], $ingredienti,  $rowProd["prezzo"]);
                        }
                    }
                }
            } else {
                echo '<p> Non ci sono prodotti disponibili per l\'acquisto fino a giovedì</p>';
            }

            /*
            $sql = "SELECT id, nome, prezzo, FROM tprodotto";
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