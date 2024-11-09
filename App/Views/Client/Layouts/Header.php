<?php

namespace App\Views\Client\Layouts;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Header extends BaseView
{
  public static function render($data = null)
  {


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <!-- Font Awe -->
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
      <link rel="stylesheet" href="<?= APP_URL ?>/public/styles/main.css">


    </head>

    <body>

      <header class="header">
        <!-- Topbar -->
        <div class="marquee-container">
          <div class="marquee-content">
            <ul class="marquee-list">
              <li>
                <i class="fas fa-apple-alt"></i> Trái cây tươi ngon - Được chọn
                lọc kỹ càng!
              </li>
              <li>
                <i class="fas fa-percent"></i> Ưu đãi giảm 20% cho đơn hàng đầu
                tiên
              </li>
              <li><i class="fas fa-truck"></i> Miễn phí giao hàng nội thành</li>
              <li><i class="fas fa-credit-card"></i> Hỗ trợ thanh toán online</li>
              <li><i class="fas fa-clock"></i> Giao hàng nhanh trong 24h</li>
              <li>
                <i class="fas fa-check-circle"></i> Chất lượng đảm bảo tuyệt đối
              </li>
            </ul>
            <ul class="marquee-list">
              <li>
                <i class="fas fa-apple-alt"></i> Trái cây tươi ngon - Được chọn
                lọc kỹ càng!
              </li>
              <li>
                <i class="fas fa-percent"></i> Ưu đãi giảm 20% cho đơn hàng đầu
                tiên
              </li>
              <li><i class="fas fa-truck"></i> Miễn phí giao hàng nội thành</li>
              <li><i class="fas fa-credit-card"></i> Hỗ trợ thanh toán online</li>
              <li><i class="fas fa-clock"></i> Giao hàng nhanh trong 24h</li>
              <li>
                <i class="fas fa-check-circle"></i> Chất lượng đảm bảo tuyệt đối
              </li>
            </ul>
          </div>
        </div>
        <!-- Navbar -->
        <div class="header-bottom">
          <div class="main-container">
            <div class="navbar">
              <!-- Hamburger Menu Icon for Mobile -->
              <button class="menu-toggle icon" onclick="toggleOffcanvasNavbar()">
                <i class="fas fa-bars"></i>
              </button>

              <div class="logo">
                <a href="/"> <img src="<?= APP_URL ?>public/assets/client/images/home/logo (1).png" alt="Logo đây nhé " /></a>
              </div>
              <ul class="menu">
                <li><a href="/">Trang chủ</a></li>
                <li>
                  <a href="/products">Sản phẩm<i class="fas fa-chevron-down"></i></a>
                  <div class="sub-menu">
                    <a href="./sanpham.html">Trái Ngon Hôm Nay</a>
                    <a href="./sanpham.html">Trái Cây Việt Nam</a>
                    <a href="./sanpham.html">Trái Cây Nhập Khẩu</a>
                    <a href="./sanpham.html">Trái Cây Cắt Sẵn</a>
                    <a href="">Quà Tặng Trái Cây</a>
                  </div>
                </li>
                <li>
                  <a href="#">Về Chúng Tôi<i class="fas fa-chevron-down"></i></a>
                  <div class="sub-menu">
                    <a href="/introduce">Giới thiệu</a>
                    <a href="/store">Cửa hàng</a>
                    <a href="/Policy">Chính sách & Ưu đãi</a>
                  </div>
                </li>
                <li>
                  <a href="/Culinary_roots">Góc Ẩm Thực</a>
                </li>
                <li><a href="/news">Tin Tức</a></li>
                <li><a href="/contact">Liên hệ</a></li>
              </ul>
              <div class="navbar-icons">
                <div class="search-icon-container">
                  <a href="javascript:void(0);" class="icon" onclick="toggleSearchOverlay()">
                    <svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 22 22">
                      <circle cx="11" cy="10" r="7" fill="none" stroke="currentColor"></circle>
                      <path d="m16 15 3 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </a>
                </div>

                <a href="javascript:void(0);" class="icon cart-icon" onclick="toggleOffcanvasCart()">
                  <svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-cart" viewBox="0 0 22 22">
                    <path d="M11 7H3.577A2 2 0 0 0 1.64 9.497l2.051 8A2 2 0 0 0 5.63 19H16.37a2 2 0 0 0 1.937-1.503l2.052-8A2 2 0 0 0 18.422 7H11Zm0 0V1" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </a>
                <a href="javascript:void(0);" class="icon" onclick="toggleLoginModal()">
                  <svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-account" viewBox="0 0 22 22">
                    <circle cx="11" cy="7" r="4" fill="none" stroke="currentColor"></circle>
                    <path d="M3.5 19c1.421-2.974 4.247-5 7.5-5s6.079 2.026 7.5 5" fill="none" stroke="currentColor" stroke-linecap="round"></path>
                  </svg>
                </a>


                <!--  -->
              </div>
            </div>
            <div class="offcanvas-cart" id="offcanvasCart">
              <div class="offcanvas-cart-header">
                <h2>Giỏ hàng</h2>
                <span class="offcanvas-cart-close" onclick="toggleOffcanvasCart()"><i class="fa-solid fa-xmark"></i></span>
              </div>
              <div class="offcanvas-cart-body">
                <p class="free-shipping-text">Bạn được giao hàng miễn phí!</p>
                <hr>
                <div class="cart-item">
                  <img src="<?= APP_URL ?>public/assets/client/images/home/hong_gion_da_lat.webp" alt="Product 1">
                  <div class="item-details">
                    <h4>Hồng giòn Fuji Đà Lạt</h4>
                    <span>125.000đ</span>
                    <span>Xuất xứ : Cuba </span>
                  </div>
                  <div class="item-quantity-container">
                    <input type="text" value="1" class="item-quantity">
                    <a href="#" class="remove-item">Bỏ</a>
                  </div>
                </div>
                <div class="cart-item">
                  <img src="<?= APP_URL ?>public/assets/client/images/home/dao_tien_uc.webp" alt="Product 1">
                  <div class="item-details">
                    <h4>Đào tiên Úc</h4>
                    <span>325.000.000đ</span>
                    <span>Xuất xứ : Úc</span>
                  </div>
                  <div class="item-quantity-container">
                    <input type="text" value="1" class="item-quantity">
                    <a href="#" class="remove-item">Bỏ</a>
                  </div>
                </div>
              </div>
              <div class="offcanvas-cart-footer">
                <div class="cart-total">
                  <h4>Tổng</h4>
                  <p>4.440.000 VND</p>
                </div>
                <p class="desc-offcanvas-footer">
                  Đã bao gồm thuế
                </p>
                <p class="desc-offcanvas-footer">
                  Phí ship sẽ được tính khi thanh toán
                </p>
                <div class="cta-button-offcanvas">
                  <a class="cta-button view-cart-btn" href="/cart">Xem giỏ hàng</a>
                  <a class="cta-button checkout-btn">Thanh toán</a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="overlay" id="cartOverlay" onclick="toggleOffcanvasCart()"></div>
        <!-- Login Modal -->
        <div class="login-modal" id="loginModal">
          <div class="login-modal-content">
            <span class="close-button" onclick="toggleLoginModal()">&times;</span>
            <img src="<?= APP_URL ?>public/assets/client/images/home/logo (1).png" alt="Logo" class="logo-login-image" />
            <h2 class="login-title-content">Chào mừng bạn đến với FRUITIFY</h2>
            <form class="form-id-login">
              <label for="email">Email</label>
              <input type="email" id="email" placeholder="Email" required>

              <label for="password">Mật khẩu</label>
              <div style="position: relative;">
                <input type="password" id="password" placeholder="Mật khẩu" required>
              </div>

              <div class="alight-left-forgot">
                <a class="forgot-password" href="">Quên mật khẩu?</a>
              </div>
              <button type="submit" class="login-btn">Đăng nhập</button>
            </form>

            <p class="or-text">HOẶC</p>
            <button class="social-login-btn facebook"><img src="public/assets/client/images/home/fb.png" alt="">Tiếp tục với Facebook</button>
            <button class="social-login-btn google"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="LgbsSe-Bz112c">
                <g>
                  <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                  <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                  <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                  <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                  <path fill="none" d="M0 0h48v48H0z"></path>
                </g>
              </svg>Tiếp tục với Google</button>

            <p class="description">Bằng cách tiếp tục, bạn đồng ý với các <a href="#">Điều khoản dịch vụ</a> và <a href="#">Chính sách quyền riêng tư</a> của chúng tôi.</p>
            <p class="signup-prompt">Chưa có tài khoản? <a href="#" onclick="switchToSignup()">Đăng ký</a></p>
          </div>
        </div>



        <!-- Dark Overlay for Login Modal -->
        <div class="overlay" id="loginOverlay" onclick="toggleLoginModal()"></div>

        <div class="login-modal" id="signupModal">
          <div class="login-modal-content">
            <span class="close-button" onclick="toggleSignupModal()">&times;</span>
            <img src="<?= APP_URL ?>public/assets/client/images/home/logo (1).png" alt="Logo" class="logo-login-image" />
            <h2 class="login-title-content">Chào mừng bạn đến với Website</h2>
            <p class="login-title-desc">Tìm những ý tưởng mới để thử</p>
            <form>
              <label for="username">Tên đăng nhập</label>
              <input type="text" id="username" placeholder="Tên đăng nhập" required>
              <label for="gender">Giới tính</label>
              <select id="gender" required>
                <option value="">Chọn giới tính</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
                <option value="other">Khác</option>
              </select>
              <label for="password">Mật khẩu</label>
              <input type="password" id="signupPassword" placeholder="Tạo mật khẩu" required>

              <label for="confirmPassword">Xác nhận mật khẩu</label>
              <input type="password" id="confirmPassword" placeholder="Xác nhận mật khẩu" required>

              <button type="submit" class="login-btn">Tiếp tục</button>
            </form>

            <p class="description">Bằng cách tiếp tục, bạn đồng ý với các <a href="#">Điều khoản dịch vụ</a> và <a href="#">Chính sách quyền riêng tư</a> của chúng tôi.</p>
            <p class="signup-prompt">Đã là thành viên? <a href="#" onclick="switchToLogin()">Đăng nhập</a></p>
          </div>
        </div>




        <!--  -->
        <!-- Off-Canvas Navbar -->
        <div class=" offcanvas-navbar" id="offcanvasNavbar"> <button class="offcanvas-close" onclick="toggleOffcanvasNavbar()">&times;</button>
          <ul class="menu">
            <li><a href="/">Trang chủ</a></li>
            <li> <a href="javascript:void(0);" onclick="toggleSubMenu('productsSubMenu')"> Sản phẩm <i class="fas fa-chevron-down"></i> </a>
              <ul class="sub-menu" id="productsSubMenu">
                <li><a href="/products/today-fruits">Trái Ngon Hôm Nay</a></li>
                <li><a href="/products/vietnam-fruits">Trái Cây Việt Nam</a></li>
                <li><a href="/products/imported-fruits">Trái Cây Nhập Khẩu</a></li>
                <li><a href="/products/cut-fruits">Trái Cây Cắt Sẵn</a></li>
                <li><a href="/products/gift-fruits">Quà Tặng Trái Cây</a></li>
              </ul>
            </li>
            <li> <a href="javascript:void(0);" onclick="toggleSubMenu('aboutSubMenu')"> Về Chúng Tôi <i class="fas fa-chevron-down"></i> </a>
              <ul class="sub-menu" id="aboutSubMenu">
                <li><a href="/about/introduce">Giới thiệu</a></li>
                <li><a href="/about/stores">Cửa hàng</a></li>
                <li><a href="/about/policies">Chính sách & Ưu đãi</a></li>
              </ul>
            </li>
            <li><a href="/recipes">Góc Ẩm Thực</a></li>
            <li><a href="/news">Tin Tức</a></li>
            <li><a href="/contact">Liên hệ</a></li>
          </ul>
        </div>




        <!-- Overlay for Off-Canvas Navbar -->
        <div class="overlay" id="navbarOverlay" onclick="toggleOffcanvasNavbar()"></div>


        <!-- Search Overlay -->
        <div class="search-overlay" id="searchOverlay">
          <div class="row-search-overlay">
            <input type="text" placeholder="Tìm..." />
            <span class="overlay-close" onclick="toggleSearchOverlay()">✕</span>
          </div>
        </div>
        <div class="overlay-search" onclick="toggleSearchOverlay()"></div>


      </header>
  <?php

  }
}

  ?>
  <!-- <script src="<?= APP_URL ?>public/assets/client/js/offcanvas_cart.js"></script> -->
  <script>
    function toggleLoginModal() {
      const loginModal = document.getElementById('loginModal');
      const loginOverlay = document.getElementById('loginOverlay');
      const signupModal = document.getElementById('signupModal');

      // Close the signup modal if it's open
      if (signupModal.classList.contains('active')) {
        signupModal.classList.remove('active');
      }

      // Toggle the login modal and overlay
      const isLoginOpen = loginModal.classList.toggle('active');
      loginOverlay.classList.toggle('active', isLoginOpen);
      document.body.classList.toggle('modal-open', isLoginOpen);
    }

    function toggleSignupModal() {
      const signupModal = document.getElementById('signupModal');
      const loginModal = document.getElementById('loginModal');
      const loginOverlay = document.getElementById('loginOverlay');

      // Close the login modal if it's open
      if (loginModal.classList.contains('active')) {
        loginModal.classList.remove('active');
      }

      // Toggle the signup modal and overlay
      const isSignupOpen = signupModal.classList.toggle('active');
      loginOverlay.classList.toggle('active', isSignupOpen);
      document.body.classList.toggle('modal-open', isSignupOpen);
    }

    function switchToSignup() {
      const loginModal = document.getElementById('loginModal');
      const signupModal = document.getElementById('signupModal');
      const overlay = document.getElementById('loginOverlay');

      // Close the login modal
      loginModal.classList.remove('active');

      // Open the signup modal and keep the overlay active
      signupModal.classList.add('active');
      overlay.classList.add('active');
      document.body.classList.add('modal-open');
    }

    function switchToLogin() {
      const signupModal = document.getElementById('signupModal');
      const loginModal = document.getElementById('loginModal');
      const overlay = document.getElementById('loginOverlay');

      // Close the signup modal
      signupModal.classList.remove('active');

      // Open the login modal and keep the overlay active
      loginModal.classList.add('active');
      overlay.classList.add('active');
      document.body.classList.add('modal-open');
    }

    function toggleOffcanvasCart() {
      const cart = document.getElementById('offcanvasCart');
      const cartOverlay = document.getElementById('cartOverlay');
      const loginModal = document.getElementById('loginModal');
      const loginOverlay = document.getElementById('loginOverlay');
      const signupModal = document.getElementById('signupModal');

      // Đóng modal đăng nhập và đăng ký nếu đang mở
      if (loginModal.classList.contains('active')) {
        loginModal.classList.remove('active');
        loginOverlay.classList.remove('active');
      }
      if (signupModal.classList.contains('active')) {
        signupModal.classList.remove('active');
        loginOverlay.classList.remove('active');
      }

      // Mở hoặc đóng giỏ hàng
      const isCartOpen = cart.classList.toggle('open');
      cartOverlay.classList.toggle('active', isCartOpen);

      document.body.classList.toggle('modal-open', isCartOpen);
    }

    function switchToSignup() {
      // Đóng modal đăng nhập nếu nó đang mở
      const loginModal = document.getElementById('loginModal');
      if (loginModal.classList.contains('active')) {
        loginModal.classList.remove('active');
      }

      // Mở modal đăng ký
      const signupModal = document.getElementById('signupModal');
      signupModal.classList.add('active');

      // Đảm bảo overlay được bật
      const loginOverlay = document.getElementById('loginOverlay');
      loginOverlay.classList.add('active');

      // Bật lớp CSS để ngăn cuộn
      document.body.classList.add('modal-open');
    }

    function toggleOffcanvasNavbar() {
      const navbar = document.getElementById('offcanvasNavbar');
      const navbarOverlay = document.getElementById('navbarOverlay');
      const cart = document.getElementById('offcanvasCart');
      const cartOverlay = document.getElementById('cartOverlay');
      const loginModal = document.getElementById('loginModal');
      const signupModal = document.getElementById('signupModal');
      const loginOverlay = document.getElementById('loginOverlay');

      // Close other modals if they're open
      if (cart.classList.contains('open')) {
        cart.classList.remove('open');
        cartOverlay.classList.remove('active');
      }
      if (loginModal.classList.contains('active')) {
        loginModal.classList.remove('active');
        loginOverlay.classList.remove('active');
      }
      if (signupModal.classList.contains('active')) {
        signupModal.classList.remove('active');
        loginOverlay.classList.remove('active');
      }

      // Toggle the navbar and overlay
      const isNavbarOpen = navbar.classList.toggle('open');
      navbarOverlay.classList.toggle('active', isNavbarOpen);

      document.body.classList.toggle('modal-open', isNavbarOpen);
    }

    function toggleOffcanvasNavbar() {
      const navbar = document.getElementById('offcanvasNavbar');
      const isNavbarOpen = navbar.classList.toggle('open');
      document.body.classList.toggle('modal-open', isNavbarOpen);
    }

    function toggleSubMenu(menuId) {
      const subMenu = document.getElementById(menuId);

      if (window.innerWidth < 769) { // Kiểm tra nếu màn hình nhỏ hơn 769px (mobile)
        if (subMenu.classList.contains('open')) {
          subMenu.classList.remove('open');
        } else {
          // Đóng tất cả các submenu khác trước khi mở submenu hiện tại
          const allSubMenus = document.querySelectorAll('.sub-menu');
          allSubMenus.forEach((menu) => menu.classList.remove('open'));

          // Mở submenu hiện tại
          subMenu.classList.add('open');
        }
      }
    }




    function toggleSearchOverlay() {
      const searchOverlay = document.querySelector('.search-overlay');
      const overlaySearch = document.querySelector('.overlay-search');

      const isOpen = searchOverlay.classList.toggle('open');
      overlaySearch.classList.toggle('active', isOpen);

      document.body.classList.toggle('modal-open', isOpen);
    }
  </script>