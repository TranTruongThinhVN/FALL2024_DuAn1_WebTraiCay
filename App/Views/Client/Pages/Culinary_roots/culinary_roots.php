<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;
use App\Views\Client\Components\Recipe_category;

class Culinary_roots extends BaseView
{
    public static function render($data = null)
    {
?>
        <style>
            .pagination {
                display: flex;
                justify-content: center;
                margin-top: 20px;
                gap: 10px;
            }

            .pagination a {
                text-decoration: none;
                padding: 5px 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
                color: #333;
            }

            .pagination a.active {
                background-color: #14532D;
                color: #fff;
                border-color: #14532D;
            }
        </style>
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
                                        <p style="
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    font-size: 16px;
    line-height: 1.5;
" class="recipe-description"><?= $item["description"] ?></p>
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

                </section>
            </main>
            <style>
                p {
                    font-size: 1.2rem;
                    color: #666;
                    line-height: 1.5;
                    display: -webkit-box !important;
                    -webkit-line-clamp: 2 !important;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
            </style>
            <?php if (isset($data['pagination'])): ?>
                <div class="pagination">
                    <?php
                    $totalPages = ceil($data['pagination']['total'] / $data['pagination']['perPage']);
                    $currentPage = $data['pagination']['currentPage'];

                    for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        </div>
        <script src="<?= APP_URL ?>/public/assets/client/js/culinary_roots.js"></script>

<?php
    }
}
?>