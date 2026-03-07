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
$sql = "SELECT idutente, nome, email, numeroTelefonico FROM tutente WHERE idutente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$popup = $_GET['popup'] ?? null;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Modifica Profilo - Appane</title>
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
                echo "<script>alert('Profilo aggiornato con successo!')</script>";
                break;
            case 'fail':
                echo "<script>alert('Errore durante l\\'aggiornamento!')</script>";
                break;
        }
        ?>
        <form action="/FRONT/update-profile.php" method="post">
            <h1>Modifica Profilo</h1>

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label>Telefono</label>
            <input type="tel" name="numeroTelefonico" value="<?php echo htmlspecialchars($user['numeroTelefonico'] ?? ''); ?>">

            <input type="submit" value="Salva Modifiche">
            <a href="profile.php" class="register-btn">Indietro</a>
        </form>
    </div>
</body>
</html>
