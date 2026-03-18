<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../grafica/style.css">
</head>
<div class="topbar">
    <h1><a href="<?= BASE_URL ?>/AppaneCoceani/index.php" style="color: inherit; text-decoration: none;">Appane</a></h1>
    <div style="margin: auto 0;">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo "<span style='margin-right: 10px; color:#fff'>Ciao, " . htmlspecialchars($_SESSION['nome']) . "</span>";
        }
        ?>
        <a href="<?= isset($_SESSION['user_id']) ? BASE_URL . '/AppaneCoceani/Account/profile.php' : BASE_URL . '/AppaneCoceani/Account/login.php'; ?>" class="button" style="margin-right: 10px;">
            <img src="<?= BASE_URL ?>/AppaneCoceani/grafica/img/user.png" alt="user" class="header-icon">
        </a>
        <a href="<?= BASE_URL ?>/AppaneCoceani/FRONT/cart.php" class="button">
            <img src="<?= BASE_URL ?>/AppaneCoceani/grafica/img/cart.png" alt="cart" class="header-icon">
        </a>
    </div>
</div>
