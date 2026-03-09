<?php
    require('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../grafica/stylelogin.css">
</head>

<body>
    <div class="main-content">

        <form action="" method="post">
            <label>
              Nome del prodotto
              <input type="text" name="nome" placeholder="Pane Bianco" required>
            </label>
            
            <div id="ingredienti-container">
                <div class="input-row">
                <select name="ingredienti[]">
                    <option value="">Seleziona ingrediente</option>
                    <?php
                        $result = $conn->query("SELECT id, nome FROM tingrediente");
                        while($row = $result->fetch_assoc()){
                            echo "<option value='{$row['nome']}'>{$row['nome']}</option>";
                        }
                    ?>
                </select>
                <button type="button" class="remove-btn">-</button>
                </div>
            </div>
            
            <button type="button" id="add-ingredient">+</button>

            <div class="input-row">
                <label>Prezzo totale (€)</label>
                <input type="number" name="prezzo" placeholder="6.67" step="0.01" required>
            </div>

            <div class="buttons">
                <button type="button" class="cancel-btn" onclick="chiudiModal()">CANCELLA</button>
                <button type="submit" class="add-btn">AGGIUNGI</button>
            </div>
            
        </form>

    </div>
</body>

</html>