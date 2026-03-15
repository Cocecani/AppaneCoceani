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

        <form action="createWeeklyMenu.php" method="post">

            <div class="level">
                
                <div style="width: 100%">
                    <div id="containerItems" style="max-height: 305px">
                        <div class="input-row">
                            <select name="products[]" required>
                                <option value="">Seleziona prodotto</option>
                                <?php
                                    $result = $conn->query("SELECT id, nome,prezzo FROM tprodotto ORDER BY nome");
                                    while($row = $result->fetch_assoc()){
                                        echo "<option value='{$row['id']}'>{$row['nome'] } - {$row['prezzo']}€</option>";
                                    }
                                ?>
                            </select>
                            <button type="button" class="remove-item" title="Togli prodotto"> - </button>
                        </div>  
                    </div>
                        
                    <button type="button" id="add-item" style="width: 100%;" title="Aggiungi prodotto">+</button> 
                </div>
            </div>
            

            <div class="level buttons">
                <button type="button" onclick="closeModal()">CANCELLA</button>
                <button type="submit">CREA</button>
            </div>
            
        </form>

    </div>

    <script src="managementProducts.js"></script>
</body>

</html>