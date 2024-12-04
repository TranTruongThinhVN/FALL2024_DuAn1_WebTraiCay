<?php

namespace App\Views\Client\Pages\Culinary_roots;

use App\Views\BaseView;

class detail_culinary_roots extends BaseView
{
    public static function render($data = null)
    {
        $recipe = $data['recipes']; // Lấy dữ liệu công thức
?>
        <div class="main-container">
            <div class="RecipeDetail">
                <!-- Banner Section -->
                <section class="RecipeDetail__Banner" style="background-image: url('<?= $recipe['image_url'] ?>');">
                    <h1 class="RecipeDetail__Title"><?= htmlspecialchars($recipe['title']) ?></h1>
                    <p class="RecipeDetail__Description"><?= htmlspecialchars($recipe['description']) ?></p>
                </section>

                <!-- Content Section -->
                <div class="RecipeDetail__Content">
                    <!-- Left Column: Ingredients -->
                    <section class="RecipeDetail__Ingredients">
                        <h2 class="RecipeDetail__SectionTitle">Nguyên Liệu</h2>
                        <ul class="RecipeDetail__IngredientsList" style="
                                                                        padding: 10px 20px; 
                                                                        margin: 0; 
                                                                        list-style: none; 
                                                                        border: 1px solid #ddd; 
                                                                        border-radius: 8px; 
                                                                        background-color: #f9f9f9; 
                                                                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                                                                        font-weight: bold;
                                                                    ">
                            <?php foreach (explode("\n", $recipe['ingredients']) as $ingredient): ?>
                                <li style="
                                                                        font-size: 16px; 
                                                                        color: #333; 
                                                                        position: relative;
                                                                    ">
                                    <?= ($ingredient) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </section>

                    <!-- Right Column: Instructions -->
                    <section class="RecipeDetail__Instructions">
                        <h2 class="RecipeDetail__SectionTitle">Hướng Dẫn</h2>
                        <ul class="RecipeDetail__InstructionsList" style="
                                                                        margin: 0; 
                                                                        list-style: none; 
                                                                        border: 1px solid #ddd; 
                                                                        border-radius: 8px; 
                                                                        background-color: #f9f9f9; 
                                                                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                                                                        font-weight: bold;
                                                                        
                                                                    ">
                            <?php foreach (explode("\n", $recipe['instructions']) as $instruction): ?>
                                <li style="
                                                                        font-size: 16px; 
                                                                        color: #333; 
                                                                        padding-left: 20px; 
                                                                        position: relative;
                                                                    ">

                                    <?= ($instruction) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </section>
                </div>

                <!-- Related Recipes Section -->
                <section class="culinary-section">

                    <div class="culinary-header">
                        <h2 class="culinary-title"></h2>
                    </div>
                    <div class="culinary-grid">
                        <!-- Hiển thị các công thức liên quan -->
                        <!-- Có thể thêm logic để lấy và hiển thị công thức liên quan -->
                    </div>
                </section>
            </div>
        </div>
<?php
    }
}
?>