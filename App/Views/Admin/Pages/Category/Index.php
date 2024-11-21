<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class Index extends BaseView
{
  public static function render($data = null)
  {
    // var_dump($data);
?>

    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
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
                <div class="card-filter d-flex" style="gap: 16px;">
                  <div class="btn-group ">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="g0r54q">
                      Lọc
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Trạng thái hiện</a>
                      <a class="dropdown-item" href="#">Trạng thái ẩn</a>
                    </div>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="g0r54q">
                      Sắp xếp
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Có nhiều sản phẩm</a>
                      <a class="dropdown-item" href="#">Có ít sản phẩm</a>
                      <a class="dropdown-item" href="#">Ngày tạo</a>
                    </div>
                  </div>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                  </form>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <?php
                    if (count($data)) :
                    ?>
                      <tr>
                        <th>
                          <label class="customcheckbox mb-3">
                            <input type="checkbox" id="mainCheckbox">
                            <span class="checkmark"></span>
                          </label>
                        </th>
                        <th>#</th>
                        <th scope="col">Id</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Trạng thái</th>
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
                        <td>
                          <?php
                          $description = $item['description'];
                          $maxLength = 100; // Số ký tự tối đa của mô tả ngắn
                          if (strlen($description) > $maxLength) {
                            $shortDesc = substr($description, 0, $maxLength) . '...';
                            $cleanDescription = strip_tags($description); // Loại bỏ các thẻ HTML
                            $cleanDescription = str_replace(["\r\n", "\r", "\n"], "\\n", $cleanDescription); // Chuyển xuống dòng thành \n
                          ?>
                            <span class="short-desc"><?= $shortDesc ?></span>
                            <a href="javascript:void(0);"
                              onclick="alert('<?= addslashes($cleanDescription) ?>')"
                              class="btn btn-link">Xem thêm</a>
                          <?php
                          } else {
                            echo nl2br($description); 
                          ?>
                        </td>

                        <td>
                          <p class="badge bg-success"><?= ($item['status'] == 1) ? 'Hiện' : 'Ẩn' ?></p>
                        </td>
                        <td>
                          <a href="/admin/category/<?= $item['id'] ?>">

                            <label class="badge bg-success">Chỉnh sửa</label>
                          </a>
                          <form action="/admin/category/<?= $item['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Chắc chưa?')">
                            <input type="hidden" name="method" value="DELETE" id="">
                            <button style="margin: 0; padding: 3.5px ; border: 0;" type="submit" class="badge bg-danger">Xoá
                            </button>
                          </form>
                        </td>
                      </tr>
                  </tbody>
                <?php
                      endforeach;
                ?>
                </table>
                </table>
              <?php
                    else :
              ?>
                <h4>KHông có dữ liệu</h4>

              <?php
                    endif;
              ?>
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
