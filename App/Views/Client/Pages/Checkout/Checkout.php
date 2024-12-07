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
                            <form method="POST" action="/process-cash-on-delivery" id="checkoutForm">
                                <input type="hidden" name="method" value="POST">

                                <!-- Thông tin người dùng -->
                                <div class="section">
                                    <h2>Thông tin liên hệ</h2>
                                    <input type="text" name="fullname" placeholder="Họ và Tên" class="input-field" required>
                                    <input type="text" name="phone" placeholder="Điện thoại" class="input-field" required>
                                </div>

                                <!-- Thông tin địa chỉ giao hàng -->
                                <div class="section">
                                    <h2>Giao hàng</h2>
                                    <div class="location-fields">
                                        <div class="select-wrapper">
                                            <select class="input-field" id="province-list" name="province" required>
                                                <option selected disabled>Tỉnh / Thành</option>
                                            </select>
                                        </div>
                                        <div class="select-wrapper">
                                            <select class="input-field" id="district-list" name="district" required>
                                                <option selected disabled>Quận / Huyện</option>
                                            </select>
                                        </div>
                                        <div class="select-wrapper">
                                            <select class="input-field" id="ward-list" name="ward" required>
                                                <option selected disabled>Phường / Xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="text" name="address" placeholder="Địa chỉ chi tiết" class="input-field" required>
                                </div>

                                <!-- Phương thức vận chuyển -->
                                <div class="section">
                                    <h2>Phương thức vận chuyển</h2>
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" name="shipping_method" value="standard" checked> Miễn phí Cần Thơ (trong ngày)
                                        </label>
                                        <label>
                                            <input type="radio" name="shipping_method" value="express"> Ship nhanh toàn quốc (2-3 ngày)
                                        </label>
                                    </div>
                                </div>

                                <!-- Phương thức thanh toán -->
                                <div class="section">
                                    <h2>Thanh toán</h2>
                                    <div class="payment-option">
                                        <label><input type="radio" name="payment_method" value="cod" checked> Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                    <div class="payment-option">
                                        <label><input type="radio" name="payment_method" value="vnpay"> VN Pay</label>
                                    </div>
                                    <div class="payment-option">
                                        <label><input type="radio" name="payment_method" value="momo"> MoMo</label>
                                    </div>
                                </div>

                                <!-- Nút thanh toán -->
                                <button type="submit" class="btn-primary">Thanh toán ngay</button>
                            </form>


                        </div>

                        <!-- Right Side: Order Summary -->
                        <div class="order-summary">
                            <h2>Tóm tắt đơn hàng</h2>
                            <?php foreach ($data['items'] as $item): ?>
                                <div class="summary-item">
                                    <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($item['sku_image']) ?>" alt="Product Image" class="product-image">
                                    <div class="product-details">
                                        <p class="product-name"><?= htmlspecialchars($item['product_name']) ?></p>
                                        <p class="product-quantity">Số lượng: <?= $item['quantity'] ?></p>
                                    </div>
                                    <p class="product-price"><?= number_format(($item['discount_price'] ?? $item['sku_price']) * $item['quantity']) ?> VNĐ</p>
                                </div>
                            <?php endforeach; ?>


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
                                <p class="total-price"><?= number_format($data['total']) ?> VNĐ</p>
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