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

function addToCart(id) {
  const quantity = parseInt(document.getElementById(id).textContent);
  let cart = getCart();
  cart[id] = quantity;
  saveCart(cart);
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


