<?php

namespace App\Views\Client\Pages\Checkout;

use App\Views\BaseView;

class Checkout extends BaseView
{
  public static function render($data = null)
  {
?>
    <!DOCTYPE html>
    <html lang="vi">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Checkout Page</title>
      <link rel="stylesheet" href="styles.css">
    </head>

    <body>
      <div class="main-container">
        <div class="checkout-page">
          <div class="checkout-container">
            <!-- Left Side: Checkout Form -->
            <div class="checkout-form">
              <div class="section">
                <h2>Thông tin liên hệ</h2>
                <!-- <input type="email" placeholder="Email" class="input-field"> -->
                <!-- <div class="checkbox-group">
                                    <input type="checkbox" id="subscribe">
                                    <label class="subscribe" for="subscribe">Gửi cho tôi tin tức và ưu đãi qua email</label>
                                </div> -->
              </div>
              <div class="section">
                <h2>Giao hàng</h2>
                <div class="location-fields">
                  <div class="select-wrapper">
                    <select class="input-field" id="province-list" aria-label="Tỉnh / Thành">
                      <option selected disabled>Tỉnh / Thành</option>
                    </select>
                  </div>
                  <div class="select-wrapper">
                    <select class="input-field" id="district-list" aria-label="Quận / Huyện">
                      <option selected disabled>Quận / Huyện</option>
                    </select>
                  </div>
                  <div class="select-wrapper">
                    <select class="input-field" id="ward-list" aria-label="Phường / Xã">
                      <option selected disabled>Phường / Xã</option>
                    </select>
                  </div>
                </div>
                <input type="text" placeholder="Địa chỉ chi tiết" class="input-field detailed-address">
                <div class="name-fields">
                  <input type="text" placeholder="Họ và Tên" class="input-field">
                  <input type="text" placeholder="Điện thoại" class="input-field">
                </div>
                <div class="radio-group">
                  <label>
                    <input type="radio" name="shipping-option" checked>
                    Vận chuyển
                    <span class="icon truck-icon">&#128666;</span>
                  </label>
                  <label>
                    <input type="radio" name="shipping-option">
                    Nhận hàng tại cửa hàng
                    <span class="icon store-icon">&#127970;</span>
                  </label>
                </div>
              </div>
              <div class="section">
                <h2>Phương thức vận chuyển</h2>
                <div class="radio-group">
                  <label>
                    <input type="radio" name="delivery-method" checked>
                    Miễn phí Cần Thơ (trong ngày)
                    <span class="price-label">MIỄN PHÍ</span>
                  </label>
                  <label>
                    <input type="radio" name="delivery-method">
                    Ship nhanh toàn quốc (2-3 ngày)
                    <span class="price-label">33.000 đ</span>
                  </label>
                </div>

              </div>
              <div class="section">
                <h2>Thanh toán</h2>
                <div class="payment-option">
                  <label><input type="radio" name="payment-method" checked> Thanh toán khi nhận hàng (COD)</label>
                </div>
                <div class="payment-option">
                  <label><input type="radio" name="payment-method">VN Pay</label>
                </div>
                <div class="payment-option">
                  <label><input type="radio" name="payment-method" value="momo"> MoMo</label>
                </div>
              </div>
              <a href="" id="btn-checkout" style="text-decoration:none;" class="btn-primary">Thanh toán ngay</a>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="order-summary">
              <h2>Tóm tắt đơn hàng</h2>
              <div class="summary-item">
                <img src="public/assets/client/images/home/nho_den_my.webp" alt="Product Image" class="product-image">
                <div class="product-details">
                  <p class="product-name">Chuột không dây siêu nhẹ Pulsar X2 V2</p>
                  <p class="product-origin">Xuất xứ: Nhật Bản</p>
                  <p class="product-origin">Trọng lượng: 1Kg</p>
                </div>
                <p class="product-price">3,227,162 đ</p>
              </div>

              <div class="voucher-section">
                <input type="text" placeholder="Mã giảm giá hoặc thẻ quà tặng">
                <button class="apply-btn">Áp dụng</button>
              </div>

              <div class="subtotal-section">
                <p class="order-summary-text">Tổng phụ • 2 mặt hàng</p>
                <p class="subtotal-price">4,290,000 đ</p>
              </div>

              <div class="shipping-section">
                <p class="order-summary-text">Vận chuyển</p>
                <p class="shipping-fee">MIỄN PHÍ</p>
              </div>

              <div class="total-section">
                <p class="order-summary-text-sum">Tổng</p>
                <p class="total-price"><span class="trantrantranokokokok">VND</span> 4,290,000 đ</p>
              </div>
              <p class="tax-info">Bao gồm 390,000 đ tiền thuế</p>
            </div>

          </div>
        </div>
      </div>
      <script src="<?= APP_URL ?>/public/assets/client/js/location.js"></script>
      <script>
        function toggleQRCode() {
          const paymentMethod = document.getElementById("paymentSelect").value;
          const qrCodeSection = document.getElementById("show-qrcode-checkout");

          if (paymentMethod == "chuyenkhoan") {
            qrCodeSection.style.display = "block";
          } else {
            qrCodeSection.style.display = "none";
          }
        }

        document.querySelectorAll('input[name="payment-method"]').forEach(input => {
          input.addEventListener('change', function() {
            if (this.value === 'momo' && this.checked) {
              document.getElementById("btn-checkout").href = "momo/PaymentMoMo.php";
            } else {
              document.getElementById("btn-checkout").href = "";
            }
          });
        });
      </script>
    </body>

    </html>
<?php
  }
}
?>