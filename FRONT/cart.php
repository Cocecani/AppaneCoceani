<?php
session_start();
require('../includes/db.php');
include('../includes/header.php');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Appane - Carrello</title>
    <link rel="stylesheet" href="../grafica/style.css">
</head>
<body>
    <script src="../js.js"></script>

    <div class="welcomeText">
        <h2>Il tuo carrello</h2>
    </div>

    <div class="main-content">
        <h1>Riepilogo ordine</h1>
        <div class="menu" id="cart-items"></div>

        <p style="text-align:center; color:#e4788e; font-size:1.3rem;">
            Totale: €<span id="cart-total">0.00</span>
        </p>

        <form id="cart-form" method="POST" action="checkout.php">
            <input type="hidden" id="cart-data" name="cart" />
            <div style="text-align:center; display:flex; justify-content:center; gap:15px; margin-top:20px;">
                <button type="button" class="counter-btn"
                    style="width:auto; border-radius:20px; padding:10px 25px;"
                    onclick="clearCart(); renderCart();">
                    Svuota
                </button>
                <button type="button" class="cart-btn"
                    style="width:auto; border-radius:20px; padding:10px 25px;"
                    onclick="submitCart()">
                        Conferma ordine
                </button>
            </div>
        </form>
    </div>

    <script>
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
