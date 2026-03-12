<?php 
    session_start();

    require('../../includes/db.php');
    require('../../includes/utils.php');


    $oldname=$_REQUEST["oldName"];
    $newname=$_REQUEST["nameIngredient"];
    
    //echo $name."<br>";

    if(isset($_REQUEST["delete"])){
        //echo "delete<br>";

        $stmt = $conn->prepare("DELETE FROM `tingrediente` WHERE nome LIKE ?");
        $stmt->bind_param("s", $oldname);
        $stmt->execute();

    }elseif(isset($_REQUEST["save"])){
        //echo "save<br>";

        $stmt = $conn->prepare("UPDATE `tingrediente` SET `nome`=? WHERE nome LIKE ?");
        $stmt->bind_param("s", $newname, $oldname);
        $stmt->execute();

    }

    redirect("managementProducts.php")


?>
