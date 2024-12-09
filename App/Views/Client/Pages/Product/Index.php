<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Index extends BaseView
{
  public static function render($data = null)
  {

?>

    <main class="main-container">
      <div class="content-container">
        <?php
        Category::render($data['categories']);
        ?>

        <div class="product-section__category product-section__category--vietnam-fruits">
          <div class="product-section__header">
            <div class="product-section__title-count">
              <h1 class="product-section__title">Sản phẩm</h1>
              <span class="product-count"><?= htmlspecialchars($data['productCount']) ?> sản phẩm</span>
            </div>

            <div class="sort-dropdown">
              <button class="sort-dropdown__toggle">
                <i class="fas fa-sort"></i> Sắp xếp
              </button>
              <div class="sort-dropdown__menu">
                <a href="?sort=default" class="<?= $data['currentSort'] == 'default' ? 'active' : '' ?>">Sản phẩm nổi bật</a>
                <a href="?sort=price_asc" class="<?= $data['currentSort'] == 'price_asc' ? 'active' : '' ?>">Giá: Tăng dần</a>
                <a href="?sort=price_desc" class="<?= $data['currentSort'] == 'price_desc' ? 'active' : '' ?>">Giá: Giảm dần</a>
                <a href="?sort=name_asc" class="<?= $data['currentSort'] == 'name_asc' ? 'active' : '' ?>">Tên: A-Z</a>
                <a href="?sort=name_desc" class="<?= $data['currentSort'] == 'name_desc' ? 'active' : '' ?>">Tên: Z-A</a>
                <a href="?sort=oldest" class="<?= $data['currentSort'] == 'oldest' ? 'active' : '' ?>">Cũ nhất</a>
                <a href="?sort=newest" class="<?= $data['currentSort'] == 'newest' ? 'active' : '' ?>">Mới nhất</a>
              </div>
            </div>


          </div>

          <div class="product-section__grid">
            <?php if (!empty($data['products'])): ?>
              <?php foreach ($data['products'] as $product): ?>
                <div class="product-card">
                  <a href="/product-detail/<?= $product['product_id'] ?>">
                    <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($product['sku_image'] ?? $product['image'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($product['product_name'] ?? 'No name') ?>" class="product-card__image" />
                    <?php if (!empty($product['final_discount_price']) && $product['final_discount_price'] < $product['final_price']): ?>
                      <span class="product-card__discount">
                        -<?= round(($product['final_price'] - $product['final_discount_price']) / $product['final_price'] * 100) ?>%
                      </span>
                    <?php endif; ?>
                  </a>
                  <div class="product-card__info">
                    <h3 class="product-card__name">
                      <?= htmlspecialchars($product['product_name'] ?? 'No name') ?>
                      <?php if ($product['type'] === 'variable' && !empty($product['sku_name'])): ?>
                        <span class="product-card__variant">- <?= htmlspecialchars($product['sku_name']) ?></span>
                      <?php endif; ?>
                    </h3>

                    <h4 class="product-card__price">
                      <?php if (isset($product['final_price'])): ?>
                        <?php if ($product['type'] === 'variable'): ?>
                          <?php if (isset($product['sku_discount_price']) && $product['sku_discount_price'] > 0): ?>
                            <del><?= number_format($product['sku_price'], 0, ',', '.') ?> VNĐ</del> <br>
                            <span style="color: red; font-weight: bold;"><?= number_format($product['final_price'], 0, ',', '.') ?> VNĐ</span>
                          <?php else: ?>
                            <?= number_format($product['final_price'], 0, ',', '.') ?> VNĐ
                          <?php endif; ?>
                        <?php else: ?>
                          <?php if (isset($product['discount_price']) && $product['discount_price'] > 0): ?>
                            <del><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</del> <br>
                            <span class="discount-price"><?= number_format($product['final_price'], 0, ',', '.') ?> VNĐ</span>
                          <?php else: ?>
                            <?= number_format($product['final_price'], 0, ',', '.') ?> VNĐ
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php else: ?>
                        <span>Giá không khả dụng</span>
                      <?php endif; ?>
                    </h4>
                    <a href="/product-detail/<?= $product['product_id'] ?>" class="product-card__button">
                      <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>

            <?php else: ?>
              <p>Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
            <?php endif; ?>

          </div>



          <div class="pagination">
            <?php if ($data['totalPages'] > 1): // Chỉ hiển thị phân trang nếu có nhiều hơn 1 trang 
            ?>
              <?php if ($data['currentPage'] > 1): ?>
                <a href="?page=<?= $data['currentPage'] - 1 ?>" class="pagination__prev">← Trang trước</a>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                <a href="?page=<?= $i ?>" class="pagination__link <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                  <?= $i ?>
                </a>
              <?php endfor; ?>

              <?php if ($data['currentPage'] < $data['totalPages']): ?>
                <a href="?page=<?= $data['currentPage'] + 1 ?>" class="pagination__next">Trang sau →</a>
              <?php endif; ?>
            <?php endif; ?>
          </div>


          <style>
            .product-card {
              position: relative;
            }



            .product-card__discount {
              position: absolute;
              top: 10px;
              right: 10px;
              background-color: red;
              color: white;
              padding: 5px 8px;
              font-size: 14px;
              font-weight: bold;
              border-radius: 5px;
              z-index: 10;
            }

            .product-card__price {
              margin: 10px 0;
              font-size: 13px;
              display: flex;
              /* Đặt flexbox để căn ngang */
              justify-content: flex-start;
              /* Căn trái */
              align-items: center;
              /* Căn giữa theo chiều dọc */
              gap: 8px;
              /* Khoảng cách giữa giá gốc và giá giảm */
            }

            .product-card__price s {
              color: #888;
              font-size: 12px;
              /* Kích thước giá gốc nhỏ hơn */
              margin: 0;
              /* Xóa khoảng cách mặc định */
            }

            .product-card__price span {
              color: red;
              font-weight: bold;
              font-size: 14px;
              /* Kích thước giá giảm lớn hơn giá gốc */
            }


            .product-card__price .discount-price {
              /* Tạo class mới */
              color: red;
              font-weight: bold;
              font-size: 15px;
              display: block;
            }
          </style>
          <!-- <button class="product-section__show-more" data-category="vietnam-fruits" onclick="showMoreProducts('vietnam-fruits')">Xem Thêm</button> -->

        </div>
        </section>
      </div>
      </div>
      <!-- <script src="<?= APP_URL ?>public/assets/client/js/products.js"></script> -->
    </main>
<?php

  }
}
?>