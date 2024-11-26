<?php

namespace App\Views\Admin\Pages\Category;

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
              <div class="card-body">
                <h5 class="card-title mb-0">Danh mục sản phẩm</h5>
                <div class="card-filter d-flex mt-2" style="gap: 16px;">
                  <form class="d-flex" method="GET" action="/admin/category">
                    <input class="form-control me-2" type="search" name="search" placeholder="Tìm kiếm..." aria-label="Search" value="<?= $_GET['search'] ?? '' ?>">
                    <button class="btn btn-success" type="submit">Tìm</button>
                  </form>
                </div>
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
                    <?php
                      foreach ($data as $item) :
                    ?>
                      <tr>
                        <th>
                          <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox">
                            <span class="checkmark"></span>
                          </label>
                        </th>
                        <td></td>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['description'] ?></td>
                        <td>
                          <p class="badge bg-success"><?= ($item['status'] == 1) ? 'Hiện' : 'Ẩn' ?></p>
                        </td>
                        <td>
                          <a href="/admin/category/<?= $item['id'] ?>">
                          
                            <label class="badge bg-success">Chỉnh sửa</label>
                          </a>
                          <form action="/admin/category/<?= $item['id'] ?>" method="post" style="display: inline-block;"onsubmit="return confirm('Chắc chưa?')" >
                            <input type="hidden" name="method" value="DELETE" id="">
                            <button style="margin: 0; padding: 3.5px ; border: 0;" type="submit" class="badge bg-danger">Xoá
                            </button>
                          </form>
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
    
                <script src="<?= APP_URL ?>/public/assets/admin/dist/js/categoryValidation.js"></script>

<?php
  }
}
