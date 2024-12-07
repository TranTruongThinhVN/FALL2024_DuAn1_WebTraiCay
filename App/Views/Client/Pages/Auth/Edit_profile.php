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
            <section id="purchase-history" class="purchase-history section">
                <!-- Top Navigation Tabs -->
                <nav class="purchase-history__tabs">
                    <button class="purchase-history__tab active">Tất cả</button>
                    <button class="purchase-history__tab">Chờ xử lý</button>
                    <button class="purchase-history__tab">Đang giao hàng</button>
                    <button class="purchase-history__tab">Hoàn thành</button>
                    <button class="purchase-history__tab">Đã hủy</button>
                    <button class="purchase-history__tab">Đã hoàn tiền</button>
                </nav>

                <!-- Search bar -->
                <div class="purchase-history__search">
                    <input type="text" placeholder="Bạn có thể tìm kiếm theo tên Shop, ID đơn hàng hoặc Tên sản phẩm" />
                </div>

                <!-- Đổ dữ liệu từ PHP -->
                <?php if (!empty($data['orders'])): ?>
                    <?php foreach ($data['orders'] as $order): ?>
                        <div class="purchase-history__item">
                            <!-- Nội dung chi tiết -->
                            <div class="purchase-history__item-details">
                                <img
                                    src="/uploads/products/<?= htmlspecialchars($order['details'][0]['product_image'] ?? 'default.jpg') ?>"
                                    alt="<?= htmlspecialchars($order['details'][0]['product_name'] ?? 'Không có') ?>"
                                    class="purchase-history__item-image" />
                                <div class="purchase-history__item-info">
                                    <p class="purchase-history__item-name">
                                        <?= htmlspecialchars($order['details'][0]['product_name'] ?? 'Sản phẩm không xác định') ?>
                                    </p>
                                    <p class="purchase-history__item-description">
                                        <?php if (!empty($order['details'][0]['variant_name'])): ?>
                                            <!-- Sản phẩm biến thể -->
                                            <?= htmlspecialchars($order['details'][0]['variant_name']) ?>
                                            <?= !empty($order['details'][0]['variant_options']) ? ' | ' . htmlspecialchars($order['details'][0]['variant_options']) : '' ?>
                                        <?php else: ?>
                                            <!-- Sản phẩm đơn giản -->
                                            <?= htmlspecialchars($order['details'][0]['product_origin'] ?? 'Không có mô tả') ?>
                                        <?php endif; ?>
                                    </p>

                                    <p class="purchase-history__item-quantity">Số lượng: x<?= htmlspecialchars($order['details'][0]['quantity'] ?? 0) ?></p>
                                    <p class="purchase-history__item-price-single">₫<?= number_format($order['details'][0]['price'] ?? 0, 0) ?></p>
                                </div>

                                <!-- Hiển thị trạng thái -->
                                <p class="purchase-history__item-status">
                                    <?php
                                    switch ($order['order_status']) {
                                        case 0:
                                            echo 'Chờ xử lý';
                                            break;
                                        case 1:
                                            echo 'Đang giao hàng';
                                            break;
                                        case 2:
                                            echo 'Đã hủy';
                                            break;
                                        case 3:
                                            echo 'Hoàn thành';
                                            break;
                                        case 4:
                                            echo 'Đã hoàn tiền';
                                            break;
                                        default:
                                            echo 'Không xác định';
                                            break;
                                    }
                                    ?>
                                </p>
                            </div>

                            <!-- Footer (Thành tiền và Nút hành động) -->
                            <div class="purchase-history__item-footer">
                                <p class="purchase-history__item-total">
                                    Thành tiền: <span class="purchase-history__item-total-price">₫<?= number_format($order['total_price'] ?? 0, 0) ?></span>
                                </p>
                                <div class="purchase-history__item-actions">
                                    <button class="purchase-history__item-reorder">Mua lại</button>
                                    <button class="purchase-history__item-detail">Xem chi tiết đơn hàng</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có đơn hàng nào để hiển thị.</p>
                <?php endif; ?>
            </section>





        </div>
        <div id="addPhoneForm" class="hidden add-phone-form">
            <form method="POST" action="/add-phone">
                <input type="hidden" name="method" value="POST">
                <label for="newPhone">Nhập số điện thoại:</label>
                <input type="text" id="newPhone" name="new_phone" placeholder="Nhập số điện thoại" required>
                <!-- <button type="button" id="sendOtpBtn">Gửi OTP</button> -->
                <div style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="flex: 1; margin-right: 10px;">
                        <label for="otp">Mã Xác Minh</label>
                        <input
                            type="text"
                            id="otp"
                            name="otp"
                            placeholder="Mã xác minh"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
                            disabled />
                    </div>
                    <button
                        type="button"
                        id="sendOtpBtn"
                        style="padding: 10px 15px; font-size: 14px; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 5px; cursor: pointer;">
                        Gửi Mã xác minh
                    </button>
                </div>

                <!-- Nút xác nhận -->
                <button
                    type="button"
                    id="confirmBtn"
                    style="width: 100%; padding: 10px; font-size: 16px; background-color: #fbd4d4; color: white; border: none; border-radius: 5px; cursor: pointer;"
                    disabled>
                    XÁC NHẬN
                </button>
            </form>

        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const sendOtpBtn = document.getElementById("sendOtpBtn");
                const confirmBtn = document.getElementById("confirmBtn");
                const phoneInput = document.getElementById("newPhone");
                const otpInput = document.getElementById("otp");

                // Gửi OTP khi nhấn nút "Gửi Mã xác minh"
                sendOtpBtn.addEventListener("click", async function() {
                    const phoneNumber = phoneInput.value.trim();

                    if (!phoneNumber) {
                        alert("Vui lòng nhập số điện thoại!");
                        return;
                    }

                    try {
                        const response = await fetch("http://localhost:8081/add-phone", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams({
                                new_phone: phoneNumber,
                                method: "POST",
                            }),
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();

                        console.log("Response Data:", data);
                        if (data.success) {
                            alert(data.message);
                            otpInput.disabled = false; // Kích hoạt trường OTP
                            otpInput.focus(); // Đưa con trỏ vào input OTP
                        } else {
                            alert(data.message || "Lỗi gửi OTP!");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("Không thể kết nối với server!");
                    }
                });

                // Theo dõi sự kiện nhập OTP
                otpInput.addEventListener("input", function() {
                    const otpValue = otpInput.value.trim();

                    // Kích hoạt nút "Xác Nhận" khi OTP có độ dài >= 6 ký tự
                    if (otpValue.length === 6) {
                        confirmBtn.disabled = false;
                    } else {
                        confirmBtn.disabled = true;
                    }
                });

                // Khi nhấn "Xác Nhận"
                confirmBtn.addEventListener("click", async function() {
                    const otp = otpInput.value.trim();
                    const phoneNumber = phoneInput.value.trim();

                    if (!otp) {
                        alert("Vui lòng nhập mã OTP!");
                        return;
                    }

                    try {
                        const response = await fetch("http://localhost:8081/phone-verify-otp", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams({
                                otp: otp,
                                new_phone: phoneNumber,
                            }),
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert("Xác minh thành công!");
                            otpInput.value = "";
                            otpInput.disabled = true;
                            confirmBtn.disabled = true;
                            // Thực hiện các hành động tiếp theo
                        } else {
                            alert(data.message || "Mã OTP không hợp lệ. Vui lòng thử lại.");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("Không thể kết nối với máy chủ. Vui lòng thử lại!");
                    }
                });
            });
        </script>
        </div>
        <!-- Hiển thị lỗi -->
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        </div>
        <script>

        </script>
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
            /* Form thêm số điện thoại */
            .add-phone-form {
                margin: 20px;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                /* max-width: 500px; */
                width: 80%;
                /* Giới hạn chiều rộng */
                /* text-align: center; */
            }

            .add-phone-form label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }

            .add-phone-form input[type="text"] {
                width: 100% !important;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                box-sizing: border-box;
            }

            .add-phone-form button {
                padding: 10px 20px;
                background-color: #28a745;
                color: #fff;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
            }

            .add-phone-form button:hover {
                background-color: #218838;
            }

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

        </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addPhoneLink = document.getElementById('addPhoneLink');
                const mainContent = document.getElementById('mainContent');
                const addPhoneForm = document.getElementById('addPhoneForm');
                const verifyOtpForm = document.getElementById('verifyOtpForm');
                const sendOtpBtn = document.getElementById('sendOtpBtn');

                // Ẩn form nhập OTP ban đầu
                verifyOtpForm.style.display = 'none';

                addPhoneLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    mainContent.classList.add('hidden');
                    addPhoneForm.classList.remove('hidden');
                });

                sendOtpBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const phoneNumber = document.getElementById('newPhone').value;

                    // Gửi AJAX request
                    fetch('/add-phone', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                'new_phone': phoneNumber
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Ẩn form nhập số điện thoại
                                addPhoneForm.style.display = 'none';
                                // Hiển thị form nhập OTP
                                verifyOtpForm.style.display = 'block';
                                // Tạo form nhập OTP 
                                verifyOtpForm.innerHTML = `
            <form method="POST" action="/phone-verify-otp">
              <label for="otp">Nhập mã OTP:</label>
              <input type="text" id="otp" name="otp" placeholder="Nhập mã OTP" required>
              <button type="submit">Xác nhận</button>
            </form>
          `;
                            } else {
                                // Hiển thị thông báo lỗi
                                alert(data.message);
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                });
            });
        </script>
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