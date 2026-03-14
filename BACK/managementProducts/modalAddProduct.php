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

        <form action="addProduct.php" method="post">
            
            <label>
                Nome del prodotto <br>
                <input type="text" name="nameProduct" placeholder="Pane Bianco" style="width: 100%;" required>
            </label>

            <div class="level">
                <div style="width: 50%">
                    Ingredienti
                    <div id="containerItems">
                        <div class="input-row">
                            <select name="ingredients[]" required>
                                <option value="">Seleziona ingrediente</option>
                                <?php
                                    $result = $conn->query("SELECT id, nome FROM tingrediente ORDER BY nome");
                                    while($row = $result->fetch_assoc()){
                                        echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                                    }
                                ?>
                            </select>
                            <button type="button" class="remove-item" title="Togli ingrediente"> - </button>
                        </div>  
                    </div>
                        
                    <button type="button" id="add-item" style="width: 100%;" title="Aggiungi ingrediente">+</button> 
                </div>
                      
                
                <label>
                    Prezzo del prodotto(€) <br>
                    <input type="number" name="priceProduct" placeholder="6.67" step="0.01" min="0" required>
                </label>  
                
                

            </div>
            

            <div class="level buttons">
                <button type="button" onclick="closeModal()">CANCELLA</button>
                <button type="submit">AGGIUNGI</button>
            </div>
            
        </form>

    </div>

    <script src="managementProducts.js"></script>
</body>

</html>