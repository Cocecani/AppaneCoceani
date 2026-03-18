<?php 

    require('../../includes/db.php');
    require('../../includes/utils.php');

    $idProd=$_REQUEST['id'];
    $name=$_REQUEST["nameProduct"];
    $price=$_REQUEST["priceProduct"];
    $ingredients=$_REQUEST["ingredients"];

    if(isset($_REQUEST["delete"])){
        $stmt = $conn->prepare("DELETE FROM `tprodotto` WHERE id=?");
        $stmt->bind_param("s", $idProd);
        $stmt->execute();
    }elseif(isset($_REQUEST["save"])){
        $stmt = $conn->prepare("UPDATE `tprodotto` SET `nome`=?,`prezzo`=? WHERE id=?");
        $stmt->bind_param("sss", $name, $price, $idProd);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM `tricetta` WHERE idProdotto=?");
        $stmt->bind_param("s", $idProd);
        $stmt->execute();

        foreach($ingredients as $ingredient){
            $stmt = $conn->prepare("INSERT INTO `tricetta`(`idIngrediente`, `idProdotto`) VALUES (?,?)");
            $stmt->bind_param("ss", $ingredient, $idProd);
            $stmt->execute();
        }
    }

    redirect("managementProducts.php")


?>
