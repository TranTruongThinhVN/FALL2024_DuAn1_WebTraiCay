<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Edit_product extends BaseView
{
  public static function render($data = null)
  {

?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" id="addProductForm">
                <input type="hidden" name="method" value="PUT">
                <div class="card-body">
                  <h4 class="card-title">Sửa sản phẩm</h4>
                  <div class="container">
                    <div class="row justify-content-center">
                      <!-- Ảnh chính -->
                      <div class="col-md-6 text-center">
                        <div class="main-image-container">
                          <img src="/public/uploads/products/<?= $data['product']['image'] ?>" alt="Ảnh chính" class="main-image img-fluid mb-3">
                          <button type="button" class="btn btn-primary change-main-image-btn">Thay đổi ảnh chính</button>
                          <input type="file" class="form-control d-none" id="main-image-input" name="image">
                        </div>
                      </div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="row justify-content-center mt-4">
                      <?php
                      $thumbnails = !empty($data['product']['thumbnails'])
                        ? json_decode($data['product']['thumbnails'], true)
                        : [];
                      foreach ($thumbnails as $index => $thumbnail): ?>
                        <div class="col-4 col-sm-3 col-md-2 text-center mb-3">
                          <div class="thumbnail-item">
                            <img src="/public/uploads/thumbnails/<?= $thumbnail ?>" alt="Thumbnail" class="thumbnail-image img-fluid mb-2">
                            <div class="thumbnail-actions">
                              <button type="button" class="btn btn-secondary btn-sm change-thumbnail-btn" data-index="<?= $index ?>">Thay đổi</button>

                            </div>
                            <input type="file" class="form-control d-none thumbnail-input" name="thumbnails[<?= $index ?>]" id="thumbnail-input-<?= $index ?>">
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>



                  <!-- Tên sản phẩm -->
                  <div class="form-group row">
                    <label for="name" class="col-sm-3 text-end control-label col-form-label">Tên sản phẩm</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control <?= isset($_SESSION['errors']['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= $data['product']['name'] ?>" placeholder="Nhập tên sản phẩm">
                      <?php if (isset($_SESSION['errors']['name'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['name'] ?>!</span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="price" class="col-sm-3 text-end control-label col-form-label">Giá</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control <?= isset($_SESSION['errors']['price']) ? 'is-invalid' : '' ?>" id="price" name="price" value="<?= $data['product']['price'] ?>" placeholder="Nhập giá sản phẩm">
                      <?php if (isset($_SESSION['errors']['price'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['price'] ?>!</span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="discount_price" class="col-sm-3 text-end control-label col-form-label">Giá giảm</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control <?= isset($_SESSION['errors']['discount_price']) ? 'is-invalid' : '' ?>" id="discount_price" name="discount_price" value="<?= $data['product']['discount_price'] ?>" placeholder="Nhập giá giảm">
                      <?php if (isset($_SESSION['errors']['discount_price'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['discount_price'] ?>!</span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="category_id" class="col-sm-3 text-end control-label col-form-label">Danh mục</label>
                    <div class="col-sm-9">
                      <select class="form-control <?= isset($_SESSION['errors']['category_id']) ? 'is-invalid' : '' ?>" id="category_id" name="category_id">
                        <option value="">Chọn danh mục</option>
                        <?php foreach ($data['categories'] as $category): ?>
                          <option value="<?= $category['id'] ?>" <?= ($data['product']['category_id'] == $category['id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php if (isset($_SESSION['errors']['category_id'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['category_id'] ?></span>
                      <?php endif; ?>
                    </div>
                  </div>





                  <div class="form-group row">
                    <label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả</label>
                    <div class="col-sm-9">
                      <textarea class="form-control <?= isset($_SESSION['errors']['description']) ? 'is-invalid' : '' ?>" id="description" name="description" rows="4"><?= $data['product']['description'] ?></textarea>
                      <?php if (isset($_SESSION['errors']['description'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['description'] ?>!</span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Sản phẩm nổi bật -->
                  <div class="form-group row">
                    <label for="is_featured" class="col-sm-3 text-end control-label col-form-label">Sản phẩm nổi bật</label>
                    <div class="col-sm-9">
                      <select class="form-control <?= isset($_SESSION['errors']['is_featured']) ? 'is-invalid' : '' ?>" id="is_featured" name="is_featured">
                        <option value="1" <?= ($data['product']['is_featured'] == '1') ? 'selected' : '' ?>>Có</option>
                        <option value="0" <?= ($data['product']['is_featured'] == '0') ? 'selected' : '' ?>>Không</option>
                      </select>
                      <?php if (isset($_SESSION['errors']['is_featured'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['is_featured'] ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái</label>
                    <div class="col-sm-9">
                      <select class="form-control <?= isset($_SESSION['errors']['status']) ? 'is-invalid' : '' ?>" id="status" name="status">
                        <option value="1" <?= ($data['product']['status'] == '1') ? 'selected' : '' ?>>Còn hàng</option>
                        <option value="0" <?= ($data['product']['status'] == '0') ? 'selected' : '' ?>>Hết hàng</option>
                      </select>
                      <?php if (isset($_SESSION['errors']['status'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['status'] ?>!</span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="quantity" class="col-sm-3 text-end control-label col-form-label">Số lượng</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control <?= isset($_SESSION['errors']['quantity']) ? 'is-invalid' : '' ?>" id="quantity" name="quantity" value="<?= $data['product']['quantity'] ?>" placeholder="Nhập số lượng">
                      <?php if (isset($_SESSION['errors']['quantity'])): ?>
                        <span class="text-danger error-message"><?= $_SESSION['errors']['quantity'] ?>!</span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-success">Thêm</button>
                      <button type="reset" class="btn btn-danger">Làm lại</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("addProductForm");
        const inputs = form.querySelectorAll("input, textarea");

        inputs.forEach((input) => {
          input.addEventListener("input", function() {
            if (this.classList.contains("is-invalid")) {
              this.classList.remove("is-invalid");
              const errorMessage = this.nextElementSibling;
              if (errorMessage && errorMessage.classList.contains("error-message")) {
                errorMessage.remove();
              }
            }
          });
        });
      });
    </script>
    <style>
      .d-none {
        display: none;
      }

      .main-image-container,
      .thumbnail-container {
        text-align: center;
        margin-bottom: 20px;
      }

      .thumbnail-item {
        display: inline-block;
        margin: 10px;
        text-align: center;
      }
    </style>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Xử lý thay đổi ảnh chính
        const mainImageBtn = document.querySelector(".change-main-image-btn");
        const mainImageInput = document.getElementById("main-image-input");

        mainImageBtn.addEventListener("click", function() {
          mainImageInput.click();
        });

        // Xử lý thay đổi thumbnail
        const changeThumbnailButtons = document.querySelectorAll(".change-thumbnail-btn");

        changeThumbnailButtons.forEach(button => {
          button.addEventListener("click", function() {
            const index = button.getAttribute("data-index");
            const thumbnailInput = document.getElementById(`thumbnail-input-${index}`);
            thumbnailInput.click();
          });
        });
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("addProductForm");

        // Các trường cần validate
        const nameInput = document.getElementById("name");
        const priceInput = document.getElementById("price");
        const discountPriceInput = document.getElementById("discount_price");
        const categorySelect = document.getElementById("category_id");
        const imageInput = document.getElementById("main-image-input");

        // Hiển thị lỗi
        function showError(input, message) {
          let errorElement = input.nextElementSibling;

          if (!errorElement || !errorElement.classList.contains("error-message")) {
            errorElement = document.createElement("span");
            errorElement.classList.add("text-danger", "error-message");
            input.parentNode.appendChild(errorElement);
          }
          errorElement.textContent = message;
          input.classList.add("is-invalid");
        }

        // Xóa lỗi
        function clearError(input) {
          const errorElement = input.nextElementSibling;
          if (errorElement && errorElement.classList.contains("error-message")) {
            errorElement.remove();
          }
          input.classList.remove("is-invalid");
        }

        // Các hàm validate
        function validateName() {
          if (nameInput.value.trim() === "") {
            showError(nameInput, "Tên sản phẩm không được để trống");
          } else {
            clearError(nameInput);
          }
        }

        function validatePrice() {
          const value = priceInput.value.trim();
          if (value === "") {
            showError(priceInput, "Giá không được để trống");
          } else if (isNaN(value)) {
            showError(priceInput, "Vui lòng nhập số hợp lệ cho giá");
          } else if (parseFloat(value) <= 0) {
            showError(priceInput, "Giá phải lớn hơn 0");
          } else {
            clearError(priceInput);
          }
        }

        function validateDiscountPrice() {
          const priceValue = parseFloat(priceInput.value.trim());
          const discountValue = discountPriceInput.value.trim();
          if (discountValue === "") {
            clearError(discountPriceInput);
          } else if (isNaN(discountValue)) {
            showError(discountPriceInput, "Vui lòng nhập số hợp lệ cho giá giảm");
          } else if (parseFloat(discountValue) > priceValue) {
            showError(discountPriceInput, "Giá giảm không được lớn hơn giá gốc");
          } else {
            clearError(discountPriceInput);
          }
        }

        function validateCategory() {
          if (categorySelect.value.trim() === "") {
            showError(categorySelect, "Danh mục không được để trống");
          } else {
            clearError(categorySelect);
          }
        }

        function validateImage() {
          if (imageInput.files.length > 0) {
            const file = imageInput.files[0];
            if (!["image/jpeg", "image/png"].includes(file.type)) {
              showError(imageInput, "Ảnh chính phải là JPG hoặc PNG");
            } else {
              clearError(imageInput);
            }
          }
        }

        // Gắn sự kiện realtime validation
        nameInput.addEventListener("input", validateName);
        priceInput.addEventListener("input", () => {
          validatePrice();
          validateDiscountPrice();
        });
        discountPriceInput.addEventListener("input", validateDiscountPrice);
        categorySelect.addEventListener("change", validateCategory);
        imageInput.addEventListener("change", validateImage);

        // Kiểm tra toàn bộ form khi submit
        form.addEventListener("submit", function(e) {
          validateName();
          validatePrice();
          validateDiscountPrice();
          validateCategory();
          validateImage();

          // Ngăn submit nếu có lỗi
          if (form.querySelectorAll(".is-invalid").length > 0) {
            e.preventDefault();
          }
        });
      });
    </script>
<?php

    unset($_SESSION['errors']);
  }
}

?>