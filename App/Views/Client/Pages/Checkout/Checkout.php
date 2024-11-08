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
                <div class="checkout__container">
                    <form class="checkout__form">
                        <div class="checkout__form-top">
                            <h2 class="checkout__form-title">Thông tin liên hệ</h2>
                            <h2 class="checkout__form-login"><a href="">Đăng nhập</a></h2>
                        </div>

                        <div class="form-group"> 
                        <input type="email" placeholder="Nhập email của bạn"> 
                            
                        </div>

                        <div class="checkbox__group">
                            <input type="checkbox" id="subscribe">
                            <label for="subscribe">Gửi cho tôi tin tức và ưu đãi qua email</label>
                        </div>

                        <h2 class="checkout__form-title">Giao hàng</h2>

                        <div class="form-group">
                            <div class="form-group">
                                <label class="radio-label topp">
                                    <input type="radio" name="option" class="radio-input">
                                    Nhận Tại Cửa Hàng
                                </label>
                                <label class="radio-label my-1">
                                    <input type="radio" name="option" class="radio-input">
                                    Vận Chuyển
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
    <label>Phương thức thanh toán</label>
    <select id="paymentSelect" onchange="toggleQRCode()">
        <option value="">Lựa Chọn</option>
        <option value="momo">Momo</option>
        <option value="chuyenkhoan">Chuyển khoản</option>
        <option value="cod">Thanh toán khi nhận hàng</option>
    </select>
    <div class="show-image" id="show-qrcode-checkout">
        <div class="qrcode-checkout__details">
            <div class="qrcode-checkout__image">
                <img src="<?= APP_URL ?>/public/assets/Client/images/payment/qrcode.png" alt="QR Code" />
            </div>
            <div class="qrcode-checkout__number">
                <span>1234567889</span>
                <div class="qrcode-checkout__namebank">
                    <p>Tên ngân hàng: <span>VietComBank</span></p>
                </div>
            </div>
            <div class="qrcode-checkout__manager">
                <span>Thanh Doan</span>
            </div>
            <div class="qrcode-checkout__sub">
                <p>
                    Sau khi nhấp vào “Thanh toán ngay”,
                    bạn sẽ được chuyển hướng đến OnePay -
                    Thanh toán trực tuyến để hoàn tất việc
                    mua hàng một cách an toàn.
                </p>
            </div>
        </div>
    </div>
</div>


                        <div class="form-group">
                            <label>Quốc gia</label>
                            <select>
                                <option>Việt Nam</option>
                                <option>Lào</option>
                                <option>Thái Lan</option>
                                <option>Campuchia</option>
                            </select>
                        </div>

                        <div class="form-group--name"> 
                            <input type="text" placeholder="Họ">
                            <input type="text" placeholder="Tên">

                        </div>

                        <div class="form-group">
                            <select name="" id="">
                                <option value="">Tỉnh thành phố</option>
                                <option value="">Hà Nội</option>
                                <option value="">TP HCM</option>
                                <option value="">Cần Thơ</option>
                                <option value="">Hậu Giang</option>
                                <option value="">An Giang</option>
                                <option value="">Sóc Trăng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="" id="" placeholder="">
                                <option value="">Quận Huyện</option>
                                <option value="">Hà Nội</option>
                                <option value="">TP HCM</option>
                                <option value="">Cần Thơ</option>
                                <option value="">Hậu Giang</option>
                                <option value="">An Giang</option>
                                <option value="">Sóc Trăng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Địa chỉ">
                        </div>

                        <div class="form-group">
                            <input type="text" placeholder="Điện thoại">
                        </div>

                        <div class="checkbox__group">
                            <input type="checkbox" id="save-info">
                            <label for="save-info">Lưu lại thông tin</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class=" cta-button btn">Mua Hàng</button>
                        </div>
                    </form>

                    <div class="summary">
                        <h2 class="summary__title">Tóm tắt đơn hàng</h2>


                        <div class="summary__products">
                            <div class="summary__item">
                                <div class="summary__image">
                                    <img src="<?= APP_URL ?>/public/assets/Client/images/payment/anh1.webp">
                                </div>
                                <div class="summary__details">
                                    <div class="summary__name">Bơ Booth Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit. Veritatis eligendi voluptatibus
                                        cumque quibusdam incidunt aliquam possimus repellat quos
                                        doloremque earum. Nobis corrupti dicta ipsam
                                        blanditiis suscipit voluptatibus aut facilis consequatur?
                                    </div>
                                    <div class="summary__origin">
                                        <p>Xuất sứ:<span>Úc</span> | Trọng lượng: <span>1Kg</span></p>
                                    </div>
                                </div>
                                <div class="summary__price">200.000</div>
                            </div>
                            <div class="summary__item">
                                <div class="summary__image">
                                    <img src="<?= APP_URL ?>/public/assets/Client/images/payment/anh1.webp">
                                </div>
                                <div class="summary__details">
                                    <div class="summary__name">Bơ Booth Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit. Veritatis eligendi voluptatibus
                                        cumque quibusdam incidunt aliquam possimus repellat quos
                                        doloremque earum. Nobis corrupti dicta ipsam
                                        blanditiis suscipit voluptatibus aut facilis consequatur?
                                    </div>
                                    <div class="summary__origin">
                                        <p>Xuất sứ <span>Úc</span> | Trọng lượng <span>1Kg</span></p>
                                    </div>
                                </div>
                                <div class="summary__price">200.000</div>
                            </div>
                            <div class="summary__voucher">
                                <input type="text">
                                <a type="submit" href="#" class="btn ">Áp Dụng</a href="">
                            </div>

                            <div class="summary__total-products">
                                <span class="summary__total-text">
                                    Tổng đơn hàng: 3 mặt hàng
                                </span>
                                <span class="summary__total-price">6.725.600 </span>
                            </div>
                            <div class="summary__delivery">
                                <span class="summary__method">Nhận tại cửa hàng</span>
                                <span class="summary__delivery-fee">Miễn Phí</span>
                            </div>
                            <div class="summary__total--after-discount">
                                <span class="summary__total-text ">Tổng tiền</span>
                                <div class="summary__total-price ">
                                    <p><span>6.725.600</span>VNĐ</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script >
                // Ẩn tất cả các phần chi tiết thanh toán
                function toggleQRCode() {
                const paymentMethod = document.getElementById("paymentSelect").value;
                const qrCodeSection = document.getElementById("show-qrcode-checkout");

                if (paymentMethod == "chuyenkhoan") {
                    qrCodeSection.style.display = "block"; // Hiển thị mã QR
                } else {
                    qrCodeSection.style.display = "none"; // Ẩn mã QR
                }
}

            </script>
        </body>

        </html>


<?php
    }
}
