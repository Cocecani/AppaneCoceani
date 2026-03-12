<?php
    require('../../includes/db.php');

    $nameIngredient=$_REQUEST['name'];

    $stmt = $conn->prepare("SELECT nome FROM tingrediente WHERE nome = ?");
    $stmt->bind_param("s", $nameIngredient);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $nameProd=$row['nome'];
    }else{
        echo "<script>alert('Error')</script>";
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

        <form action="modifyIngredient.php?oldName=<?php echo $nameIngredient;?>" method="post">
            
            <label>
                Nome del prodotto <br>
                <input type="text" name="nameIngredient" value="<?php echo $nameIngredient;?>" style="width: 100%;" required>
            </label>

            <div class="spaceBetween buttons">
                <button type="button" onclick="closeModal()">CANCELLA</button>
                <button type="submit" name="delete">ELIMINA</button>
                <button type="submit" name="save">SALVA</button>
            </div>
            
        </form>

    </div>

    <script src="../managementProducts.js"></script>
</body>

</html>