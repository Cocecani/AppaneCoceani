<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Appane login</title>
    <link rel="stylesheet" href="../grafica/stylelogin.css">
</head>

<body>
    <div class="topbar">
        <h1><a href="../index.php" style="color: inherit; text-decoration: none;">Appane</a></h1>

    </div>
    <div class="main-content">
        <?php
        $popup = $_GET['popup'] ?? null;
        switch ($popup) {
            case 'noUser':
                echo "<script>alert('Utente non trovato! Controlla l\\'email inserita.')</script>";
                break;
            case 'wrongPassword':
                echo "<script>alert('Password non corretta!')</script>";
                break;
        }
        ?>
        <form action="/logUser.php" method="post">
            <h1>Login</h1>
            <input type="email" name="email" placeholder="mario.rossi@gmail.com" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <a href="/FRONT/registrati.php" class="register-btn">Registrati</a>
        </form>
    </div>
</body>

</html>