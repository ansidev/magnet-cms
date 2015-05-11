<?php
session_start();
if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'Administrator') {
}
else {
    header('location:../login.php');
}
include_once('../core/database/connect.php');
if (!empty($_POST["username"])
    && !empty($_POST["fullname"])
    && !empty($_POST["address"])
    && !empty($_POST["phone"])
    && !empty($_POST["role"])
) {
    $username = $conn->real_escape_string($_POST["username"]);
    $fullname = $conn->real_escape_string($_POST["fullname"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $role = $conn->real_escape_string($_POST["role"]);
    if (!empty($_POST['password'])) {
        $password = $conn->real_escape_string($_POST["password"]);
    }

    // Câu truy vấn
    $sql = "SELECT * FROM users WHERE `username` = '" . $username . "' LIMIT 1";
//    echo $sql; die;
    $query = $conn->query($sql);
    $total = $query->num_rows;
    if ($total === 1) {
        $sql = "UPDATE `users` SET `username` = '" . $username . "', `fullname` = '" . $fullname . "', `address` = '" . $address . "', `phone` = '" . $phone . "', `role` = '" . $role . "'";
        if (!empty($password)) {
            $sql .= "', `role` = '" . $role . "'";
        }
        $sql .= "WHERE `username` = '" . $username . "'";
//        echo $sql;
//        die;
        $query = mysqli_query($conn, $sql);
        $_SESSION['messages'][] = "Thông tin đã được cập nhật !!!";
    } else {
        $_SESSION['messages'][] = "Lỗi: Người dùng không tồn tại !!!";
    }
    header('location:user.php');
}