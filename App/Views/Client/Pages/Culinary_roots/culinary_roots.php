<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;

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
                <section class="CulinaryRoots__Categories">
                    <h3 class="CulinaryRoots__CategoriesTitle">Danh Mục Công Thức</h3>
                    <div class="CulinaryRoots__SearchBar">
                        <input type="text" class="CulinaryRoots__SearchBarInput" placeholder="Tìm công thức...">
                        <button class="CulinaryRoots__SearchBarButton">Tìm</button>
                    </div>
                    <div class="CulinaryRoots__CategoriesItems">
                        <div class="CulinaryRoots__CategoryCard">
                            <h4 class="CulinaryRoots__CategoryCardName">Trái Cây Tươi</h4>
                        </div>
                        <div class="CulinaryRoots__CategoryCard">
                            <h4 class="CulinaryRoots__CategoryCardName">Smoothies</h4>
                        </div>
                        <div class="CulinaryRoots__CategoryCard">
                            <h4 class="CulinaryRoots__CategoryCardName">Tráng Miệng</h4>
                        </div>
                        <div class="CulinaryRoots__CategoryCard">
                            <h4 class="CulinaryRoots__CategoryCardName">Bánh Táo Nướng</h4>
                        </div>
                        <div class="CulinaryRoots__CategoryCard">
                            <h4 class="CulinaryRoots__CategoryCardName">Sinh Tố Chuối Xoài</h4>
                        </div>
                        <div class="CulinaryRoots__CategoryCard">
                            <h4 class="CulinaryRoots__CategoryCardName">Kem Trái Cây</h4>
                        </div>
                    </div>
                </section>
                <section class="CulinaryRoots__RecipeList">
                    <h3 class="CulinaryRoots__RecipeListTitle">Công Thức Mới Nhất</h3>
                    <div class="recipe-grid">
                        <div class="recipe-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="recipe-card">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="recipe-image">
                            <div class="recipe-content">
                                <h3 class="recipe-title">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="recipe-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="recipe-link">CHI TIẾT <span>→</span></a>
                            </div>
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