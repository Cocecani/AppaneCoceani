<?php
    require('../../includes/db.php');
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../grafica/styleModalWindow.css?v=<?php echo time();?>">
</head>

<body>
    <div class="main-content">

        <form action="addIngredient.php" method="post">
            
            <label>
                Nome del prodotto <br>
                <input type="text" name="nameIngredient" placeholder="Farina" style="width: 100%;" required>
            </label>

            <div class="level buttons">
                <button type="button" onclick="closeModal()">CANCELLA</button>
                <button type="submit">AGGIUNGI</button>
            </div>
            
        </form>

    </div>

    <script src="../managementProducts.js"></script>
</body>

</html>