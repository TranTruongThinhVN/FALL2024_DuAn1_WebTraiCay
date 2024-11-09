<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="shopping-cart">
            <div class="shopping-cart__header">
                <div class="cart-header__checkbox">
                    <input type="checkbox">
                </div>
                <div class="cart-header__title">Sản Phẩm</div>
                <div class="cart-header__price">Đơn Giá</div>
                <div class="cart-header__quantity">Số Lượng</div>
                <div class="cart-header__subtotal">Số Tiền</div>
                <div class="cart-header__action">Thao Tác</div>
            </div>

            <div class="shopping-cart__items">
                <div class="cart-product">
                    <div class="cart-product__info">
                        <input type="checkbox" class="cart-product__info-checkbox">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-product__info-image">
                        <div class="cart-product__info-details">
                            <h2>Tên Sản Phẩm</h2>
                            <p class="cart-product__options">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-product__price">₫100.000</div>
                    <div class="cart-product__quantity">
                        <button class="cart-product__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-product__quantity-input">
                        <button class="cart-product__quantity-btn">+</button>
                    </div>
                    <div class="cart-product__total-price">₫100.000</div>
                    <div class="cart-product__action">
                        <button class="cart-product__action-delete-btn">Xóa</button>
                    </div>
                </div>
            </div>
            <div class="shopping-cart__items">
                <div class="cart-product">
                    <div class="cart-product__info">
                        <input type="checkbox" class="cart-product__info-checkbox">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-product__info-image">
                        <div class="cart-product__info-details">
                            <h2>Tên Sản Phẩm</h2>
                            <p class="cart-product__options">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-product__price">₫100.000</div>
                    <div class="cart-product__quantity">
                        <button class="cart-product__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-product__quantity-input">
                        <button class="cart-product__quantity-btn">+</button>
                    </div>
                    <div class="cart-product__total-price">₫100.000</div>
                    <div class="cart-product__action">
                        <button class="cart-product__action-delete-btn">Xóa</button>
                    </div>
                </div>
            </div>
            <div class="shopping-cart__items">
                <div class="cart-product">
                    <div class="cart-product__info">
                        <input type="checkbox" class="cart-product__info-checkbox">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-product__info-image">
                        <div class="cart-product__info-details">
                            <h2>Tên Sản Phẩm</h2>
                            <p class="cart-product__options">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-product__price">₫100.000</div>
                    <div class="cart-product__quantity">
                        <button class="cart-product__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-product__quantity-input">
                        <button class="cart-product__quantity-btn">+</button>
                    </div>
                    <div class="cart-product__total-price">₫100.000</div>
                    <div class="cart-product__action">
                        <button class="cart-product__action-delete-btn">Xóa</button>
                    </div>
                </div>
            </div>
            <div class="shopping-cart__items">
                <div class="cart-product">
                    <div class="cart-product__info">
                        <input type="checkbox" class="cart-product__info-checkbox">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-product__info-image">
                        <div class="cart-product__info-details">
                            <h2>Tên Sản Phẩm</h2>
                            <p class="cart-product__options">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-product__price">₫100.000</div>
                    <div class="cart-product__quantity">
                        <button class="cart-product__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-product__quantity-input">
                        <button class="cart-product__quantity-btn">+</button>
                    </div>
                    <div class="cart-product__total-price">₫100.000</div>
                    <div class="cart-product__action">
                        <button class="cart-product__action-delete-btn">Xóa</button>
                    </div>
                </div>
            </div>
            <div class="shopping-cart__items">
                <div class="cart-product">
                    <div class="cart-product__info">
                        <input type="checkbox" class="cart-product__info-checkbox">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-product__info-image">
                        <div class="cart-product__info-details">
                            <h2>Tên Sản Phẩm</h2>
                            <p class="cart-product__options">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-product__price">₫100.000</div>
                    <div class="cart-product__quantity">
                        <button class="cart-product__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-product__quantity-input">
                        <button class="cart-product__quantity-btn">+</button>
                    </div>
                    <div class="cart-product__total-price">₫100.000</div>
                    <div class="cart-product__action">
                        <button class="cart-product__action-delete-btn">Xóa</button>
                    </div>
                </div>
            </div>
            <div class="shopping-cart__items">
                <div class="cart-product">
                    <div class="cart-product__info">
                        <input type="checkbox" class="cart-product__info-checkbox">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-product__info-image">
                        <div class="cart-product__info-details">
                            <h2>Tên Sản Phẩm</h2>
                            <p class="cart-product__options">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-product__price">₫100.000</div>
                    <div class="cart-product__quantity">
                        <button class="cart-product__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-product__quantity-input">
                        <button class="cart-product__quantity-btn">+</button>
                    </div>
                    <div class="cart-product__total-price">₫100.000</div>
                    <div class="cart-product__action">
                        <button class="cart-product__action-delete-btn">Xóa</button>
                    </div>
                </div>
            </div>

            <div class="shopping-cart__summary">
                <!-- Shopee Voucher Section -->
                <div class="voucher-section">
                    <span class="voucher-icon">🎟️</span> <!-- Bạn có thể thay bằng icon thực tế -->
                    <span class="voucher-title">Shopee Voucher</span>
                    <a href="#" class="voucher-link">Chọn hoặc nhập mã</a>
                </div>

                <!-- Thanh toán tổng -->
                <div class="shopping-cart__summary-bottom">
                    <div class="shopping-cart__summary-left">
                        <input type="checkbox" class="shopping-cart__summary-select-all">
                        <span class="click-all-left">Chọn tất cả</span>
                        <a class="shopping-cart__summary-delete-selected">Xóa</a>
                    </div>
                    <div class="summary-right">
                        <div class="shopping-cart__summary-right">
                            <span class="summary-total-label">Tổng thanh toán (1 sản phẩm):</span>
                            <span class="summary-total-amount">₫100.000</span>
                        </div>

                        <button class="cta-button checkout-btn">Mua Hàng</button>
                    </div>
                </div>
            </div>

        </div>
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


<?php

    }
}
?>
<script>
    window.addEventListener('scroll', function() {
        const cartItems = document.querySelector('.shopping-cart__items');
        const cartSummary = document.querySelector('.shopping-cart__summary');

        const itemsBottom = cartItems.getBoundingClientRect().bottom;
        const windowBottom = window.innerHeight;

        if (itemsBottom <= windowBottom) {
            cartSummary.classList.add('fixed');
        } else {
            cartSummary.classList.remove('fixed');
        }
    });
</script>