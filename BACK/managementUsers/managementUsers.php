<?php

require('../../includes/db.php');
include('../header.php');

function createUser($name, $email, $phoneNumber)
{
    if($phoneNumber===null) $phoneNumber="ASSENTE";
    return "<div>
                <h2>$name</h2>
                <p>Email:<br>$email</p>
                <p>Numero di telefono: <br>$phoneNumber</p>
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
        <h1>Gestione di Utenti</h1>
        
        
            <?php
                $resultUser = $conn->query("SELECT nome, email, numeroTelefonico, indirizzo FROM `tutente`");

                if($resultUser->num_rows>0){
                    echo "<div class='listUsers'>";
                    while($user=$resultUser->fetch_assoc()){
                        echo "<div class='user'>";
                        echo "<img src='../../grafica/img/user.png' alt='user' class='userImg'>";

                        echo "<div class='userInformation'>";
                        echo "<div>";

                        echo createUser($user["nome"],$user["email"],$user["numeroTelefonico"]);

                        $query="SELECT `via`, `numeroCivico`, `CAP`, `citta`, `provincia`
                                FROM `tindirizzo` 
                                WHERE id = ?;";
                    
                        $stmt = $conn->prepare($query);
                
                        $stmt->bind_param("i", $user["indirizzo"]);
                        $stmt->execute();

                        $resultAddress=$stmt->get_result();
                        if($resultAddress->num_rows===1){
                            $rowAddress=$resultAddress->fetch_assoc();

                            echo createAddress($rowAddress["via"],$rowAddress["numeroCivico"],
                                    $rowAddress["CAP"],$rowAddress["citta"],$rowAddress["provincia"]);
                        }else{
                            echo "<div class='address'>
                                        <p>Indirizzo: <br> ASSENTE</p>
                                    </div>";
                        }
                        
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        
                        
                    }
                    echo "</div>";
                }else{
                    echo "<p>Non ci sono utenti registrati</p>";
                }
                            
                
            ?>

            
        

    </div>

    <div id="modal" class="modal">

    </div>

    
</body>

</html>
