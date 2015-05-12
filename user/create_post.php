<?php
include_once('check_role.php');
include_once('../core/database/connect.php');
if (!empty($_SESSION['user']['id']) && strcmp($_SESSION['user']['id'], $_POST['id']) !== 0) {
    if (!empty($_POST['delete'])) {
        if (strcmp($_POST['delete'], 'Có') === 0) {
            $id = $conn->real_escape_string($_POST['id']);
            $sql = "DELETE FROM `users` WHERE `id` ='" . $id . "'";
            $query = $conn->query($sql);
            $_SESSION['messages'][] = "Xóa người dùng thành công.";
        }
        header('location:user.php');
    }
} else {
    $_SESSION['messages'][] = 'Bạn không thể xóa tài khoản của bạn !!!';
    header('location:user.php');
}
?>
<?php
include_once('check_role.php');
include_once('../core/database/connect.php');
if (!empty($_SESSION['user']['id'])) {
    if (!empty($_POST["title"]) && !empty($_POST["content"])) {
        $user_id = $conn->real_escape_string($_SESSION['user']['id']);
        $title = $conn->real_escape_string($_POST["title"]);
        $content = $conn->real_escape_string($_POST["content"]);
        // Câu truy vấn
        $sql = "INSERT INTO `posts` (`title`, `content`, `user_id`) VALUES ('" . $title . "','" . $content . "','" . $user_id . "')";
        $query = $conn->query($sql);
        $_SESSION['messages'][] = "Bài viết đã được đăng !!!";
        header("location:post.php");
    }
}