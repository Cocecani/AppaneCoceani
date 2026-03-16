<?php 
    require('../../includes/db.php');
    require('../../includes/utils.php');

    $idUser=$_REQUEST['idUser'];

    if(isset($_REQUEST['delivered'])){

        $query = "UPDATE tordine
                  SET consegnato=TRUE
                  WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                idUtente = ? AND accettato = TRUE AND consegnato IS NULL;";

        $stmt = $conn->prepare($query);         
        $stmt->bind_param("s", $idUser);
        $stmt->execute();

    }elseif(isset($_REQUEST['notDelivered'])){
        $query = "UPDATE tordine
                  SET consegnato=FALSE
                  WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                idUtente = ? AND accettato = TRUE AND consegnato IS NULL; ";

        $stmt = $conn->prepare($query);         
        $stmt->bind_param("s", $idUser);
        $stmt->execute();
    }


    redirect("managementOrdersAccepted.php");

    

?>