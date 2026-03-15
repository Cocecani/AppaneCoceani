<?php
session_start();

require('../../includes/db.php');
include('../header.php');

function createIngredient($id, $name)
{
    return "<div class='ingredient'>
                
                <h2>$name</h2>
                <button class='cart-btn' title='Modifica ingrediente' 
                    onclick='openModal(\"modalModifyIngredient.php?id=$id\")'>
                    <img src='../../grafica/img/pen.png' class='cart-icon' />
                </button>
                
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
        <div class="listIngredients">
            <?php
            $result = $conn->query("SELECT id, nome FROM tingrediente ORDER BY nome");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo createIngredient($row["id"], $row["nome"]); 
                }
            } else {
                echo '<p> Per ora non ci sono prodotti salvati </p>';
            }
            ?>

            
        </div>

    </div>
    <button class="add-btn" title="Aggiungi ingrediente" onclick="openModal('modalAddIngredient.php')">+</button>

    <div id="modal" class="modal">

    </div>

    <script src="../managementProducts.js?v=<?php echo time();?>"></script>
</body>

</html>