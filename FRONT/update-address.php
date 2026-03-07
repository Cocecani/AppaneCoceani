<?php
session_start();
require('../includes/db.php');
require('../includes/utils.php');

// Reindirizza al login se non loggato
if (!isset($_SESSION['user_id'])) {
    redirect("/FRONT/login.php");
}

$user_id = $_SESSION['user_id'];
$via = trim($_POST['via'] ?? '');
$numeroCivico = trim($_POST['numeroCivico'] ?? '');
$CAP = trim($_POST['CAP'] ?? '');
$citta = trim($_POST['citta'] ?? '');
$provincia = trim($_POST['provincia'] ?? '');

// Validazione
if (empty($via) || empty($numeroCivico) || empty($CAP) || empty($citta) || empty($provincia)) {
    redirect("/FRONT/edit-address.php?popup=fail");
}

// Prendi l'indirizzo corrente dell'utente
$sql = "SELECT indirizzo FROM tutente WHERE idutente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['indirizzo']) {
    // UPDATE indirizzo esistente
    $sql_update = "UPDATE tindirizzo SET via = ?, numeroCivico = ?, CAP = ?, citta = ?, provincia = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssss", $via, $numeroCivico, $CAP, $citta, $provincia, $user['indirizzo']);
    
    if (!$stmt_update->execute()) {
        redirect("/FRONT/edit-address.php?popup=fail");
    }
} else {
    // INSERT nuovo indirizzo
    $sql_insert = "INSERT INTO tindirizzo (via, numeroCivico, CAP, citta, provincia) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssss", $via, $numeroCivico, $CAP, $citta, $provincia);
    
    if ($stmt_insert->execute()) {
        $address_id = $stmt_insert->insert_id;
        
        // Collega l'indirizzo all'utente
        $sql_link = "UPDATE tutente SET indirizzo = ? WHERE idutente = ?";
        $stmt_link = $conn->prepare($sql_link);
        $stmt_link->bind_param("ii", $address_id, $user_id);
        
        if (!$stmt_link->execute()) {
            redirect("/FRONT/edit-address.php?popup=fail");
        }
    } else {
        redirect("/FRONT/edit-address.php?popup=fail");
    }
}

redirect("/FRONT/profile.php?popup=success");
