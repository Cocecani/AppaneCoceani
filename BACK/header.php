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
    <a  href="../managementProducts/managementProducts.php" class="menu-option">Prodotti</a>
    <a  href="../managementIngredients/managementIngredients.php" class="menu-option">Ingredienti</a>
    <a  href="../managementWeeklyMenu/managementWeeklyMenu.php" class="menu-option">Menu Settimanale</a>
    <a  href="../managementOrders/managementOrders.php" class="menu-option">Ordini</a>
    <a  href="../managementUsers/managementUsers.php" class="menu-option">Utenti</a>
    <a  href="../managementSummary/managementSummary.php" class="menu-option">Riepilogo</a>
</div>