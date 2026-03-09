<?php
session_start();

require('../includes/db.php');
include('header.php');

/*$popup = $_GET['popup'] ?? null;
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
}*/

function creaProd($id, $nome, $ingredienti, $prezzo)
{
    // ingredienti is expected to be an array; join with commas for display
    $string_ingredienti = implode(', ', $ingredienti);
    return "<div class='prodotto' id=$id>
                <div>
                    <h2>$nome</h2>
                    <button class='cart-btn' style='float: right;' onclick='openModalWindow($id)'>
                        <img src='../grafica/img/cart.png' class='cart-icon' />
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
    <script src="js.js"></script>
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

            <button class="add-btn">+</button>
        </div>

    </div>


</body>

</html>