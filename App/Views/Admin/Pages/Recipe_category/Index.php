<?php

namespace App\Views\Admin\Pages\Recipe_category;

use App\Views\BaseView;

class Index extends BaseView
{
  public static function render($data = null)
  {
?>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">QUẢN LÝ LOẠI SẢN PHẨM</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách loại sản phẩm</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Danh mục sản phẩm</h5>
                <!-- Nút Thêm Danh Mục -->
                <a href="/admin/add-recipe_category" class="btn btn-primary">Thêm Danh Mục</a>
              </div>
              <div class="card-filter d-flex" style="gap: 16px; margin-top: -10px; margin-left: 10px; margin-bottom: 10px;">
                <form class="d-flex" method="GET" action="/admin/category">
                  <input class="form-control me-2" type="search" name="search" placeholder="Tìm danh mục..." aria-label="Search" value="<?= $_GET['search'] ?? '' ?>">
                  <button class="btn btn-success" type="submit">Tìm</button>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th style="font-weight: bold;" scope="col">Id</th>
                      <th style="font-weight: bold;" scope="col">Tên danh mục</th>
                      <th style="font-weight: bold;" scope="col">Trạng thái</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="customtable">
                    <?php if (count($data)) : ?>
                      <?php foreach ($data as $item) : ?>
                        <tr>
                          <td><?= $item['id'] ?></td>
                          <td><?= $item['name'] ?></td>
                          <td>
                            <p class="badge <?= $item['status'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                              <?= ($item['status'] == 1) ? 'Hiện' : 'Ẩn' ?>
                            </p>
                          </td>
                          <td>
                            <a href="/admin/recipe_category/<?= $item['id'] ?>">
                              <label class="badge bg-warning">Chỉnh sửa</label>
                            </a>
                            <form action="/admin/recipe_category/<?= $item['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa Danh mục này không?')">
                              <input type="hidden" name="method" value="DELETE">
                              <button style="margin: 0; padding: 3.5px; border: 0;" type="submit" class="badge bg-danger">Xoá</button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" style="text-align: center; padding: 20px; font-weight: bold; color: #888;">
                          Không tìm thấy kết quả phù hợp.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="<?= APP_URL ?>/public/assets/admin/dist/js/Recipe_categoryValidation.js"></script>

<?php
  }
}
