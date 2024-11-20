<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Edit_profile extends BaseView
{
    public static function render($data = null)
    {
?>

        <div class="account-page">
            <!-- Sidebar -->
            <div class="account-page__sidebar">
                <ul class="account-page__menu">
                    <li class="account-page__menu-item">
                        <a href="#profile" class="account-page__menu-link active" data-section="profile">Tài Khoản Của Tôi</a>
                    </li>
                    <li class="account-page__menu-item">
                        <a href="#purchase-history" class="account-page__menu-link" data-section="purchase-history">Lịch Sử Mua Hàng</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="account-page__content">
                <!-- Profile Section -->
                <div id="profile" class="profile section active">
                    <h2 class="profile__title">Hồ Sơ Của Tôi</h2>
                    <p class="profile__description">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    <div class="profile__content">
                        <form class="profile__form" method="post" action="/users/<?= $data['id'] ?>" enctype="multipart/form-data">
                            <input type="hidden" name="method" value="PUT">

                            <!-- Hiển thị Email (chỉ đọc) -->
                            <label class="profile__label">Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>" class="profile__input" readonly>

                            <!-- Hiển thị Họ -->
                            <label class="profile__label">Tên</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>" class="profile__input">



                            <!-- Hiển thị Số điện thoại -->
                            <label class="profile__label">Số điện thoại</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($data['phone'] ?? '') ?>" class="profile__input">

                            <!-- Hiển thị Giới tính -->
                            <label class="profile__label">Giới tính</label>
                            <div class="profile__input-row">
                                <input type="radio" name="gender" value="male" id="male"
                                    <?= (isset($data['gender']) && $data['gender'] === 'male') ? 'checked' : '' ?>
                                    required>
                                <label for="male">Nam</label>

                                <input type="radio" name="gender" value="female" id="female"
                                    <?= (isset($data['gender']) && $data['gender'] === 'female') ? 'checked' : '' ?>
                                    required>
                                <label for="female">Nữ</label>

                                <input type="radio" name="gender" value="other" id="other"
                                    <?= (isset($data['gender']) && $data['gender'] === 'other') ? 'checked' : '' ?>
                                    required>
                                <label for="other">Khác</label>
                            </div>
                            <input type="file" id="avatarInput" name="avatar" accept=".jpg, .jpeg, .png" class="profile__avatar-input" style="display: none;">

                            <!-- Hiển thị Ngày sinh -->
                            <!-- <label class="profile__label">Ngày sinh</label>
                            <input type="date" name="dob" value="<?= htmlspecialchars($data['dob'] ?? '') ?>" class="profile__input"> -->
                            <button type="submit" class="profile__button">Lưu</button>
                        </form>


                        <div class="profile__avatar">
                            <?php if (!empty($data['avatar'])): ?>
                                <!-- Hiển thị avatar nếu có -->
                                <img id="avatarImage" src="<?= APP_URL ?>/public/uploads/users/<?= $data['avatar'] ?>" alt="User Avatar" class="profile__avatar-image">

                            <?php else: ?>
                                <!-- Hiển thị chữ cái đầu của email nếu không có avatar -->
                                <div class="profile__avatar-placeholder">
                                    <?= strtoupper(substr($data['email'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <label for="avatarInput" class="profile__avatar-button">Chọn Ảnh</label>

                            <p class="profile__avatar-info">Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Purchase History Section -->
        <div id="purchase-history" class="purchase-history section">
            <h2 class="purchase-history__title">Lịch Sử Mua Hàng</h2>

            <!-- Purchase Item -->
            <div class="purchase-history__item">
                <div class="purchase-history__item-details">
                    <img src="path/to/product-image.jpg" alt="Product Image" class="purchase-history__item-image">
                    <div class="purchase-history__item-info">
                        <h3 class="purchase-history__item-name">Bộ nắp sau tay lái | ốp gáy sau Vision</h3>
                        <p class="purchase-history__item-description">Màu Xám xi măng *NHC60P*</p>
                        <p class="purchase-history__item-quantity">x1</p>
                    </div>
                </div>

                <!-- Reorder Button -->
                <button class="purchase-history__item-reorder">Mua Lại</button>
            </div>

            <!-- Add more order history content here -->
        </div>
        </div>
        </div>

<?php
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const avatarPlaceholders = document.querySelectorAll(".profile__avatar-placeholder, .user-initial");
        avatarPlaceholders.forEach(avatar => {
            const colors = ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#FF8C33"];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            avatar.style.backgroundColor = randomColor;
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuLinks = document.querySelectorAll(".account-page__menu-link");

        // Event listener for each menu link
        menuLinks.forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();

                const sectionId = this.getAttribute("data-section");

                // Hide all sections by removing 'active' class
                document.querySelectorAll(".section").forEach(section => {
                    section.classList.remove("active");
                });

                // Show the selected section
                document.getElementById(sectionId).classList.add("active");

                // Remove 'active' class from all menu links
                menuLinks.forEach(link => link.classList.remove("active"));

                // Add 'active' class to the clicked menu link
                this.classList.add("active");
            });
        });
    });
</script>
<style>
    /* Initially hide all sections */
    .section {
        display: none;
    }

    /* Show the active section */
    .section.active {
        display: block;
    }
</style>