<?php
session_start();

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['user_id'])) {
    redirect(BASE_URL . '/AppaneCoceani/Account/login.php');
}

$cart = json_decode($_POST['cart'] ?? '{}', true);

if (empty($cart)) {
    redirect(BASE_URL . '/FRONT/cart.php');
}

$user_id = $_SESSION['user_id'];

// get user's address
$stmtAddr = $conn->prepare("SELECT indirizzo FROM tutente WHERE idutente = ?");
$stmtAddr->bind_param("i", $user_id);
$stmtAddr->execute();
$addr = $stmtAddr->get_result()->fetch_assoc();
$id_indirizzo = $addr['indirizzo'] ?? null;

// INSERT one row per product
$stmt = $conn->prepare("INSERT INTO tordine (idUtente, idProdotto, quantita, totale, idIndirizzo, data) VALUES (?, ?, ?, ?, ?, NOW())");

foreach ($cart as $id => $item) {
    $id_prod  = (int)$id;
    $qty      = (int)$item['quantity'];
    $totale   = round($item['prezzo'] * $qty, 2);

    $stmt->bind_param("iiidi", $user_id, $id_prod, $qty, $totale, $id_indirizzo);
    $stmt->execute();
}

redirect(BASE_URL . '/index.php?popup=orderSuccess');
