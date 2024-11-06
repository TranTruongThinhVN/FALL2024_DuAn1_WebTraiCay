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
                <div class="checkout-container">
                    <form class="checkout-form">
                        <h2 class="section-title">Thông tin liên hệ</h2>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="Nhập email của bạn">
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="subscribe">
                            <label for="subscribe">Gửi cho tôi tin tức và ưu đãi qua email</label>
                        </div>

                        <h2 class="section-title">Giao hàng</h2>

                        <div class="form-group">
                            <div class="form-group">
                                <label class="radio-label topp">
                                    <input type="radio" name="option" class="radio-input">
                                    Tùy chọn 1
                                </label>
                                <label class="radio-label my-1">
                                    <input type="radio" name="option" class="radio-input">
                                    Tùy chọn 2
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Quốc gia</label>
                            <select>
                                <option>Việt Nam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" placeholder="Tên">
                        </div>

                        <div class="form-group">
                            <label>Họ</label>
                            <input type="text" placeholder="Họ">
                        </div>

                        <div class="form-group">
                            <label>Công ty (không bắt buộc)</label>
                            <input type="text" placeholder="Công ty">
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" placeholder="Địa chỉ">
                        </div>

                        <div class="form-group">
                            <label>Thành phố</label>
                            <input type="text" placeholder="Thành phố">
                        </div>

                        <div class="form-group">
                            <label>Mã bưu chính (không bắt buộc)</label>
                            <input type="text" placeholder="Mã bưu chính">
                        </div>

                        <div class="form-group">
                            <label>Điện thoại</label>
                            <input type="text" placeholder="Điện thoại">
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="save-info">
                            <label for="save-info">Lưu lại thông tin</label>
                        </div>
                    </form>

                    <div class="summary">
                        <h2 class="section-title">Tóm tắt đơn hàng</h2>


                        <div class="summary__products">
                            <div class="summary__item">
                                <div class="summary__image">
                                    <img src="<?= APP_URL ?>/public/assets/Client/images/payment/anh1.webp">
                                </div>
                                <div class="summary__title">Bơ Booth Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis eligendi voluptatibus cumque quibusdam incidunt aliquam possimus repellat quos doloremque earum. Nobis corrupti dicta ipsam blanditiis suscipit voluptatibus aut facilis consequatur?</div>
                                <div class="summary__price">200.000</div>
                            </div>
                            <div class="summary__item">
                                <div class="summary__image">
                                    <img src="<?= APP_URL ?>/public/assets/Client/images/payment/anh1.webp">
                                </div>
                                <div class="summary__title">Bơ Booth Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis eligendi voluptatibus cumque quibusdam incidunt aliquam possimus repellat quos doloremque earum. Nobis corrupti dicta ipsam blanditiis suscipit voluptatibus aut facilis consequatur?</div>
                                <div class="summary__price">200.000</div> 
                            </div>
                            <div class="summary__voucher">
                                    <input type="text">
                                    <button class="btn ">Áp Dụng</button>
                                </div>

                                <div class="summary-item">
                                    <span>Vận chuyển</span>
                                    <span>MIỄN PHÍ</span>
                                </div>

                                <div class="summary-item total">
                                    <span>Tổng</span>
                                    <span>3.340.000 đ</span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>


<?php
    }
}
