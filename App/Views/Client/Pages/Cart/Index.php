<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="main-container">
            <div class="cart-container">
                <div class="cart-header">
                    <div class="cart-header__checkbox">
                        <input type="checkbox" class="cart-header__checkbox-input custom-checkbox">
                    </div>
                    <div class="cart-header__title">Sản Phẩm</div>
                    <div class="cart-header__price">Đơn Giá</div>
                    <div class="cart-header__quantity">Số Lượng</div>
                    <div class="cart-header__total">Số Tiền</div>
                    <div class="cart-header__action">Thao Tác</div>
                </div>

                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div class="cart-item__checkbox">
                        <input type="checkbox" class="custom-checkbox">
                    </div>
                    <div class="cart-item__details">
                        <img src="public/assets/client/images/home/dua_luoi_hoang_kim.webp" alt="Sản phẩm" class="cart-item__image" width="50px">
                        <div class="cart-item__info">
                            <h2 class="cart-item__name">Tên Sản Phẩm</h2>
                            <p class="cart-item__variant">Phân loại hàng: Màu đỏ</p>
                        </div>
                    </div>
                    <div class="cart-item__price">₫100.000</div>
                    <div class="cart-item__quantity">
                        <button class="cart-item__quantity-btn">-</button>
                        <input type="text" value="1" class="cart-item__quantity-input">
                        <button class="cart-item__quantity-btn">+</button>
                    </div>
                    <div class="cart-item__total">₫100.000</div>
                    <div class="cart-item__action">
                        <button class="cart-item__delete-btn">Xóa</button>
                    </div>
                </div>


            </div>

            <div class="shopping-cart__summary">
                <div class="voucher-section">
                    <span class="voucher-icon">🎟️</span>
                    <span class="voucher-title">Shopee Voucher</span>
                    <a href="#" class="voucher-link">Chọn hoặc nhập mã</a>
                </div>
                <div class="shopping-cart__summary-bottom">
                    <div class="shopping-cart__summary-lefts">
                        <input type="checkbox" class="shopping-cart__summary-select-all custom-checkbox">
                        <span class="click-all-lefts">Chọn tất cả</span>
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
<?php

    }
}
?>
<script>
    const cartContainer = document.querySelector('.cart-container');
    const summaryContainer = document.querySelector('.shopping-cart__summary');
    cartContainer.addEventListener('scroll', function() {
        if (cartContainer.scrollTop + cartContainer.clientHeight >= cartContainer.scrollHeight - 100) {
            summaryContainer.classList.add('fixed-summary');
        } else {
            summaryContainer.classList.remove('fixed-summary');
        }
    });
</script>