<?php 
    require('../../includes/db.php');
    require('../../includes/utils.php');


    $idIngredient=$_REQUEST["id"];
    $nameIngredient=$_REQUEST["nameIngredient"];

    if(isset($_REQUEST["delete"])){

        $stmt = $conn->prepare("DELETE FROM `tingrediente` WHERE id LIKE ?");
        $stmt->bind_param("s", $idIngredient);
        $stmt->execute();

    }elseif(isset($_REQUEST["save"])){

        $stmt = $conn->prepare("UPDATE `tingrediente` SET `nome`=? WHERE id LIKE ?");
        $stmt->bind_param("ss", $nameIngredient, $idIngredient);
        $stmt->execute();

    }

    redirect("managementIngredients.php")

?>
