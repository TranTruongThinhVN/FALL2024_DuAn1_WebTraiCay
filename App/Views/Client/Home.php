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
            <a href="/products"><button class="cta-button">Xem thêm</button></a>
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
            <a href="/products"><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <div class="carousel-wrapper__slide fade-animation" style="display: none;">
          <img src="<?= APP_URL ?>public/assets/client/images/home/BANNER4.webp" class="img-fluid">
          <div class="carousel-text" style="max-width: 780px;">
            <p>Gần gũi thiên nhiên trong từng miếng trái cây</p>
            <span>Tận hưởng sự thuần khiết và tươi mát của từng sản phẩm</span>
            <a href="/products"><button class="cta-button">Xem thêm</button></a>
          </div>
        </div>
        <div class="carousel-wrapper__slide fade-animation" style="display: none;">
          <img src="<?= APP_URL ?>public/assets/client/images/home/bANNER6.webp" class="img-fluid">
          <div class="carousel-text">
            <p>Chọn trái cây ngon, tận hưởng cuộc sống khỏe</p>
            <span>Sức khỏe và chất lượng bắt đầu từ những gì bạn ăn</span>
            <a href="/products"><button class="cta-button">Xem thêm</button></a>
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
          <?php if (!empty($data['featuredProducts'])): ?>
            <h1 class="title-featured-products">TRÁI NGON HÔM NAY</h1>

            <div class="product-grid">

              <?php foreach ($data['featuredProducts'] as $product): ?>
                <div class="product-card">
                  <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($product['image']) ?>"
                    alt="<?= htmlspecialchars($product['name']) ?>"
                    class="product-image">
                  <div class="product-info">
                    <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="product-price"><?= number_format($product['price'], 0, ',', '.') ?>₫</p>
                    <a href="/product-detail/<?= $product['id'] ?>" class="buy-button">
                      <i class="fas fa-shopping-bag"></i> Chọn Mua
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>

            <?php else: ?>
              <!-- <p class="no-products text-center">Hiện tại không có sản phẩm nổi bật nào.</p> -->

            </div>
          <?php endif; ?>
          <!-- Nút "Xem Thêm" -->
          <!-- <button class="show-more-btn" data-category="featured" onclick="showMoreProducts('featured')">Xem Thêm</button> -->
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

            <a href="/products"><button class="cta-button">Khám phá ngay</button></a>
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
            <a href="/products"><button class="cta-button">Khám phá thêm</button></a>
          </div>
          <div class="image-container">
            <img src="<?= APP_URL ?>public/assets/client/images/home/info_right.png" alt="Trái cây chất lượng">
          </div>
        </div>
      </div>
    </section>
    <section class="latest-news">
      <div class="main-container">
        <?php if (!empty($data['latestRecipes'])): ?>
          <h2 class="latest-news__title">
            <img src="https://lh3.googleusercontent.com/rLLNp8QrI68R6nXuIx5UzS_3SxdjsPCDckf08bQ9H9h5XdRVR3iZQNZxIIxcl3OrZL-Y"
              alt="Icon Trái Cây"
              class="latest-news__icon">CÔNG THỨC CHẾ BIẾN TRÁI CÂY
          </h2>
          <div class="news-grid">
            <?php foreach ($data['latestRecipes'] as $recipe): ?>
              <!-- Tin Tức 1 -->
              <div class="news-card">
                <img src="<?= ($recipe['image_url']); ?>" alt="Bắt gặp Sài Gòn xưa trong món uống...">

                <div class="news-content">
                  <span class="news-date"> <?= date('d/m/Y', strtotime($recipe['created_at'])) ?></span>
                  <h3><?= htmlspecialchars($recipe['title']) ?></h3>
                  <p><?= htmlspecialchars(substr($recipe['description'], 0, 100)) ?></p>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        <?php else: ?>
          <p class="no-recipes text-center">Hiện tại không có công thức nào.</p>
        <?php endif; ?>
      </div>
    </section>
    <script src="<?= APP_URL ?>public/assets/client/js/featured-product.js"></script>
    <script src="<?= APP_URL ?>public/assets/client/js/slideshow.js"></script>
<?php
  }
}
