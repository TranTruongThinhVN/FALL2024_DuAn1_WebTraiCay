function toggleLoginModal() {
  const loginModal = document.getElementById("loginModal");
  const loginOverlay = document.getElementById("loginOverlay");
  const signupModal = document.getElementById("signupModal");
  if (signupModal.classList.contains("active")) {
    signupModal.classList.remove("active");
  }
  const isLoginOpen = loginModal.classList.toggle("active");
  loginOverlay.classList.toggle("active", isLoginOpen);
  document.body.classList.toggle("modal-open", isLoginOpen);
}

function toggleSignupModal() {
  const signupModal = document.getElementById("signupModal");
  const loginModal = document.getElementById("loginModal");
  const loginOverlay = document.getElementById("loginOverlay");
  if (loginModal.classList.contains("active")) {
    loginModal.classList.remove("active");
  }
  const isSignupOpen = signupModal.classList.toggle("active");
  loginOverlay.classList.toggle("active", isSignupOpen);
  document.body.classList.toggle("modal-open", isSignupOpen);
}

function switchToSignup() {
  const loginModal = document.getElementById("loginModal");
  const signupModal = document.getElementById("signupModal");
  const overlay = document.getElementById("loginOverlay");
  loginModal.classList.remove("active");
  signupModal.classList.add("active");
  overlay.classList.add("active");
  document.body.classList.add("modal-open");
}

function switchToLogin() {
  const signupModal = document.getElementById("signupModal");
  const loginModal = document.getElementById("loginModal");
  const overlay = document.getElementById("loginOverlay");
  signupModal.classList.remove("active");
  loginModal.classList.add("active");
  overlay.classList.add("active");
  document.body.classList.add("modal-open");
}

function toggleOffcanvasCart() {
  const cart = document.getElementById("offcanvasCart");
  const overlay = document.getElementById("cartOverlay");

  // Bật/tắt class để hiển thị hoặc ẩn overlay và giỏ hàng
  cart.classList.toggle("open");
  overlay.classList.toggle("show");
}

// Đóng giỏ hàng khi nhấn ra ngoài
document.addEventListener("click", function (event) {
  const cart = document.getElementById("offcanvasCart");
  const overlay = document.getElementById("cartOverlay");
  const cartIcon = document.querySelector(".cart-icon");

  if (
    cart.classList.contains("open") && // Nếu giỏ hàng đang mở
    !cart.contains(event.target) && // Không nhấn vào giỏ hàng
    !cartIcon.contains(event.target) && // Không nhấn vào icon giỏ hàng
    !overlay.contains(event.target) // Không nhấn vào overlay
  ) {
    cart.classList.remove("open");
    overlay.classList.remove("show");
  }
});

function switchToSignup() {
  const loginModal = document.getElementById("loginModal");
  if (loginModal.classList.contains("active")) {
    loginModal.classList.remove("active");
  }
  const signupModal = document.getElementById("signupModal");
  signupModal.classList.add("active");
  const loginOverlay = document.getElementById("loginOverlay");
  loginOverlay.classList.add("active");
  document.body.classList.add("modal-open");
}

function toggleOffcanvasNavbar() {
  const navbar = document.getElementById("offcanvasNavbar");
  const isNavbarOpen = navbar.classList.toggle("open");
  document.body.classList.toggle("modal-open", isNavbarOpen);
}

function toggleSubMenu(menuId) {
  const subMenu = document.getElementById(menuId);

  if (window.innerWidth < 769) {
    if (subMenu.classList.contains("open")) {
      subMenu.classList.remove("open");
    } else {
      const allSubMenus = document.querySelectorAll(".sub-menu");
      allSubMenus.forEach((menu) => menu.classList.remove("open"));
      subMenu.classList.add("open");
    }
  }
}
// Tìm kiếm
function toggleSearchOverlay() {
  const searchOverlay = document.querySelector(".search-overlay");
  const overlaySearch = document.querySelector(".overlay-search");

  const isOpen = searchOverlay.classList.toggle("open");
  overlaySearch.classList.toggle("active", isOpen);

  document.body.classList.toggle("modal-open", isOpen);
}
