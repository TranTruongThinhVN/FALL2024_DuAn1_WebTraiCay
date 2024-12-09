<?php

namespace App\Views\Admin\Pages\Comments;

use App\Views\BaseView;

class Index extends BaseView
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
                                <div class="card-filter d-flex" style="gap: 16px;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle text-white" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Lọc
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Trạng thái bình luận</a>
                                            <a class="dropdown-item" href="#">Đánh giá</a>
                                            <a class="dropdown-item" href="#">Theo thời gian</a>
                                            <a class="dropdown-item" href="#">Theo danh mục</a>
                                            <a class="dropdown-item" href="#">Theo người dùng</a>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle text-white" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Sắp xếp
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Mới nhất</a>
                                            <a class="dropdown-item" href="#">Cũ nhất </a>
                                            <a class="dropdown-item" href="#">Bình luận có ảnh</a>
                                            <a class="dropdown-item" href="#">Bình luận dài</a>
                                            <a class="dropdown-item" href="#">Bình luận ngắn</a>
                                        </div>
                                    </div>
                                    <form class="d-flex" method="GET" action="">
                                        <input type="text" name="keyword" class="form-control me-2" type="search" placeholder="Tìm mã sản phẩm" aria-label="Search" value="<?= htmlspecialchars($data['keyword']) ?>">
                                        <button class="btn btn-success text-white" type="submit">Search</button>
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
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Đánh giá</th>
                                                <th scope="col">Tuỳ chỉnh</th>
                                            </tr>
                                        </thead>
                                        <tbody class="customtable">
                                            <?php $count = 1;
                                            foreach ($data['allComment'] as $row): ?>
                                                <?php if ($row['status'] == 1): ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td><?= $row['id'] ?></td>
                                                        <td>
                                                            <div class="name-product">
                                                                <p class="my-0 "><?= $row['product_name'] ?></p>
                                                                <span><small style="font-weight: 700 !important;"><?= $row['category_name'] ?></small></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="comment-container">
                                                                <button class="btn-show-modal btn btn-success text-white" data-modal-id="modal-content-<?= $row['id'] ?>" style="cursor: pointer; border: none; outline: none;">Xem chi tiết </button>
                                                                <p class="created-at text-muted mb-0" style="font-size: 10px;">
                                                                    <?= $row['created_at'] ?>
                                                                </p>
                                                            </div>
                                                            <!-- Modal riêng biệt cho mỗi bình luận -->
                                                            <div id="modal-content-<?= $row['id'] ?>" class="modal" style="display: none;">
                                                                <div class="modal-content">
                                                                    <span class="close" style="cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 24px;">&times;</span>
                                                                    <div id="modal-content">
                                                                        <h6 class="text-center">Bình luận</h6>
                                                                        <?php if (!empty($row['user_name'])) : ?>
                                                                            <p>Phản hồi: <b><?= $row['user_name'] ?></b></p>
                                                                        <?php endif ?>
                                                                        <p class="content mb-1"><?= $row['content'] ?></p>
                                                                        <p class="created-at text-muted mb-0" style="font-size: 10px;">
                                                                            <?= $row['created_at'] ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row['images'])) : ?>
                                                                <button class="btn-show-modal btn btn-success text-white" data-modal-id="modal-images-<?= $row['id'] ?>" style="cursor: pointer; border: none; outline: none;">Xem ảnh</button>
                                                                <div id="modal-images-<?= $row['id'] ?>" class="modal" style="display: none;">
                                                                    <div class="modal-content">
                                                                        <span class="close" style="cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 24px;">&times;</span>
                                                                        <div id="modal-content">
                                                                            <h6 class="text-center">Hình ảnh bình luận</h6>
                                                                            <div class="comment-images row">
                                                                                <?php foreach ($row['images'] as $image): ?>
                                                                                    <div class="col-4 p-0" style=" width: 100px; height: 100px; margin: 10px; padding: 0; border: 1px solid #000; max-width: 100%; max-height: 100%;">
                                                                                        <img src="<?= APP_URL ?>/public/uploads/comment-images/<?= $image['image_url'] ?>" alt="Ảnh bình luận" style="display: block; width: 100%; height: 100%; object-fit: cover; margin: 0; padding: 0; border: none;">
                                                                                    </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php elseif (empty($row['images'])): ?>
                                                                <p> Không có ảnh</p>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['rating'] > 0): ?>
                                                                <div class="rating">
                                                                    <p><?= $row['rating'] ?> <i class="fa-solid fa-star" style="color: #FFD43B;"></i></p>
                                                                </div>
                                                            <?php else: ?>
                                                                <p>Chưa có đánh giá.</p>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                                <a href="/comments/edit/<?= $row['id'] ?>" class="btn btn-primary text-white ">Chỉnh sửa</a>
                                                                <form action="/comments/delete/<?= $row['id'] ?>" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');">
                                                                    <input type="hidden" name="method" value="DELETE">
                                                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                                    <button type="submit" class="btn btn-danger text-white" style="border: none">Xóa</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php $count++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <ul class="pagination justify-content-center"> <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                            <li class="page-item <?= ($data['currentPage'] == $i) ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Lắng nghe tất cả nút "Xem thêm"
                const buttons = document.querySelectorAll('.btn-show-modal');
                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Lấy id của modal tương ứng với nút
                        const modalId = button.getAttribute('data-modal-id');
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            modal.style.display = 'block'; // Hiển thị modal
                        }
                    });
                });

                // Lắng nghe sự kiện đóng modal
                const closeBtns = document.querySelectorAll('.close');
                closeBtns.forEach(closeBtn => {
                    closeBtn.addEventListener('click', function() {
                        const modal = closeBtn.closest('.modal');
                        if (modal) {
                            modal.style.display = 'none'; // Đóng modal
                        }
                    });
                });
            });
        </script>
        <style>
            .modal {
                display: block;
                /* Ẩn modal mặc định */
                position: fixed;
                /* Đảm bảo modal ở vị trí cố định */
                top: 50%;
                /* Đưa modal đến giữa theo chiều dọc */
                left: 50%;
                /* Đưa modal đến giữa theo chiều ngang */
                transform: translate(-50%, -50%);
                /* Đẩy modal ra khỏi điểm 50% của chiều rộng và chiều cao để căn chính xác vào giữa */
                width: 560px;
                /* Chiều rộng modal, có thể thay đổi theo nhu cầu */
                height: 340px;
                max-width: 600px;
                /* Chiều rộng tối đa của modal */
                background-color: rgba(0, 0, 0, 0.5);
                /* Lớp nền mờ */
                z-index: 9999;
                /* Đảm bảo modal nằm trên tất cả các phần tử khác */
                align-items: center;
                justify-content: center;
                box-sizing: border-box;
                box-shadow: 0 6px 11px rgba(0, 0, 0, 0.2);
                /* Thêm shadow */

            }

            .modal-content {
                background-color: white;
                padding: 20px;
                height: 100%;
                /* border-radius: 8px; */
                max-height: 80vh;
                overflow-y: auto;
                border: none;
                outline: none;
            }

            .close {
                cursor: pointer;
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 24px;
            }
        </style>
<?php
    }
}
?>