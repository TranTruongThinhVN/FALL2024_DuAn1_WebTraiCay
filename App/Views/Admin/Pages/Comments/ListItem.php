<?php

namespace App\Views\Admin\Pages\Comments;

use App\Views\BaseView;

class ListItem  extends BaseView
{
  public static function render($data = null)
  {

?>
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">QUẢN LÝ BÌNH LUẬN</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
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
                <!-- <h5 class="card-title mb-0">Static Table With Checkboxes</h5> -->
                
            </div>
                <div class="card-filter d-flex" style="gap: 16px;">
                  <div class="btn-group ">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="g0r54q">
                      Lọc
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Màu sắc</a>
                      <a class="dropdown-item" href="#">Kích thước lớn</a>
                      <a class="dropdown-item" href="#">Kích thước nhỏ</a>
                      <a class="dropdown-item" href="#">Trạng thái còn hàng</a>  
                      <a class="dropdown-item" href="#">Trạng thái hết hàng</a> 
                    </div>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="g0r54q">
                      Sắp xếp
                    </button>
                    <div class="dropdown-menu"> 
                      <a class="dropdown-item" href="#">Số lượng</a>
                      <a class="dropdown-item" href="#">Giá từ cao đến thấp</a>
                      <a class="dropdown-item" href="#">Giá dịch từ thấp đến cao</a>
                      <a class="dropdown-item" href="#">Ngày tạo</a> 
                    </div>
                  </div>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm mã sản phẩm" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                  </form>
                </div>
              </div> 
              <?php 
              
if (!empty($data) && is_array($data)): 
  ?>

              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr> 
                      <th>#</th>
                      <th scope="col">ID bình luận</th>
                      <th scope="col">Ten</th>
                      <th scope="col">san pham</th>
                      <th scope="col">noi dung</th>
                      <th scope="col">thoi gian</th>
                      <th scope="col">trang thai</th>

                    </tr>
                  </thead>
                  <tbody class="customtable">
                    <?php 
                    $counter = 1;
                    foreach ($data as $item):
                    ?>
                    <tr> 
                      <td><?= $counter ?></td>
                      <td><?= $item['id']?></td>
                      <td><?= $item['first_name'].' '. $item['last_name']?></td>
                      <td><?= $item['product_name']?></td>
                      <td><?= $item['content']?></td>
                      <td><?= $item['created_at']?></td>
                      <td><?= ($item['status'] == 1) ? "Hien thi" : "An" ?></td> 
                      <td>
                        <div>
                        <a href="/admin/comments/<?=$item['id'] ?>" class="badge bg-warning" href="">Chỉnh sửa</a>
                        <form action="/admin/comments/<?=$item['id']?>" method="post">
                            <input type="hidden" name="method" value="DELETE" id="">
                            <button type="submit" class="badge bg-danger" href="">Xoá</button>
                        </form>
                        
                        </div>
                      </td>
                    </tr>  
                    <?php $counter++;
                  endforeach; ?>
                  </tbody>
                </table>
              </div>
              <?php endif; ?>
            </div>
            
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
      </div>
    </div>
<?php

  }
}

?>