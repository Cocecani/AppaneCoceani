<?php
session_start();

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/utils.php';

if (!isset($_SESSION['user_id'])) {
    redirect(BASE_URL . '/AppaneCoceani/Account/login.php');
}

$cart = json_decode($_POST['cart'] ?? '{}', true);

if (empty($cart)) {
    redirect(BASE_URL . '/AppaneCoceani/FRONT/cart.php');
}

$user_id = $_SESSION['user_id'];

// get user's saved address ID
$stmtAddr = $conn->prepare("SELECT indirizzo FROM tutente WHERE idutente = ?");
$stmtAddr->bind_param("i", $user_id);
$stmtAddr->execute();
$addr = $stmtAddr->get_result()->fetch_assoc();
$id_indirizzo = $addr['indirizzo'] ?? null;

// if override address was submitted, insert it into tindirizzo
$override_via = trim($_POST['override_via'] ?? '');
if (!empty($override_via)) {
    $via       = $override_via;
    $civico    = trim($_POST['override_civico'] ?? '');
    $cap       = trim($_POST['override_cap'] ?? '');
    $citta     = trim($_POST['override_citta'] ?? '');
    $provincia = trim($_POST['override_provincia'] ?? '');

    $stmtIns = $conn->prepare("INSERT INTO tindirizzo (via, numeroCivico, CAP, citta, provincia) VALUES (?, ?, ?, ?, ?)");
    $stmtIns->bind_param("sssss", $via, $civico, $cap, $citta, $provincia);
    $stmtIns->execute();
    $id_indirizzo = $conn->insert_id;

    // only save as default if user has no address yet
    if (empty($addr['indirizzo'])) {
        $stmtUpd = $conn->prepare("UPDATE tutente SET indirizzo = ? WHERE idutente = ?");
        $stmtUpd->bind_param("ii", $id_indirizzo, $user_id);
        $stmtUpd->execute();
    }
}

// still no address? block checkout
if (!$id_indirizzo) {
    redirect(BASE_URL . '/AppaneCoceani/Account/profile.php?error=missing_address');
}

// INSERT one row per product
$stmt = $conn->prepare("INSERT INTO tordine (idUtente, idProdotto, quantita, totale, idIndirizzo, data) VALUES (?, ?, ?, ?, ?, NOW())");

foreach ($cart as $id => $item) {
    $id_prod = (int)$id;
    $qty     = (int)$item['quantity'];
    $totale  = round($item['prezzo'] * $qty, 2);

    $stmt->bind_param("iiidi", $user_id, $id_prod, $qty, $totale, $id_indirizzo);
    $stmt->execute();
}

redirect(BASE_URL . '/AppaneCoceani/index.php?popup=orderSuccess');
?>
W