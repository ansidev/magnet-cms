<?php
include_once('check_role.php');
include_once('../core/database/connect.php');
if (!empty($_POST['id'])
    && !empty($_POST["title"])
    && !empty($_POST["content"])
) {
    $id = $conn->real_escape_string($_POST["id"]);
    $title = $conn->real_escape_string($_POST["title"]);
    $content = $conn->real_escape_string($_POST["content"]);
    // Câu truy vấn
    $sql = "SELECT * FROM `posts` WHERE `id` = '" . $id . "' LIMIT 1";
//    echo $sql; die;
    $query = $conn->query($sql);
    $total = $query->num_rows;
    if ($total === 1) {
        $sql = "UPDATE `posts` SET `title` = '" . $title . "', `content` = '" . $content . "' WHERE `id` = '" . $id . "'";
//        echo $sql; die;
        $query = $conn->query($sql);
        $_SESSION['messages'][] = "Bài viết đã được cập nhật !!!";
    } else {
        $_SESSION['messages'][] = "Lỗi: Bài viết không tồn tại !!!";
    }
    header('location:post.php');
}