<?php
session_start();
if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'Administrator') {
        header('location:../admin/user.php');
        return;
    }
} else {
    header('location:../login.php');
    return;
}