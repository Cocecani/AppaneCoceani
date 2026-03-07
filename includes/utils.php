<?php
function redirect($url)
{
    header('Location: ' . $url);
    die();
}

function logout()
{
    session_destroy();
    redirect("../index.php?popup=logout_success");
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}
?>