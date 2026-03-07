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
$sql = "SELECT indirizzo FROM tutente WHERE idutente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Prendi i dati dell'indirizzo se esiste
$address = null;
if ($user['indirizzo']) {
    $sql_addr = "SELECT id, via, numeroCivico, CAP, citta, provincia FROM tindirizzo WHERE id = ?";
    $stmt_addr = $conn->prepare($sql_addr);
    $stmt_addr->bind_param("i", $user['indirizzo']);
    $stmt_addr->execute();
    $result_addr = $stmt_addr->get_result();
    $address = $result_addr->fetch_assoc();
}

$popup = $_GET['popup'] ?? null;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Modifica Indirizzo - Appane</title>
    <link rel="stylesheet" href="../grafica/stylelogin.css">
</head>
<body>
    <div class="topbar">
        <h1>Appane</h1>
    </div>
    <div class="main-content">
        <?php
        switch ($popup) {
            case 'success':
                echo "<script>alert('Indirizzo salvato con successo!')</script>";
                break;
            case 'fail':
                echo "<script>alert('Errore durante il salvataggio!')</script>";
                break;
        }
        ?>
        <form action="/FRONT/update-address.php" method="post">
            <h1><?php echo $address ? 'Modifica Indirizzo' : 'Aggiungi Indirizzo'; ?></h1>

            <label>Via</label>
            <input type="text" name="via" value="<?php echo htmlspecialchars($address['via'] ?? ''); ?>" required>

            <label>Numero Civico</label>
            <input type="text" name="numeroCivico" value="<?php echo htmlspecialchars($address['numeroCivico'] ?? ''); ?>" required>

            <label>CAP</label>
            <input type="text" name="CAP" maxlength="5" value="<?php echo htmlspecialchars($address['CAP'] ?? ''); ?>" required>

            <label>Città</label>
            <input type="text" name="citta" value="<?php echo htmlspecialchars($address['citta'] ?? ''); ?>" required>

            <label>Provincia</label>
            <input type="text" name="provincia" maxlength="4" value="<?php echo htmlspecialchars($address['provincia'] ?? ''); ?>" required>

            <input type="submit" value="Salva Indirizzo">
            <a href="profile.php" class="register-btn">Indietro</a>
        </form>
    </div>
</body>
</html>
