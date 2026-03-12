<?php
session_start();

require('../../includes/db.php');
include('../header.php');

function createIngredient($name)
{
    return "<div class='prodotto'>
                <div>
                    <h2>$name</h2>
                    <button class='cart-btn' style='float: right;' title='Modifica prodotto' 
                        onclick='openModal(\"modalModifyIngredient.php?name=$name\")'>
                        <img src='../../grafica/img/pen.png' class='cart-icon' />
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
    <link rel="stylesheet" href="../../grafica/style.css?v=<?php echo time();?>">
</head>

<body>
    <div class="welcomeText">
        <h2>Benvenuto a il panificio di cui non potrai fare ammeno</h2>
    </div>
    <div class="main-content">
        <h1>Gestione di ingredienti</h1>
        <div class="menu">
            <?php
            $result = $conn->query("SELECT * FROM tingrediente");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo createIngredient($row["nome"]); 
                }
            } else {
                echo '<p> Per ora non ci sono ingredienti salvati </p>';
            }
            ?>

            
        </div>

    </div>
    <button class="add-btn" title="Aggiungi prodotto" onclick="openModal('modalAddIngredient.php')">+</button>

    <div id="modal" class="modal">

    </div>

    <script src="../managementProducts.js"></script>
</body>

</html>