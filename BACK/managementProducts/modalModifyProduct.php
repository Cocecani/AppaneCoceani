<?php
    require('../../includes/db.php');

    $idProd=$_REQUEST['id'];
    $nameProd=null;
    $priceProd=null;

    $stmt = $conn->prepare("SELECT nome, prezzo FROM tprodotto WHERE id = ?");
    $stmt->bind_param("s", $idProd);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows === 1){
        $rowProd = $result->fetch_assoc();
        $nameProd=$rowProd['nome'];
        $priceProd=$rowProd['prezzo'];
    }else{
        echo "<script>alert('Error')</script>";
    } 



    function createInputRowSelected($conn, $ingredient)
    {
        echo "<div class='input-row'>
                <select name='ingredients[]' required>
                    <option value=''>Seleziona ingrediente</option>";
        

        $result = $conn->query("SELECT id, nome FROM tingrediente ORDER BY nome");
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row['id']==$ingredient)
                    echo "<option value='{$row['id']}' selected>{$row['nome']}</option>";
                else
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
        }else{
            echo "<script>alert('Error')</script>";
        } 
                

        echo "  </select>
                <button type='button' class='remove-btn' title='Togli ingrediente'> - </button>
            </div>";

                       
    }
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../grafica/styleModalWindow.css?v=<?php echo time();?>">
</head>

<body>
    <div class="main-content">

        <form action="modifyProduct.php?id=<?php echo $idProd;?>" method="post">
            
            <label>
                Nome del prodotto <br>
                <input type="text" name="nameProduct" value="<?php echo $nameProd;?>" style="width: 100%;" required>
            </label>

            <div class="level">
                <div style="width: 70%">
                    Ingredienti
                    <div id="containerIngredients">
                        <?php
                            $stmt = $conn->prepare("SELECT idIngrediente FROM tricetta WHERE idProdotto = ?");
                            $stmt->bind_param("s", $idProd);
                            $stmt->execute();

                            $result = $stmt->get_result();
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    createInputRowSelected($conn, $row['idIngrediente']);
                                }
                            }else{
                                echo "<script>alert('Error')</script>";
                            } 
                        ?>

                    </div>
                        
                    <button type="button" id="add-ingredient" style="width: 100%;" title="Aggiungi ingrediente">+</button> 
                </div>
                      
                
                <label>
                    Prezzo del prodotto(€) <br>
                    <input type="number" name="priceProduct" value="<?php echo $priceProd;?>" step="0.01" min="0" required>
                </label>  
                
                

            </div>
            

            <div class="level buttons">
                <button type="button" onclick="closeModal()">CANCELLA</button>
                <button type="submit" name="delete">ELIMINA</button>
                <button type="submit" name="save">SALVA</button>
            </div>
            
        </form>

    </div>

    <script src="managementProducts.js"></script>
</body>

</html>