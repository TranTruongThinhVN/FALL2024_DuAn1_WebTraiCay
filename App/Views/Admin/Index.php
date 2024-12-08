<?php

namespace App\Views\Admin;

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
                        <h4 class="page-title">Trang Chủ</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Site Analysis</h4>
                                        <h5 class="card-subtitle">Overview of Latest Month</h5>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-4">
                                        <div class="bg-dark p-10 text-white text-center rounded shadow">
                                            <i class="fas fa-cube fa-2x mb-2 text-warning"></i>
                                            <h5 class="mb-0 mt-1"><?= $data['totalProducts'] ?></h5>
                                            <small class="font-light">Tổng số sản phẩm</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-dark p-10 text-white text-center rounded shadow">
                                            <i class="fas fa-dollar-sign fa-2x mb-2 text-success"></i>
                                            <h5 class="mb-0 mt-1"><?= number_format($data['totalRevenue'], 2) ?> VND</h5>
                                            <small class="font-light">Tổng doanh thu</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-dark p-10 text-white text-center rounded shadow">
                                            <i class="fas fa-chart-line fa-2x mb-2 text-info"></i>
                                            <h5 class="mb-0 mt-1"><?= number_format($data['averagePrice'], 2) ?> VND</h5>
                                            <small class="font-light">Giá trung bình</small>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <div class="bg-dark p-10 text-white text-center rounded shadow">
                                                <i class="fas fa-users fa-2x mb-2 text-primary"></i>
                                                <h5 class="mb-0 mt-1"><?= $data['totalUsers'] ?></h5>
                                                <small class="font-light">Tổng số người dùng</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="bg-dark p-10 text-white text-center rounded shadow">
                                                <i class="fas fa-user-shield fa-2x mb-2 text-warning"></i>
                                                <h5 class="mb-0 mt-1"><?= $data['totalAdmins'] ?></h5>
                                                <small class="font-light">Quản trị viên</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="bg-dark p-10 text-white text-center rounded shadow">
                                                <i class="fas fa-user fa-2x mb-2 text-success"></i>
                                                <h5 class="mb-0 mt-1"><?= $data['totalRegularUsers'] ?></h5>
                                                <small class="font-light">Người dùng thường</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <div class="bg-dark p-10 text-white text-center rounded shadow">
                                                <i class="fas fa-comments fa-2x mb-2 text-info"></i>
                                                <h5 class="mb-0 mt-1"><?= $data['totalComments'] ?></h5>
                                                <small class="font-light">Tổng số bình luận</small>
                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <!-- Biểu đồ thống kê sản phẩm theo danh mục -->
                                            <div class="col-lg-6">
                                                <h4 class="card-title text-center mb-4">Biểu đồ thống kê sản phẩm theo danh mục</h4>
                                                <div>
                                                    <canvas id="categoryChart" width="100" height="100"></canvas>
                                                </div>
                                            </div>

                                            <!-- Biểu đồ thống kê sản phẩm được bình luận nhiều nhất -->
                                            <div class="col-lg-6">
                                                <h4 class="card-title text-center mb-4">Thống kê sản phẩm được bình luận nhiều nhất</h4>
                                                <div>
                                                    <canvas id="mostCommentedChart" width="400" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- Sales chart -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Recent comment and chats -->
                        <!-- ============================================================== -->

                        <div class="row">
                            <!-- column -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <?php if (!empty($data['comment_new'])): var_dump($data) ?>
                                        <div class="card-body">
                                            <h4 class="card-title">Bình luận gần đây</h4>
                                        </div>
                                        <div class="comment-widgets scrollable">
                                            <?php
                                            // Nếu là một mảng bình luận 
                                            foreach ($data['comment_new'] as $item['comment_new']): ?>
                                                <div class="d-flex flex-row comment-row mt-0">
                                                    <div class="p-2">
                                                        <img src="<?= APP_URL ?>/public/assets/admin/images/users/1.jpg" alt="user" width="50" class="rounded-circle">
                                                    </div>
                                                    <div class="comment-text w-100">
                                                        <h6 class="font-medium"><?= $item['user_name'] ?? 'Ẩn danh' ?></h6>
                                                        <span class="mb-3 d-block"><?= $item['content'] ?? 'Không có nội dung' ?></span>
                                                        <div class="comment-footer">
                                                            <span class="text-muted float-end"><?= $item['created_at'] ?? 'N/A' ?></span>
                                                            <button type="button" class="btn btn-cyan btn-sm text-white">Phản hồi</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- column -->


                            </div>
                            <!-- ============================================================== -->
                            <!-- Recent comment and chats -->
                            <!-- ============================================================== -->
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Container fluid  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            // Dữ liệu từ PHP
                            const categoryLabels = <?= json_encode(array_column($data['productsByCategory'], 'category_name')) ?>;
                            const categoryData = <?= json_encode(array_column($data['productsByCategory'], 'total_products')) ?>;

                            // Tạo màu sắc cho biểu đồ
                            const colors = [
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 0.8)',
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 0.8)'
                            ];

                            const borderColors = [
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ];

                            // Vẽ biểu đồ tròn
                            const ctx = document.getElementById('categoryChart').getContext('2d');
                            const categoryChart = new Chart(ctx, {
                                type: 'pie', // Đổi loại biểu đồ thành 'pie'
                                data: {
                                    labels: categoryLabels, // Tên các danh mục
                                    datasets: [{
                                        label: 'Số lượng sản phẩm',
                                        data: categoryData, // Dữ liệu số lượng sản phẩm
                                        backgroundColor: colors, // Màu nền
                                        borderColor: borderColors, // Màu viền
                                        borderWidth: 1, // Độ dày viền
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    aspectRatio: 1.5, // Tỷ lệ width / height (giá trị nhỏ hơn sẽ làm biểu đồ nhỏ lại)
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    const label = context.label || '';
                                                    const value = context.raw;
                                                    return `${label}: ${value} sản phẩm`;
                                                }
                                            }
                                        },
                                        legend: {
                                            position: 'bottom',
                                            labels: {
                                                color: '#000',
                                                font: {
                                                    size: 14,
                                                }
                                            }
                                        }
                                    },
                                    animation: {
                                        duration: 1500,
                                        easing: 'easeInOutQuad',
                                    }
                                }

                            });
                        </script>


                        <script>
                            // Dữ liệu từ PHP
                            const mostCommentedLabels = <?= json_encode(array_column($data['mostCommentedProducts'], 'product_name')) ?>;
                            const mostCommentedData = <?= json_encode(array_column($data['mostCommentedProducts'], 'comment_count')) ?>;

                            // Vẽ biểu đồ
                            const mostCommentedCtx = document.getElementById('mostCommentedChart').getContext('2d');
                            const mostCommentedChart = new Chart(mostCommentedCtx, {
                                type: 'bar', // Loại biểu đồ
                                data: {
                                    labels: mostCommentedLabels, // Tên sản phẩm
                                    datasets: [{
                                        label: 'Số lượng bình luận',
                                        data: mostCommentedData, // Số lượng bình luận
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        x: {
                                            ticks: {
                                                maxRotation: 0, // Không xoay nhãn
                                                minRotation: 0,
                                                font: {
                                                    size: 12, // Kích thước font
                                                    family: 'Arial', // Font chữ
                                                    weight: 'bold' // Đậm hơn nếu cần
                                                }
                                            }
                                        },
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    const value = context.raw;
                                                    return `Số lượng: ${value}`;
                                                }
                                            }
                                        }
                                    }
                                }

                            });
                        </script>



                <?php

            }
        }

                ?>