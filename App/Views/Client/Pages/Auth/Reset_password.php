<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Reset_password extends BaseView
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
                    <span class="top-title">Đặt lại mật khẩu</span> <!-- Chữ "Đăng ký" bên cạnh logo -->
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
            <div class="container-reset-password">
                <div class="reset-password">
                    <div class="reset-password__header">
                        <a href="/login" class="reset-password__back-button">&#8592;</a>
                        <h2 class="reset-password__title">Đặt lại mật khẩu</h2>
                    </div>

                    <form class="reset-password__form" action="/reset-password" method="post">
                        <input type="hidden" name="method" value="POST">

                        <!-- Mật khẩu mới -->
                        <div class="reset-password__field">
                            <input
                                type="password"
                                name="new_password"
                                id="newPassword"
                                class="reset-password__input"
                                placeholder="Mật khẩu mới"
                                value="<?= isset($_POST['new_password']) ? htmlspecialchars($_POST['new_password']) : '' ?>" />
                            <span id="newPasswordError" class="reset-password__error">
                                <?= $_SESSION['errors']['new_password'] ?? '' ?>
                            </span>
                        </div>

                        <!-- Xác nhận mật khẩu -->
                        <div class="reset-password__field">
                            <input
                                type="password"
                                name="confirm_password"
                                id="confirmPassword"
                                class="reset-password__input"
                                placeholder="Xác nhận mật khẩu mới"
                                value="<?= isset($_POST['confirm_password']) ? htmlspecialchars($_POST['confirm_password']) : '' ?>" />
                            <span id="confirmPasswordError" class="reset-password__error">
                                <?= $_SESSION['errors']['confirm_password'] ?? '' ?>
                            </span>
                        </div>

                        <!-- Nút submit -->
                        <button type="submit" class="reset-password__submit-button">ĐẶT LẠI MẬT KHẨU</button>
                    </form>
                </div>
            </div>

    <?php
    }
}
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector(".reset-password__form");
            const newPasswordField = document.getElementById("newPassword");
            const confirmPasswordField = document.getElementById("confirmPassword");
            const newPasswordError = document.getElementById("newPasswordError");
            const confirmPasswordError = document.getElementById("confirmPasswordError");

            form.addEventListener("submit", function(event) {
                event.preventDefault();
                if (validateAll()) {
                    form.submit();
                }
            });

            [newPasswordField, confirmPasswordField].forEach((field) => {
                field.addEventListener("input", validateAll);
            });

            function validateAll() {
                const newPasswordValid = validate(
                    newPasswordField,
                    newPasswordError,
                    "Mật khẩu không được để trống",
                    passwordFormat(newPasswordField.value)
                );
                const confirmPasswordValid = validate(
                    confirmPasswordField,
                    confirmPasswordError,
                    "Xác nhận mật khẩu không được để trống",
                    newPasswordField.value === confirmPasswordField.value
                );
                return newPasswordValid && confirmPasswordValid;
            }

            function validate(field, errorElement, emptyMessage, condition = true) {
                const message = !field.value ?
                    emptyMessage :
                    condition ?
                    "" :
                    getMessage(field.name);

                if (message) {
                    errorElement.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="12" fill="#FFCDD2"></circle>
                    <path d="M12 7V13" stroke="#F44336" stroke-width="2" stroke-linecap="round"></path>
                    <circle cx="12" cy="16" r="1" fill="#F44336"></circle>
                </svg>
                <span>${message}</span>
            `;
                    errorElement.style.display = "flex";
                    field.classList.add("input-error");
                } else {
                    errorElement.innerHTML = "";
                    errorElement.style.display = "none";
                    field.classList.remove("input-error");
                }

                return !message;
            }

            function getMessage(fieldName) {
                const messages = {
                    new_password: "Mật khẩu phải có ít nhất 6 ký tự, bao gồm ít nhất một ký tự hoa, một ký tự thường, một chữ số và một ký tự đặc biệt",
                    confirm_password: "Xác nhận mật khẩu không khớp",
                };
                return messages[fieldName];
            }

            function passwordFormat(password) {
                return (
                    password.length >= 6 &&
                    /[A-Z]/.test(password) &&
                    /[a-z]/.test(password) &&
                    /[0-9]/.test(password) &&
                    /[\W]/.test(password)
                );
            }
        });
    </script>