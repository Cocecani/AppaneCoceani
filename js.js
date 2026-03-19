function increment(id) {
    const val = document.getElementById(id);
    val.textContent = parseInt(val.textContent) + 1;
}

function decrement(id) {
    const val = document.getElementById(id);
    const current = parseInt(val.textContent);
    if (current > 0) val.textContent = current - 1;
}

function getCart() {
    return JSON.parse(sessionStorage.getItem('cart')) || {};
}

function saveCart(cart) {
    sessionStorage.setItem('cart', JSON.stringify(cart));
}

// now accepts full product details
function addToCart(id, nome, prezzo, ingredienti) {
    const quantity = parseInt(document.getElementById(id).textContent);
    if (quantity === 0) return;
    let cart = getCart();
    cart[id] = { nome, prezzo, ingredienti, quantity };
    saveCart(cart);
    //alert(`"${nome}" aggiunto al carrello!`);
}

function removeFromCart(id) {
    let cart = getCart();
    delete cart[id];
    saveCart(cart);
}

function clearCart() {
    sessionStorage.removeItem('cart');
}

function submitCart() {
    document.getElementById('cart-data').value = JSON.stringify(getCart());
    document.getElementById('cart-form').submit();
}
