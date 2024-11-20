<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class verify_otp extends BaseView
{
    public static function render($data = null)
    {
?>
        <link rel="stylesheet" href="<?= APP_URL ?>/public/styles/main.css">
        <div class="content-wrapper">
            <div class="top-section">
                <!-- Phần logo và chữ Đăng ký bên trái -->
                <div class="top-left">
                    <a href="/"><img src="public/assets/client/images/home/logo (1).png" alt="FRUITIFY Logo" class="top-logo" /></a>
                    <span class="top-title">Xác thực OTP</span>
                </div>

                <!-- Phần ngôn ngữ bên phải -->
                <div class="language-dropdown">
                    <button class="language-button">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.00065 14.6667C11.6825 14.6667 14.6673 11.6819 14.6673 8.00004C14.6673 4.31814 11.6825 1.33337 8.00065 1.33337C4.31875 1.33337 1.33398 4.31814 1.33398 8.00004C1.33398 11.6819 4.31875 14.6667 8.00065 14.6667Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5.33464 8.00004C5.33464 11.6819 6.52854 14.6667 8.0013 14.6667C9.47406 14.6667 10.668 11.6819 10.668 8.00004C10.668 4.31814 9.47406 1.33337 8.0013 1.33337C6.52854 1.33337 5.33464 4.31814 5.33464 8.00004Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M1.33398 8H14.6673" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span class="country-language">Tiếng Việt</span>
                        <span class="arrow-down">&#9662;</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item" onclick="changeLanguage('vi')">Tiếng Việt</li>
                        <li class="dropdown-item" onclick="changeLanguage('en')">English</li>
                    </ul>
                </div>
            </div>
            <div class="container-verify-otp">
                <div class="verify-otp">
                    <div class="verify-otp__header">
                        <a href="/forgot-password" class="verify-otp__back-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path d="M15 5l-7 7 7 7" stroke="#4caf50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <h2 class="verify-otp__title">Xác thực OTP</h2>
                    </div>

                    <p class="verify-otp__subtitle">Nhập mã OTP được gửi tới email của bạn</p>

                    <form id="verifyOtpForm" class="verify-otp__form" action="/verify-otp" method="post">
                        <input type="hidden" name="method" value="POST">

                        <div class="verify-otp__input-group">
                            <label for="verifyOtpInput" class="verify-otp__label">Nhập mã OTP</label>
                            <input
                                type="text"
                                name="otp"
                                id="verifyOtpInput"
                                class="verify-otp__input"
                                placeholder="Nhập mã OTP" />
                            <div id="verifyOtpError" class="verify-otp__error">
                                <?= $_SESSION['errors']['verifyOtp'] ?? '' ?>
                            </div>
                        </div>


                        <button type="submit" class="verify-otp__submit-button">XÁC THỰC</button>
                    </form>
                </div>
            </div>
    <?php
    }
}
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const otpInput = document.getElementById("verifyOtpInput");
            const otpError = document.getElementById("verifyOtpError");
            const form = document.getElementById("verifyOtpForm");

            otpInput.addEventListener("input", function() {
                clearOtpError(); // Xóa lỗi khi người dùng bắt đầu nhập
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn form gửi mặc định
                if (!otpInput.value.trim()) {
                    displayOtpError("Vui lòng nhập mã OTP."); // Hiển thị lỗi nếu không có OTP
                } else {
                    clearOtpError(); // Xóa lỗi nếu có
                    form.submit(); // Gửi form nếu hợp lệ
                }
            });

            function displayOtpError(message) {
                otpError.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#FFCDD2"></circle>
                <path d="M12 7V13" stroke="#F44336" stroke-width="2" stroke-linecap="round"></path>
                <circle cx="12" cy="16" r="1" fill="#F44336"></circle>
            </svg>
            <span>${message}</span>
        `;
                otpError.style.display = "flex";
                otpInput.classList.add("input-error");
            }

            function clearOtpError() {
                otpError.innerHTML = ""; // Xóa nội dung lỗi
                otpError.style.display = "none";
                otpInput.classList.remove("input-error"); // Xóa class lỗi
            }
        });
    </script>