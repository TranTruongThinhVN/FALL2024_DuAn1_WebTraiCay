<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use App\Views\Client\Components\Notification;

class Login extends BaseView
{
    public static function render($data = null)
    {
?>
        <link rel="stylesheet" href="public/styles/main.css">
        <div class="content-wrapper">
            <div class="top-section">
                <div class="top-left">
                    <a href="/"><img src="public/assets/client/images/home/logo (1).png" alt="Logo" class="top-logo" /></a>
                    <span class="top-title">Đăng nhập</span>
                </div>
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

            <div class="main-content">
                <div class="left-section">
                    <a href="/"><img src="<?= APP_URL ?>public/assets/client/images/home/logo.png" alt="Logo" class="logo-login-image" /></a>
                    <p class="login-title-content">Nơi khởi nguồn ý tưởng sáng tạo với trái cây tươi sạch.</p>
                </div>

                <div class="login-modal" id="loginModal">
                    <div class="login-modal-content">
                        <form id="loginForm" action="/login" method="post">
                            <input type="hidden" name="method" value="POST">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="loginEmail" placeholder="Email của bạn"
                                    class="<?= isset($_SESSION['errors']['email']) ? 'input-error' : '' ?>"
                                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                                <span class="error-message" id="emailError"><?= $_SESSION['errors']['email'] ?? '' ?></span>
                            </div>

                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="loginPassword" placeholder="Nhập mật khẩu"
                                    class="<?= isset($_SESSION['errors']['password']) ? 'input-error' : '' ?>">
                                <span class="error-message" id="passwordError"><?= $_SESSION['errors']['password'] ?? '' ?></span>
                            </div>


                            <div class="alight-left-forgots">
                                <div class="remember-logins">
                                    <input type="checkbox" name="remember" id="rememberCheckbox">
                                    <label class="rememberCheckbox" for="rememberCheckbox">Ghi nhớ đăng nhập</label>
                                </div>
                                <a class="forgot-password" href="/forgot-password">Quên mật khẩu?</a>
                            </div>



                            <button type="submit" class="login-btn">Đăng nhập</button>
                            <?php if (isset($_SESSION['errors']['general'])): ?>
                                <div class="error-message-general">
                                    <?= htmlspecialchars($_SESSION['errors']['general']) ?>
                                </div>
                                <?php unset($_SESSION['errors']['general']); ?>
                            <?php endif; ?>
                        </form>

                        <p class="or-text">HOẶC</p>
                        <a href="/google-login" type="button" class="social-login-btn google" id="googleLoginButton">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="LgbsSe-Bz112c">
                                <!-- SVG của Google -->
                                <g>
                                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                </g>
                            </svg>
                            Tiếp tục với Google


                        </a>

                        <p class="description">Bằng cách tiếp tục, bạn đồng ý với các <a href="#">Điều khoản dịch vụ</a> và <a href="#">Chính sách quyền riêng tư</a> của chúng tôi.</p>
                        <p class="signup-prompt">Chưa có tài khoản? <a href="/register">Đăng ký</a></p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("loginForm");
        const emailField = document.getElementById("loginEmail");
        const passwordField = document.getElementById("loginPassword");
        let isSubmitted = false;

        form.addEventListener("submit", function(event) {
            event.preventDefault();
            isSubmitted = true;
            if (validateAll()) {
                form.submit();
            }
        });

        [emailField, passwordField].forEach((field) => {
            field.addEventListener("input", function() {
                if (isSubmitted) {
                    validateField(field);
                }
            });
        });

        // Gọi hàm thêm icon cho lỗi tổng quát ngay sau khi trang load
        addIconToGeneralError();

        function validateAll() {
            const emailValid = validate(
                emailField,
                "emailError",
                "Email không được để trống!",
                emailFormat(emailField.value)
            );
            const passwordValid = validate(
                passwordField,
                "passwordError",
                "Mật khẩu không được để trống!"
            );
            return emailValid && passwordValid;
        }

        function validateField(field) {
            if (field === emailField) {
                validate(
                    emailField,
                    "emailError",
                    "Email không được để trống!",
                    emailFormat(emailField.value)
                );
            } else if (field === passwordField) {
                validate(
                    passwordField,
                    "passwordError",
                    "Mật khẩu không được để trống!"
                );
            }
        }

        function validate(field, errorId, emptyMessage, condition = true) {
            const errorElement = document.getElementById(errorId);
            const message = !field.value ?
                emptyMessage :
                condition ?
                "" :
                getMessage(errorId);
            if (errorElement) {
                if (message) {
                    errorElement.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="12" fill="#FFCDD2"></circle>
                        <path d="M12 7V13" stroke="#F44336" stroke-width="2" stroke-linecap="round"></path>
                        <circle cx="12" cy="16" r="1" fill="#F44336"></circle>
                    </svg>
                    <span>${message}</span>
                `;
                    errorElement.classList.add("show");
                } else {
                    errorElement.classList.remove("show");
                    errorElement.innerHTML = "";
                }
            }
            field.classList.toggle("input-error", !!message);
            return !message;
        }

        function getMessage(errorId) {
            return {
                emailError: "Email không đúng định dạng!",
                passwordError: "Mật khẩu phải dài ít nhất 6 ký tự!",
            } [errorId];
        }

        function emailFormat(email) {
            return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email);
        }

        function addIconToGeneralError() {
            const generalError = document.querySelector(".error-message-general");
            if (generalError && !generalError.innerHTML.includes("<svg")) {
                const message = generalError.textContent.trim();
                generalError.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="12" fill="#FFCDD2"></circle>
                    <path d="M12 7V13" stroke="#F44336" stroke-width="2" stroke-linecap="round"></path>
                    <circle cx="12" cy="16" r="1" fill="#F44336"></circle>
                </svg>
                <span>${message}</span>
            `;
            }
        }
    });
</script>