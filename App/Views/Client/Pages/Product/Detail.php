<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;

class Detail extends BaseView
{
  public static function render($data = null)
  {
?>

    <section>
      <?php if (!empty($data['product'])): ?>
        <div class="main-container">
          <div class="product">
            <div class="product__image-section">
              <div class="product__main-image">
                <img id="mainImage" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['product']["thumbnail"] ?>"
                  alt="Main Product Image">
              </div>
              <div class="product__thumbnails">
                <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['product']["thumbnail"] ?>" alt="Thumbnail 1" onclick="changeImage(this)">
                <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['product']["thumbnail"] ?>" alt="Thumbnail 1" onclick="changeImage(this)">
                <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['product']["thumbnail"] ?>" alt="Thumbnail 1" onclick="changeImage(this)">
                <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['product']["thumbnail"] ?>" alt="Thumbnail 1" onclick="changeImage(this)">
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
              <div class="product__price"><?= number_format($data['product']['price']) ?> VNĐ</div>
              <div class="product__weight">
                <label>Khối lượng</label>
                <div class="product__weight-options">
                  <button type="button" class="product__weight-option" onclick="selectWeight(this, '100g')">100g</button>
                  <button type="button" class="product__weight-option" onclick="selectWeight(this, '250g')">250g</button>
                  <button type="button" class="product__weight-option" onclick="selectWeight(this, '500g')">500g</button>
                  <button type="button" class="product__weight-option" onclick="selectWeight(this, '1kg')">1kg</button>
                </div>
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
                <button class="cta-button product__add-to-cart"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
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
          <h2>Đánh Giá Sản Phẩm</h2>
          <?php if (!empty($data['rating'])): ?>
            <div class="product-reviews">
              <div class="review-summary">
                <div class="rating-summary">
                  <div class="rating-score">
                    <span class="score"><?= $data['rating']['average'] ?> </span> trên 5
                  </div>
                  <div class="rating-stars">
                    <span>
                      <div class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $data['rating']['average']): ?>
                            <i class="bi bi-star-fill text-warning"></i> <!-- Sao đầy -->
                          <?php else: ?>
                            <i class="bi bi-star text-secondary"></i> <!-- Sao rỗng -->
                          <?php endif; ?>
                        <?php endfor; ?>
                      </div>
                    </span>
                  </div>
                </div>

                <div class="filter-options">
                  <?php if (!empty($data['rating']['detailedRatings'])): ?>
                    <button class="active">Tất Cả</button>
                    <?php foreach ($data['rating']['detailedRatings'] as $item) : ?>
                      <button class="mx-3"><?= $item['rating'] ?> Sao (<?= number_format($item['count']) ?>) </button>
                    <?php endforeach; ?>
                    <div class="extra-options">
                      <button>Có Bình Luận (<?= $data['rating']['totalReviews'] ?>)</button>
                      <button>Có Hình Ảnh / Video (48)</button>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <!-- Button để mở modal -->
          <button id="openModalBtn" class="show-more-btn d-flex justify-content-start m-0" onclick="toggleModal()">Gửi phản hồi</button>

          <!-- Modal Đánh giá -->
          <div id="reviewModal" class="modal">
            <div class="modal-content">
              <span id="closeModalBtn" class="close-btn">&times;</span>
              <h3>Đánh Giá Sản Phẩm</h3>
              <?php if (!empty($data)): ?>
                <div class="product-info">
                  <div class="product-details">
                    <img src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['product']["thumbnail"] ?>" alt="Product Image" width="70px">
                    <p class="product-name"><?= $data['product']["name"] ?></p>
                  </div>
                </div>
              <?php endif; ?>
              <form class="review-form" action="/create-comment" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">
                <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user']['id'] ?>">
                <input type="hidden" name="product_id" id="product_id" value="<?= $data['product']['id'] ?>">
                <input type="hidden" name="rating" id="rating" value="5">
                <div id="rating-comments" name="rating-comments" class="rating-container">
                  <span class="bi bi-star-fill text-warning" data-value="1"></span>
                  <span class="bi bi-star text-warning" data-value="2"></span>
                  <span class="bi bi-star text-warning" data-value="3"></span>
                  <span class="bi bi-star text-warning" data-value="4"></span>
                  <span class="bi bi-star text-warning" data-value="5"></span>
                </div>
                <p id="rating-value" name="rating-value" class="d-flex justify-content-center align-items-center"></p>
                <div class="form-group">
                  <label for="images-upload">Tải ảnh lên (tối đa 6 ảnh):</label>
                  <div class="form-group">
                    <label for="images" class="form-label">Chọn hình ảnh</label>
                    <input type="file" class="form-control-file" id="images" name="images[]" accept="image/*" multiple>
                  </div>

