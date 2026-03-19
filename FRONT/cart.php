<?php
session_start();

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/utils.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/header.php';

$user_id = $_SESSION['user_id'] ?? null;
$address = null;

if ($user_id) {
    $sql = "SELECT idutente, indirizzo FROM tutente WHERE idutente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && $user['indirizzo']) {
        $sql_addr = "SELECT id, via, numeroCivico, CAP, citta, provincia FROM tindirizzo WHERE id = ?";
        $stmt_addr = $conn->prepare($sql_addr);
        $stmt_addr->bind_param("i", $user['indirizzo']);
        $stmt_addr->execute();
        $address = $stmt_addr->get_result()->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Appane - Carrello</title>
    <link rel="stylesheet" href="../grafica/style.css?v=<?php echo filemtime('../grafica/style.css'); ?>">
</head>

<body>
    <script src="../js.js"></script>

    <div class="welcomeText">
        <h2>Il tuo carrello</h2>
    </div>

    <div class="cart-wrapper">

        <!-- LEFT: Cart -->
        <div class="cart-main main-content">
            <h1>Riepilogo ordine</h1>
            <div class="menu" id="cart-items"></div>

            <p style="text-align:center; color:#e4788e; font-size:1.3rem;">
                Totale: €<span id="cart-total">0.00</span>
            </p>

            <form id="cart-form" method="POST" action="checkout.php">
                <input type="hidden" id="cart-data" name="cart" />
                <!-- passes the override address to checkout -->
                <input type="hidden" id="override-via" name="override_via" />
                <input type="hidden" id="override-civico" name="override_civico" />
                <input type="hidden" id="override-cap" name="override_cap" />
                <input type="hidden" id="override-citta" name="override_citta" />
                <input type="hidden" id="override-provincia" name="override_provincia" />

                <div style="text-align:center; display:flex; justify-content:center; gap:15px; margin-top:20px;">
                    <button type="button" class="counter-btn"
                        style="width:auto; border-radius:20px; padding:10px 25px;"
                        onclick="clearCart(); renderCart();">
                        Svuota
                    </button>
                    <button type="button" class="cart-btn"
                        style="width:auto; border-radius:20px; padding:10px 25px;"
                        onclick="submitCart();"
>
                        Conferma ordine
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT: Address Sidebar -->
<div class="address-sidebar">
    <h3>📍 Indirizzo di Consegna</h3>

    <div class="address-override">
        <input type="text" id="input-via" placeholder="Via"
            value="<?php echo htmlspecialchars($address['via'] ?? ''); ?>" />
        <input type="text" id="input-civico" placeholder="Numero Civico"
            value="<?php echo htmlspecialchars($address['numeroCivico'] ?? ''); ?>" />
        <input type="text" id="input-cap" placeholder="CAP"
            value="<?php echo htmlspecialchars($address['CAP'] ?? ''); ?>" />
        <input type="text" id="input-citta" placeholder="Città"
            value="<?php echo htmlspecialchars($address['citta'] ?? ''); ?>" />
        <input type="text" id="input-provincia" placeholder="Provincia"
            value="<?php echo htmlspecialchars($address['provincia'] ?? ''); ?>" />
        <button type="button" onclick="applyOverride()">
            <?php echo $address ? 'Usa questo indirizzo' : 'Salva e usa questo indirizzo'; ?>
        </button>
        
    </div>
    <p style="font-size:0.85rem; color:#888;">
        ⚠️ Confermare sempre l'indirizzo prima di confermare l'ordine!
    </p>
</div>


    </div>

    <script>
        function applyOverride() {
            const via = document.getElementById('input-via').value.trim();
            const civico = document.getElementById('input-civico').value.trim();
            const cap = document.getElementById('input-cap').value.trim();
            const citta = document.getElementById('input-citta').value.trim();
            const provincia = document.getElementById('input-provincia').value.trim();

            if (!via || !civico || !cap || !citta) {
                alert('Per favore compila almeno via, numero civico, CAP e città.');
                return;
            }

            document.getElementById('override-via').value = via;
            document.getElementById('override-civico').value = civico;
            document.getElementById('override-cap').value = cap;
            document.getElementById('override-citta').value = citta;
            document.getElementById('override-provincia').value = provincia;

            document.getElementById('address-confirm-msg').style.display = 'block';
        }

        function renderCart() {
            const cart = getCart();
            const container = document.getElementById('cart-items');
            container.innerHTML = '';

            if (Object.keys(cart).length === 0) {
                container.innerHTML = '<p style="text-align:center; color:#e4788e;">Il carrello è vuoto.</p>';
                document.getElementById('cart-total').textContent = '0.00';
                return;
            }

            let total = 0;
            Object.entries(cart).forEach(([id, item]) => {
                const subtotal = (item.prezzo * item.quantity).toFixed(2);
                total += parseFloat(subtotal);
                container.innerHTML += `
                    <div class="prodotto">
                        <h2>${item.nome}</h2>
                        <p>${item.ingredienti}</p>
                        <p>€${item.prezzo} × ${item.quantity} = <strong>€${subtotal}</strong></p>
                        <div class="counter">
                            <button class="counter-btn" onclick="changeQty(${id}, -1)">-</button>
                            <span class="counter-value">${item.quantity}</span>
                            <button class="counter-btn" onclick="changeQty(${id}, 1)">+</button>
                        </div>
                    </div>`;
            });

            document.getElementById('cart-total').textContent = total.toFixed(2);
        }

        function changeQty(id, delta) {
            let cart = getCart();
            const newQty = cart[id].quantity + delta;
            if (newQty <= 0) {
                removeFromCart(id);
            } else {
                cart[id].quantity = newQty;
                saveCart(cart);
            }
            renderCart();
        }

        renderCart();
    </script>
</body>
</html>
