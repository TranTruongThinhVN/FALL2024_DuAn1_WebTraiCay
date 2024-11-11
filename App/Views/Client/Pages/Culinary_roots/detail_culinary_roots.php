<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;

class Detail_culinary_roots extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="main-container">
            <div class="RecipeDetail">
                <!-- Banner Section -->
                <section class="RecipeDetail__Banner" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_salad.jpg');">
                    <h1 class="RecipeDetail__Title">Salad Trái Cây Tươi</h1>
                    <p class="RecipeDetail__Description">Một món salad tươi mát và bổ dưỡng, hoàn hảo cho mùa hè.</p>
                </section>

                <!-- Content Section -->
                <div class="RecipeDetail__Content">
                    <!-- Left Column: Ingredients -->
                    <section class="RecipeDetail__Ingredients">
                        <h2 class="RecipeDetail__SectionTitle">Nguyên Liệu</h2>
                        <ul class="RecipeDetail__IngredientsList">
                            <li class="RecipeDetail__Item">1 quả xoài, cắt lát</li>
                            <li class="RecipeDetail__Item">1 quả dứa, cắt nhỏ</li>
                            <li class="RecipeDetail__Item">1 chén dâu tây, cắt đôi</li>
                            <li class="RecipeDetail__Item">1 chén nho, tách hạt</li>
                            <li class="RecipeDetail__Item">2 quả kiwi, cắt lát</li>
                            <li class="RecipeDetail__Item">1 muỗng canh mật ong</li>
                            <li class="RecipeDetail__Item">1 muỗng canh nước cốt chanh</li>
                        </ul>
                    </section>

                    <!-- Right Column: Instructions -->
                    <section class="RecipeDetail__Instructions">
                        <h2 class="RecipeDetail__SectionTitle">Hướng Dẫn</h2>
                        <ol class="RecipeDetail__InstructionsList">
                            <li class="RecipeDetail__Item">Cho tất cả trái cây vào một tô lớn.</li>
                            <li class="RecipeDetail__Item">Trong một bát nhỏ, pha trộn mật ong và nước cốt chanh.</li>
                            <li class="RecipeDetail__Item">Rưới hỗn hợp mật ong lên trái cây và trộn đều.</li>
                            <li class="RecipeDetail__Item">Bày ra đĩa và thưởng thức ngay.</li>
                        </ol>
                    </section>
                </div>
                <section class="culinary-section">
                    <div class="culinary-header">
                        <h2 class="culinary-title">Công Thức Liên Quan</h2>
                        <a href="<?= APP_URL ?>/related-recipes" class="culinary-link">Xem Thêm Công Thức</a>
                    </div>
                    <div class="culinary-grid">
                        <div class="culinary-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="culinary-image">
                            <div class="culinary-content">
                                <h3 class="culinary-heading">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="culinary-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="culinary-detail-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="culinary-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="culinary-image">
                            <div class="culinary-content">
                                <h3 class="culinary-heading">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="culinary-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="culinary-detail-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="culinary-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="culinary-image">
                            <div class="culinary-content">
                                <h3 class="culinary-heading">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="culinary-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="culinary-detail-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="culinary-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="culinary-image">
                            <div class="culinary-content">
                                <h3 class="culinary-heading">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="culinary-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="culinary-detail-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="culinary-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="culinary-image">
                            <div class="culinary-content">
                                <h3 class="culinary-heading">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="culinary-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="culinary-detail-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>
                        <div class="culinary-card" onclick="location.href='/culinary_roots_detail'">
                            <img src="public/assets/client/images/Culinary_roots/CongThuc_KemTraiCay.jpg" alt="Mô tả hình ảnh" class="culinary-image">
                            <div class="culinary-content">
                                <h3 class="culinary-heading">BẮT GẶP SÀI GÒN XƯA TRONG MÓN UỐNG HIỆN ĐẠI</h3>
                                <p class="culinary-description">Dấu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm...</p>
                                <a href="#" class="culinary-detail-link">CHI TIẾT <span>→</span></a>
                            </div>
                        </div>

                    </div>
                </section>



                <section class="RecipeComments">
                    <h2 class="RecipeComments__Title">Bình Luận</h2>
                    <div class="RecipeComments__List">
                        <div class="RecipeComments__Comment">
                            <p class="RecipeComments__Text">"Rất ngon và tươi mát! Tôi đã thử và cả nhà đều thích."</p>
                            <span class="RecipeComments__Author">- Người dùng A</span>
                        </div>
                        <div class="RecipeComments__Comment">
                            <p class="RecipeComments__Text">"Dễ làm và nguyên liệu dễ tìm. Tuyệt vời cho ngày hè!"</p>
                            <span class="RecipeComments__Author">- Người dùng B</span>
                        </div>
                    </div>

                    <!-- Comment Form -->
                    <form class="RecipeComments__Form">
                        <textarea class="RecipeComments__Input" placeholder="Viết bình luận của bạn..." required></textarea>
                        <button type="submit" class="RecipeComments__Button">Gửi Bình Luận</button>
                    </form>
                </section>

            </div>
        </div>






<?php
    }
}

?>