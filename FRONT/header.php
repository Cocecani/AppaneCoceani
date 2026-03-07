<div class="topbar">
    <h1><a href="../index.php" style="color: inherit; text-decoration: none;">Appane</a></h1>
    <div style="margin: auto 0;">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo "<span style='margin-right: 10px; color:#fff'>Ciao, " . htmlspecialchars($_SESSION['nome']) . "</span>";
            //echo "<a href='../logout.php' class='button' style='margin-right: 10px;'>Logout</a>";
        }
        ?>
        <a href="<?php echo isset($_SESSION['user_id']) ? 'profile.php' : 'login.php'; ?>" class="button" style="margin-right: 10px;"><img src="../grafica/img/user.png" alt="user" class="header-icon"></a>
        <a href="../cart.php" class="button"><img src="../grafica/img/cart.png" alt="cart" class="header-icon"></a>
    </div>


</div>
