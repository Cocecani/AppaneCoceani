<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Appane registrazione</title>
    <link rel="stylesheet" href="../grafica/stylelogin.css">
</head>

<body>
    <div class="topbar">
<h1>Appane</h1>
    </div>
    <div class="main-content">
        <?php
        $popup = $_GET['popup'] ?? null;
        switch ($popup){
            case 'mailDupe':
                echo "<script>alert('Email già in uso, prova a loggarti o usa un\\'altra email!')</script>";
                break;
            case 'fail':
                echo "<script>alert('Si è verificato un errore, riprova più tardi!')</script>";
                break;
        }
        ?>
        <form action="/registrazione.php" method="post">
            <h1>Registrati</h1>

            <input type="email" name="email" placeholder="mario.rossi@gmail.com*" required>
            <input type="password" name="password" placeholder="Password*" required>
            <input type="text" name="nome" placeholder="Nome*" required>
            <input type="tel" name="telefono" placeholder="Numero di telefono">
            <p>* campi obbligatori</p>

            <input type="submit" value="Registrati">
            <a href="/FRONT/login.php" class="register-btn">Hai già un account? Accedi</a>
        </form>
    </div>
</body>

</html>
