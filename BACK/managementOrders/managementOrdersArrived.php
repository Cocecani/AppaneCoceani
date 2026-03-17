<?php
session_start();

require('../../includes/db.php');
include('../header.php');

function createUser($name, $email, $phoneNumber)
{
    if($phoneNumber===null) $phoneNumber="ASSENTE";
    return "<div>
                <h2>$name</h2>
                <p>Email: $email</p>
                <p>Numero di telefono: $phoneNumber</p>
            </div>";
}

function createAddress($address, $number, $cap, $city, $province)
{
    return "<div>
                
                <p>Indirizzo: <br>$address, $number,
                $cap,
                $city,
                $province</p>
                
            </div>";
}

function createProd($idUser, $nameProd,  $price, $quantity, $total)
{
    $price=number_format($price, 2, '.', '');
    $total=number_format($total, 2, '.', '');
    return "<div>
                <h2>$nameProd</h2>
                <p> $quantity × $price € = $total € </p>
            </div>";
}



?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Appane</title>
    <link rel="stylesheet" href="../../grafica/style.css?v=<?php echo time();?>">
</head>

<body>
    <div class="main-content">
        <h1>Gestione di Ordini Arrivati</h1>

        <div>
            <?php
                
                $query="SELECT DISTINCT `idUtente` 
                        FROM `tordine` 
                        WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                        accettato IS NULL;";
                $result = $conn->query($query);
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        $idUser=$row["idUtente"];

                        $query="SELECT nome, email, numeroTelefonico 
                                FROM `tutente` 
                                WHERE idutente = ?";

                        $stmt = $conn->prepare($query);
                    
                        $stmt->bind_param("i",$idUser );
                        $stmt->execute();
                        $resultUser = $stmt->get_result();
                        if($resultUser->num_rows===1){
                            echo "<div class='order'>";
                            
                            echo "<div class='userInformation'>";
                            echo "<div>";


                            $user=$resultUser->fetch_assoc();
                            echo createUser($user["nome"],$user["email"],$user["numeroTelefonico"]);

                            $query="SELECT DISTINCT `idIndirizzo` 
                                    FROM `tordine` 
                                    WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                                    idUtente = ? AND accettato IS NULL";
                            
                            $stmt = $conn->prepare($query);
                    
                            $stmt->bind_param("i", $idUser);
                            $stmt->execute();
                            $resultAddress=$stmt->get_result();
                            if($resultAddress->num_rows===1){
                                $idAddress=$resultAddress->fetch_assoc()["idIndirizzo"];

                                $query="SELECT `via`, `numeroCivico`, `CAP`, `citta`, `provincia`
                                        FROM `tindirizzo` 
                                        WHERE id = ?;";
                            
                                $stmt = $conn->prepare($query);
                        
                                $stmt->bind_param("i", $idAddress);
                                $stmt->execute();

                                $resultAddress=$stmt->get_result();
                                $rowAddress=$resultAddress->fetch_assoc();

                                echo createAddress($rowAddress["via"],$rowAddress["numeroCivico"],
                                            $rowAddress["CAP"],$rowAddress["citta"],$rowAddress["provincia"]);
                                
                            }
                            echo "</div>";
                            echo "</div>";

                            //-------------------------------------

                            echo "<div class='container'>";

                            echo "<div class='level'>";
                            echo "<div class='listProducts'>";

                            $query="SELECT `idProdotto`, `prezzo`, `quantita`, `totale`
                                    FROM `tordine` 
                                    WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                                    idUtente = ? AND accettato IS NULL";
                            
                            $stmt = $conn->prepare($query);
                    
                            $stmt->bind_param("i", $idUser);
                            $stmt->execute();

                            $resultOrders=$stmt->get_result();
                            while($rowOrder=$resultOrders->fetch_assoc()){
                                $query="SELECT nome
                                        FROM `tprodotto` 
                                        WHERE id = ?;";

                                $stmt = $conn->prepare($query);
                    
                                $stmt->bind_param("i", $rowOrder["idProdotto"]);
                                $stmt->execute();
                                $resultProd=$stmt->get_result();
                                $nameProd=$resultProd->fetch_assoc()["nome"];

                                echo createProd($idUser, $nameProd, $rowOrder["prezzo"],$rowOrder["quantita"], $rowOrder["totale"]);
                            }

                            echo "</div>";

                            echo "<button class='cart-btn' title='Modifica ordine' 
                                    onclick='openModal(\"modalModifyOrder.php?idUser=$idUser\")'>
                                    <img src='../../grafica/img/pen.png' class='cart-icon' />
                                </button>";

                            echo "</div>";

                            
                             

                            $query="SELECT SUM(`totale`) AS totaleOrdine
                                    FROM `tordine` 
                                    WHERE data >= (CURDATE() - INTERVAL 1 DAY) + INTERVAL 15 HOUR AND
                                    idUtente = ? AND accettato IS NULL";
                            
                            $stmt = $conn->prepare($query);
                    
                            $stmt->bind_param("i", $idUser);
                            $stmt->execute();

                            $resultTotale=$stmt->get_result();
                            $totalOrder=$resultTotale->fetch_assoc()["totaleOrdine"];
                            $totalOrder=number_format($totalOrder, 2, '.', '');
                            echo "<div class='accept'>";

                                echo "<div class='level'>";
                                    echo "<h2>In totale: </h2>";
                                    echo "<h2> $totalOrder €</h2>";
                                echo "</div>";
                            
                                echo "<form action='acceptOrder.php?idUser=$idUser' method='post'>";
                                echo "<div class='buttons'>";
                                    echo "<button type='submit' name='refuse' class='btn'>
                                            NON ACCETTARE
                                        </button>";
                                    echo "<button type='submit' name='accept' class='btn'>
                                            ACCETTARE
                                        </button>";

                                echo "</div>";
                                echo "</form>";

                            echo "</div>";

                            echo "</div>";

                            

                            echo "</div>";
                        }
                    }
                }else{
                    echo "<p >Non ci sono ordini arrivati</p >";

                }
                

                
            ?>

            
        </div>

    </div>

    <div id="modal" class="modal">

    </div>

    <script src="../managementProducts.js?v=<?php echo time();?>"></script>
</body>

</html>
