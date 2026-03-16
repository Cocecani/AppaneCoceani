<?php 
    require('../../includes/db.php');
    require('../../includes/utils.php');

    $idUser=$_REQUEST['idUser'];

    if(isset($_REQUEST['accept'])){

        $query = "UPDATE tordine
                  SET accettato=TRUE
                  WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                idUtente = ? AND accettato IS NULL ;";

        $stmt = $conn->prepare($query);         
        $stmt->bind_param("s", $idUser);
        $stmt->execute();

    }elseif(isset($_REQUEST['refuse'])){
        $query = "UPDATE tordine
                  SET accettato=FALSE
                  WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                idUtente = ? AND accettato IS NULL ";

        $stmt = $conn->prepare($query);         
        $stmt->bind_param("s", $idUser);
        $stmt->execute();
    }


    redirect("managementOrdersArrived.php");

    

?>
