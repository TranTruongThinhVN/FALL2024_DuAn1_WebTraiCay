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
            <button class="menu-toggle icon">
          <i class="fas fa-bars"></i>
        </button>
              <div class="logo">
                <img src="<?= APP_URL ?>public/assets/client/images/home/logo (1).png" alt="Logo đây nhé " />
              </div>
              <ul class="menu">
                <li><a href="">Trang chủ</a></li>
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
                    <a href="#">Giới thiệu</a>
                    <a href="#">Cửa hàng</a>
                    <a href="#">Chính sách & Ưu đãi</a>
                  </div>
                </li>
                <li>
                  <a href="#">Góc Ẩm Thực</a>
                </li>
                <li><a href="/news">Tin Tức</a></li>
                <li><a href="">Liên hệ</a></li>
              </ul>
              <div class="navbar-icons">
                <div class="search-icon-container">
                  <a href="#" class="icon"><svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 22 22">
                      <circle cx="11" cy="10" r="7" fill="none" stroke="currentColor"></circle>
                      <path d="m16 15 3 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
                  <div class="search-dropdown">
                    <input type="text" placeholder="Search..." />
                  </div>
                </div>
                <a href="javascript:void(0);" class="icon cart-icon" onclick="toggleOffcanvasCart()">
                  <svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-cart" viewBox="0 0 22 22">
                    <path d="M11 7H3.577A2 2 0 0 0 1.64 9.497l2.051 8A2 2 0 0 0 5.63 19H16.37a2 2 0 0 0 1.937-1.503l2.052-8A2 2 0 0 0 18.422 7H11Zm0 0V1" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </a>
                <a href="#" class="icon"><svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-account" viewBox="0 0 22 22">
                    <circle cx="11" cy="7" r="4" fill="none" stroke="currentColor"></circle>
                    <path d="M3.5 19c1.421-2.974 4.247-5 7.5-5s6.079 2.026 7.5 5" fill="none" stroke="currentColor" stroke-linecap="round"></path>
                  </svg></a>
              </div>
            </div>
            <div class="offcanvas-cart" id="offcanvasCart">
              <div class="offcanvas-cart-header">
                <h2>Giỏ hàng</h2>
                <span class="offcanvas-cart-close" onclick="toggleOffcanvasCart()">×</span>
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
              <button class="cta-button view-cart-btn">Xem giỏ hàng</button>
              <button class="cta-button checkout-btn">Thanh toán</button>
              </div>
              </div>
            </div>
            <div class="overlay" id="overlay" onclick="toggleOffcanvasCart()"></div>
          </div>
        </div>

      </header>
  <?php

  }
}

  ?>
 <script src="<?=APP_URL?>public/assets/client/js/offcanvas_cart.js"></script>
