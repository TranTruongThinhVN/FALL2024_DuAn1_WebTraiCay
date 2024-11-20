<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Forgot_password extends BaseView
{
    public static function render($data = null)
    {
?>
        <link rel="stylesheet" href="public/styles/main.css">

        <div class="content-wrapper">
            <div class="top-section">
                <!-- Phần logo và chữ Đăng ký bên trái -->
                <div class="top-left">
                    <a href="/"><img src="public/assets/client/images/home/logo (1).png" alt="FRUITIFY Logo" class="top-logo" /></a>
                    <span class="top-title">Quên mật khẩu</span> <!-- Chữ "Đăng ký" bên cạnh logo -->
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
                        <span class="arrow-down">&#9662;</span> <!-- Mũi tên xuống -->
                    </button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item" onclick="changeLanguage('vi')">Tiếng Việt</li>
                        <li class="dropdown-item" onclick="changeLanguage('en')">English</li>
                    </ul>
                </div>


            </div>
            <!-- Main content container -->
            <div class="container-reset-password">
                <div class="reset-password">
                    <div class="reset-password__header">
                        <a href="/login" class="reset-password__back-button">&#8592;</a>
                        <h2 class="reset-password__title">Quên mật khẩu</h2>
                    </div>
                    <form id="forgotPasswordForm" class="reset-password__form" action="/forgot-password" method="post">
                        <input type="hidden" name="method" value="POST">
                        <!-- Email Input -->
                        <div class="reset-password__input-group">
                            <input
                                type="email"
                                name="email"
                                id="forgotPasswordEmailInput"
                                class="reset-password__input <?= isset($_SESSION['errors']['email']) ? 'input-error' : '' ?>"
                                placeholder="Email của bạn"
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                            <span id="forgotPasswordEmailErrorContainer" class="reset-password__error-container">
                                <?= isset($_SESSION['errors']['email']) ? htmlspecialchars($_SESSION['errors']['email']) : '' ?>
                            </span>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="reset-password__submit-button">TIẾP THEO</button>
                    </form>

                </div>
            </div>
        </div>
<?php
    }
}
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const emailInput = document.getElementById("forgotPasswordEmailInput");
        const emailErrorContainer = document.getElementById("forgotPasswordEmailErrorContainer");
        const form = document.getElementById("forgotPasswordForm");
        let isSubmitted = false;

        // Khi submit form
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            isSubmitted = true;
            if (validateEmail()) {
                form.submit(); // Gửi form nếu không có lỗi
            }
        });

        // Xóa lỗi khi người dùng bắt đầu nhập
        emailInput.addEventListener("input", function() {
            if (isSubmitted) {
                validateEmail();
            }
        });

        // Hàm kiểm tra email
        function validateEmail() {
            const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
            let message = "";

            if (!emailInput.value) {
                message = "Email không được để trống!";
            } else if (!emailPattern.test(emailInput.value)) {
                message = "Email không đúng định dạng!";
            }

            if (message) {
                displayError(message);
                return false;
            } else {
                clearError();
                return true;
            }
        }

        // Hiển thị lỗi
        function displayError(message) {
            emailErrorContainer.innerHTML = `
            <div style="display: flex; align-items: center;">
                <svg width="16" height="16" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="12" fill="#FFCDD2"></circle>
                    <path d="M12 7V13" stroke="#F44336" stroke-width="2" stroke-linecap="round"></path>
                    <circle cx="12" cy="16" r="1" fill="#F44336"></circle>
                </svg>
                <span style="margin-left: 5px;">${message}</span>
            </div>
        `;
            emailErrorContainer.style.display = "block";
            emailErrorContainer.classList.add("show");
            emailInput.classList.add("input-error");
        }

        // Xóa lỗi
        function clearError() {
            emailErrorContainer.innerHTML = "";
            emailErrorContainer.style.display = "none";
            emailErrorContainer.classList.remove("show");
            emailInput.classList.remove("input-error");
        }
    });
</script>