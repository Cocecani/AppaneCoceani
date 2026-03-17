<?php
    require('../../includes/db.php');

    $idUser=$_REQUEST['idUser'];

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



    function createInputRow( $idProduct, $nameProduct,  $price, $quantity,$total)
    { 
        echo "<div class='level'>";
        echo "<h2>$nameProduct</h2>";

        echo "<input type='number' class='quantity' data-price='$price' data-id='$idProduct' 
                name='$idProduct' value='$quantity' step='1' min='0'>";
        echo "<span id='total$idProduct'> × $price € =  $total € </span>";
        echo "</div>";

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

        <form action="modifyOrder.php?idUser=<?php echo $idUser;?>" method="post">
            
            
            <div id="container">
                <?php
                    $query="SELECT `idProdotto`, `prezzo`, `quantita`, `totale`
                            FROM `tordine` 
                            WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                            idUtente = ? AND accettato IS NULL";
                    
                    $stmt = $conn->prepare($query);
            
                    $stmt->bind_param("i", $idUser);
                    $stmt->execute();

                    $resultOrders=$stmt->get_result();
                    while($rowOrder=$resultOrders->fetch_assoc()){
                        $query="SELECT nome
                                FROM `tprodotto` 
                                WHERE id = ?;";

                        $stmt = $conn->prepare($query);
            
                        $stmt->bind_param("i", $rowOrder["idProdotto"]);
                        $stmt->execute();
                        $resultProd=$stmt->get_result();
                        $nameProd=$resultProd->fetch_assoc()["nome"];

                        createInputRow($rowOrder["idProdotto"], $nameProd, $rowOrder["prezzo"],
                                        $rowOrder["quantita"], $rowOrder["totale"] );
                    }


                ?>

            </div>

            <div class="level buttons">
                <button type="button" onclick="closeModal()">CANCELLA</button>
                <button type="submit" name="save">SALVA</button>
            </div>
            
        </form>

    </div>

    <script src="managementOrdersArrived.js"></script>
</body>

</html>