<?php

namespace App\Views\Admin\Pages\Recipe;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {
?>
        <style>
            .error-border {
                border: 2px solid red;
                border-radius: 4px;
            }

            .text-danger {
                color: red;
                font-weight: bold;
            }
        </style>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Thêm Công Thức</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Recipes
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" action="/admin/add_recipe" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm Công Thức</h4>
                                    <input type="hidden" name="method" value="POST">

                                    <!-- Tiêu đề -->
                                    <div class="form-group">
                                        <label for="title">Tiêu đề</label>
                                        <input
                                            id="title"
                                            name="title"
                                            type="text"
                                            class="form-control <?= isset($_SESSION['errors']['title']) ? 'error-border' : '' ?>"
                                            placeholder="Tiêu đề công thức..."
                                            value="<?= htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES) ?>">
                                        <?php if (isset($_SESSION['errors']['title'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['title'] ?></small>
                                        <?php endif; ?>
                                    </div>



                                    <!-- Mô tả -->
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control" rows="4"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES) : '' ?></textarea>
                                        <?php if (isset($_SESSION['errors']['description'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['description'] ?></small>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Hình ảnh -->
                                    <div class="form-group">
                                        <label for="image_url">Hình ảnh</label>
                                        <input
                                            id="image_url"
                                            name="image_url"
                                            type="file"
                                            class="form-control <?= isset($_SESSION['errors']['image_url']) ? 'error-border' : '' ?>"
                                            accept="image/*">
                                        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['errors']['image_url'])): ?>
                                            <div class="text-danger mt-1"><?= $_SESSION['errors']['image_url'] ?></div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="form-group">
                                        <label for="category_id">Danh mục</label>
                                        <select class="form-control <?= isset($_SESSION['errors']['category_id']) ? 'error-border' : '' ?>" id="category_id" name="category_id">
                                            <option value="" selected disabled>Chọn danh mục...</option>
                                            <?php foreach ($data['categories'] as $category): ?>
                                                <option value="<?= $category['id'] ?>" <?= isset($_POST['category_id']) && $_POST['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category['name'], ENT_QUOTES) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset($_SESSION['errors']['category_id'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['category_id'] ?></small>
                                        <?php endif; ?>
                                    </div>


                                    <!-- Nguyên liệu -->
                                    <div class="form-group">
                                        <label for="ingredients">Nguyên liệu</label>
                                        <textarea
                                            id="ingredients"
                                            name="ingredients"
                                            class="form-control <?= isset($_SESSION['errors']['ingredients']) ? 'error-border' : '' ?>"
                                            rows="4"><?= htmlspecialchars($_POST['ingredients'] ?? '', ENT_QUOTES) ?></textarea>
                                        <div id="ingredients-error">
                                            <?php if (isset($_SESSION['errors']['ingredients'])): ?>
                                                <small class="text-danger"><?= $_SESSION['errors']['ingredients'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Hướng dẫn -->
                                    <div class="form-group">
                                        <label for="instructions">Hướng dẫn</label>
                                        <textarea
                                            id="instructions"
                                            name="instructions"
                                            class="form-control <?= isset($_SESSION['errors']['instructions']) ? 'error-border' : '' ?>"
                                            rows="4"><?= htmlspecialchars($_POST['instructions'] ?? '', ENT_QUOTES) ?></textarea>
                                        <div id="instructions-error">
                                            <?php if (isset($_SESSION['errors']['instructions'])): ?>
                                                <small class="text-danger"><?= $_SESSION['errors']['instructions'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- Buttons -->
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" id="success-btn" class="btn btn-success">Thêm</button>
                                            <button type="reset" class="btn btn-danger">Làm lại</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Xóa lỗi nếu không phải là request POST
                                if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                                    unset($_SESSION['errors']);
                                }
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= APP_URL ?>/public/assets/admin/js/RecipeValidation.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Thêm CKEditor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>




        <!-- Thêm CKEditor -->


<?php
    }
}
?>