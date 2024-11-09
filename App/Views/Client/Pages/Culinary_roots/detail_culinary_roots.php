<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;

class detail_culinary_roots extends BaseView
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
                <section class="RelatedRecipes">
                    <div class="RelatedRecipes__Header">
                        <h2 class="RelatedRecipes__Title">Công Thức Liên Quan</h2>
                        <a href="<?= APP_URL ?>/related-recipes" class="RelatedRecipes__Link">Xem Thêm Công Thức</a>
                    </div>
                    <div class="RelatedRecipes__List">
                        <div class="RelatedRecipes__Item">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_smoothiesTraSuaDau.jpg" alt="Related Recipe 1" class="RelatedRecipes__Image">
                            <h4 class="RelatedRecipes__Name">Smoothie Dâu Tươi</h4>
                            <p class="RelatedRecipes__Description">Thơm ngon và bổ dưỡng.</p>
                        </div>
                        <div class="RelatedRecipes__Item">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_BanhTaoNuong.jpg" alt="Related Recipe 2" class="RelatedRecipes__Image">
                            <h4 class="RelatedRecipes__Name">Bánh Táo Nướng</h4>
                            <p class="RelatedRecipes__Description">Giòn tan và ngọt ngào.</p>
                        </div>
                        <div class="RelatedRecipes__Item">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/CongThuc_salad.jpg" alt="Related Recipe 3" class="RelatedRecipes__Image">
                            <h4 class="RelatedRecipes__Name">Salad Hoa Quả</h4>
                            <p class="RelatedRecipes__Description">Tươi mát và đầy màu sắc.</p>
                        </div>
                        <div class="RelatedRecipes__Item">
                            <img src="<?= APP_URL ?>/public/assets/client/images/Culinary_roots/Congthuc_SinhToChuoiXoai.jpg" alt="Related Recipe 4" class="RelatedRecipes__Image">
                            <h4 class="RelatedRecipes__Name">Sinh Tố Xoài</h4>
                            <p class="RelatedRecipes__Description">Tươi mát và thơm lừng.</p>
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