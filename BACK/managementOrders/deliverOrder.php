<?php 
    require('../../includes/db.php');
    require('../../includes/utils.php');

    $idUser=$_REQUEST['idUser'];

    if(isset($_REQUEST['delivered'])){

        $discount=$_REQUEST["discount"];

        $query="SELECT totale
                FROM `tordine` 
                WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                idUtente = ? AND accettato = TRUE AND consegnato IS NULL LIMIT 1;";
        
        $stmt = $conn->prepare($query);

        $stmt->bind_param("i", $idUser);
        $stmt->execute();

        $resultTotale=$stmt->get_result();
        $total=$resultTotale->fetch_assoc()["totale"];
        $total=$total-$discount;
        
        $query = "UPDATE tordine
                  SET sconto=?, totale=?
                  WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                    idUtente = ? AND accettato = TRUE AND consegnato IS NULL 
                    LIMIT 1;";

        $stmt = $conn->prepare($query);         
        $stmt->bind_param("sss", $discount,$total, $idUser);
        $stmt->execute();

        
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