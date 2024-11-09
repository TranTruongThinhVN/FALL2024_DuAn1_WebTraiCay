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


        <aside class="sidebar">

          <div class="search-bar">
            <input type="text" placeholder="Bạn muốn tìm gì?" />
            <button><i class="fas fa-search"></i></button>
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

          <div class="category-section">
            <h2>Lọc giá</h2>
            <ul>
              <li><input type="checkbox" /> Dưới 500.000₫</li>
              <li><input type="checkbox" /> 500.000₫ - 1.000.000₫</li>
              <li><input type="checkbox" /> 1.000.000₫ - 2.500.000₫</li>
              <li><input type="checkbox" /> 2.500.000₫ - 5.000.000₫</li>
              <li><input type="checkbox" /> Trên 5.000.000₫</li>
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
                <a href="#">Sản phẩm nổi bật</a>
                <a href="#">Giá: Tăng dần</a>
                <a href="#">Giá: Giảm dần</a>
                <a href="#">Tên: A-Z</a>
                <a href="#">Tên: Z-A</a>
                <a href="#">Cũ nhất</a>
                <a href="#">Mới nhất</a>
                <a href="#">Bán chạy nhất</a>
                <a href="#">Tồn kho giảm dần</a>
              </div>
            </div>
          </div>

          <div class="product-section__grid" onclick="location.href='/product-detail'">
            <div class="product-card">
              <img src="<?= APP_URL ?>public/assets/client/images/product/buoi_da_xanh.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/luu_tu_xuyen.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/quyt_duong_lao.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/chomchom_giong_thai.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/luu_tu_xuyen.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/quyt_duong_lao.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/nho_den_my.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/quyt_duong_lao.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/dao_tien_uc.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/dua_luoi_hoang_kim.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card" onclick="location.href='/product-detail'">
              <img src="<?= APP_URL ?>public/assets/client/images/product/buoi_da_xanh.webp" alt="Dừa xiêm gọt trọc" class="product-card__image" />
              <div class="product-card__info">
                <h3 class="product-card__name">Dừa xiêm gọt trọc</h3>
                <p class="product-card__price">15,500₫</p>
                <button class="product-card__button">
                  <i class="product-card__icon fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
          </div>
          <button class="product-section__show-more" data-category="vietnam-fruits" onclick="showMoreProducts('vietnam-fruits')">Xem Thêm</button>

        </div>
        </section>


      </div>
      </div>
    </main>
<?php

  }
}
?>
<script src="<?= APP_URL ?>public/assets/client/js/products.js"></script>