                  <!-- Textarea input -->
                  <div class="form-group mt-3">
                    <label for="content" class="form-label">Để lại ý kiến</label>
                    <textarea class="form-control form-control-lg" id="content" name="content" placeholder="Chúng tôi muốn nghe ý kiến của bạn" required rows="6"></textarea>
                  </div>
                  <button type="submit" class="submit-btn">Đánh giá</button>
                </div>
              </form>

            </div>
          </div>
          <?php if (!empty($data['comments'])) : ?>
            <div class="review-list">
              <?php foreach ($data['comments'] as $item): ?>
                <div class="review-item border-bottom-0">
                  <div class="review-header">
                    <img src="<?= APP_URL ?>/public/assets/client/images/product/chomchom_giong_thai.webp" alt="User Avatar" class="avatar">
                    <div class="review-info">
                      <span class="reviewer-name"><?= $item['username'] ?></span>
                      <span class="review-rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $item['rating']): ?> <!-- Đổi $comment['rating'] thành $item['rating'] -->
                            <i class="bi bi-star-fill text-warning"></i>
                          <?php else: ?>
                            <i class="bi bi-star text-secondary"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </span>
                      <div class="review-details">
                        <span class="review-date"><?= $item['created_at'] ?></span> |
                        <?php if (isset($data['product']['name'])):  ?>
                          <span class="review-category">Phân loại hàng: <?= $data['product']['name'] ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="review-item border-bottom-0 p-0">
                    <p class="short-content"><?= mb_substr($item['content'], 0, 60) ?>...</p>
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
                  <div class="review-likes">
                    <i class="fas fa-thumbs-up"></i> <span>0</span>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- Phân trang -->
    <div class="pagination">
      <button class="page-number">1</button>
      <button class="page-number">2</button>
      <button class="page-number">3</button>
      <button class="page-number">4</button>
      <button class="page-number">5</button>
    </div>
    <!-- </div>
    </div>
    </section> -->
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

      function toggleModal() {
        const modal = document.getElementById("reviewModal");
        const closeBtn = document.getElementById("closeModalBtn");

        // Mở modal khi nhấn nút
        document.getElementById("openModalBtn").onclick = function() {
          modal.style.display = "block";
        }

        // Đóng modal khi nhấn vào nút đóng (X)
        closeBtn.onclick = function() {
          modal.style.display = "none";
        }
      }

      document.addEventListener('DOMContentLoaded', function() {
        const starGroup = document.getElementById('rating-comments');
        const stars = starGroup.querySelectorAll('span');
        const ratingValue = document.getElementById('rating-value');
        let selectedRating = 5;

        // Hàm cập nhật màu và giá trị sao
        function updateRating(value) {
          selectedRating = value; // Lưu giá trị đánh giá
          ratingValue.textContent = `Đánh giá: ${value} sao`; // Cập nhật nội dung

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
        updateRating(5);

        // Xử lý khi form được submit
        document.querySelector('form').addEventListener('submit', (e) => {
          const ratingText = ratingValue.textContent; // Lấy nội dung text của <p>
          const match = ratingText.match(/Đánh giá:\s(\d+)/); // Trích xuất số sao từ chuỗi
          const rating = match ? parseInt(match[1], 10) : 5; // Mặc định là 5 nếu không có số sao

          // Thêm giá trị số sao vào một input hidden trước khi submit
          const ratingInput = document.createElement('input');
          ratingInput.type = 'hidden';
          ratingInput.name = 'rating';
          ratingInput.value = rating;

          e.target.appendChild(ratingInput); // Đính kèm input vào form
        });
      });


      document.addEventListener('DOMContentLoaded', () => {
        // Lấy tất cả các nút "Xem thêm"
        const buttons = document.querySelectorAll('.btn-review-content');

        buttons.forEach((button) => {
          button.addEventListener('click', () => {
            // Tìm phần tử cha chứa nội dung
            const reviewItem = button.closest('.review-item');
            const shortContent = reviewItem.querySelector('.short-content');
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
        });
      });


      // Khởi chạy khi tải trang
      document.addEventListener('DOMContentLoaded', () => {
        initializeContent();
      });
    </script>
<?php

  }
}
?>