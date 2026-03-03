<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Appane login</title>
    <link rel="stylesheet" href="grafica/stylelogin.css">
</head>

<body>
    <div class="topbar">
        <img src="grafica/img/Appane_logo.png" alt="Appane_logo" class="logo">
        <h1>Appane</h1>
    </div>
    <div class="main-content">
    <form action="login.php" method="post">
        <h1>Login</h1>
        <input type="email" name="email" placeholder="mario.rossi@gmail.com">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
        <a href="registrazione.php" class="register-btn">Registrati</a>
    </form>
</div>
</body>

</html>