<?php 
    session_start();

    require('../includes/db.php');
    require('../includes/utils.php');

    $idProd=$_REQUEST['id'];
    $name=$_REQUEST["nameProduct"];
    $price=$_REQUEST["priceProduct"];
    $ingredients=$_REQUEST["ingredients"];
    
    echo $idProd."<br>";
    echo $name."<br>";
    echo $price."<br>";
    print_r($ingredients);

    if(isset($_REQUEST["delete"])){
        echo "delete<br>";
        $stmt = $conn->prepare("DELETE FROM `tprodotto` WHERE id=?");
        $stmt->bind_param("s", $idProd);
        $stmt->execute();
    }elseif(isset($_REQUEST["save"])){
        echo "delete<br>";
        $stmt = $conn->prepare("UPDATE `tprodotto` SET `nome`=?,`prezzo`=? WHERE id=?");
        $stmt->bind_param("sss", $name, $price, $idProd);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM `tricetta` WHERE idProdotto=?");
        $stmt->bind_param("s", $idProd);
        $stmt->execute();

        foreach($ingredients as $ingredient){
            $stmt = $conn->prepare("INSERT INTO `tricetta`(`ingrediente`, `idProdotto`) VALUES (?,?)");
            $stmt->bind_param("ss", $ingredient, $idProd);
            $stmt->execute();
        }
    }

    redirect("managementProducts.php")


?>
