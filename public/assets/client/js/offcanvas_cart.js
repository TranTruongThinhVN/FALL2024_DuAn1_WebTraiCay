function toggleOffcanvasCart() {
  const cart = document.getElementById("offcanvasCart");
  cart.classList.toggle("open");
}
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("offcanvasCart").classList.remove("open");
});

document.addEventListener("click", function (event) {
  const cart = document.getElementById("offcanvasCart");
  const cartIcon = document.querySelector(".cart-icon");

  if (
    cart.classList.contains("open") &&
    !cart.contains(event.target) &&
    !cartIcon.contains(event.target)
  ) {
    cart.classList.remove("open");
  }
});
