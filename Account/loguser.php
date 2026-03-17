<?php 
session_start();

require('../includes/db.php');
require('../includes/utils.php');


$email = trim($_POST['email']);
$psw = $_POST['password'];

//controllo se esiste l'utente
$sql = "SELECT idutente, nome, password, email FROM `tutente` WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifica la password con password_verify
        if (password_verify($psw, $user['password'])) {
                $_SESSION['user_id'] = $user['idutente'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['email'] = $user['email'];
                $_SESSION["password"]=null;

                $stmt = $conn->prepare("SELECT idUtente FROM `tadmin` WHERE idUtente = ?");
                $stmt->bind_param("i", $user['idutente']);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows===1){
                        redirect("/BACK/managementProducts/managementProducts.php");  
                }else{
                        redirect("profile.php");
    
                }
                
        } else {
                redirect("/Account/login.php?popup=wrongPassword");
        }
    
} else {
        redirect("/Account/login.php?popup=noUser");
}

