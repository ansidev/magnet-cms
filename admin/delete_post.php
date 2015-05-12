<?php
include_once('check_role.php');
include_once('../core/database/connect.php');
if (!empty($_SESSION['user']['id'])) {
    if (!empty($_POST['delete'])) {
        if (strcmp($_POST['delete'], 'Có') === 0) {
            $id = $conn->real_escape_string($_POST['id']);
            $sql = "DELETE FROM `posts` WHERE `id` ='" . $id . "'";
            $query = $conn->query($sql);
            $_SESSION['messages'][] = "Xóa bài viết thành công.";
        }
    }
} else {
    $_SESSION['messages'][] = 'Bạn cần đăng nhập để thực hiện hành động  !!!';
}
header('location:post.php');
