<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Index extends BaseView
{
  public static function render($products = null)
  {

?>

    <main class="main-container">
      <div class="content-container">
        <aside class="sidebar">
          <div class="search-bar">
            <form method="GET" action="/product-search">
              <input type="text" name="keyword" placeholder="Bạn muốn tìm gì?" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" />
              <button type="submit" value="Tìm kiếm"><i class="fas fa-search"></i></button>
            </form>
          </div>

          <div class="category-section">
            <h2>Danh mục sản phẩm</h2>
            <ul>
              <li class="hover-target"><a href="#">Trái Cây Việt Nam</a></li>
              <li class="hover-target"><a href="#">Trái Cây Nhập Khẩu</a></li>
              <li class="hover-target"><a href="#">Trái Cây Cắt Sẵn</a></li>
              <li class="hover-target"><a href="#">Quà Tặng Trái Cây</a></li>
              <li class="hover-target"><a href="#">Mâm Ngũ Quả</a></li>
            </ul>
          </div>

          <div class="category-section">
            <h2>Lọc giá</h2>
            <form method="GET" action="/product-filter">
              <ul>
                <li>
                  <input type="radio" name="price_range" value="0-50000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '0-50000' ? 'checked' : '' ?> /> Dưới 50.000₫
                </li>
                <li>
                  <input type="radio" name="price_range" value="50000-100000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '50000-100000' ? 'checked' : '' ?> /> 50.000₫ - 100.000₫
                </li>
                <li>
                  <input type="radio" name="price_range" value="100000-500000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '100000-500000' ? 'checked' : '' ?> /> 100.000₫ - 500.000₫
                </li>
                <li>
                  <input type="radio" name="price_range" value="500000-1000000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '500000-1000000' ? 'checked' : '' ?> /> 500.000₫ - 1.000.000₫
                </li>
                <li>
                  <input type="radio" name="price_range" value="1000000-1000000000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '1000000-1000000000' ? 'checked' : '' ?> /> Trên 1.000.000₫
                </li>
              </ul>
              <button type="submit" class="product-section__show-more">Áp dụng</button>
            </form>
          </div>

          <div class="category-section">
            <h2>Xuất xứ</h2>
            <ul>
              <li><input type="checkbox" /> Mỹ</li>
              <li><input type="checkbox" /> Pháp</li>
              <li><input type="checkbox" /> Việt Nam</li>
              <li><input type="checkbox" /> New Zealand</li>
              <li><input type="checkbox" /> Úc</li>
              <li><input type="checkbox" /> Canada</li>
              <li><input type="checkbox" /> Hàn Quốc</li>
              <li><input type="checkbox" /> Nhật Bản</li>
              <li><input type="checkbox" /> Nam Phi</li>
              <li><input type="checkbox" /> Khác</li>
            </ul>
          </div>

        </aside>
        <div class="product-section__category product-section__category--vietnam-fruits">
          <div class="product-section__header">
            <div class="product-section__title-count">
              <h1 class="product-section__title">Sản phẩm</h1>
              <span class="product-count">172 sản phẩm</span>
            </div>
            <div class="sort-dropdown">
              <button class="sort-dropdown__toggle">
                <i class="fas fa-sort"></i> Sắp xếp
              </button>
              <div class="sort-dropdown__menu">
                <a href="#">Giá: Tăng dần</a>
                <a href="#">Giá: Giảm dần</a>
                <a href="#">Tên: A-Z</a>
                <a href="#">Tên: Z-A</a>
              </div>
            </div>
          </div>

          <div class="product-section__grid">
            <?php if ($products): ?>
              <?php foreach ($products as $product): ?>
                <div class="product-card">
                  <div class="product-card__info">
                    <h3 class="product-card__name">
                      <a href="/product-detail/<?= $product['id'] ?>"> <?= $product['name'] ?> </a>
                    </h3>
                    <h4 class="product-card__price"><?= number_format($product['price']) ?> VNĐ</h4>
                    <button class="product-card__button">
                      <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                    </button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
            <?php endif; ?>
          </div>


          <button class="product-section__show-more" data-category="vietnam-fruits" onclick="showMoreProducts('vietnam-fruits')">Xem Thêm</button>

        </div>
        </section>
      </div>
      </div>
      <script src="<?= APP_URL ?>public/assets/client/js/products.js"></script>
    </main>
<?php

  }
}
?>