<?php

namespace App\Views\Client\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
    public static function render($data = null)
    {
?>
        <footer class="footer__container">
            <div class="main-container">
                <section class="footer__section">
                    <div class="footer__columns">
                        <div class="footer__column footer__logo-info">
                            <img src="<?= APP_URL ?>/public/assets/client/images/home/logo (1).png" alt="Logo Công Ty"
                                class="footer__logo-image">
                            <ul class="footer__contact-info">
                                <li>Điện thoại: 0878.999.894</a></li>
                                <li>Email: khainqpc08388@gmai.com</a></li>
                                <li class="ad-footer">Địa chỉ: KDC Hoàng Quân, phường Thường Thạnh, quận Cái Răng, Cần Thơ</li>
                            </ul>
                        </div>
                        <div class="footer__column">
                            <h3 class="footer__title">Về Chúng Tôi</h3>
                            <ul class="footer__list">
                                <li><a href="#">Giới thiệu</a></li>
                                <li><a href="#">Cửa hàng</a></li>
                                <li><a href="#">Giá trị cốt lõi</a></li>
                                <li><a href="#">Đội ngũ</a></li>
                                <li><a href="#">Lịch sử phát triển</a></li>
                            </ul>
                        </div>
                        <div class="footer__column">
                            <h3 class="footer__title">Sản phẩm</h3>
                            <ul class="footer__list">
                                <li><a href="#">Trái Ngon Hôm nay</a></li>
                                <li><a href="#">Trái Cây Việt Nam</a></li>
                                <li><a href="#">Trái Cây Nhập Khẩu</a></li>
                                <li><a href="#">Trái Cây Cắt Sẵn</a></li>
                                <li><a href="#">Giỏ Quà Trái Cây</a></li>
                                <li><a href="#">Mâm Ngũ Quả</a></li>
                            </ul>
                        </div>
                        <div class="footer__column">
                            <h3 class="footer__title">Nhận tin khuyến mãi</h3>
                            <div class="prose__form">
                                <form action="">
                                    <div class="prose__form__input">
                                        <input class="prose__form__input__email" type="email" placeholder="Email">
                                        <button class="prose__form__input__next"><i
                                                class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer__column">
                            <h3 class="footer__title">Các chính sách</h3>
                            <ul class="footer__list">
                                <li><a href="#">Tìm kiếm</a></li>
                                <li><a href="#">Câu chuyện thương hiệu</a></li>
                                <li><a href="#">Chính sách thành viên</a></li>
                                <li><a href="#">Chính sách kiểm hàng</a></li>
                                <li><a href="#">Chính sách bảo hành</a></li>
                                <li><a href="#">Chính sách giao hàng</a></li>
                                <li><a href="#">Chính sách thanh toán</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Hướng dẫn mua hàng Online</a></li>
                                <li><a href="#">Kiến thức trái cây</a></li>
                                <li><a href="#">Liên hệ</a></li>
                            </ul>
                </section>
                <hr class="footer__border">
                <div class="footer__bottom">
                    <p class="footer__legal">
                        &copy; 2018 - 2024 Công Ty Cổ Phần Thực Phẩm Hàng Đầu Việt Nam.
                    </p>
                    <div class="footer__social-icons">
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Đảm bảo đoạn script này nằm ở file Footer hoặc ở cuối trang -->
        <script src="<?= APP_URL ?>public/assets/client/js/overlay.js"></script>
        <script src="<?= APP_URL ?>public/assets/client/js/auth/main.js"></script>
        <script src="<?= getenv('APP_URL ') ?>App/Styles/Vendors/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        </body>


        </html>

<?php
    }
}

?>
<?php unset($_SESSION['errors']); ?>