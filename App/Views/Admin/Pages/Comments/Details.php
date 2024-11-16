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
                            <div class="card-body ">
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
                            <!-- car -->
                            <div class="row">
                                <div class="col-6 d-flex align-items-center " style="position:sticky;  height: 100vh;">
                                    <div class="card"><img src="https://originmarket.vn/wp-content/uploads/2022/06/cam-vang-My-768x768.png" width="200px"></div>
                                    <div class="items ps-3">
                                        <p>Name: Cam vàng</p>
                                        <p>Giá</p>
                                        <p>Đánh Giá</p>
                                    </div>
                                </div>
                                <div class="col-6 " style="overflow-y: scroll;height: 100vh;scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE 10+ */">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Latest Posts</h4>
                                        </div>
                                        <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="5bc9c16c-f3ac-5e93-9200-26249bfeaecb" >
                                            <!-- Comment Row -->
                                            <div class="d-flex flex-row comment-row mt-0">
                                                <div class="p-2">
                                                    <img src="../assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle">
                                                </div>
                                                <div class="comment-text w-100">
                                                    <h6 class="font-medium">James Anderson</h6>
                                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                                        type setting industry.
                                                    </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-end">April 14, 2021</span>
                                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm text-white">
                                                            Publish
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment Row -->
                                            <div class="d-flex flex-row comment-row">
                                                <div class="p-2">
                                                    <img src="../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle">
                                                </div>
                                                <div class="comment-text active w-100">
                                                    <h6 class="font-medium">Michael Jorden</h6>
                                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                                        type setting industry.
                                                    </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-end">May 10, 2021</span>
                                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm text-white">
                                                            Publish
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment Row -->
                                            <div class="d-flex flex-row comment-row">
                                                <div class="p-2">
                                                    <img src="../assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle">
                                                </div>
                                                <div class="comment-text w-100">
                                                    <h6 class="font-medium">Johnathan Doeting</h6>
                                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                                        type setting industry.
                                                    </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-end">August 1, 2021</span>
                                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm text-white">
                                                            Publish
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                            </div>
                                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                            </div>
                                            <div class="d-flex flex-row comment-row mt-0">
                                                <div class="p-2">
                                                    <img src="../assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle">
                                                </div>
                                                <div class="comment-text w-100">
                                                    <h6 class="font-medium">James Anderson</h6>
                                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                                        type setting industry.
                                                    </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-end">April 14, 2021</span>
                                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm text-white">
                                                            Publish
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment Row -->
                                            <div class="d-flex flex-row comment-row">
                                                <div class="p-2">
                                                    <img src="../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle">
                                                </div>
                                                <div class="comment-text active w-100">
                                                    <h6 class="font-medium">Michael Jorden</h6>
                                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                                        type setting industry.
                                                    </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-end">May 10, 2021</span>
                                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm text-white">
                                                            Publish
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment Row -->
                                            <div class="d-flex flex-row comment-row">
                                                <div class="p-2">
                                                    <img src="../assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle">
                                                </div>
                                                <div class="comment-text w-100">
                                                    <h6 class="font-medium">Johnathan Doeting</h6>
                                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                                        type setting industry.
                                                    </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-end">August 1, 2021</span>
                                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm text-white">
                                                            Publish
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                            </div>
                                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

?>