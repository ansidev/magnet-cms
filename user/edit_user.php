<?php
include_once('check_role.php');
include_once('../core/database/connect.php');
if (!empty($_POST['id'])
    && !empty($_POST["fullname"])
    && !empty($_POST["address"])
    && !empty($_POST["phone"])
) {
    $id = $conn->real_escape_string($_POST["id"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $fullname = $conn->real_escape_string($_POST["fullname"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    if (!empty($_POST['password'])) {
        $password = $conn->real_escape_string($_POST["password"]);
    }

    // Câu truy vấn
    $sql = "SELECT * FROM users WHERE `id` = '" . $id . "' LIMIT 1";
//    echo $sql; die;
    $query = $conn->query($sql);
    $total = $query->num_rows;
    if ($total === 1) {
        $sql = "UPDATE `users` SET `fullname` = '" . $fullname . "', `address` = '" . $address . "', `phone` = '" . $phone . "'";
        if (!empty($password)) {
            $sql .= "', `role` = '" . $role . "'";
        }
        $sql .= "WHERE `id` = '" . $id . "'";
//        echo $sql;
//        die;
        $query = $conn->query($sql);
        $_SESSION['messages'][] = "Thông tin đã được cập nhật !!!";
    } else if ($total === 0) {
        $_SESSION['messages'][] = "Lỗi: Người dùng không tồn tại !!!";
    }
    header('location:user.php');
}