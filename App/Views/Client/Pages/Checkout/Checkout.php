<?php

namespace App\Views\Client\Pages\Checkout;

use App\Views\BaseView;

class Checkout extends BaseView
{
    public static function render($cartItems = null)
    {
?>
        <!DOCTYPE html>
        <html lang="vi">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Checkout Page</title>
            <link rel="stylesheet" href="styles.css">
            <style>
                .product-price {
                    font-size: 1.2em;
                    font-weight: bold;
                    color: #333;
                }

                .original-price {
                    text-decoration: line-through;
                    color: #888;
                    margin-right: 10px;
                    font-size: 1em;
                }

                .discounted-price {
                    color: red;
                    font-size: 1.2em;
                    font-weight: bold;
                    margin-left: 10px;
                }
            </style>
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
                                        <input type="radio" name="delivery-method" value="free-ship" checked>
                                        Miễn phí Cần Thơ (trong ngày)
                                        <span class="price-label">MIỄN PHÍ</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="delivery-method" value="fast-ship">
                                        Ship nhanh toàn quốc (2-3 ngày)
                                        <span class="price-label">30.000 đ</span>
                                    </label>

                                </div>

                            </div>
                            <div class="section">
                                <h2>Thanh toán</h2>
                                <div class="payment-option">
                                    <label><input type="radio" name="payment-method" checked> Thanh toán khi nhận hàng
                                        (COD)</label>
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
                            <?php if ($cartItems): ?>
                                <?php foreach ($cartItems as $item): ?>
                                    <div class="summary-item">
                                        <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($item['type'] === 'simple' ? $item['image'] : $item['sku_image']) ?>" alt="Product Image" class="product-image">
                                        <div class="product-details">
                                            <p class="product-name"><?= $item['sku_name'] ?></p>
                                            <p class="product-origin">Số lượng: <?= $item['quantity'] ?></p>
                                           
                                        </div>
                                        <p class="product-price">
                                            <?php if (!empty($item['discount_price'])): ?>
                                                <span class="original-price"><?= number_format($item['price'], 0, ',', '.') ?> đ</span>
                                                <span class="discounted-price"><?= number_format($item['discount_price'], 0, ',', '.') ?>
                                                    đ</span>
                                            <?php else: ?>
                                                <?= number_format($item['price'], 0, ',', '.') ?> đ
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Giỏ hàng của bạn hiện tại trống.</p>
                            <?php endif; ?>

                            <div class="voucher-section">
                                <input type="text" placeholder="Mã giảm giá hoặc thẻ quà tặng">
                                <button class="apply-btn">Áp dụng</button>
                            </div>

                            <div class="subtotal-section">
                                <p class="order-summary-text">Tổng phụ •
                                    <?= count($cartItems) ?> mặt hàng
                                </p>
                                <p class="subtotal-price">
                                    <?php
                                    $subtotal = 0;
                                    foreach ($cartItems as $item) {
                                        $subtotal += $item['price'] * $item['quantity'];
                                    }
                                    echo number_format($subtotal, 0, ',', '.') . " đ";
                                    ?>
                                </p>
                            </div>

                            <div class="shipping-section">
                                <p class="order-summary-text">Vận chuyển</p>
                                <p class="shipping-fee">MIỄN PHÍ</p>
                            </div>

                            <div class="total-section">
                                <p class="order-summary-text-sum">Tổng</p>
                                <p class="total-price">
                                    <span class="trantrantranokokokok">VND</span>
                                    <?php
                                    $total = 0;
                                    foreach ($cartItems as $item) {
                                        $price = $item['discount_price'] ? $item['discount_price'] : $item['price'];
                                        $total += $price * $item['quantity'];
                                    }

                                    echo number_format($total, 0, ',', '.') . " đ";
                                    ?>
                                </p>
                            </div>

                            <p class="tax-info">Bao gồm 390,000 đ tiền thuế</p>
                        </div>

                    </div>
                </div>
            </div>
            <script src="<?= APP_URL ?>/public/assets/client/js/location.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let subtotal = 0;
                    const cartItems = <?php echo json_encode($cartItems); ?>;

                    cartItems.forEach(item => {
                        const price = item.discount_price ? item.discount_price : item.price;
                        subtotal += price * item.quantity;
                    });
                    document.querySelector('.subtotal-price').innerText = formatPrice(subtotal) + ' đ';
                    let total = subtotal;
                    document.querySelectorAll('input[name="delivery-method"]').forEach(input => {
                        input.addEventListener('change', function() {
                            let shippingFee = 0;
                            const shippingFeeLabel = document.querySelector('.shipping-fee');
                            if (this.value === "fast-ship") {
                                shippingFee = 30000;
                                shippingFeeLabel.innerText = '30.000 đ';
                            } else {
                                shippingFeeLabel.innerText = 'MIỄN PHÍ';
                            }

                            total = subtotal + shippingFee;
                            document.querySelector('.total-price').innerText = 'VND ' + formatPrice(total) + ' đ';
                        });
                    });
                    document.querySelectorAll('input[name="payment-method"]').forEach(input => {
                        input.addEventListener('change', function() {
                            if (this.value === 'momo' && this.checked) {
                                document.getElementById("btn-checkout").href = "#";
                                document.getElementById("btn-checkout").onclick = function() {
                                    submitOrderData();
                                };
                            } else {
                                document.getElementById("btn-checkout").href = "";
                            }
                        });
                    });

                    function submitOrderData() {
                        const deliveryMethod = document.querySelector('input[name="delivery-method"]:checked').value;
                        const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;
                        const shippingFee = deliveryMethod === 'fast-ship' ? 30000 : 0;

                        const provinceElement = document.getElementById('province-list');
                        const province = provinceElement.value;
                        const provinceText = provinceElement.options[provinceElement.selectedIndex]?.text || "";

                        const districtElement = document.getElementById('district-list');
                        const district = districtElement.value;
                        const districtText = districtElement.options[districtElement.selectedIndex]?.text || "";

                        const wardElement = document.getElementById('ward-list');
                        const ward = wardElement.value;
                        const wardText = wardElement.options[wardElement.selectedIndex]?.text || "";

                        const detailedAddress = document.querySelector('.detailed-address').value.trim();
                        const fullName = document.querySelector('.name-fields input:nth-child(1)').value.trim();
                        const phoneNumber = document.querySelector('.name-fields input:nth-child(2)').value.trim();

                        if (!fullName || !phoneNumber || !province || !district || !ward || !detailedAddress) {
                            alert("Vui lòng điền đầy đủ thông tin liên hệ và địa chỉ giao hàng.");
                            return;
                        }
                        const fullAddress = `${detailedAddress}, ${wardText}, ${districtText}, ${provinceText}`;

                        const orderData = {
                            cartItems: cartItems,
                            subtotal: subtotal,
                            shippingFee: shippingFee,
                            total: total,
                            deliveryMethod: deliveryMethod,
                            paymentMethod: paymentMethod,
                            fullName: fullName,
                            phoneNumber: phoneNumber,
                            address: fullAddress
                        };
                        console.log("🚀 ~ submitOrderData ~ orderData:", orderData)

                        fetch('/checkout', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(orderData)
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = data.paymentUrl;
                                } else {
                                    const errorMessage = data.message || "Không thể tạo liên kết thanh toán. Vui lòng thử lại.";
                                    alert("Đã xảy ra lỗi: " + errorMessage);
                                }
                            })
                            .catch(error => {
                                console.error('Error submitting order data:', error);
                                alert("Đã xảy ra lỗi trong quá trình gửi đơn hàng.");
                            });
                    }

                    function formatPrice(price) {
                        return price.toLocaleString('vi-VN');
                    }

                    function toggleQRCode() {
                        const paymentMethod = document.getElementById("paymentSelect").value;
                        const qrCodeSection = document.getElementById("show-qrcode-checkout");

                        if (paymentMethod == "chuyenkhoan") {
                            qrCodeSection.style.display = "block";
                        } else {
                            qrCodeSection.style.display = "none";
                        }
                    }


                });
            </script>

        </body>

        </html>
<?php
    }
}
?>