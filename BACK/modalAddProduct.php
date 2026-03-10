<?php
    require('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../grafica/styleModalWindow.css">
</head>

<body>
    <div class="main-content">

        <form action="addProduct.php" method="post">
            
            <label>
                Nome del prodotto <br>
                <input type="text" name="nameProduct" placeholder="Pane Bianco" style="width: 100%;" required>
            </label>

            <div class="spaceBetween">
                <div style="width: 70%">
                    Ingredienti
                    <div id="containerIngredients">
                        <div class="input-row">
                            <select name="ingredients[]" required>
                                <option value="">Seleziona ingrediente</option>
                                <?php
                                    $result = $conn->query("SELECT nome FROM tingrediente");
                                    while($row = $result->fetch_assoc()){
                                        echo "<option value='{$row['nome']}'>{$row['nome']}</option>";
                                    }
                                ?>
                            </select>
                            <button type="button" class="remove-btn"> - </button>
                        </div>  
                    </div>
                        
                    <button type="button" id="add-ingredient" style="width: 100%;">+</button> 
                </div>
                      
                <div class="container">
                    <label>
                        Prezzo del prodotto(€) <br>
                        <input type="number" name="priceProduct" placeholder="6.67" step="0.01"  required>
                    </label>  
                </div>
                

            </div>
            

            <div class="spaceBetween">
                <button type="button" onclick="closeModalAdd()">CANCELLA</button>
                <button type="submit">AGGIUNGI</button>
            </div>
            
        </form>

    </div>

    <script src="addProduct.js"></script>
</body>

</html>