<?php

namespace App\Views\Client\Pages\Contact;

use App\Views\BaseView;

class Contact extends BaseView
{
    public static function render($data = null)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="<?= APP_URL ?>./public/styles/main.css">
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
                integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <title>Document</title>
        </head>

        <body>
           <div class="main-container">
           <div class="container__content">
                <section class="breadcrumbs">
                    <p class="breadcrumbs__path">Trang chủ / Liên hệ</p>
                </section>

                <section class="contact">
                    <div class="contact__map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d31433.16943385829!2d105.74979959307515!3d10.004781816439392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x31a08906415c355f%3A0x416815a99ebd841e!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYywgVG_DoCBuaMOgIEZQVCBQb2x5dGVjaG5pYywgxJAuIFPhu5EgMjIsIFRoxrDhu51uZyBUaOG6oW5oLCBDw6FpIFLEg25nLCBD4bqnbiBUaMahLCBWaeG7h3QgTmFt!3m2!1d9.982104399999999!2d105.758276!5e0!3m2!1svi!2s!4v1730388994579!5m2!1svi!2s"
                            width="1440" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="contact__details">
                        <div class="contact__info">
                            <h1 class="contact__info-title">Thông Tin Liên Hệ</h1>
                            <ul class="contact__info-list">
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-location-dot"></i></span>
                                    <p class="contact-text">
                                        <b>Chi nhánh 1:</b> <br> Lầu 1, 43 Nguyễn Thái Học, phường Cầu Ông Lãnh, quận 1, TP. Hồ
                                        Chí Minh.<br>
                                        <b>Chi nhánh 2:</b> <br> SAV.7-00.01, Tầng trệt Tháp 7, The Sun Avenue, 28 Mai Chí Thọ,
                                        phường An Phú, thành phố Thủ Đức.
                                    </p>
                                </li>
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-envelope"></i></span>
                                    <p class="contact__text">
                                        <b>Email</b> <br>hello@morningfruit.com.vn
                                    </p>
                                </li>
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-phone"></i></span>
                                    <p class="contact__text"><strong>Điện thoại</strong>
                                        <br><b>Hotline 1:</b>0865660775<br>
                                        <b>Hotline 2:</b>0327400880
                                    </p>
                                </li>
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-clock"></i></span>
                                    <p class="contact__text"><strong>Thời gian làm việc</strong>
                                        <br>Thứ 2 đến Chủ nhật từ 8h đến 20h
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="contact__form">
                            <h1 class="contact__form-title">Tư Vấn Quà Tặng Doanh Nghiệp</h1>
                            <p class="contact__form-description">Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và
                                chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.</p>
                            <form action="">
                                <div class="contact__form-group">
                                    <input type="text" class="contact__form-input" placeholder="Tên của bạn">
                                </div>
                                <div class="contact__form-group dflex">
                                    <input type="email" class="contact__form-input" placeholder="Email">
                                    <input type="text" class="contact__form-input" placeholder="SDT của bạn">
                                </div>
                                <div class="contact__form-group">
                                    <textarea class="contact__form-textarea" placeholder="Nội dung"></textarea>
                                    <p class="contact__form-note">This site is protected by reCAPTCHA and the Google</p>
                                </div>
                                <div class="contact__form-group">
                                    <button class="contact__form-button">Gửi cho chúng tôi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- footer -->
                <footer class="footer__container">
                    <section class="footer__section">
                        <div class="footer__columns">
                            <!-- Column 1: Giới Thiệu -->
                            <div class="footer__column">
                                <h6 class="footer__title">Giới Thiệu</h6>
                                <p class="footer__description">Chào mừng bạn đến với trang web bán trái cây tươi ngon của chúng tôi! Tại đây, bạn sẽ tìm thấy đa dạng các loại trái cây từ vườn đến bàn, đảm bảo tươi mới, chất lượng cao và an toàn cho sức khỏe. Chúng tôi cam kết cung cấp sản phẩm từ những nông trại uy tín, giúp bạn thưởng thức hương vị tự nhiên tuyệt vời nhất. Hãy ghé thăm và trải nghiệm dịch vụ giao hàng nhanh chóng, tiện lợi của chúng tôi ngay hôm nay!</p>
                            </div>

                            <!-- Column 2: Liên Kết -->
                            <div class="footer__column">
                                <h6 class="footer__title">Liên Kết</h6>
                                <ul class="footer__list">
                                    <li><a href="#">Tìm Kiếm</a></li>
                                    <li><a href="#">Giới Thiệu</a></li>
                                    <li><a href="#">Chính Sách Đổi Trả</a></li>
                                    <li><a href="#">Chính Sách Bảo Mật</a></li>
                                    <li><a href="#">Liên Hệ</a></li>
                                    <li><a href="#">Chính Sách Thanh Toán</a></li>
                                    <li><a href="#">Chính Sách Giao Hàng</a></li>
                                    <li><a href="#">Chính Sách Trả Hàng</a></li>
                                </ul>
                            </div>

                            <!-- Column 3: Thông Tin Liên Hệ -->
                            <div class="footer__column">
                                <h6 class="footer__title">Thông Tin Liên Hệ</h6>
                                <ul class="footer__list">
                                    <li><a href="#">KDC Hoàng Quân, Phường Trường Thạnh, Quận Caái Răng, TP Cần Thơ</a></li>
                                    <li><a href="#">Email: contact@gmail.com</a></li>
                                    <li><a href="#">HotLine: 1900 0000</a></li>
                                    <li><a href="#">HotLine: 1900 2222</a></li>
                                </ul>
                            </div>

                            <!-- Column 4: Panpage -->
                            <div class="footer__column">
                                <h6 class="footer__title">Panpage</h6>
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCDFPTCT%3Flocale%3Dvi_VN&tabs&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                        </div>

                        <!-- Footer Image -->
                        <div class="footer__image">
                            <img src="https://webmedia.com.vn/images/2021/09/logo-da-thong-bao-bo-cong-thuong-mau-xanh.png" alt="">
                        </div>

                        <hr class="footer__border">
                    </section>

                    <div class="footer__bottom">
                        <p class="footer__legal">Công Ty Cổ Phần Thực Phẩm, mã số thuế 0123456789, do ông Nguyễn Văn A làm người đại diện pháp luật, có trụ sở tại Tầng 10, Tòa Nhà LandMark 81, Quận 1, TP. Hồ Chí Minh. Mọi thắc mắc vui lòng liên hệ qua email: contact@gmail.com. &copy;2024 Công Ty Cổ Phần Thực Phẩm. Mọi quyền được bảo lưu.</p>
                    </div>
                </footer> 
            </div>
           </div> 

        </body>

        </html>
<?php
    }
}
