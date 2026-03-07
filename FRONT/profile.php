<?php
session_start();
require('../includes/db.php');
require('../includes/utils.php');

// Reindirizza al login se non loggato
if (!isset($_SESSION['user_id'])) {
    redirect("/FRONT/login.php");
}

$user_id = $_SESSION['user_id'];

// Prendi i dati dell'utente
$sql = "SELECT idutente, nome, email, numeroTelefonico, indirizzo FROM tutente WHERE idutente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    redirect('/index.php');
}

// Prendi i dati dell'indirizzo se esiste
$address = null;
if ($user['indirizzo']) {
    $sql_addr = "SELECT id, via, numeroCivico, CAP, citta, provincia FROM tindirizzo WHERE id = ?";
    $stmt_addr = $conn->prepare($sql_addr);
    $stmt_addr->bind_param("i", $user['indirizzo']);
    redirect("index.php?". $user['indirizzo']);
    $stmt_addr->execute();
    $result_addr = $stmt_addr->get_result();
    $address = $result_addr->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Profilo - Appane</title>
    <link rel="stylesheet" href="../grafica/style.css">
    
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="profile-container">
        <h1>Il mio profilo</h1>
        
        <div class="profile-section">
            <h2>Dati Personali</h2>
            <div class="profile-item">
                <label>Nome:</label>
                <span><?php echo htmlspecialchars($user['nome']); ?></span>
            </div>
            <div class="profile-item">
                <label>Email:</label>
                <span><?php echo htmlspecialchars($user['email']); ?></span>
            </div>
            <div class="profile-item">
                <label>Telefono:</label>
                <span><?php echo $user['numeroTelefonico'] ? htmlspecialchars($user['numeroTelefonico']) : 'Non inserito'; ?></span>
            </div>
                <a href="edit-profile.php" class="btn">Modifica</a>
            
        </div>

        <div class="profile-section">
            <h2>Indirizzo di Consegna</h2>
            <?php if ($address): ?>
                <div class="profile-item">
                    <label>Via:</label>
                    <span><?php echo htmlspecialchars($address['via']); ?></span>
                </div>
                <div class="profile-item">
                    <label>Numero Civico:</label>
                    <span><?php echo htmlspecialchars($address['numeroCivico']); ?></span>
                </div>
                <div class="profile-item">
                    <label>CAP:</label>
                    <span><?php echo htmlspecialchars($address['CAP']); ?></span>
                </div>
                <div class="profile-item">
                    <label>Città:</label>
                    <span><?php echo htmlspecialchars($address['citta']); ?></span>
                </div>
                <div class="profile-item">
                    <label>Provincia:</label>
                    <span><?php echo htmlspecialchars($address['provincia']); ?></span>
                </div>
            <?php else: ?>
                <p>Nessun indirizzo aggiunto.</p>
            <?php endif; ?>
                <a href="edit-address.php" class="btn">Modifica Indirizzo</a>
            
        </div>

            <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>

</body>
</html>
