<?php 
    session_start();

    require('../../includes/db.php');
    require('../../includes/utils.php');

    $name=$_REQUEST["nameProduct"];
    $price=$_REQUEST["priceProduct"];
    $ingredients=$_REQUEST["ingredients"];

    /*echo $name."<br>";
    echo $price."<br>";
    print_r($ingredients);*/
    

    $stmtProd = $conn->prepare("SELECT nome FROM tprodotto WHERE nome LIKE ?");
    $stmtProd->bind_param("s", $name);
    $stmtProd->execute();

    $resultProd = $stmtProd->get_result();
    if ($resultProd->num_rows > 0) {
        echo $resultProd->num_rows."<br>";
        echo $resultProd->fetch_assoc()["nome"];
        echo "<script>alert('Prodotto con questo nome già esiste')</script>"; 
    }else{
        $stmtProd = $conn->prepare("INSERT INTO `tprodotto`(`nome`, `prezzo`) VALUES (?,?)");
        $stmtProd->bind_param("ss", $name, $price);
        $stmtProd->execute();

        $stmtProd = $conn->prepare("SELECT id FROM tprodotto WHERE nome LIKE?");
        $stmtProd->bind_param("s", $name);
        $stmtProd->execute();

        $resultProd = $stmtProd->get_result();
        if($resultProd->num_rows === 1){
            $rowProd = $resultProd->fetch_assoc();
            foreach($ingredients as $ingredient){
                $stmtProd = $conn->prepare("INSERT INTO `tricetta`(`ingrediente`, `idProdotto`) VALUES (?,?)");
                $stmtProd->bind_param("ss", $ingredient, $rowProd["id"]);
                $stmtProd->execute();
            }

        }else{
            echo "<script>alert('Error')</script>";
        } 
    }
    redirect("managementProducts.php");

    

?>
