<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Appane registrazione</title>
    <link rel="stylesheet" href="grafica/stylelogin.css">
</head>

<body>
    <div class="topbar">
<h1>Appane</h1>
    </div>
    <div class="main-content">
        <form action="registrazione.php" method="post">
            <h1>Registrati</h1>

            <input type="email" name="email" placeholder="mario.rossi@gmail.com*" required>
            <input type="password" name="password" placeholder="Password*" required>
            <input type="text" name="nome" placeholder="Nome*" required>
            <input type="tel" name="telefono" placeholder="Numero di telefono">
            <p>* campi obbligatori</p>

            <input type="submit" value="Registrati">
            <a href="login.php" class="register-btn">Hai già un account? Accedi</a>
        </form>
    </div>
</body>

</html>
