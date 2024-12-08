<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Recipe_category extends BaseView
{
    public static function render($data = null)
    {

?>
<style>
    .CulinaryRoots__CategoryCardName {
        color: rgb(20, 83, 45); 
    }

    .CulinaryRoots__CategoryCardName:hover {
        color: aliceblue; 
    }
</style>
        <section class="CulinaryRoots__Categories">
            <h3 class="CulinaryRoots__CategoriesTitle">Danh Mục Công Thức</h3>
            <div class="CulinaryRoots__SearchBar">
                <input type="text" class="CulinaryRoots__SearchBarInput" placeholder="Tìm công thức...">
                <button class="CulinaryRoots__SearchBarButton">Tìm</button>
            </div>
            <div class="CulinaryRoots__CategoriesItems">
            <div class="CulinaryRoots__CategoryCard">
            <a class="CulinaryRoots__CategoryCardName" href="/culinary_roots">Tất cả</a>
                    </div>
                <?php
                
                foreach ($data as $item) :
                ?>
                    <div class="CulinaryRoots__CategoryCard">
                    <a class="CulinaryRoots__CategoryCardName" href="/culinary_roots/category/<?= $item['id'] ?>"><?= $item['name'] ?></a>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </section>
<?php
    }
}
