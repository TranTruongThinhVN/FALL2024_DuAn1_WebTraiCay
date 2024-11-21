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
            <div class="account-page__content" id="mainContent">
                <!-- Profile Section -->
                <div id="profile" class="profile section active">
                    <h2 class="profile__title">Hồ Sơ Của Tôi</h2>
                    <p class="profile__description">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    <div class="profile__content">
                        <form class="profile__form" method="post" action="/users/<?= $data['id'] ?>" enctype="multipart/form-data">
                            <input type="hidden" name="method" value="PUT">

                            <!-- Hiển thị Email (chỉ đọc) -->
                            <div class="form-group__profile">
                                <label class="profile__label">Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>" class="profile__input" readonly>

                            </div>
                            <!-- Hiển thị Họ -->
                            <div class="form-group__profile">
                                <label class="profile__label">Tên</label>
                                <input type="text" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>" class="profile__input">


                            </div>

                            <!-- Hiển thị Số điện thoại -->
                            <div class="form-group__profile">
                                <label class="profile__label">Số điện thoại</label>
                                <div class="phone-section">
                                    <span id="currentPhone"><?= htmlspecialchars($data['phone'] ?? 'Chưa có') ?></span>
                                    <a href="#" id="addPhoneLink" class="add-phone-link">Thêm</a>
                                </div>
                            </div>
                            <!-- Hiển thị Giới tính -->
                            <div class="form-group__profile">
                                <label class="profile__label">Giới tính</label>
                                <div class="profile__input-row">
                                    <div class="form-group__profile__radio">
                                        <input type="radio" name="gender" value="male" id="male"
                                            <?= (isset($data['gender']) && $data['gender'] === 'male') ? 'checked' : '' ?>>
                                        <label for="male">Nam</label>
                                    </div>

                                    <div class="form-group__profile__radio">
                                        <input type="radio" name="gender" value="female" id="female"
                                            <?= (isset($data['gender']) && $data['gender'] === 'female') ? 'checked' : '' ?>>
                                        <label for="female">Nữ</label>
                                    </div>

                                    <div class="form-group__profile__radio">
                                        <input type="radio" name="gender" value="other" id="other"
                                            <?= (isset($data['gender']) && $data['gender'] === 'other') ? 'checked' : '' ?>>
                                        <label for="other">Khác</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group__profile">
                                <label for="dob" class="profile__label">Ngày sinh</label>
                                <div class="dob-container">
                                    <?php if (isset($_GET['edit_dob']) && $_GET['edit_dob'] == 1): ?>
                                        <!-- Hiển thị dropdown nếu nhấn "Thay Đổi" -->
                                        <select name="dob_day">
                                            <option value="">Ngày</option>
                                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                                <option value="<?= $i ?>" <?= isset($data['dob']) && date('d', strtotime($data['dob'])) == $i ? 'selected' : '' ?>>
                                                    <?= $i ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                        <select name="dob_month">
                                            <option value="">Tháng</option>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?= $i ?>" <?= isset($data['dob']) && date('m', strtotime($data['dob'])) == $i ? 'selected' : '' ?>>
                                                    <?= $i ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                        <select name="dob_year">
                                            <option value="">Năm</option>
                                            <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                                                <option value="<?= $i ?>" <?= isset($data['dob']) && date('Y', strtotime($data['dob'])) == $i ? 'selected' : '' ?>>
                                                    <?= $i ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    <?php elseif (isset($data['dob']) && !empty($data['dob'])): ?>
                                        <!-- Hiển thị ngày sinh dạng text nếu đã cập nhật -->
                                        <span><?= date('d/m/Y', strtotime($data['dob'])) ?></span>
                                        <a href="?edit_dob=1" class="edit-dob-link">Thay Đổi</a>
                                    <?php else: ?>
                                        <!-- Hiển thị dropdown nếu chưa có ngày sinh -->
                                        <select name="dob_day">
                                            <option value="">Ngày</option>
                                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <select name="dob_month">
                                            <option value="">Tháng</option>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <select name="dob_year">
                                            <option value="">Năm</option>
                                            <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                                <!-- Hiển thị lỗi, nếu có -->
                                <?php if (isset($_SESSION['errors']['dob'])): ?>
                                    <div class="dob-error" id="dobError">
                                        <?= htmlspecialchars($_SESSION['errors']['dob']) ?>
                                    </div>
                                    <?php unset($_SESSION['errors']['dob']); ?>
                                <?php endif; ?>
                            </div>





                            <input type="file" id="avatarInput" name="avatar" accept=".jpg, .jpeg, .png" class="profile__avatar-input" style="display: none;">

                            <!-- Hiển thị Ngày sinh -->
                            <!-- <label class="profile__label">Ngày sinh</label>
                            <input type="date" name="dob" value="<?= htmlspecialchars($data['dob'] ?? '') ?>" class="profile__input"> -->
                            <button type="submit" class="profile__button">Lưu</button>
                        </form>


                        <<div class="profile__avatar">
                            <!-- Avatar -->
                            <img
                                id="avatarImage"
                                src="<?= !empty($data['avatar']) ? APP_URL . '/public/uploads/users/' . $data['avatar'] : '' ?>"
                                data-default-src="<?= !empty($data['avatar']) ? APP_URL . '/public/uploads/users/' . $data['avatar'] : '' ?>"
                                alt="User Avatar"
                                class="profile__avatar-image"
                                style="<?= !empty($data['avatar']) ? 'display: block;' : 'display: none;' ?>">

                            <!-- Placeholder -->
                            <?php if (empty($data['avatar'])): ?>
                                <div
                                    id="avatarPlaceholder"
                                    class="profile__avatar-placeholder">
                                    <?= strtoupper(substr($data['email'] ?? 'U', 0, 1)) ?>
                                </div>
                            <?php endif; ?>

                            <!-- Chọn ảnh -->
                            <label for="avatarInput" class="profile__avatar-button">Chọn Ảnh</label>
                            <input type="file" id="avatarInput" name="avatar" accept=".jpg, .jpeg, .png" style="display: none;">
                            <p class="profile__avatar-info">Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</p>
                    </div>




                </div>


            </div>

        </div>
        <div id="addPhoneForm" class="hidden">
            <form method="POST" action="/add-phone">
                <input type="hidden" name="method" value="POST">
                <label for="newPhone">Nhập số điện thoại:</label>
                <input type="text" id="newPhone" name="new_phone" placeholder="Nhập số điện thoại" required>
                <button type="submit">Gửi OTP</button>
            </form>
        </div>

        <!-- Hiển thị lỗi -->
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const addPhoneLink = document.getElementById("addPhoneLink");
                const mainContent = document.getElementById("mainContent");
                const addPhoneForm = document.getElementById("addPhoneForm");

                // Khi nhấn nút "Thêm"
                addPhoneLink.addEventListener("click", function(e) {
                    e.preventDefault();

                    // Ẩn nội dung chính và hiển thị form
                    mainContent.classList.add("hidden");
                    addPhoneForm.classList.remove("hidden");
                });
            });
        </script>

        <style>
            /* Điều chỉnh layout cho form "Thêm Số Điện Thoại" */
            .add-phone-form {
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f9f9f9;
                max-width: 500px;
                /* Giới hạn chiều rộng */
                text-align: center;
                /* Căn giữa nội dung */
            }

            .add-phone-form h2 {
                margin-bottom: 15px;
                font-size: 20px;
                color: #333;
            }

            .add-phone-form label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }

            .add-phone-form input[type="text"] {
                width: 100%;
                /* Đảm bảo input chiếm toàn bộ chiều rộng */
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                box-sizing: border-box;
                /* Đảm bảo padding không gây tràn */
            }

            .add-phone-form button {
                padding: 10px 20px;
                background-color: #28a745;
                color: #fff;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .add-phone-form button:hover {
                background-color: #218838;
            }

            /* Xử lý lỗi hiển thị chiều ngang */
            .add-phone-form .form-row {
                display: flex;
                flex-direction: column;
                /* Sắp xếp theo cột */
                align-items: center;
                /* Căn giữa các phần tử */
            }

            /* Ẩn form khi không cần */
            .hidden {
                display: none;
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.querySelector(".profile__form");
                const dayField = document.querySelector("[name='dob_day']");
                const monthField = document.querySelector("[name='dob_month']");
                const yearField = document.querySelector("[name='dob_year']");
                const dobErrorId = "dobError";

                form.addEventListener("submit", function(event) {
                    // Xóa lỗi cũ
                    const existingError = document.getElementById(dobErrorId);
                    if (existingError) existingError.remove();

                    // Kiểm tra ngày sinh ONLY IF user has entered something
                    if (dayField.value || monthField.value || yearField.value) {
                        if (
                            !dayField.value ||
                            !monthField.value ||
                            !yearField.value ||
                            !checkValidDate(
                                parseInt(yearField.value),
                                parseInt(monthField.value),
                                parseInt(dayField.value)
                            )
                        ) {
                            event.preventDefault(); // Ngăn gửi form nếu lỗi
                            showErrorMessage(
                                document.querySelector(".dob-container"),
                                dobErrorId,
                                "Vui lòng nhập ngày sinh hợp lệ!"
                            );
                        }
                    }
                });

                function checkValidDate(year, month, day) {
                    // Kiểm tra ngày hợp lệ
                    return (
                        year > 1900 &&
                        year <= new Date().getFullYear() &&
                        month >= 1 &&
                        month <= 12 &&
                        day >= 1 &&
                        day <= new Date(year, month, 0).getDate()
                    );
                }

                function showErrorMessage(parentElement, errorId, message) {
                    const errorElement = document.createElement("div");
                    errorElement.id = errorId;
                    errorElement.className = "error-message show";
                    errorElement.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#FFCDD2"></circle>
                <path d="M12 7V13" stroke="#F44336" stroke-width="2" stroke-linecap="round"></path>
                <circle cx="12" cy="16" r="1" fill="#F44336"></circle>
            </svg>
            <span>${message}</span>
        `;
                    parentElement.appendChild(errorElement);
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const avatarInput = document.getElementById("avatarInput");
                const avatarImage = document.getElementById("avatarImage");
                const avatarPlaceholder = document.getElementById("avatarPlaceholder");

                avatarInput.addEventListener("change", function() {
                    const file = avatarInput.files[0];

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Hiển thị ảnh preview
                            if (avatarImage) {
                                avatarImage.src = e.target.result;
                                avatarImage.style.display = "block";
                            }
                            // Ẩn placeholder
                            if (avatarPlaceholder) {
                                avatarPlaceholder.style.display = "none";
                            }
                        };

                        reader.readAsDataURL(file); // Đọc file
                    } else {
                        // Nếu không chọn file, khôi phục trạng thái ban đầu
                        if (avatarImage) {
                            avatarImage.src = avatarImage.dataset.defaultSrc || "";
                            avatarImage.style.display = avatarImage.dataset.defaultSrc ? "block" : "none";
                        }
                        if (avatarPlaceholder) {
                            avatarPlaceholder.style.display = avatarImage.dataset.defaultSrc ? "none" : "block";
                        }
                    }
                });
            });
        </script>
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