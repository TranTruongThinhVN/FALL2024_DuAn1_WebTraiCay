<?php

namespace App\Views\Admin\Pages\Comments;

use App\Views\BaseView;

class Details extends BaseView
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
                        <h4 class="page-title">QUẢN LÝ LOẠI SẢN PHẨM</h4>
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
                            <?php if (!empty($data)): ?>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ID bình luận</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Bình luận</th>
                                                <th scope="col">Đánh giá</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Tuỳ chỉnh</th>


                                            </tr>
                                        </thead>
                                        <tbody class="customtable">
                                            <?php $count = 1;
                                            foreach ($data as $row): ?>
                                                <?php if ($row['status'] == 1): ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td><?= $row['id'] ?></td>
                                                        <td><?= $row['product_name'] ?></td>
                                                        <td>
                                                            <div class="comment-container">
                                                                <p class="content mb-1"><?= $row['content'] ?></p> <!-- Không có margin dưới phần nội dung -->
                                                                <p class="created-at text-muted mb-0 " style="font-size: 10px;"><?= $row['created_at'] ?></p> <!-- Không có margin dưới phần ngày tạo -->
                                                            </div>
                                                        </td>
                                                        <td><?php if ( $row['rating'] > 0): ?>
                                                                <div class="rating"> 
                                                                <p><?=$row['rating']?><i class="fa-solid fa-star" style="color: #FFD43B;"></i></p>
                                                                </div>
                                                            <?php else: ?>
                                                                <p>Chưa có đánh giá.</p>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row['images'])): ?>
                                                                <div class="comment-images row">
                                                                    <?php foreach ($row['images'] as $image): ?>
                                                                        <div class="col-4 p-0" style="display: block; width: 50px; height: 50px;  margin: 2px; padding: 0; border: none; max-width: 100%; max-height: 100%;">
                                                                            <img src="<?= $image['image_url'] ?>" alt="Ảnh bình luận" style="display: block; width: 50px; height: 50px; object-fit: cover; margin: 0; padding: 0; border: none; max-width: 100%; max-height: 100%;">
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                                <a href="/comments/edit/<?= $row['id'] ?>" class="badge bg-success">Chỉnh sửa</a>
                                                                <form action="/comments/delete/<?= $row['id'] ?>" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');">
                                                                    <input type="hidden" name="method" value="DELETE">
                                                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>"> <!-- Thêm product_id -->
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>"> <!-- Chắc chắn bạn đã truyền id bình luận -->
                                                                    <button type="submit" class="badge bg-danger" style="border: none">Xóa</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                        </tbody>
                                    <?php
                                                $count++;
                                            endforeach;
                                    ?>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

?>