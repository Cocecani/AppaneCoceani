<?php
session_start();
require('../includes/db.php');
require('../includes/utils.php');

// Reindirizza al login se non loggato
if (!isset($_SESSION['user_id'])) {
    redirect("/FRONT/login.php");
}

$user_id = $_SESSION['user_id'];
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$numeroTelefonico = trim($_POST['numeroTelefonico'] ?? '');

// Validazione
if (empty($nome) || empty($email)) {
    redirect("/FRONT/edit-profile.php?popup=fail");
}

// Controlla se la nuova email esiste già (escludendo l'utente corrente)
$sql_check = "SELECT idutente FROM tutente WHERE email = ? AND idutente != ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("si", $email, $user_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    redirect("/FRONT/edit-profile.php?popup=emailExists");
}

// Aggiorna i dati
$sql_update = "UPDATE tutente SET nome = ?, email = ?, numeroTelefonico = ? WHERE idutente = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("sssi", $nome, $email, $numeroTelefonico, $user_id);

if ($stmt_update->execute()) {
    // Aggiorna la sessione
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    redirect("/FRONT/profile.php?popup=success");
} else {
    redirect("/FRONT/edit-profile.php?popup=fail");
}
