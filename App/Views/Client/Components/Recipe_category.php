<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Recipe_category extends BaseView
{
    public static function render($data = null)
    {

?>
        <section class="CulinaryRoots__Categories">
            <h3 class="CulinaryRoots__CategoriesTitle">Danh Mục Công Thức</h3>

            <div class="CulinaryRoots__CategoriesItems">
                <div class="CulinaryRoots__CategoryCard">
                    <h4 class="CulinaryRoots__CategoryCardName">Tất cả</h4>
                </div>
                <?php

                foreach ($data as $item) :
                ?>
                    <div class="CulinaryRoots__CategoryCard">
                        <h4 class="CulinaryRoots__CategoryCardName"><?= $item["name"] ?></h4>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </section>
<?php
    }
}
