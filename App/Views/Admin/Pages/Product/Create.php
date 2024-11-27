<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {
        $old = $_SESSION['old'] ?? [];
?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Nội dung form của bạn -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="/admin/add-product" method="POST" enctype="multipart/form-data" class="form-horizontal" id="addProductForm">
                                <input type="hidden" name="method" value="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm sản phẩm</h4>

                                    <!-- Tên sản phẩm -->
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-end control-label col-form-label">Tên sản phẩm</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control <?= isset($_SESSION['errors']['name']) ? 'is-invalid' : '' ?>"
                                                id="name"
                                                name="name"
                                                placeholder="Nhập tên sản phẩm"
                                                value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES) ?>">
                                            <?php if (isset($_SESSION['errors']['name'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['name']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Giá -->
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-3 text-end control-label col-form-label">Giá</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="number"
                                                class="form-control <?= isset($_SESSION['errors']['price']) ? 'is-invalid' : '' ?>"
                                                id="price"
                                                name="price"
                                                placeholder="Nhập giá sản phẩm"
                                                value="<?= htmlspecialchars($old['price'] ?? '', ENT_QUOTES) ?>"
                                                step="0.01"
                                                min="0.01">
                                            <?php if (isset($_SESSION['errors']['price'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['price']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Giá giảm -->
                                    <div class="form-group row">
                                        <label for="discount_price" class="col-sm-3 text-end control-label col-form-label">Giá giảm</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="number"
                                                class="form-control <?= isset($_SESSION['errors']['discount_price']) ? 'is-invalid' : '' ?>"
                                                id="discount_price"
                                                name="discount_price"
                                                placeholder="Nhập giá giảm (nếu có)"
                                                value="<?= htmlspecialchars($old['discount_price'] ?? '', ENT_QUOTES) ?>"
                                                step="0.01"
                                                min="0">
                                            <?php if (isset($_SESSION['errors']['discount_price'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['discount_price']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Danh mục -->
                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-3 text-end control-label col-form-label">Danh mục</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control <?= isset($_SESSION['errors']['category_id']) ? 'is-invalid' : '' ?>"
                                                id="category_id"
                                                name="category_id">
                                                <option value="">Chọn danh mục</option>
                                                <?php foreach ($data as $category): ?>
                                                    <option
                                                        value="<?= htmlspecialchars($category['id']) ?>"
                                                        <?= (isset($old['category_id']) && $old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($category['name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['category_id'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['category_id']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Ảnh chính -->
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-3 text-end control-label col-form-label">Ảnh chính</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="file"
                                                class="form-control <?= isset($_SESSION['errors']['image']) ? 'is-invalid' : '' ?>"
                                                id="image"
                                                name="image"
                                                accept="image/jpeg, image/png, image/gif">
                                            <?php if (isset($_SESSION['errors']['image'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['image']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="form-group row">
                                        <label for="thumbnails" class="col-sm-3 text-end control-label col-form-label">Ảnh nhỏ (thumbnails)</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="file"
                                                id="thumbnails"
                                                name="thumbnails[]"
                                                class="form-control <?= isset($_SESSION['errors']['thumbnails']) ? 'is-invalid' : '' ?>"
                                                accept="image/jpeg, image/png, image/gif"
                                                multiple>
                                            <?php if (isset($_SESSION['errors']['thumbnails'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['thumbnails']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Số lượng -->
                                    <div class="form-group row">
                                        <label for="quantity" class="col-sm-3 text-end control-label col-form-label">Số lượng</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="number"
                                                class="form-control <?= isset($_SESSION['errors']['quantity']) ? 'is-invalid' : '' ?>"
                                                id="quantity"
                                                name="quantity"
                                                placeholder="Nhập số lượng"
                                                value="<?= htmlspecialchars($old['quantity'] ?? '', ENT_QUOTES) ?>"
                                                step="1"
                                                min="0">
                                            <?php if (isset($_SESSION['errors']['quantity'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['quantity']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Trạng thái -->
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control <?= isset($_SESSION['errors']['status']) ? 'is-invalid' : '' ?>"
                                                id="status"
                                                name="status">
                                                <option value="1" <?= (isset($old['status']) && $old['status'] == 1) ? 'selected' : '' ?>>Còn hàng</option>
                                                <option value="0" <?= (isset($old['status']) && $old['status'] == 0) ? 'selected' : '' ?>>Hết hàng</option>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['status'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['status']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Nổi bật -->
                                    <div class="form-group row">
                                        <label for="is_featured" class="col-sm-3 text-end control-label col-form-label">Nổi bật</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control <?= isset($_SESSION['errors']['is_featured']) ? 'is-invalid' : '' ?>"
                                                id="is_featured"
                                                name="is_featured">
                                                <option value="0" <?= (isset($old['is_featured']) && $old['is_featured'] == 0) ? 'selected' : '' ?>>Bình thường</option>
                                                <option value="1" <?= (isset($old['is_featured']) && $old['is_featured'] == 1) ? 'selected' : '' ?>>Nổi bật</option>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['is_featured'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['is_featured']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Mô tả -->
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả</label>
                                        <div class="col-sm-9">
                                            <textarea
                                                class="form-control <?= isset($_SESSION['errors']['description']) ? 'is-invalid' : '' ?>"
                                                id="description"
                                                name="description"
                                                rows="10"
                                                placeholder="Nhập mô tả sản phẩm..."><?= htmlspecialchars($old['description'] ?? '', ENT_QUOTES) ?></textarea>
                                            <?php if (isset($_SESSION['errors']['description'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['description']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Nút submit -->
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success">Thêm</button>
                                            <button type="reset" class="btn btn-danger">Làm lại</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Validation Script -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.getElementById("addProductForm");
                    const nameInput = document.getElementById("name");
                    const priceInput = document.getElementById("price");
                    const discountPriceInput = document.getElementById("discount_price");
                    const quantityInput = document.getElementById("quantity");
                    const statusSelect = document.getElementById("status");
                    const isFeaturedSelect = document.getElementById("is_featured");
                    const categorySelect = document.getElementById("category_id");
                    const imageInput = document.getElementById("image");
                    const thumbnailsInput = document.getElementById("thumbnails");

                    // Hàm hiển thị lỗi
                    function showError(input, message) {
                        input.classList.add("is-invalid");
                        let errorElement = input.nextElementSibling;
                        if (!errorElement || !errorElement.classList.contains("invalid-feedback")) {
                            errorElement = document.createElement("div");
                            errorElement.className = "invalid-feedback";
                            input.parentNode.appendChild(errorElement);
                        }
                        errorElement.textContent = message;
                    }

                    // Hàm xóa lỗi
                    function clearError(input) {
                        input.classList.remove("is-invalid");
                        let errorElement = input.nextElementSibling;
                        if (errorElement && errorElement.classList.contains("invalid-feedback")) {
                            errorElement.remove();
                        }
                    }

                    // Kiểm tra tên sản phẩm
                    function validateName() {
                        const value = nameInput.value.trim();
                        if (value === "") {
                            showError(nameInput, "Không được để trống tên sản phẩm.");
                            return false;
                        } else {
                            clearError(nameInput);
                            return true;
                        }
                    }

                    // Kiểm tra giá
                    function validatePrice() {
                        const value = priceInput.value.trim();
                        if (value === "") {
                            showError(priceInput, "Không được để trống giá.");
                            return false;
                        } else if (isNaN(value) || parseFloat(value) <= 0) {
                            showError(priceInput, "Vui lòng nhập số lớn hơn 0.");
                            return false;
                        } else {
                            clearError(priceInput);
                            return true;
                        }
                    }

                    // Kiểm tra giá giảm
                    function validateDiscountPrice() {
                        const priceValue = parseFloat(priceInput.value.trim());
                        const discountValue = discountPriceInput.value.trim();
                        if (discountValue === "") {
                            clearError(discountPriceInput);
                            return true; // Không bắt buộc nhập
                        } else if (isNaN(discountValue)) {
                            showError(discountPriceInput, "Vui lòng nhập số.");
                            return false;
                        } else if (parseFloat(discountValue) < 0) {
                            showError(discountPriceInput, "Giá giảm phải lớn hơn hoặc bằng 0.");
                            return false;
                        } else if (parseFloat(discountValue) > priceValue) {
                            showError(discountPriceInput, "Giá giảm không được lớn hơn giá.");
                            return false;
                        } else {
                            clearError(discountPriceInput);
                            return true;
                        }
                    }

                    // Kiểm tra số lượng
                    function validateQuantity() {
                        const value = quantityInput.value.trim();
                        if (value === "") {
                            showError(quantityInput, "Không được để trống số lượng.");
                            return false;
                        } else if (isNaN(value) || parseInt(value) < 0) {
                            showError(quantityInput, "Vui lòng nhập số lượng hợp lệ (>= 0).");
                            return false;
                        } else {
                            clearError(quantityInput);
                            return true;
                        }
                    }

                    // Kiểm tra trạng thái
                    function validateStatus() {
                        const value = statusSelect.value;
                        if (value !== "0" && value !== "1") {
                            showError(statusSelect, "Vui lòng chọn trạng thái hợp lệ.");
                            return false;
                        } else {
                            clearError(statusSelect);
                            return true;
                        }
                    }

                    // Kiểm tra nổi bật
                    function validateIsFeatured() {
                        const value = isFeaturedSelect.value;
                        if (value !== "0" && value !== "1") {
                            showError(isFeaturedSelect, "Vui lòng chọn giá trị hợp lệ cho mục nổi bật.");
                            return false;
                        } else {
                            clearError(isFeaturedSelect);
                            return true;
                        }
                    }

                    // Kiểm tra danh mục
                    function validateCategory() {
                        const value = categorySelect.value;
                        if (value === "") {
                            showError(categorySelect, "Vui lòng chọn danh mục.");
                            return false;
                        } else {
                            clearError(categorySelect);
                            return true;
                        }
                    }

                    // Kiểm tra ảnh chính
                    function validateImage() {
                        if (imageInput.files.length === 0) {
                            showError(imageInput, "Ảnh chính không được để trống.");
                            return false;
                        } else {
                            const file = imageInput.files[0];
                            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                            if (!allowedTypes.includes(file.type)) {
                                showError(imageInput, "Chỉ cho phép định dạng JPG, PNG, GIF.");
                                return false;
                            }
                            clearError(imageInput);
                            return true;
                        }
                    }

                    // Kiểm tra thumbnails
                    function validateThumbnails() {
                        if (thumbnailsInput.files.length === 0) {
                            showError(thumbnailsInput, "Vui lòng tải lên ít nhất một ảnh thumbnail.");
                            return false;
                        } else {
                            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                            for (let i = 0; i < thumbnailsInput.files.length; i++) {
                                if (!allowedTypes.includes(thumbnailsInput.files[i].type)) {
                                    showError(thumbnailsInput, "Chỉ cho phép định dạng JPG, PNG, GIF cho tất cả các thumbnails.");
                                    return false;
                                }
                            }
                            clearError(thumbnailsInput);
                            return true;
                        }
                    }

                    // Gắn sự kiện cho các input
                    nameInput.addEventListener("input", validateName);
                    priceInput.addEventListener("input", function() {
                        validatePrice();
                        validateDiscountPrice(); // Kiểm tra lại giá giảm khi giá thay đổi
                    });
                    discountPriceInput.addEventListener("input", validateDiscountPrice);
                    quantityInput.addEventListener("input", validateQuantity);
                    statusSelect.addEventListener("change", validateStatus);
                    isFeaturedSelect.addEventListener("change", validateIsFeatured);
                    categorySelect.addEventListener("change", validateCategory);
                    imageInput.addEventListener("change", validateImage);
                    thumbnailsInput.addEventListener("change", validateThumbnails);

                    // Kiểm tra toàn bộ form khi submit
                    form.addEventListener("submit", function(event) {
                        let isFormValid = true;

                        if (!validateName()) isFormValid = false;
                        if (!validatePrice()) isFormValid = false;
                        if (!validateDiscountPrice()) isFormValid = false;
                        if (!validateQuantity()) isFormValid = false;
                        if (!validateStatus()) isFormValid = false;
                        if (!validateIsFeatured()) isFormValid = false;
                        if (!validateCategory()) isFormValid = false;
                        if (!validateImage()) isFormValid = false;
                        if (!validateThumbnails()) isFormValid = false;

                        if (!isFormValid) {
                            event.preventDefault(); // Ngăn chặn submit nếu form không hợp lệ
                        }
                    });

                    // Hàm xóa lỗi khi người dùng sửa đổi các trường
                    const inputs = form.querySelectorAll("input, textarea, select");
                    inputs.forEach((input) => {
                        input.addEventListener("input", function() {
                            if (this.classList.contains("is-invalid")) {
                                this.classList.remove("is-invalid");
                                const errorElement = this.nextElementSibling;
                                if (errorElement && errorElement.classList.contains("invalid-feedback")) {
                                    errorElement.remove();
                                }
                            }
                        });
                        input.addEventListener("change", function() {
                            if (this.classList.contains("is-invalid")) {
                                this.classList.remove("is-invalid");
                                const errorElement = this.nextElementSibling;
                                if (errorElement && errorElement.classList.contains("invalid-feedback")) {
                                    errorElement.remove();
                                }
                            }
                        });
                    });
                });
            </script>
            <!-- CKEditor -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    try {
                        CKEDITOR.replace('description', {
                            height: 300,
                            filebrowserUploadUrl: '/admin/products/upload-image', // API xử lý upload
                            filebrowserUploadMethod: 'form' // Gửi file qua method POST
                        });
                    } catch (error) {
                        console.error("CKEditor initialization error:", error);
                    }
                });
            </script>



    <?php
        unset($_SESSION['old']);
        unset($_SESSION['errors']);
    }
}

    ?>