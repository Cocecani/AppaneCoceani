<?php 
session_start();

require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../config.php';

$email = trim($_POST['email']);
$psw = $_POST['password'];

$sql = "SELECT idutente, nome, password, email FROM `tutente` WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($psw, $user['password'])) {
        $_SESSION['user_id'] = $user['idutente'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION["password"] = null;

        $stmt = $conn->prepare("SELECT idUtente FROM `tadmin` WHERE idUtente = ?");
        $stmt->bind_param("i", $user['idutente']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            
            redirect(BASE_URL . '/BACK/managementProducts/managementProducts.php');
        } else {
            redirect(BASE_URL . '/Account/profile.php');
        }
    } else {
        redirect(BASE_URL . '/Account/login.php?popup=wrongPassword');
    }
} else {
    redirect(BASE_URL . '/Account/login.php?popup=noUser');
}
