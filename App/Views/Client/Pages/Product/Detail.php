<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;

class Detail extends BaseView
{
  public static function render($data = null)
  {
?>
    <div class="cart-notification hidden" id="cartNotification">
      <button class="close-btn" onclick="hideNotification()">×</button>
      <h4>Đã thêm vào giỏ hàng thành công!</h4>
      <img id="notificationImage" src="default-image.jpg" alt="Product Image">
      <div class="product-name" id="notificationName">Tên sản phẩm</div>
      <div class="product-price" id="notificationPrice">100₫</div>
    </div>
    <style>
      .cart-notification {
        position: fixed;
        top: 10%;
        right: 2%;
        background-color: #ffe5e5;
        border: 1px solid #ff424e;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        padding: 15px;
        width: 300px;
        z-index: 1000;
        font-family: Arial, sans-serif;
        animation: fadeIn 0.5s ease;
      }

      .cart-notification h4 {
        margin: 0;
        color: #ff424e;
        font-size: 16px;
        font-weight: bold;
      }

      .cart-notification img {
        display: block;
        width: 60px;
        height: 60px;
        border-radius: 5px;
        margin: 10px auto;
      }

      .cart-notification .product-name {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        text-align: center;
      }

      .cart-notification .product-price {
        font-size: 14px;
        color: #333;
        text-align: center;
      }

      .cart-notification .close-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: none;
        border: none;
        font-size: 16px;
        color: #333;
        cursor: pointer;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>


    <section>


      <div class="main-container">
        <div class="product">
          <div class="product__image-section">
            <div class="product__main-image">
              <img id="mainImage"
                src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($data['defaultSku']['image'] ?? $data['product']['image']) ?>"
                alt="Main Product Image">
            </div>

            <div class="product__thumbnails">

              <img class="product__thumbnail" src="<?= APP_URL ?>/public/uploads/thumbnails/<?= $data['product']['thumbnails'] ?>" alt="Thumbnail 1" onclick="changeImage(this)">
              <img class="product__thumbnail" src="<?= APP_URL ?>/public/uploads/thumbnails/<?= $data['product']['thumbnails'] ?>" alt="Thumbnail 2" onclick="changeImage(this)">
              <img class="product__thumbnail" src="<?= APP_URL ?>/public/uploads/thumbnails/<?= $data['product']['thumbnails'] ?>" alt="Thumbnail 3" onclick="changeImage(this)">
              <img class="product__thumbnail" src="<?= APP_URL ?>/public/uploads/thumbnails/<?= $data['product']['thumbnails'] ?>" alt="Thumbnail 4" onclick="changeImage(this)">
              <img class="product__thumbnail" src="<?= APP_URL ?>/public/uploads/thumbnails/<?= $data['product']['thumbnails'] ?>" alt="Thumbnail 5" onclick="changeImage(this)">
            </div>
            <div class="product__share-like">
              <div class="share-buttons">
                <span>Chia sẻ:</span>

                <a href="#"><i class="fab fa-facebook-messenger"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
              </div>|
              <div class="like-count">
                <i class="fas fa-heart"></i> Đã thích (87)
              </div>
            </div>
          </div>
          <div class="product__details">
            <h1 class="product__name"><?= $data['product']['name'] ?></h1>
            <div class="product__info">
              <span class="product__code">Mã sản phẩm: CP12345</span>|
              <span class="product__brand">Thương hiệu: Nestle</span>
            </div>
            <div class="product__price">
              <?php
              // Lấy giá gốc và số tiền giảm giá
              $original_price = $data['product']['price'];
              $discount_price = $data['product']['discount_price'];

              // Tính giá sau khi giảm
              $final_price = $original_price - ($discount_price ?? 0); // Trừ giá giảm nếu có

              // Đảm bảo giá giảm không âm
              if ($final_price < 0) {
                $final_price = 0;
              }
              ?>

              <?php if (!empty($discount_price) && $discount_price > 0): ?>
                <!-- Hiển thị giá gốc và giá sau giảm -->
                <s><?= number_format($original_price) ?> VNĐ</s>
                <span><?= number_format($final_price) ?> VNĐ</span>
              <?php else: ?>
                <!-- Hiển thị giá gốc nếu không có giảm giá -->
                <?= number_format($original_price) ?> VNĐ
              <?php endif; ?>
            </div>

            <div class="product__variants">
              <?php foreach ($data['variants'] as $variant): ?>
                <div class="product__variant">
                  <label><?= htmlspecialchars($variant['name']) ?></label>
                  <div class="product__variant-options">
                    <?php foreach ($variant['options'] as $option): ?>
                      <button
                        type="button"
                        class="product__variant-option"
                        data-variant-id="<?= $variant['id'] ?>"
                        data-option-id="<?= $option['id'] ?>"
                        onclick="selectOption(this)">
                        <?= htmlspecialchars($option['name']) ?>
                      </button>

                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="shipping-info">
              <h3>Vận Chuyển</h3>
              <div class="shipping-details">
                <div class="shipping-item">
                  <img src="public/assets/client/images/product/d9e992985b18d96aab90.png" alt="Free Ship Icon" />
                  <span>Miễn phí vận chuyển</span>
                </div>
                <div class="shipping-item">
                  <i class="fa fa-truck"></i>
                  <span>Vận Chuyển Tới <strong>Phường Thường Thạnh, Quận Cái Răng</strong></span>
                </div>
                <div class="shipping-item">
                  <span>Phí Vận Chuyển</span>
                  <strong>₫0</strong>
                </div>
              </div>
            </div>
            <script>
              document.querySelectorAll('.product__variant-option').forEach(button => {
                button.addEventListener('click', async function() {
                  const variantId = this.getAttribute('data-variant-id');
                  const optionId = this.getAttribute('data-option-id');

                  try {
                    const response = await fetch(`/get-sku-price?variant_id=${variantId}&option_id=${optionId}`);
                    const data = await response.json();

                    if (data.success) {
                      // Cập nhật giá trên giao diện
                      document.querySelector('.product__price').textContent = `${data.price} VNĐ`;
                    } else {
                      console.error('Lỗi khi lấy giá SKU:', data.message);
                    }
                  } catch (error) {
                    console.error('Lỗi kết nối:', error);
                  }
                });
              });
            </script>
            <div class="product__quantity">
              <label for="productQuantity">Số lượng</label>
              <div class="product__quantity-controls">
                <button type="button" class="product__quantity-btn" onclick="decrementQuantity()">-</button>
                <input type="text" value="1" min="1" id="productQuantity" class="product__quantity-input">
                <button type="button" class="product__quantity-btn" onclick="incrementQuantity()">+</button>
              </div>
            </div>


            <div class="product__actions">
              <button class="cta-button product__buy-now">Mua ngay</button>
              <form id="addToCartForm" action="/cart-add" method="post">
                <input type="hidden" name="method" value="POST">
                <input type="hidden" name="variant_id" id="selectedVariant" value="">
                <input type="hidden" name="option_id" id="selectedOption" value="">
                <input type="hidden" name="product_id" value="<?= $data['product']['id'] ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="cta-button">Thêm vào giỏ hàng</button>
              </form>
              <script>
                document.querySelectorAll('.product__variant-option').forEach(button => {
                  button.addEventListener('click', function() {
                    const variantId = this.getAttribute('data-variant-id');
                    const optionId = this.getAttribute('data-option-id');

                    // Gửi dữ liệu lên backend hoặc cập nhật frontend
                    updatePrice(variantId, optionId);

                    // Đổi trạng thái nút (highlight nút đã chọn)
                    const options = button.parentNode.querySelectorAll('.product__variant-option');
                    options.forEach(option => option.classList.remove('selected'));
                    button.classList.add('selected');
                  });
                });

                async function updatePrice(variantId, optionId) {
                  console.log("Sending Request: ", {
                    variantId,
                    optionId
                  });

                  try {
                    const response = await fetch('/get-sku-price', {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                      },
                      body: JSON.stringify({
                        variant_id: variantId,
                        option_id: optionId
                      }),
                    });

                    const data = await response.json();
                    console.log("Response: ", data);

                    if (data.success) {
                      document.querySelector('.product__price').textContent = `${data.price} VNĐ`;
                    } else {
                      console.error('Lỗi lấy giá sản phẩm:', data.message);
                    }
                  } catch (error) {
                    console.error('Error updating price:', error);
                  }
                }

