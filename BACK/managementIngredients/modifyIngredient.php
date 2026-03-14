<?php 
    session_start();

    require('../../includes/db.php');
    require('../../includes/utils.php');


    $idIngredient=$_REQUEST["id"];
    $nameIngredient=$_REQUEST["nameIngredient"];
    
    //echo $name."<br>";

    if(isset($_REQUEST["delete"])){
        //echo "delete<br>";

        $stmt = $conn->prepare("DELETE FROM `tingrediente` WHERE id LIKE ?");
        $stmt->bind_param("s", $idIngredient);
        $stmt->execute();

    }elseif(isset($_REQUEST["save"])){
        //echo "save<br>";

        $stmt = $conn->prepare("UPDATE `tingrediente` SET `nome`=? WHERE id LIKE ?");
        $stmt->bind_param("ss", $nameIngredient, $idIngredient);
        $stmt->execute();

    }

    redirect("managementIngredients.php")


?>
