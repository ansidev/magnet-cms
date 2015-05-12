<?php
session_start();
if (!empty($_SESSION['user'])) {

    if ($_SESSION['user']['role'] === 'Administrator') {
    } else {
        header('location:../user/user.php');
        return;
    }
} else {
    header('location:../login.php');
    return;
}