<?php

namespace App\Views\Client\Pages\Store;

use App\Views\BaseView;


class store  extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="store-banner">
            <img src="<?= APP_URL ?>/public/assets/client/images/store/banner.webp" alt="Banner - Fresh Fruit Store" class="store-banner__image">
            <div class="store-banner__content">
                <h1>Welcome to Trái Cây Tươi</h1>
                <p>Khám phá những trái cây tươi ngon nhất từ nông trại đến bàn ăn của bạn!</p>
            </div>
        </div>

        <div class="main-container">
            <main class="store">
                <aside class="store__sidebar">
                    <h2 class="store__sidebar-title">Theo khu vực</h2>
                    <ul class="store__sidebar-list">
                        <li class="store__sidebar-item store__sidebar-item--active">Ho Chi Minh City (53)</li>
                        <li class="store__sidebar-item">Hanoi (32)</li>
                        <li class="store__sidebar-item">Hai Phong (3)</li>
                        <li class="store__sidebar-item">Tay Ninh (2)</li>
                        <li class="store__sidebar-item">Nha Trang (3)</li>
                        <li class="store__sidebar-item">Ba Ria Vung Tau (1)</li>
                        <li class="store__sidebar-item">Dong Nai (1)</li>
                        <li class="store__sidebar-item">Hung Yen (1)</li>
                        <li class="store__sidebar-item">Binh Duong (1)</li>
                        <li class="store__sidebar-item">Tien Giang (1)</li>
                    </ul>
                </aside>

                <section class="store__listings">
                    <section class="store__filter">
                        <h2 class="store__filter-title">Khám phá 53 cửa hàng của chúng tôi ở Tp Hồ Chí Minh</h2>
                        <div class="store__filter-dropdown">
                            <select class="store__dropdown" aria-label="Chọn Quận/Huyện">
                                <option value="" disabled selected>Quận/Huyện</option>
                                <option value="hanoi">Hanoi (32)</option>
                                <option value="hai-phong">Hai Phong (3)</option>
                                <option value="tay-ninh">Tay Ninh (2)</option>
                                <option value="nha-trang">Nha Trang (3)</option>
                                <option value="ba-ria-vung-tau">Ba Ria Vung Tau (1)</option>
                                <option value="dong-nai">Dong Nai (1)</option>
                                <option value="hung-yen">Hung Yen (1)</option>
                                <option value="binh-duong">Binh Duong (1)</option>
                                <option value="tien-giang">Tien Giang (1)</option>
                            </select>
                        </div>
                    </section>

                    <div class="store__listings-cards">
                        <div class="store-card">
                            <img src="<?= APP_URL ?>/public/assets/client/images/store/store4.jpg" alt="HCM Signature by The Coffee House" class="store-card__image">
                            <h3 class="store-card__name">Trái Cây Tươi - Chất Lượng Hàng Đầu</h3>
                            <a href="#" class="cta-button store-card__view-map">Xem vị trí cửa hàng</a>
                            <p class="store-card__address">123 Đường Trái Cây, Quận 1, Thành phố Hồ Chí Minh</p>
                            <p class="store-card__time">8:00 - 20:00</p>
                            <div class="store-card__features">
                                <span class="store-card__feature"><i class="fas fa-car"></i> Có chỗ đỗ xe hơi</span>
                                <span class="store-card__feature"><i class="fas fa-child"></i>Thân thiện</span>
                                <span class="store-card__feature"><i class="fas fa-shopping-bag"></i>Mua mang về</span>
                            </div>
                            <div class="store-card__share">
                                <span>Share on:</span>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-zalo"></i>
                                <i class="fas fa-copy"></i>
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                        <div class="store-card">
                            <img src="<?= APP_URL ?>/public/assets/client/images/store/store3.jpg" alt="HCM Signature by The Coffee House" class="store-card__image">
                            <h3 class="store-card__name">Organic Fresh - Trái Cây Hữu Cơ</h3>
                            <a href="#" class="cta-button store-card__view-map">Xem vị trí cửa hàng</a>
                            <p class="store-card__address">456 Đường Xanh, Quận 3, Thành phố Hồ Chí Minh</p>
                            <p class="store-card__time">8:00 - 20:00</p>
                            <div class="store-card__features">
                                <span class="store-card__feature"><i class="fas fa-car"></i> Có chỗ đỗ xe hơi</span>
                                <span class="store-card__feature"><i class="fas fa-child"></i>Thân thiện</span>
                                <span class="store-card__feature"><i class="fas fa-shopping-bag"></i>Mua mang về</span>
                            </div>
                            <div class="store-card__share">
                                <span>Share on:</span>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-zalo"></i>
                                <i class="fas fa-copy"></i>
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                        <div class="store-card">
                            <img src="<?= APP_URL ?>/public/assets/client/images/store/store1.jpg" alt="HCM Signature by The Coffee House" class="store-card__image">
                            <h3 class="store-card__name">Thiên Đường Trái Cây Nhiệt Đới</h3>
                            <a href="#" class="cta-button store-card__view-map">Xem vị trí cửa hàng</a>
                            <p class="store-card__address">789 Đường Hoa Quả, Quận 5, Thành phố Hồ Chí Minh</p>
                            <p class="store-card__time">8:00 - 20:00</p>
                            <div class="store-card__features">
                                <i class="fas fa-car"></i><span class="store-card__feature"> Có chỗ đỗ xe hơi</span>
                                <i class="fas fa-child"></i><span class="store-card__feature">Thân thiện</span>
                                <i class="fas fa-shopping-bag"></i> <span class="store-card__feature">Mua mang về</span>
                            </div>
                            <div class="store-card__share">
                                <span>Share on:</span>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-zalo"></i>
                                <i class="fas fa-copy"></i>
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                        <div class="store-card">
                            <img src="<?= APP_URL ?>/public/assets/client/images/store/store2.jpg" alt="HCM Signature by The Coffee House" class="store-card__image">
                            <h3 class="store-card__name">Exotic Fruit Market - Trái Cây Độc Đáo</h3>
                            <a href="#" class="cta-button store-card__view-map">Xem vị trí cửa hàng</a>
                            <p class="store-card__address">159 Đường Hương Vị, Quận 4, Thành phố Hồ Chí Minh</p>
                            <p class="store-card__time">8:00 - 20:00</p>
                            <div class="store-card__features">
                                <span class="store-card__feature"><i class="fas fa-car"></i>Thân thiện</span>
                                <span class="store-card__feature"><i class="fas fa-shopping-bag"></i>Mua mang về</span>
                            </div>
                            <div class="store-card__share">
                                <span>Share on:</span>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-zalo"></i>
                                <i class="fas fa-copy"></i>
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                        <div class="store-card">
                            <img src="<?= APP_URL ?>/public/assets/client/images/store/store2.jpg" alt="HCM Signature by The Coffee House" class="store-card__image">
                            <h3 class="store-card__name">Exotic Fruit Market - Trái Cây Độc Đáo</h3>
                            <a href="#" class="cta-button store-card__view-map">Xem vị trí cửa hàng</a>
                            <p class="store-card__address">159 Đường Hương Vị, Quận 4, Thành phố Hồ Chí Minh</p>
                            <p class="store-card__time">8:00 - 20:00</p>
                            <div class="store-card__features">
                                <span class="store-card__feature"><i class="fas fa-car"></i>thân thiện</span>
                                <span class="store-card__feature"><i class="fas fa-shopping-bag"></i>Mua mang về</span>
                            </div>
                            <div class="store-card__share">
                                <span>Share on:</span>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-zalo"></i>
                                <i class="fas fa-copy"></i>
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                        <div class="store-card">
                            <img src="<?= APP_URL ?>/public/assets/client/images/store/store2.jpg" alt="HCM Signature by The Coffee House" class="store-card__image">
                            <h3 class="store-card__name">Exotic Fruit Market - Trái Cây Độc Đáo</h3>
                            <a href="#" class="cta-button store-card__view-map">Xem vị trí cửa hàng</a>
                            <p class="store-card__address">159 Đường Hương Vị, Quận 4, Thành phố Hồ Chí Minh</p>
                            <p class="store-card__time">8:00 - 20:00</p>
                            <div class="store-card__features">
                                <span class="store-card__feature"><i class="fas fa-car"></i>thân thiện</span>
                                <span class="store-card__feature"><i class="fas fa-shopping-bag"></i>Mua mang về</span>
                            </div>
                            <div class="store-card__share">
                                <span>Share on:</span>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-zalo"></i>
                                <i class="fas fa-copy"></i>
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                    </div>
                    <!-- "See More Stores" button -->
                    <div class="store__see-more">
                        <button class="store__see-more-button" onclick="showMoreStores()">Xem thêm cửa hàng</button>
                    </div>
                </section>
            </main>
        </div>

<?php
    }
}
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const storeCards = document.querySelectorAll(".store-card");
        const seeMoreButton = document.querySelector(".store__see-more-button");

        // Show only the first four stores initially
        storeCards.forEach((card, index) => {
            if (index >= 4) card.classList.add("hidden");
        });

        // Show all hidden stores when "See More" is clicked
        window.showMoreStores = function() {
            storeCards.forEach(card => card.classList.remove("hidden"));
            seeMoreButton.style.display = "none";
        };
    });
</script>