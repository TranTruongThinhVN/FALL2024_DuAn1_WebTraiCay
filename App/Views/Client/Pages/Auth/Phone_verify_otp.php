<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Phone_verify_otp extends BaseView
{
    public static function render($data = null)
    {
?>

        <div class="otp-page">
            <h2>Nhập mã xác nhận</h2>
            <p>Mã xác minh của bạn đã được gửi đến số: <?= htmlspecialchars($_SESSION['new_phone']) ?></p>

            <form method="POST" action="/phone-verify-otp">
                <input type="hidden" name="method" value="POST">
                <label for="otp">Mã OTP:</label>
                <input type="text" id="otp" name="otp" placeholder="Nhập mã OTP" required>
                <button type="submit">Xác minh</button>
            </form>

            <!-- Hiển thị lỗi -->
            <?php if (isset($_SESSION['error'])): ?>
                <p class="error"><?= $_SESSION['error'] ?></p>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>

<?php
    }
}
?>