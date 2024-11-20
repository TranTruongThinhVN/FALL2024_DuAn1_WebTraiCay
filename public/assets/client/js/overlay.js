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
  const cartOverlay = document.getElementById("cartOverlay");

  // Kiểm tra nếu các phần tử tồn tại
  if (!cart || !cartOverlay) {
    console.error("cart hoặc cartOverlay không tồn tại.");
    return;
  }

  const isCartOpen = cart.classList.toggle("open");
  cartOverlay.classList.toggle("active", isCartOpen);

  document.body.classList.toggle("modal-open", isCartOpen);
}

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
