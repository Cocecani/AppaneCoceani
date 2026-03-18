<div class="topbar">
    <h1>
        <?php
            if(file_exists("../managementProducts/managementProducts.php")){
                echo "<a href='../managementProducts/managementProducts.php' ";
            }else{
                echo "<a href='../BACK/managementProducts/managementProducts.php' ";
            }      
            echo "style='color: inherit; text-decoration: none;'>Appane</a>" ;   
        ?>
        
    </h1>


    <div style="margin: auto 0;">
        <?php
            if (isset($_SESSION['user_id'])) {
                echo "<span style='margin-right: 10px; color:#fff'>Ciao, " . htmlspecialchars($_SESSION['nome']) . "</span>";
                //echo "<a href='/FRONT/logout.php' class='button' style='margin-right: 10px;'>Logout</a>";
            }
        ?>
        <a  href="<?php
            if(file_exists("../../Account/profile.php")){
                echo "../../Account/profile.php";
            }else{
                echo "profile.php";
            }   
        ?>" 

        class="button" style="margin-right: 10px;">
            <?php
                if(file_exists("../../grafica/img/user.png")){
                    echo  "<img src='../../grafica/img/user.png' alt='user' class='header-icon'>";
                }else{
                    echo  "<img src='../grafica/img/user.png' alt='user' class='header-icon'>";
                }
                
            ?>
        </a>

    </div>


</div>

<div class="options">
    <?php
        $partUrl="";
        if(file_exists("../managementProducts/managementProducts.php")){
            $partUrl="../";
        }else{
            $partUrl="../BACK/";
        }          
    ?>
    <a  href="<?php echo $partUrl; ?>managementProducts/managementProducts.php" class="menu-option">Prodotti</a>
    <a  href="<?php echo $partUrl; ?>managementIngredients/managementIngredients.php" class="menu-option">Ingredienti</a>
    <a  href="<?php echo $partUrl; ?>managementWeeklyMenu/managementWeeklyMenu.php" class="menu-option">Menu Settimanale</a>
    <a  href="<?php echo $partUrl; ?>managementOrders/managementOrdersArrived.php" class="menu-option">Ordini Arrivati</a>
    <a  href="<?php echo $partUrl; ?>managementOrders/managementOrdersAccepted.php" class="menu-option">Ordini Accettati</a>
    <a  href="<?php echo $partUrl; ?>managementUsers/managementUsers.php" class="menu-option">Utenti</a>
    <a  href="<?php echo $partUrl; ?>managementSummary/managementSummary.php" class="menu-option">Riepilogo</a>
</div>