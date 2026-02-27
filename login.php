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
        <h1>Login</h1>
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="mario.rossi@gmail.com">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>