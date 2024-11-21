<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;

class Detail extends BaseView
{
  public static function render($data = null)
  {
?>
    <section>

      <?php if (!empty($data)): ?>
        <div class="main-container">
          <div class="product"> 
              <div class="product__image-section">
                <div class="product__main-image">
                  <img id="mainImage" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['thumbnail']?>"
                    alt="Main Product Image">
                </div>
                <div class="product__thumbnails">
                  <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['thumbnail']?>" alt="Thumbnail 1" onclick="changeImage(this)">
                  <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['thumbnail']?>" alt="Thumbnail 2" onclick="changeImage(this)">
                  <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['thumbnail']?>" alt="Thumbnail 3" onclick="changeImage(this)">
                  <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['thumbnail']?>" alt="Thumbnail 4" onclick="changeImage(this)">
                  <img class="product__thumbnail" src="<?= APP_URL ?>/public/assets/client/images/product/<?= $data['thumbnail']?>" alt="Thumbnail 5" onclick="changeImage(this)">
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
                <h1 class="product__name"><?= $data['name']?></h1>
                <div class="product__info">
                  <span class="product__code">Mã sản phẩm: CP12345</span>|
                  <span class="product__brand">Thương hiệu: Nestle</span>
                </div>
                <div class="product__price"><?= number_format($data['price'])?> VNĐ</div>
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
          <?php if (!empty($data)): ?>
          <div class="product-reviews">
            <div class="review-summary"> 
            <?php foreach ($data as $item) : ?>
              <div class="rating-summary">
                <div class="rating-score">
                  <span class="score">4.5</span> trên 5
                </div>
                <div class="rating-stars">
                  <span>★★★★★</span>
                </div>
              </div>

              <div class="filter-options">
                <button class="active">Tất Cả</button>
                <button>5 Sao (41,9k)</button>
                <button>4 Sao (5,3k)</button>
                <button>3 Sao (2,6k)</button>
                <button>2 Sao (1,2k)</button>
                <button>1 Sao (2,5k)</button>
                <div class="extra-options">
                  <button>Có Bình Luận (81)</button>
                  <button>Có Hình Ảnh / Video (48)</button>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?> 
          <div class="review-list">
            <?php foreach ($data as $item): ?>
              <div class="review-item">
                <div class="review-header">
                  <img src="<?= APP_URL ?>/public/assets/client/images/product/chomchom_giong_thai.webp" alt="User Avatar" class="avatar">
                  <div class="review-info">
                    <span class="reviewer-name"><?= $item['first_name'] . ' ' . $item['last_name']?></span>
                    <span class="review-rating">★★★★★</span>
                    <div class="review-details">
                      <span class="review-date"><?= $item['created_at'] ?></span> |
                      <span class="review-category">Phân loại hàng: <?= $item['product_name'] ?></span>
                    </div>
                  </div>
                </div>
                <p class="review-content"><?= $item['content']?></p>
                <div class="review-images">
                  <img src="<?= APP_URL ?>public/assets/client/images/product/chomchom_giong_thai.webp" alt="Review Image 1">
                  <img src="<?= APP_URL ?>public/assets/client/images/product/chomchom_giong_thai.webp" alt="Review Image 2">
                  <img src="<?= APP_URL ?>public/assets/client/images/product/chomchom_giong_thai.webp" alt="Review Image 3">
                  <img src="<?= APP_URL ?>public/assets/client/images/product/chomchom_giong_thai.webp" alt="Review Image 4">
                  <img src="<?= APP_URL ?>public/assets/client/images/product/chomchom_giong_thai.webp" alt="Review Image 5">
                </div>
                <div class="review-likes">
                  <i class="fas fa-thumbs-up"></i> <span>8</span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>


          <!-- Phân trang -->
          <div class="pagination">
            <button class="page-number">1</button>
            <button class="page-number">2</button>
            <button class="page-number">3</button>
            <button class="page-number">4</button>
            <button class="page-number">5</button>
          </div>
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
<?php

  } 
}
?>
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
</script>