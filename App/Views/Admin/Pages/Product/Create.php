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



                                    <!-- Danh mục -->
                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-3 text-end control-label col-form-label">Danh mục</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control <?= isset($_SESSION['errors']['category_id']) ? 'is-invalid' : '' ?>"
                                                id="category_id"
                                                name="category_id">
                                                <option value="">Chọn danh mục</option>
                                                <?php foreach ($data['categories'] as $category): ?>
                                                    <option
                                                        value="<?= htmlspecialchars((string)$category['id']) ?>"
                                                        <?= (isset($old['category_id']) && $old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars((string)$category['name']) ?>
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
                                    <div class="form-group row">
                                        <label for="product_type" class="col-sm-3 text-end control-label col-form-label">Loại sản phẩm</label>
                                        <div class="col-sm-9">
                                            <select id="product_type" name="product_type" class="form-control">
                                                <option value="simple">Sản phẩm đơn giản</option>
                                                <option value="variable">Sản phẩm có biến thể</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Giá và số lượng chỉ hiển thị nếu là sản phẩm đơn giản -->
                                    <div id="simple_product_fields">
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
                                        <div class="form-group row">
                                            <label for="discount_price" class="col-sm-3 text-end control-label col-form-label">Giá giảm</label>
                                            <div class="col-sm-9">
                                                <input
                                                    type="number"
                                                    id="discount_price"
                                                    name="discount_price"
                                                    class="form-control"
                                                    value="<?= htmlspecialchars($old['discount_price'] ?? '0', ENT_QUOTES) ?>"
                                                    step="0.01"
                                                    min="0">


                                                <?php if (isset($_SESSION['errors']['discount_price'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= htmlspecialchars($_SESSION['errors']['discount_price']) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- Trường số lượng -->
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
                                                    min="1">
                                                <?php if (isset($_SESSION['errors']['quantity'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= htmlspecialchars($_SESSION['errors']['quantity']) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Biến thể chỉ hiển thị nếu là sản phẩm có biến thể -->
                                    <div id="variable_product_fields" style="display: none;">
                                        <h4>Thêm biến thể</h4>
                                        <div class="form-group row">
                                            <label for="variant_action" class="col-sm-3 text-end control-label col-form-label">Thao tác</label>
                                            <div class="col-sm-9">
                                                <select id="variant_action" name="variant_action" class="form-control">
                                                    <option value="add_new">Thêm biến thể mới</option>
                                                    <option value="use_existing">Sử dụng biến thể hiện có</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Nếu chọn "Thêm biến thể mới" -->
                                        <div id="add_new_variant_fields" style="display: block;">
                                            <div class="form-group row">
                                                <label for="variant_name" class="col-sm-3 text-end control-label col-form-label">Tên biến thể</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="variant_name" name="variant_name" class="form-control" placeholder="Ví dụ: Kích thước, Màu sắc">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="variant_options" class="col-sm-3 text-end control-label col-form-label">Tùy chọn</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="variant_options" name="variant_options" class="form-control" placeholder="Nhập các tùy chọn, cách nhau bằng dấu phẩy">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nếu chọn "Sử dụng biến thể hiện có" -->
                                        <div id="use_existing_variant_fields" style="display: none;">
                                            <div class="form-group row">
                                                <label for="existing_variant_id" class="col-sm-3 text-end control-label col-form-label">Chọn biến thể</label>
                                                <div class="col-sm-9">
                                                    <select id="existing_variant_id" name="variant_id" class="form-control">
                                                        <option value="">Chọn biến thể hiện có</option>
                                                        <?php foreach ($data['variants'] as $variant): ?>
                                                            <option
                                                                value="<?= htmlspecialchars($variant['id'], ENT_QUOTES) ?>"
                                                                <?= ($data['selected_variant'] == $variant['id']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($variant['name'], ENT_QUOTES) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <label class="col-sm-3 text-end control-label col-form-label">Giá trị biến thể</label>
                                            <div class="col-sm-9">
                                                <div class="form-group row">
                                                    <ul id="variant_options_list" class="list-group">
                                                        <!-- Các giá trị sẽ được hiển thị ở đây -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bảng cấu hình SKU -->
                                        <div id="sku_configuration" style="display: none;">
                                            <h4>Cấu hình SKU</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tên biến thể</th>
                                                        <th>Giá trị</th>
                                                        <th>SKU</th>
                                                        <th>Giá</th>
                                                        <th>Số lượng</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sku_table_body">
                                                    <!-- Các dòng được thêm qua JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <script>
                                        // Hiển thị các trường tương ứng với hành động
                                        document.getElementById('product_type').addEventListener('change', function() {
                                            const type = this.value;
                                            document.getElementById('simple_product_fields').style.display = type === 'simple' ? 'block' : 'none';
                                            document.getElementById('variable_product_fields').style.display = type === 'variable' ? 'block' : 'none';
                                        });

                                        document.getElementById('variant_action').addEventListener('change', function() {
                                            const action = this.value;
                                            document.getElementById('add_new_variant_fields').style.display = action === 'add_new' ? 'block' : 'none';
                                            document.getElementById('use_existing_variant_fields').style.display = action === 'use_existing' ? 'block' : 'none';
                                        });

                                        document.getElementById('variant_options').addEventListener('input', function() {
                                            const options = this.value.split(',').map(option => option.trim()).filter(option => option);
                                            const skuTableBody = document.getElementById('sku_table_body');

                                            skuTableBody.innerHTML = ''; // Reset bảng SKU
                                            options.forEach(option => {
                                                const row = document.createElement('tr');
                                                row.innerHTML = `
            <td>${document.getElementById('variant_name').value}</td>
            <td>${option}</td>
            <td><input type="text" name="sku[${option}]" placeholder="SKU"></td>
            <td><input type="number" name="price[${option}]" placeholder="Giá"></td>
            <td><input type="number" name="quantity[${option}]" placeholder="Số lượng"></td>
        `;
                                                skuTableBody.appendChild(row);
                                            });

                                            document.getElementById('sku_configuration').style.display = options.length > 0 ? 'block' : 'none';
                                        });
                                    </script>

                                    <!-- Nút submit -->
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success">Xuất bản</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Khi chọn biến thể
                document.getElementById('existing_variant_id').addEventListener('change', function() {
                    const variantId = this.value;

                    if (!variantId) return;

                    // Gửi AJAX để lấy giá trị biến thể
                    fetch(`/admin/product-variants/options?variant_id=${variantId}`)
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                const tbody = document.getElementById('sku_table_body');
                                tbody.innerHTML = ''; // Xóa dữ liệu cũ

                                data.options.forEach((option) => {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                        <td>${option.name}</td>
                        <input type="hidden" name="variant_id" value="{variant_id}">

                       <td><input type="text" class="form-control sku-input" data-variant-id="1" placeholder="Nhập SKU"></td>
    <td><input type="number" class="form-control price-input" data-variant-id="1" placeholder="Nhập giá"></td>
    <td><input type="number" class="form-control discount-price-input" data-variant-id="1" placeholder="Nhập giá giảm"></td>
    <td><input type="number" class="form-control quantity-input" data-variant-id="1" placeholder="Nhập số lượng"></td>
    <td>
        <select class="form-control status-input" data-variant-id="1">
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
    </td>
    <td><input type="file" class="form-control image-input" data-variant-id="1"></td>
         <td><button class="btn btn-primary save-sku-btn" data-variant-id="${variantId}">Lưu</button></td>
                    `;
                                    tbody.appendChild(row);
                                });

                                document.getElementById('sku_configuration').style.display = 'block';
                            } else {
                                alert(data.message);
                            }
                        });
                });

                // Xử lý lưu SKU

                document.querySelector('#sku_table_body').addEventListener('click', function(event) {
                    if (event.target.classList.contains('save-sku-btn')) {
                        event.preventDefault();

                        const variantId = event.target.getAttribute('data-variant-id');
                        const skuInput = document.querySelector(`.sku-input[data-variant-id="${variantId}"]`).value;
                        const priceInput = document.querySelector(`.price-input[data-variant-id="${variantId}"]`).value;
                        const quantityInput = document.querySelector(`.quantity-input[data-variant-id="${variantId}"]`).value;
                        const statusInput = document.querySelector(`.status-input[data-variant-id="${variantId}"]`).value;

                        if (!skuInput || !priceInput || !quantityInput) {
                            alert('Vui lòng nhập đầy đủ thông tin SKU!');
                            return;
                        }

                        const formData = {
                            product_variant_id: variantId,
                            sku: skuInput,
                            price: priceInput,
                            quantity: quantityInput,
                            status: statusInput,
                        };

                        // Gửi request AJAX để lưu SKU
                        fetch('/admin/product/save-sku', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    product_variant_id: 1, // Dữ liệu cần thiết
                                    sku: 'TEST123',
                                    price: 100,
                                    quantity: 10,
                                    status: 1
                                })
                            })
                            .then(async response => {
                                const text = await response.text();
                                try {
                                    const data = JSON.parse(text); // Parse JSON
                                    if (data.success) {
                                        alert('Lưu SKU thành công!');
                                    } else {
                                        alert('Lỗi: ' + data.message);
                                    }
                                } catch (err) {
                                    console.error('Phản hồi không phải JSON:', text);
                                    alert('Phản hồi lỗi: ' + text);
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi fetch:', error.message);
                                alert('Đã xảy ra lỗi: ' + error.message);
                            });

                    }
                });
            </script>
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
            <!-- Thêm JavaScript để gọi API khi chọn biến thể: -->

            <!-- THEM VÀ HIEN THI GIA TRI -->
            <script>
                // Khi chọn biến thể
                document.getElementById('existing_variant_id').addEventListener('change', function() {
                    const variantId = this.value;
                    const optionsList = document.getElementById('variant_options_list');

                    // Xóa danh sách giá trị cũ
                    optionsList.innerHTML = '';

                    if (variantId) {
                        // Gửi AJAX để lấy danh sách giá trị
                        fetch(`/admin/product-variants/options?variant_id=${variantId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    data.options.forEach(option => {
                                        const li = document.createElement('li');
                                        li.textContent = option.name; // Giá trị
                                        li.classList.add('list-group-item');
                                        optionsList.appendChild(li);
                                    });
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                            });
                    }
                });
            </script>


    <?php
        unset($_SESSION['old']);
        unset($_SESSION['errors']);
    }
}

    ?>