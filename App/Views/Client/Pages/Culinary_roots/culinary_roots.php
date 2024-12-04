<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;
use App\Views\Client\Components\Recipe_category;

class Culinary_roots extends BaseView
{
    public static function render($data = null)
    {
?>
        <!-- Banner -->
        <section class="CulinaryRoots__Banner" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/Culinary_roots/banner.jpg');">
            <div class="CulinaryRoots__BannerContent">
                <h2 class="CulinaryRoots__BannerTitle">Chào Mừng Đến Với Thế Giới Trái Cây</h2>
                <p class="CulinaryRoots__BannerDescription">Khám phá những công thức sáng tạo và đầy màu sắc để bữa ăn của bạn trở nên thú vị hơn!</p>
                <button class="cta-button">Tìm Hiểu Ngay</button>
            </div>
        </section>

        <div class="main-container">
            <main class="CulinaryRoots__MainContent">
                <?php
                Recipe_category::render($data['recipe_category']);
                ?>

                <section class="CulinaryRoots__RecipeList">
                    <h3 class="CulinaryRoots__RecipeListTitle">Công Thức Mới Nhất</h3>
                    <div class="recipe-grid">
                        <?php
                        if (count($data) && count($data['recipes'])) :
                        ?>
                            <?php foreach ($data['recipes'] as $item) :
                            ?>
                                <div class="recipe-card" onclick="location.href='/culinary_roots_detail/<?= $item['id'] ?>'">
                                    <img src="<?= ($item['image_url']); ?>" alt="Mô tả hình ảnh" class="recipe-image">
                                    <div class="recipe-content">
                                        <h3 class="recipe-title"><?= $item["title"] ?></h3>
                                        <p class="recipe-description"><?= $item["description"] ?></p>
                                        <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>

                            <tr>
                                <td colspan="10" style="text-align: center; padding: 20px; font-weight: bold; color: #888;">
                                    Không tìm thấy kết quả phù hợp.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </div>

                    <!-- Nút xem thêm công thức -->
                    <div class="CulinaryRoots__LoadMoreContainer" style="text-align: center;">
                        <button class="cta-button CulinaryRoots__LoadMoreButton" onclick="loadMoreRecipes()">Xem Thêm Công Thức</button>
                    </div>
                </section>
            </main>
        </div>
        <script src="<?= APP_URL ?>/public/assets/client/js/culinary_roots.js"></script>

<?php
    }
}
?>