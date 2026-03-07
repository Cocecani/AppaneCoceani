<?php
session_start();

require('includes/db.php');
require('includes/utils.php');

//Signor Appane
//adminAppane

$nome = trim($_POST['nome']);
$psw = ($_POST['password']);
$hashed_password = password_hash($psw, PASSWORD_DEFAULT);
$email = trim($_POST['email']);
$telefono = null;
$telefono = trim($_POST['telefono']);

//controllo se esiste già
$sql = "SELECT email FROM tutente WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    redirect("/FRONT/registrati.php?popup=mailDupe");
} else {
    $sqlInsert = "INSERT INTO `tutente`(`nome`, `password`, `email`, `numeroTelefonico`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->bind_param("ssss", $nome, $hashed_password, $email, $telefono);

    if ($stmt->execute()) {
        $sqlId = "SELECT idutente FROM tutente WHERE email = ?";
        $stmt = $conn->prepare($sqlId);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['idutente'];
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            redirect("/index.php?popup=registrationSuccess");
        }
    } else {
        redirect("/FRONT/registrati.php?popup=fail");
    }
}

redirect("/FRONT/registrati.php?popup=fail");
