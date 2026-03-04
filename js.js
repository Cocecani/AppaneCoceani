document.addEventListener("DOMContentLoaded", function () {
  function increment() {s
    const val = document.getElementById("value");
    val.textContent = parseInt(val.textContent) + 1;
  }

  function decrement() {
    const val = document.getElementById("value");
    const current = parseInt(val.textContent);
    if (current > 0) val.textContent = current - 1;
  }
});
