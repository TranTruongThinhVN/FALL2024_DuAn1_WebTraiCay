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
                    <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($product['sku_image'] ?? $product['image']) ?>"
                      alt="<?= htmlspecialchars($product['product_name']) ?>"
                      class="product-card__image" />
                    <?php
                    // Kiểm tra type để lấy giá và giảm giá phù hợp
                    $original_price = $product['type'] === 'simple' ? $product['product_price'] : $product['sku_price'];
                    $discount_price = $product['type'] === 'simple' ? $product['product_discount_price'] : $product['sku_discount_price'];
                    ?>
                    <?php if (!empty($discount_price) && $discount_price < $original_price): ?>
                      <span class="product-card__discount">
                        -<?= round((($original_price - $discount_price) / $original_price) * 100) ?>%
                      </span>
                    <?php endif; ?>
                  </a>
                  <div class="product-card__info">
                    <h3 class="product-card__name">
                      <?= htmlspecialchars($product['product_name']) ?>
                      <?php if ($product['type'] === 'variable'): ?>
                        (<?= htmlspecialchars($product['sku_name']) ?>)
                      <?php endif; ?>
                    </h3>
                    <h4 class="product-card__price">
                      <?php if (!empty($discount_price) && $discount_price < $original_price): ?>
                        <s><?= number_format($original_price) ?> VNĐ</s>
                        <span><?= number_format($discount_price) ?> VNĐ</span>
                      <?php else: ?>
                        <?= number_format($original_price) ?> VNĐ
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
              font-size: 16px;
            }

            .product-card__price s {
              color: #888;
              margin-right: 5px;
              font-size: 13px;
            }

            .product-card__price span {
              color: red;
              font-weight: bold;
              font-size: 16px;
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