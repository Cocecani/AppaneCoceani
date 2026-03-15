<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php'); // always works
require($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php'); // always works

if (!isset($_SESSION['user_id'])) {
    redirect('/FRONT/login.php');
}

$cart = json_decode($_POST['cart'] ?? '{}', true);

if (empty($cart)) {
    redirect('/FRONT/cart.php');
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

redirect('/index.php?popup=orderSuccess');
