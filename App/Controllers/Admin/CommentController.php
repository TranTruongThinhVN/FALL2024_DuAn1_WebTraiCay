<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Comment;
use App\Validations\AuthValidation;
use App\Validations\CommentValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Comments\Danhsach;
use App\Views\Admin\Pages\Comments\ListItem;
// use App\Views\Admin\Pages\Comments\Danhsach\Index;
use GrahamCampbell\ResultType\Success;

class CommentController
{


    // hiển thị danh sách
    public static function index()
    { 
        $comment = new Comment();
        $data = $comment->getAllCommentJoinProductAndUser();
        Header::render();
        ListItem::render();
        Footer::render();

        // Header::render();
        // Notification::render();
        // NotificationHelper::unset();
        // // hiển thị giao diện danh sách
        // Index::render($data);
        // Footer::render();
    }


    // hiển thị giao diện form thêm
    // public static function create()
    // {
    //     Header::render();
    //     Notification::render();
    //     NotificationHelper::unset();
    //     // hiển thị form thêm
    //     Create::render();
    //     Footer::render();
    // } 
    // public static function store()
    // {
    //     $is_valid = CommentValidation::create();

    //     if(!$is_valid){
    //         NotificationHelper::error('store', 'Thêm bình luận thất bại');
    //         header('Location: /admin/categories/create');
    //         exit;
    //     }

    //     $name = $_POST['name'];
    //     $status = $_POST['status'];
    //     //kiểm tra tên danh mục trùng tên
    //     $Comment = new Comment();
    //     $is_exist = $Comment->getOneCommentByName($name);

    //     if($is_exist){
    //         NotificationHelper::error('store', 'Tên bình luận đã tồn tại');
    //         header('Location: /admin/categories/create');
    //         exit;
    //     }

    //     $data = [
    //         'name' => $name,
    //         'status' => $status
    //     ]; 

    //     $result = $Comment->createComment($data);

    //     if($result){
    //         NotificationHelper::success('store', 'Thêm bình luận thành công');
    //         header('Location: /admin/categories');
    //     } else {
    //         NotificationHelper::error('store', 'Thêm bình luận thất bại');
    //         header('Location: /admin/categories/create');
    //     }
    // }


    // hiển thị chi tiết
    public static function show()
    {
    }


    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        
        $Comment = new Comment();
        $data = $Comment->getOneComment($id);

        if(!$data){
            NotificationHelper::error('edit', 'Không thể xem bình luận này');
            header('Location : /admin/categories');
            exit;
        }

        // Header::render();
        // Notification::render();
        // NotificationHelper::unset();
        // // hiển thị form sửa
        // Edit::render($data);
        // Footer::render(); 
    }


    // xử lý chức năng update
    // public static function update(int $id)
    // {
        
    //     $is_valid = CommentValidation::edit();

    //     if(!$is_valid){
    //         NotificationHelper::error('update', 'Cập nhật bình luận thất bại');
    //         header("Location: /admin/categories/$id");
    //         exit;
    //     }

    //     $name = $_POST['name'];
    //     $status = $_POST['status'];
    //     //kiểm tra tên loại trùng tên
    //     $Comment = new Comment();
    //     $is_exist = $Comment->getOneCommentByName($name);

    //     if($is_exist){
    //         if($is_exist['id'] != $id){
    //             NotificationHelper::error('update', 'Tên bình luận đã tồn tại');
    //             header("Location: /admin/categories/$id");
    //             exit;
    //         }
    //     }

    //     $data = [
    //         'name' => $name,
    //         'status' => $status
    //     ]; 

    //     $result = $Comment->updateComment($id, $data);

    //     if($result){
    //         NotificationHelper::success('update', 'Cập nhật bình luận thành công');
    //         header('Location: /admin/categories');
    //     } else {
    //         NotificationHelper::error('update', 'Cập nhật bình luận thất bại');
    //         header("Location: /admin/categories/$id");
    //     }
    // }


    // thực hiện xoá
    public static function delete(int $id)
    {
        
            $Comment = new Comment();
            $result = $Comment->deleteComment($id);
            
            if($result){
                NotificationHelper::success('delete', 'Xóa bình luận thành công');
            } else {
                NotificationHelper::error('delete', 'Xóa bình luận thất bại');
            }
            header('Location: /admin/categories');

    }
}

