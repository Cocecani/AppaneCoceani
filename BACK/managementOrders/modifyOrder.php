<?php 

    require('../../includes/db.php');
    require('../../includes/utils.php');

    $idUser=$_REQUEST['idUser'];

    $query="SELECT `idProdotto`, `prezzo`, `quantita`
            FROM `tordine` 
            WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
            idUtente = ? AND accettato IS NULL";
    
    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $resultOrders=$stmt->get_result();
    //echo $idUser."<br>";
    while($rowOrder=$resultOrders->fetch_assoc()){

        $newQuantity=$_REQUEST[$rowOrder["idProdotto"]];
        //echo $newQuantity."<br>";
        if($newQuantity == 0){
            $query="DELETE FROM `tordine` 
                    WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                    idUtente = ? AND idProdotto = ? AND accettato IS NULL";
    
            $stmt = $conn->prepare($query);

            $stmt->bind_param("ii", $idUser,$rowOrder["idProdotto"] );
            $stmt->execute();
        }elseif($newQuantity!==$rowOrder["quantita"]){
            $query="UPDATE `tordine` 
                    SET quantita = ?, totale=?
                    WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                    idUtente = ? AND idProdotto = ? AND accettato IS NULL";
    
            $stmt = $conn->prepare($query);

            $totale=$newQuantity*$rowOrder["prezzo"];
            $stmt->bind_param("idii",$newQuantity, $totale, 
                                $idUser,$rowOrder["idProdotto"] );
            $stmt->execute();
        }

    }

    redirect("managementOrdersArrived.php")


?>
