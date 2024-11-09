<?php

namespace App\Views\Client;

use App\Views\BaseView;

class Home extends BaseView
{
  public static function render($data = null)
  {
?>
    <section class="main-carousel">
      <div class="carousel-wrapper">
        <div class="carousel-wrapper__slide fade-animation">
          <img src="<?= APP_URL ?>public/assets/client/images/home/BANNER1.png" class="img-fluid">
          <div class="carousel-text">
            <p>Trái cây tươi từ vườn đến tay bạn!</p>
            <span>Tận hưởng sự tươi mát và dinh dưỡng từ nông trại. </span>
            <a><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <div class="carousel-wrapper__slide fade-animation" style="display: none;">
          <img src="<?= APP_URL ?>public/assets/client/images/home/BANNER2.jpg" class="img-fluid">
          <div class="carousel-text">
            <p>Vị ngọt tự nhiên, tươi ngon mỗi ngày</p>
            <span>Chọn lựa trái cây tự nhiên và an toàn cho gia đình bạn</span>
            <a><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <div class="carousel-wrapper__slide fade-animation" style="display: none;">
          <img src="<?= APP_URL ?>public/assets/client/images/home/BANNER3.jpg" class="img-fluid">
          <div class="carousel-text">
            <p>Trải nghiệm hương vị từ thiên nhiên</p>
            <span> Đưa những gì tinh túy nhất từ thiên nhiên đến bàn ăn của bạn</span>
            <a><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <div class="carousel-wrapper__slide fade-animation" style="display: none;">
          <img src="<?= APP_URL ?>public/assets/client/images/home/BANNER4.webp" class="img-fluid">
          <div class="carousel-text" style="max-width: 780px;">
            <p>Gần gũi thiên nhiên trong từng miếng trái cây</p>
            <span>Tận hưởng sự thuần khiết và tươi mát của từng sản phẩm</span>
            <a><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <div class="carousel-wrapper__slide fade-animation" style="display: none;">
          <img src="<?= APP_URL ?>public/assets/client/images/home/bANNER6.webp" class="img-fluid">
          <div class="carousel-text">
            <p>Chọn trái cây ngon, tận hưởng cuộc sống khỏe</p>
            <span>Sức khỏe và chất lượng bắt đầu từ những gì bạn ăn</span>
            <a><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        <div class="main-carousel-dots">
          <span class="dot active" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
          <span class="dot" onclick="currentSlide(4)"></span>
          <span class="dot" onclick="currentSlide(5)"></span>
        </div>

      </div>
    </section>

    <section class="product-section">
      <div class="main-container">
        <div class="featured-products">
          <h1 class="title-featured-products">TRÁI NGON HÔM NAY</h1>
          <div class="product-grid">
            <!-- Product Card 1 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/dua_xiem_got_troc.webp" alt="Dừa xiêm gọt trọc" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Dừa xiêm gọt trọc</h3>
                <p class="product-price">15,500₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 2 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/buoi_da_xanh.webp" alt="Bưởi da xanh" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Bưởi da xanh</h3>
                <p class="product-price">85,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 3 -->
            <div class="product-card">
              <img src="<?= APP_URL ?>/public/assets/client/images/home/xoai_tu_quy_da_vang.webp" alt="Xoài tứ quý da vàng" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Xoài tứ quý da vàng</h3>
                <p class="product-price">55,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 4 -->
            <div class="product-card">
              <img src="<?= APP_URL ?>/public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Dưa lưới Hoàng Kim" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Dưa lưới Hoàng Kim</h3>
                <p class="product-price">105,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 5 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/chomchom_giong_thai.webp" alt="Chôm chôm giống Thái" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Chôm chôm giống Thái</h3>
                <p class="product-price">95,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 6 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/xoai_cat_hoa_loc.webp" alt="Xoài cát Hoà Lộc" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Xoài cát Hoà Lộc</h3>
                <p class="product-price">195,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/hong_gion_da_lat.webp" alt="Hồng giòn Fuji Đà Lạt" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Hồng giòn Fuji Đà Lạt</h3>
                <p class="product-price">125,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 2 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/sapoche.webp" alt="Sapoche" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Sapoche</h3>
                <p class="product-price">75,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 3 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/nho_den_my.webp" alt="Nho đen Mỹ" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Nho đen Mỹ</h3>
                <p class="product-price">285,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 4 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/luu_tu_xuyen.webp" alt="Lựu Tứ Xuyên" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Lựu Tứ Xuyên</h3>
                <p class="product-price">105,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 5 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/quyt_duong_lao.webp" alt="Quýt Đường Lão" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Quýt Đường Lão</h3>
                <p class="product-price">80,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 6 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/dao_tien_uc.webp" alt="Đào tiên Úc" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Đào tiên Úc</h3>
                <p class="product-price">195,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/vu_sua_lo_ren.webp" alt="Vú sữa Lò Rèn" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Vú sữa Lò Rèn</h3>
                <p class="product-price">120,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>

            <!-- Product Card 6 -->
            <div class="product-card">
              <img src=" <?= APP_URL ?>public/assets/client/images/home/bo_booth.webp" alt="Bơ Booth" class="product-image">
              <div class="product-info">
                <h3 class="product-name">Bơ Booth</h3>
                <p class="product-price">195,000₫</p>
                <button class="buy-button">
                  <i class="fas fa-shopping-bag"></i> Chọn Mua
                </button>
              </div>
            </div>
          </div>

          <!-- Nút "Xem Thêm" -->
          <button class="show-more-btn" data-category="featured" onclick="showMoreProducts('featured')">Xem Thêm</button>
        </div>
      </div>
    </section>
    <!-- Section 1: Ảnh bên trái, nội dung bên phải -->
    <section class="brand-introduction">
      <div class="main-container">
        <div class="content">
          <div class="image-container">
            <img src="<?= APP_URL ?>public/assets/client/images/home/Info_left.jpg" alt="Trái cây tươi ngon">
          </div>
          <div class="text-content">
            <h2>TỪ NHỮNG TRÁI NGỌT, CHÚNG TÔI TẠO RA NIỀM ĐAM MÊ</h2>
            <p>
              Trải qua nhiều năm gắn bó với ngành nông sản, chúng tôi tự hào mang đến cho bạn những trái cây tươi ngon nhất. Các sản phẩm của chúng tôi không chỉ được chọn lọc từ những vườn cây đạt chuẩn mà còn được trồng trọt, chăm sóc và bảo quản theo quy trình nghiêm ngặt. Chúng tôi cam kết mang đến cho bạn và gia đình những trái cây tươi ngon, bổ dưỡng và an toàn cho sức khỏe.
            </p>
            <p>
              Chúng tôi tin rằng mỗi quả trái cây đều là một món quà quý giá từ thiên nhiên, chứa đựng sự tươi mát và những giá trị dinh dưỡng thiết yếu. Từ những giống cây truyền thống cho đến những giống cây ngoại nhập đặc sắc, mỗi sản phẩm đều trải qua quy trình kiểm định chất lượng khắt khe để đảm bảo rằng chỉ những quả tươi ngon nhất mới được giao đến tay khách hàng. Với chúng tôi, trái cây không chỉ là thực phẩm mà còn là một phần của lối sống lành mạnh và cân bằng.
            </p>

            <button class="cta-button">Khám phá ngay</button>
          </div>
        </div>
      </div>
    </section>
    <section class="brand-introduction">
      <div class="main-container">
        <div class="content reverse">
          <div class="text-content">
            <h2>CHẤT LƯỢNG TỪ TÂM, GIÁ TRỊ CHO SỨC KHỎE</h2>
            <p>
              Mỗi loại trái cây đều được chăm sóc kỹ lưỡng, từ lúc gieo trồng cho đến khi thu hoạch, để đảm bảo mang đến hương vị tự nhiên và chất lượng tốt nhất. Chúng tôi không ngừng cải tiến và đổi mới để phục vụ tốt hơn, mang đến những trái cây tươi ngon, an toàn và giàu dinh dưỡng.
            </p>
            <p>
              Hãy đến với chúng tôi để trải nghiệm những sản phẩm trái cây sạch, được trồng trọt và bảo quản một cách khoa học. Mỗi trái cây không chỉ là thực phẩm mà còn là sự chăm sóc sức khỏe cho bạn và gia đình. Chúng tôi tin rằng sức khỏe là tài sản quý giá nhất, và chúng tôi cam kết mang đến những giá trị tốt đẹp từ thiên nhiên cho cuộc sống của bạn.
            </p>
            <button class="cta-button">Khám phá thêm</button>
          </div>
          <div class="image-container">
            <img src="<?= APP_URL ?>public/assets/client/images/home/info_right.png" alt="Trái cây chất lượng">
          </div>
        </div>
      </div>
    </section>
    <section class="latest-news">
      <div class="main-container">
        <h2 class="latest-news__title">
          <img src="https://lh3.googleusercontent.com/rLLNp8QrI68R6nXuIx5UzS_3SxdjsPCDckf08bQ9H9h5XdRVR3iZQNZxIIxcl3OrZL-Y"
            alt="Icon Trái Cây"
            class="latest-news__icon"> TIN TỨC MỚI NHẤT
        </h2>
        <div class="news-grid">
          <!-- Tin Tức 1 -->
          <div class="news-card">
            <img src="<?= APP_URL ?>public/assets/client/images/home/tintuc1-1.webp" alt="Bắt gặp Sài Gòn xưa trong món uống...">
            <div class="news-content">
              <span class="news-date">01/11/2023</span>
              <h3>Bắt gặp Sài Gòn xưa trong món uống...</h3>
              <p>Đâu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
            </div>
          </div>

          <!-- Tin Tức 2 -->
          <div class="news-card">
            <img src="<?= APP_URL ?>public/assets/client/images/home/tintuc2.webp" alt="Chỉ chọn cà phê mỗi sáng nhưng cũng...">
            <div class="news-content">
              <span class="news-date">30/10/2023</span>
              <h3>Chỉ chọn cà phê mỗi sáng nhưng cũng...</h3>
              <p>Thực chất, bạn không nhất thiết phải làm gì to tát để tạo nên một ngày rực rỡ...</p>
            </div>
          </div>
          <div class="news-card">
            <img src="<?= APP_URL ?>public/assets/client/images/home/tintuc3.webp" alt="Chỉ chọn cà phê mỗi sáng nhưng cũng...">
            <div class="news-content">
              <span class="news-date">30/10/2023</span>
              <h3>Chỉ chọn cà phê mỗi sáng nhưng cũng...</h3>
              <p>Thực chất, bạn không nhất thiết phải làm gì to tát để tạo nên một ngày rực rỡ...</p>
            </div>
          </div>
          <div class="news-card">
            <img src="<?= APP_URL ?>public/assets/client/images/home/tintuc4-4.webp" alt="Bắt gặp Sài Gòn xưa trong món uống...">
            <div class="news-content">
              <span class="news-date">01/11/2023</span>
              <h3>Bắt gặp Sài Gòn xưa trong món uống...</h3>
              <p>Đâu qua bao nhiêu lớp sống thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ...</p>
            </div>
          </div>

          <!-- Tin Tức 2 -->
          <div class="news-card">
            <img src="<?= APP_URL ?>public/assets/client/images/home/tintuc5.webp" alt="Chỉ chọn cà phê mỗi sáng nhưng cũng...">
            <div class="news-content">
              <span class="news-date">30/10/2023</span>
              <h3>Chỉ chọn cà phê mỗi sáng nhưng cũng...</h3>
              <p>Thực chất, bạn không nhất thiết phải làm gì to tát để tạo nên một ngày rực rỡ...</p>
            </div>
          </div>
          <div class="news-card">
            <img src="<?= APP_URL ?>public/assets/client/images/home/tintuc6.webp" alt="Chỉ chọn cà phê mỗi sáng nhưng cũng...">
            <div class="news-content">
              <span class="news-date">30/10/2023</span>
              <h3>Chỉ chọn cà phê mỗi sáng nhưng cũng...</h3>
              <p>Thực chất, bạn không nhất thiết phải làm gì to tát để tạo nên một ngày rực rỡ...</p>
            </div>
          </div>

          <!-- Thêm các tin tức khác ở đây -->
          <!-- Tin Tức 3, 4, 5, 6 -->
        </div>
      </div>
    </section>
    <script src="<?= APP_URL ?>public/assets/client/js/featured-product.js"></script>
    <script src="<?= APP_URL ?>public/assets/client/js/slideshow.js"></script>
<?php
  }
}
