<?php

namespace App\Views\Client\Pages\Contact;

use App\Views\BaseView;

class Contact extends BaseView
{
    public static function render($data = null)
    {
?>


        <div id="contact-success-message" class="notification hidden">
            <p>🎉 Liên hệ thành công! Chúng tôi sẽ liên lạc với bạn sớm.</p>
        </div>
        <div id="contact-error-message" class="notification hidden">
            <p>❌ Liên hệ thất bại. Vui lòng thử lại sau!</p>
        </div>
        <style>
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #4CAF50;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                font-family: Arial, sans-serif;
                font-size: 16px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                opacity: 0;
                transform: translateY(-20px);
                transition: all 0.5s ease;
                z-index: 1000;
            }

            .notification.error {
                background-color: #FF5722;
            }

            .notification.show {
                opacity: 1;
                transform: translateY(0);
            }

            .notification.hidden {
                display: none;
            }
        </style>



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

                    <div class="contact__wrapper">
                        <div class="contact__info">
                            <h1 class="contact__info-title">Thông Tin Liên Hệ</h1>
                            <ul class="contact__info-list">
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-location-dot"></i></span>
                                    <p class="contact-text">
                                        FPT POLYTECHNIC, KDC Hoàng Quân, phường Thường Thạnh, quận Cái Răng, Cần Thơ
                                    </p>
                                </li>
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-envelope"></i></span>
                                    <p class="contact__text">
                                        khainqpc08388@gmail.com
                                    </p>
                                </li>
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-phone"></i></span>
                                    <p class="contact__text">0878999894</p>

                                </li>
                                <li class="contact__info-item">
                                    <span class="contact__info-icon"><i class="fa-solid fa-clock"></i></span>
                                    <p class="contact__text">Thứ 2 đến Chủ nhật từ 8h đến 20h

                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="contact__form">
                            <h1 class="contact__form-title">Tư Vấn Quà Tặng Doanh Nghiệp</h1>
                            <p class="contact__form-description">
                                Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.
                            </p>



                            <form id="contact-form" method="POST" onsubmit="return submitForm(this);">
                                <input type="hidden" name="method" value="POST">
                                <div class="contact__form-group">
                                    <input type="text" class="contact__form-input" name="name" placeholder="Tên của bạn" required>
                                </div>
                                <div class="contact__form-group dflex">
                                    <input type="email" class="contact__form-input" name="email" placeholder="Email" required>
                                    <input type="text" class="contact__form-input" name="phone" placeholder="SDT của bạn" required>
                                </div>
                                <div class="contact__form-group">
                                    <textarea class="contact__form-textarea" name="message" placeholder="Nội dung" required></textarea>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LeH2ZMqAAAAAME7gYotJm4s5SwvrRl1qmxt3Y6D"></div>
                                <div id="recaptcha-error" style="color: red; font-size: 14px; margin-top: 8px; display: none;">
                                    Vui lòng hoàn thành xác minh reCAPTCHA.
                                </div>
                                <div class="contact__form-group mt-3">
                                    <button class="contact__form-button" type="submit">Gửi cho chúng tôi</button>
                                </div>
                            </form>


                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <script>
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('6Lej15MqAAAAAMLPNd3Y2wuWhtkL_BQdK79b6dwH', {
                                        action: 'submit'
                                    }).then(function(token) {
                                        document.getElementById('g-recaptcha-response').value = token;
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </section>
            </div>
        </div>



        <script>
            document.getElementById('contact-form').addEventListener('submit', function(e) {
                e.preventDefault(); // Ngăn chặn form gửi đi mặc định

                // Kiểm tra nếu người dùng chưa hoàn thành reCAPTCHA
                const recaptchaResponse = grecaptcha.getResponse();
                const recaptchaError = document.getElementById('recaptcha-error');

                if (!recaptchaResponse) {
                    // Hiển thị lỗi dưới thẻ reCAPTCHA
                    recaptchaError.style.display = 'block';
                    recaptchaError.textContent = 'Vui lòng hoàn thành xác minh reCAPTCHA.';
                    return; // Ngừng việc gửi form
                } else {
                    // Ẩn thông báo lỗi nếu reCAPTCHA hợp lệ
                    recaptchaError.style.display = 'none';
                }

                // Nếu reCAPTCHA hợp lệ, tiếp tục xử lý form
                const formData = new FormData(this);
                formData.append('g-recaptcha-response', recaptchaResponse);

                fetch('/contact', {
                        method: 'POST',
                        body: formData
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === 'success') {
                            showNotification('success', 'Liên hệ thành công! Chúng tôi sẽ liên lạc với bạn sớm.');
                        } else {
                            showNotification('error', data.message);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        showNotification('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
                    });
            });


            function showNotification(type, message = '') {
                const successMessage = document.getElementById('contact-success-message');
                const errorMessage = document.getElementById('contact-error-message');

                if (type === 'success') {
                    successMessage.querySelector('p').textContent = '🎉 Liên hệ thành công! Chúng tôi sẽ liên lạc với bạn sớm.';
                    successMessage.classList.remove('hidden');
                    successMessage.classList.add('show');
                    setTimeout(() => {
                        successMessage.classList.remove('show');
                        successMessage.classList.add('hidden');
                    }, 1000);
                } else {
                    errorMessage.querySelector('p').textContent = `❌ ${message || 'Liên hệ thất bại. Vui lòng thử lại sau!'}`;
                    errorMessage.classList.remove('hidden');
                    errorMessage.classList.add('show');
                    setTimeout(() => {
                        errorMessage.classList.remove('show');
                        errorMessage.classList.add('hidden');
                    }, 5000);
                }
            }
        </script>



<?php
    }
}
?>