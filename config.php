<?php
// config.php — place at root
$protocol = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'];
$script   = $_SERVER['SCRIPT_NAME']; 

// Walk up to find project root by stripping path segments
$depth    = substr_count(dirname($script), '/') - 1;
$base     = implode('/', array_slice(explode('/', $script), 0, 2));

define('BASE_URL', $protocol . '://' . $host . $base);
?>
