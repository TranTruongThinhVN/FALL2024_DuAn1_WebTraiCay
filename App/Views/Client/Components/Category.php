<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
    public static function render($categories = null)
    {
?>
        <aside class="sidebar">
            <!-- Search Bar -->
            <div class="search-bar">
                <form method="GET" action="/products">
                    <input type="text" name="keyword" placeholder="Bạn muốn tìm gì?" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" />
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- Category Section -->
            <div class="category-section">
                <h2>Danh mục sản phẩm</h2>
                <ul>
                    <?php if (!empty($categories) && count($categories) > 0): ?>
                        <?php foreach ($categories as $category): ?>
                            <li class="hover-target">
                                <a href="/products?category=<?= $category['id'] ?>">
                                    <?= htmlspecialchars($category['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Không có danh mục nào.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Price Filter Section -->
            <div class="category-section">
                <h2>Lọc giá</h2>
                <form id="filterForm" method="GET" action="/products">
                    <ul>
                        <li>
                            <input type="radio" id="price1" name="price_range" value="0-50000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '0-50000' ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="price1">Dưới 50.000₫</label>
                        </li>
                        <li>
                            <input type="radio" id="price2" name="price_range" value="50000-100000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '50000-100000' ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="price2">50.000₫ - 100.000₫</label>
                        </li>
                        <li>
                            <input type="radio" id="price3" name="price_range" value="100000-500000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '100000-500000' ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="price3">100.000₫ - 500.000₫</label>
                        </li>
                        <li>
                            <input type="radio" id="price4" name="price_range" value="500000-1000000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '500000-1000000' ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="price4">500.000₫ - 1.000.000₫</label>
                        </li>
                        <li>
                            <input type="radio" id="price5" name="price_range" value="1000000-1000000000" <?= isset($_GET['price_range']) && $_GET['price_range'] == '1000000-1000000000' ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="price5">Trên 1.000.000₫</label>
                        </li>
                    </ul>
                </form>
            </div>

            <!-- Origin Filter Section -->
            <div class="category-section">
                <h2>Xuất xứ</h2>
                <form id="filterForm" method="GET" action="/products">
                    <ul>
                        <li>
                            <input type="checkbox" id="origin_us" name="origin[]" value="Mỹ" <?= isset($_GET['origin']) && in_array('Mỹ', $_GET['origin']) ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="origin_us">Mỹ</label>
                        </li>
                        <li>
                            <input type="checkbox" id="origin_fr" name="origin[]" value="Pháp" <?= isset($_GET['origin']) && in_array('Pháp', $_GET['origin']) ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="origin_fr">Pháp</label>
                        </li>
                        <li>
                            <input type="checkbox" id="origin_vn" name="origin[]" value="Việt Nam" <?= isset($_GET['origin']) && in_array('Việt Nam', $_GET['origin']) ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="origin_vn">Việt Nam</label>
                        </li>
                        <li>
                            <input type="checkbox" id="origin_au" name="origin[]" value="Úc" <?= isset($_GET['origin']) && in_array('Úc', $_GET['origin']) ? 'checked' : '' ?> onchange="autoSubmit()" />
                            <label for="origin_au">Úc</label>
                        </li>
                    </ul>
                </form>
            </div>
        </aside>

        <script>
            function autoSubmit() {
                document.getElementById('filterForm').submit();
            }
        </script>


<?php
    }
}
