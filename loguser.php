<?php 
session_start();

require('includes/db.php');
require('includes/utils.php');

//appane@appane.com
//adminAppane

$email = trim($_SESSION['email']);
$psw = ($_SESSION['password']);

//controllo se esiste l'utente
$sql = "SELECT idutente, nome, password, email FROM `tutente` WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo $email;
        echo $psw;
        echo $user['password']."<br>";
        echo password_hash("1234", PASSWORD_DEFAULT)."<br>";
        echo password_hash("appane", PASSWORD_DEFAULT)."<br>";
        // Verifica la password con password_verify
        if (password_verify($psw, $user['password'])) {
                $_SESSION['user_id'] = $user['idutente'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['email'] = $user['email'];
                $_SESSION["password"]=null;
                if($user['email']==="admin@appane.it"){
                        redirect("BACK/managementProducts.php");  
                }else{
                    redirect("index.php?popup=loginSuccess");    
                }
                
        } else {
                redirect("FRONT/login.php?popup=wrongPassword");
        }
    
} else {
        redirect("FRONT/login.php?popup=noUser");
}

