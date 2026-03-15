<?php 

    require('../../includes/db.php');
    require('../../includes/utils.php');

    $idProducts = $_REQUEST["products"];

    $conn->query("DELETE FROM tmenu");
    if (!empty($idProducts)) {

        $values = [];

        foreach ($idProducts as $id) {
            $values[] = "(" . intval($id) . ")";
        }

        $sql = "INSERT INTO tmenu (idProdotto) VALUES " . implode(",", $values);

        $conn->query($sql);
    }

    redirect("managementWeeklyMenu.php");

?>
