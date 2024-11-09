<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;

class culinary_roots extends BaseView
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

                <!-- Recipe Categories -->
                <section class="CulinaryRoots__Categories">
                    <h3 class="CulinaryRoots__CategoriesTitle">Danh Mục Công Thức</h3>
                    <div class="CulinaryRoots__SearchBar">
                        <input type="text" class="CulinaryRoots__SearchBarInput" placeholder="Tìm công thức...">
                        <button class="CulinaryRoots__SearchBarButton">Tìm</button>
                    </div>
                    <div class="CulinaryRoots__CategoriesItems">
                        <div class="cta-button">
                            <h4 class="CulinaryRoots__CategoryCardName">Trái Cây Tươi</h4>
                        </div>
                        <div class="cta-button">
                            <h4 class="CulinaryRoots__CategoryCardName">Smoothies</h4>
                        </div>
                        <div class="cta-button">
                            <h4 class="CulinaryRoots__CategoryCardName">Tráng Miệng</h4>
                        </div>
                        <div class="cta-button">
                            <h4 class="CulinaryRoots__CategoryCardName">Bánh Táo Nướng</h4>
                        </div>
                        <div class="cta-button">
                            <h4 class="CulinaryRoots__CategoryCardName">Sinh Tố Chuối Xoài</h4>
                        </div>
                        <div class="cta-button">
                            <h4 class="CulinaryRoots__CategoryCardName">Kem Trái Cây</h4>
                        </div>
                    </div>
                </section>

                <!-- Latest Recipes -->
                <section class="CulinaryRoots__RecipeList">
                    <h3 class="CulinaryRoots__RecipeListTitle">Công Thức Mới Nhất</h3>
                    <div class="CulinaryRoots__RecipeListItems">
                        <div class="CulinaryRoots__RecipeCard" onclick="location.href='/Culinary_roots_detail'">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_salad.jpg" alt="Fruit Dish 1" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Salad Trái Cây Tươi</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Đơn giản, tươi ngon và bổ dưỡng.</p>
                        </div>

                        <div class="CulinaryRoots__RecipeCard">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_smoothiesTraSuaDau.jpg" alt="Fruit Dish 2" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Smoothie Dâu Tươi</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Mát lạnh và thơm ngon.</p>
                        </div>

                        <div class="CulinaryRoots__RecipeCard">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_BanhTaoNuong.jpg" alt="Fruit Dish 3" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Bánh Táo Nướng</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Bánh táo ngọt ngào, thơm lừng.</p>
                        </div>

                        <div class="CulinaryRoots__RecipeCard">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/Congthuc_SinhToChuoiXoai.jpg" alt="Fruit Dish 4" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Sinh Tố Chuối Xoài</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Hương vị nhiệt đới, giàu vitamin.</p>
                        </div>

                        <div class="CulinaryRoots__RecipeCard">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Fruit Dish 5" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Kem Trái Cây</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Giải nhiệt mùa hè với kem trái cây mát lạnh.</p>
                        </div>

                        <div class="CulinaryRoots__RecipeCard">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_TraiCaySay.jpeg" alt="Fruit Dish 6" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Trái Cây Sấy Dẻo</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Một món ăn vặt bổ dưỡng, dễ làm.</p>
                        </div>

                        <div class="CulinaryRoots__RecipeCard">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_MucDau.jpg" alt="Fruit Dish 7" class="CulinaryRoots__RecipeCardImage">
                            <h4 class="CulinaryRoots__RecipeCardTitle">Mứt Dâu</h4>
                            <p class="CulinaryRoots__RecipeCardDescription">Món mứt ngọt ngào, phù hợp làm quà.</p>
                        </div>
                    </div>
                    <!-- Nút xem thêm công thức -->
                    <div class="CulinaryRoots__LoadMoreContainer">
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