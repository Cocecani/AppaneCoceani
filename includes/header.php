<div class="topbar">
    <h1><a href="/quintaf/coceani/AppaneCoceani/index.php" style="color: inherit; text-decoration: none;">Appane</a></h1>
    <div style="margin: auto 0;">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo "<span style='margin-right: 10px; color:#fff'>Ciao, " . htmlspecialchars($_SESSION['nome']) . "</span>";
        }
        ?>
        <a href="<?php echo isset($_SESSION['user_id']) ? 'Account/profile.php' : 'Account/login.php'; ?>" class="button" style="margin-right: 10px;">
            <img src="http://192.168.8.103/quintaf/coceani/AppaneCoceani/grafica/img/user.png" alt="user" class="header-icon">
        </a>
        <a href="http://192.168.8.103/quintaf/coceani/AppaneCoceani/FRONT/cart.php" class="button">
            <img src="http://192.168.8.103/quintaf/coceani/AppaneCoceani/grafica/img/cart.png" alt="cart" class="header-icon">
        </a>

    </div>


</div>