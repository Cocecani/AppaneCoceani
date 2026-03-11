<div class="topbar">
    <h1><a href="index.php" style="color: inherit; text-decoration: none;">Appane</a></h1>
    <div style="margin: auto 0;">
        <?php
            if (isset($_SESSION['user_id'])) {
                echo "<span style='margin-right: 10px; color:#fff'>Ciao, " . htmlspecialchars($_SESSION['nome']) . "</span>";
                //echo "<a href='/FRONT/logout.php' class='button' style='margin-right: 10px;'>Logout</a>";
            }
        ?>
        <a  href="<?php echo isset($_SESSION['user_id']) ? '../../FRONT/profile.php' : './FRONT/login.php'; ?>" 
        class="button" style="margin-right: 10px;">
            <img src="../../grafica/img/user.png" alt="user" class="header-icon">
        </a>

    </div>


</div>

<div class="options">
    <a  href="../BACK/managementProducts/managementProducts.php" class="menu-option">Prodotti</a>
    <a  href="../BACK/managementIngredients/managementIngredients.php" class="menu-option">Ingredienti</a>
    <a  href="../BACK/managementWeeklyMenu/managementWeeklyMenu.php" class="menu-option">Menu Settimanale</a>
    <a  href="../BACK/managementOrders/managementOrders.php" class="menu-option">Ordini</a>
    <a  href="../BACK/managementUsers/managementUsers.php" class="menu-option">Utenti</a>
    <a  href="../BACK/managementSummary/managementSummary.php" class="menu-option">Riepilogo</a>
</div>