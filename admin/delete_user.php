<?php
session_start();
if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'Administrator') {
} else {
    header('location:../login.php');
}
include_once('../core/database/connect.php');
if (!empty($_SESSION['user']['id']) && strcmp($_SESSION['user']['id'], $_POST['id']) !== 0) {
    if (!empty($_POST['delete'])) {
        if (strcmp($_POST['delete'], 'Có') === 0) {
            $id = $conn->real_escape_string($_POST['id']);
            $sql = "DELETE FROM `users` WHERE id ='" . $id . "'";
            $query = $conn->query($sql);
            $_SESSION['messages'][] = "Xóa người dùng thành công.";
        }
        header('location:user.php');
    }
} else {
    $_SESSION['messages'][] = 'Bạn không thể xóa tài khoản của bạn !!!';
    header('location:user.php');
}