                // Gắn sự kiện cho các nút
                document.querySelectorAll('.product__variant-option').forEach(button => {
                  button.addEventListener('click', function() {
                    const variantId = this.getAttribute('data-variant-id');
                    const optionId = this.getAttribute('data-option-id');

                    // Gán giá trị vào các input hidden
                    document.getElementById('selectedVariant').value = variantId;
                    document.getElementById('selectedOption').value = optionId;
                  });
                });
              </script>

            </div>
          </div>
        </div>
      </div>
      <script>
        document.getElementById('addToCartForm').addEventListener('submit', async function(e) {
          e.preventDefault(); // Ngăn form tự submit

          const formData = new FormData(this);

          try {
            const response = await fetch('/cart-add', {
              method: 'POST',
              body: formData,
            });

            // Kiểm tra trạng thái HTTP
            if (!response.ok) {
              throw new Error(`HTTP Error: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
              // Hiển thị thông báo khi thêm vào giỏ hàng thành công
              showNotification({
                name: data.name || 'Sản phẩm không xác định', // Đặt giá trị mặc định nếu undefined
                price: data.price || '0', // Đặt giá trị mặc định
                image: data.image ? `/public/uploads/products/${data.image}` : 'default-image.jpg', // Kiểm tra nếu không có ảnh
              });
            } else {
              if (data.redirect) {
                // Chuyển hướng đến trang đăng nhập
                window.location.href = data.redirect;
              } else {
                alert(data.message || 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
              }
            }
          } catch (error) {
            console.error('Fetch API Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại!');
          }
        });
      </script>

    </section>
    <section class="product-description-section">
      <div class="main-container">
        <h2 class="product-description-title">Mô tả sản phẩm</h2>
        <p class="product-description-text">
          Sản phẩm cà phê sữa đá hòa tan mang đến hương vị đậm đà, dễ pha chế và tiện lợi. Được sản xuất từ nguồn nguyên liệu chọn lọc, đảm bảo mang lại trải nghiệm tuyệt vời cho người thưởng thức.
        </p>
      </div>
    </section>
    <section class="product-reviews-container">
      <div class="main-container">
        <div class="product__reviews--boxshadow">
          <!-- cmt -->
          <h2>Đánh Giá Sản Phẩm</h2>
          <?php if (!empty($data['countRating'])): ?>
            <div class="product-reviews">
              <div class="review-summary">
                <div class="rating-summary">
                  <div class="rating-score">
                    <span class="score"><?= $data['countRating']['average'] ?></span>
                    <span class="score">/5</span>
                  </div>
                  <div class="rating-stars">
                    <span>
                      <div class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $data['countRating']['average']): ?>
                            <i class="bi bi-star-fill text-warning"></i>
                          <?php else: ?>
                            <i class="bi bi-star text-secondary"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </div>
                    </span>
                  </div>
                </div>
                <div class="filter-options">
                  <!-- Nút "Tất Cả" -->
                  <button class="active">Tất Cả</button>

                  <!-- Duyệt qua từ 1 đến 5 để luôn hiển thị các nút rating -->
                  <?php for ($i = 5; $i >= 1; $i--): ?>
                    <?php
                    // Kiểm tra xem rating này có dữ liệu hay không
                    $count = 0;
                    foreach ($data['countRating']['detailedRatings'] as $item) {
                      if ($item['rating'] == $i) {
                        $count = $item['count'];
                        break;
                      }
                    }
                    ?>
                    <button class="mx-3"><?= $i ?> Sao (<?= number_format($count) ?>)</button>
                  <?php endfor; ?>

                  <div class="extra-options">
                    <!-- Nút có bình luận -->
                    <button>Có Bình Luận (<?= number_format($data['countRating']['totalReviews'] ?? 0) ?>)</button>
                    <!-- Nút có hình ảnh/video (lấy dữ liệu tạm từ 48) -->
                    <button>Có Hình Ảnh / Video (<?= $data['countImages'] ?>)</button>
                  </div>
                </div>

              </div>
            </div>
          <?php endif; ?>

          <form id="edit-form-1" class="review-form" action="/create-comment" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="method" value="POST">
            <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user']['id'] ?>">
            <?php if (!empty($data['product'])): ?>
              <input type="hidden" name="product_id" id="product_id" value="<?= $data['product']['id'] ?>">
              <!--  -->
            <?php endif; ?>
            <input type="hidden" name="rating" id="rating-1" value="5">
            <div id="rating-comments-1" name="rating-comments" class="rating-container">
              <span class="bi bi-star-fill text-warning" data-value="1"></span>
              <span class="bi bi-star text-warning" data-value="2"></span>
              <span class="bi bi-star text-warning" data-value="3"></span>
              <span class="bi bi-star text-warning" data-value="4"></span>
              <span class="bi bi-star text-warning" data-value="5"></span>
            </div>
            <p id="rating-value-1" name="rating-value" class="d-flex justify-content-center align-items-center"></p>
            <div class="form-group">
              <label for="images-upload">Tải ảnh lên (tối đa 6 ảnh):</label>
              <div class="form-group">
                <label for="images" class="form-label">Chọn hình ảnh</label>
                <input type="file" class="form-control-file" id="images_1" name="images[]" accept="image/*" multiple>
                <div id="imagePreview_1"></div>
              </div>
              <div class="form-group mt-3">
                <label for="content" class="form-label">Để lại ý kiến</label>
                <textarea class="form-control form-control-lg" id="content" name="content" placeholder="Chúng tôi muốn nghe ý kiến của bạn" rows="6"></textarea>
              </div>
              <button type="submit" class="submit-btn">Đánh giá</button>
            </div>
          </form>
          <?php if (!empty($data['comments'])) : ?>
            <div class="review-list ">
              <?php foreach ($data['comments'] as $item): ?>
                <div class="review-item border-bottom-0">
                  <div class="review-header">
                    <img src="<?= APP_URL ?>/public/assets/client/images/product/chomchom_giong_thai.webp" alt="User Avatar" class="avatar">
                    <div class="review-info">
                      <span class="reviewer-name"><?= $item['username'] ?></span>
                      <span class="review-rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $item['rating'] && $item['rating'] > 0): ?>
                            <i class="bi bi-star-fill text-warning"></i>
                          <?php else: ?>
                            <i class="bi bi-star text-secondary"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </span>
                      <div class="review-details">
                        <span class="review-date"><?= $item['created_at'] ?></span> |
                        <span class="review-category">Phân loại hàng: <?= $item['product_name'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="review-item border-bottom-0 p-0">
                    <p class="short-content"><?= $item['content'] ?>...</p>
                    <span class="btn-review-content" style="cursor: pointer;">Xem thêm</span>
                    <p class="full-content" style="display: none;"><?= $item['content'] ?></p>
                  </div>
                  <div class="review-images">
                    <?php if (!empty($item['images'])): ?>
                      <?php foreach ($item['images'] as $image): ?>
                        <img src="<?= APP_URL ?>/public/uploads/comment-images/<?= $image['image_url'] ?>" alt="Review Image">
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                  <div class="review-bottom">
                    <div class="review-likes">
                      <i class="fas fa-thumbs-up"></i> <span>0</span>
                    </div>
                    <button class="review-update-text" onclick="toggleForm('edit-btn', 'edit-form-2')" id="edit-btn">Chỉnh sửa</button>
                    <button class="review-reply">Phản hồi</button>
                  </div>
                  <form id="edit-form-2" class="review-form" action="/update-comment" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="method" value="PUT">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="rating" id="rating-2" value="5">
                    <div id="rating-comments-2" name="rating-comments" class="rating-container">
                      <span class="bi bi-star-fill text-warning" data-value="1"></span>
                      <span class="bi bi-star text-warning" data-value="2"></span>
                      <span class="bi bi-star text-warning" data-value="3"></span>
                      <span class="bi bi-star text-warning" data-value="4"></span>
                      <span class="bi bi-star text-warning" data-value="5"></span>
                    </div>
                    <p id="rating-value-2" name="rating-value" class="d-flex justify-content-center align-items-center"></p>
                    <div class="form-group">
                      <label for="images-upload">Tải ảnh lên (tối đa 6 ảnh):</label>
                      <div class="form-group">
                        <label for="images" class="form-label">Chọn hình ảnh</label>
                        <input type="file" class="form-control-file" id="images_2" name="images[]" accept="image/*" multiple>
                        <div id="imagePreview_2"></div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="content" class="form-label">Để lại ý kiến</label>
                        <textarea class="form-control form-control-lg" id="content" name="content" placeholder="Chúng tôi muốn nghe ý kiến của bạn" rows="6"></textarea>
                      </div>
                      <button type="submit" class="submit-btn">Cập nhật</button>
                    </div>
                  </form>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="pagination">
              <a class="page-number page-item <?= $data['currentPage'] == 1 ? 'disabled' : '' ?>" href="?page=<?= $data['currentPage'] - 1 ?>" style="width: auto;">Previous</a>

              <?php
              // Hiển thị 3 số trang gần nhau
              if ($data['currentPage'] == 1) {
                // Nếu ở trang 1, hiển thị 1, 2, 3
                $start = 1;
                $end = min(3, $data['totalPages']);
              } elseif ($data['currentPage'] == $data['totalPages']) {
                // Nếu ở trang cuối, hiển thị các trang cuối
                $start = max($data['totalPages'] - 2, 1);
                $end = $data['totalPages'];
              } else {
                // Nếu ở giữa, hiển thị 1 trang trước và sau
                $start = $data['currentPage'] - 1;
                $end = $data['currentPage'] + 1;
              }

              for ($i = $start; $i <= $end; $i++): ?>
                <a class="page-number page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
              <?php endfor; ?>

              <a class="page-number page-item <?= $data['currentPage'] == $data['totalPages'] ? 'disabled' : '' ?>"
                href="?page=<?= min($data['currentPage'] + 1, $data['totalPages']) ?>"
                style="width: auto;">Next</a>
            </div>




          <?php endif; ?>



        </div>
      </div>
    </section>
    <section class="related-products">
      <div class="main-container">
        <div class="container">
          <div class="related-products__header">
            <h1 class="related-products__title">Sản phẩm liên quan</h1>
            <a href="#" class="related-products__view-all">Xem tất cả</a>
          </div>
          <div class="related-products__grid">
            <!-- Product Card 1 -->
            <div class="related-products__card">
              <img src="<?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="related-products__image">
              <div class="related-products__info">
                <h3 class="related-products__name">Dừa xiêm gọt trọc</h3>
                <p class="related-products__price">15,500₫</p>
                <button class="related-products__buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="related-products__card">
              <img src="<?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="related-products__image">
              <div class="related-products__info">
                <h3 class="related-products__name">Dừa xiêm gọt trọc</h3>
                <p class="related-products__price">15,500₫</p>
                <button class="related-products__buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="related-products__card">
              <img src="<?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="related-products__image">
              <div class="related-products__info">
                <h3 class="related-products__name">Dừa xiêm gọt trọc</h3>
                <p class="related-products__price">15,500₫</p>
                <button class="related-products__buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="related-products__card">
              <img src="<?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="related-products__image">
              <div class="related-products__info">
                <h3 class="related-products__name">Dừa xiêm gọt trọc</h3>
                <p class="related-products__price">15,500₫</p>
                <button class="related-products__buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="related-products__card">
              <img src="<?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="related-products__image">
              <div class="related-products__info">
                <h3 class="related-products__name">Dừa xiêm gọt trọc</h3>
                <p class="related-products__price">15,500₫</p>
                <button class="related-products__buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="related-products__card">
              <img src="<?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="related-products__image">
              <div class="related-products__info">
                <h3 class="related-products__name">Dừa xiêm gọt trọc</h3>
                <p class="related-products__price">15,500₫</p>
                <button class="related-products__buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <!-- Thêm các thẻ sản phẩm khác theo mẫu trên -->
          </div>
        </div>
      </div>
    </section>
    </div>


    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const selectedVariants = {};

        // Hàm xử lý khi người dùng chọn một tùy chọn
        function selectOption(button) {
          const variantId = button.getAttribute('data-variant-id');
          const optionId = button.getAttribute('data-option-id');

          console.log("Selected variant ID:", variantId);
          // Lưu lựa chọn vào object
          selectedVariants[variantId] = optionId;

          // Đổi trạng thái nút (highlight nút đã chọn)
          const options = button.parentNode.querySelectorAll('.product__variant-option');
          options.forEach(option => option.classList.remove('selected'));
          button.classList.add('selected');

          // Cập nhật giá trị hidden input
          document.getElementById('selectedVariants').value = JSON.stringify(selectedVariants);
        }

        // Đăng ký sự kiện cho tất cả các nút
        document.querySelectorAll('.product__variant-option').forEach(button => {
          button.addEventListener('click', () => selectOption(button));
        });
      });
    </script>
    <!-- thongbao -->
    <script>
      function showNotification(data) {
        const notification = document.getElementById('cartNotification');
        document.getElementById('notificationImage').src = data.image || 'default-image.jpg';
        document.getElementById('notificationName').textContent = data.name || 'Sản phẩm không xác định';
        document.getElementById('notificationPrice').textContent = `${data.price || '0'}₫`;

        notification.classList.remove('hidden');

        setTimeout(() => {
          notification.classList.add('hidden');
        }, 5000);
      }
    </script>
    <!-- comment
      -->
    <script>
      function selectWeight(element, weight) {
        // Deselect all other options
        document.querySelectorAll('.product__weight-option').forEach(option => {
          option.classList.remove('selected');
        });
        // Mark the clicked option as selected
        element.classList.add('selected');
        // You can also store the selected weight for form submission or further use
        console.log(`Selected weight: ${weight}`);
      }

      document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.review-form');

        forms.forEach((form, index) => {
          const ratingGroup = form.querySelector(`#rating-comments-${index + 1}`);
          const stars = ratingGroup.querySelectorAll('span');
          const ratingValue = form.querySelector(`#rating-value-${index + 1}`);
          const hiddenRating = form.querySelector(`#rating-${index + 1}`);

          let selectedRating = parseInt(hiddenRating.value); // Lấy giá trị rating mặc định từ input hidden

          // Hàm cập nhật màu và giá trị sao
          function updateRating(value) {
            selectedRating = value; // Lưu giá trị đánh giá
            ratingValue.textContent = `Đánh giá: ${value} sao`; // Cập nhật nội dung
            hiddenRating.value = value; // Cập nhật giá trị rating vào input hidden

            stars.forEach((star) => {
              const starValue = parseInt(star.getAttribute('data-value'));
              if (starValue <= value) {
                star.classList.replace('bi-star', 'bi-star-fill'); // Sao được chọn giữ màu vàng
              } else {
                star.classList.replace('bi-star-fill', 'bi-star'); // Sao không được chọn chuyển màu xám
              }
            });
          }

          // Gán sự kiện click cho mỗi sao
          stars.forEach((star) => {
            star.addEventListener('click', () => {
              const rating = parseInt(star.getAttribute('data-value')); // Lấy giá trị sao
              updateRating(rating); // Cập nhật giao diện
            });
          });

          // Thiết lập mặc định
          updateRating(selectedRating); // Đảm bảo giá trị rating mặc định là 5 nếu chưa chọn
        });
      });



      document.addEventListener('DOMContentLoaded', () => {
        // Lấy tất cả các nút "Xem thêm"
        const buttons = document.querySelectorAll('.btn-review-content');

        buttons.forEach((button) => {
          // Tìm phần tử cha chứa nội dung
          const reviewItem = button.closest('.review-item');
          const shortContent = reviewItem.querySelector('.short-content');

          // Kiểm tra độ dài của nội dung ngắn
          if (shortContent.innerText.length <= 400) { // Sử dụng innerText thay vì textContent
            button.style.display = 'none'; // Ẩn nút nếu nội dung ngắn không vượt quá 400 ký tự
          } else {
            button.addEventListener('click', () => {
              const fullContent = reviewItem.querySelector('.full-content');

              // Chuyển đổi giữa hiển thị và ẩn
              if (fullContent.style.display === 'none' || fullContent.style.display === '') {
                fullContent.style.display = 'block';
                shortContent.style.display = 'none';
                button.textContent = 'Thu gọn';
              } else {
                fullContent.style.display = 'none';
                shortContent.style.display = 'block';
                button.textContent = 'Xem thêm';
              }
            });
          }
        });
      });



      // Khởi chạy khi tải trang
      document.addEventListener('DOMContentLoaded', () => {
        initializeContent();
      });
      const handleImageSelection = (inputId, previewId) => {
        let selectedImages = [];
        const maxImages = 6;

        const imageInput = document.getElementById(inputId);
        const previewDiv = document.getElementById(previewId);

        // Lắng nghe sự kiện chọn ảnh
        imageInput.addEventListener('change', (event) => {
          const files = [...event.target.files]; // Chuyển files thành mảng

          files.forEach(file => {
            if (selectedImages.length < maxImages &&
              !selectedImages.some(img => img.name === file.name)) {
              selectedImages.push(file); // Thêm ảnh vào mảng nếu chưa có
            }
          });

          updateImagePreview(); // Cập nhật giao diện
        });

        // Cập nhật khu vực preview ảnh
        const updateImagePreview = () => {
          previewDiv.innerHTML = ''; // Xóa ảnh cũ

          selectedImages.forEach((file, index) => {
            const imageContainer = document.createElement('div');
            imageContainer.textContent = `${index + 1}. ${file.name}`;

            // Tạo nút xóa cho ảnh
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Xóa';
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.addEventListener('click', () => deleteImage(index)); // Gọi hàm xóa

            imageContainer.appendChild(deleteButton); // Thêm nút xóa vào
            previewDiv.appendChild(imageContainer); // Thêm vào giao diện
          });

          // Vô hiệu hóa nút chọn file nếu đủ 6 ảnh
          if (selectedImages.length >= maxImages) {
            imageInput.disabled = true;
          } else {
            imageInput.disabled = false;
          }
        };

        // Hàm xóa ảnh khỏi mảng
        const deleteImage = (index) => {
          selectedImages.splice(index, 1); // Xóa ảnh tại vị trí index
          updateImagePreview(); // Cập nhật lại giao diện
        };
      };

      // Gọi hàm cho từng form với id tương ứng
      document.addEventListener('DOMContentLoaded', () => {
        handleImageSelection('images_1', 'imagePreview_1'); // Gọi cho form 1
        handleImageSelection('images_2', 'imagePreview_2'); // Gọi cho form 2
      });

      // haàm taái suử dunụng
      function toggleForm(buttonId, formId) {
        const button = document.getElementById(buttonId);
        const form = document.getElementById(formId);

        // Set initial state if not already set
        form.style.display = form.style.display || 'none';

        button.onclick = function() {
          form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        };
      }

      // phân trang 
      // This will output the PHP variable as a JS variable
      <?php $product_id = isset($data['product']['id']) ? $data['product']['id'] : null; ?>
      // Function to load comments and pagination dynamically 
      var productId = <?= json_encode($product_id); ?>;

      function loadPage(page, event) {
        // Ngừng hành động mặc định của nút phân trang (ngừng load lại trang)
        event.preventDefault();

        console.log("Product ID:", productId);

        // Construct the URL with the correct page number
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/product/detail/' + productId + '?page=' + page + '&ajax=true', true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            console.log(xhr.responseText); // Ghi lại phản hồi từ server

            try {
              var response = JSON.parse(xhr.responseText);

              // Cập nhật phần bình luận
              document.querySelector('.review-list').innerHTML = response.commentsHtml;

              // Cập nhật phân trang
              document.querySelector('.pagination').innerHTML = response.paginationHtml;
            } catch (e) {
              console.error("JSON parse error:", e);
            }
          }
        };
        xhr.send();
      }
    </script>
<?php

  }
}
?>