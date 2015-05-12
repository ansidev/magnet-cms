<?php
session_start();
if (isset($_SESSION['user'])) {
    header('location:index.php');
}
include_once('core/layout/form_header.php');
?>
<div class="container" style="padding-top: 70px">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="users">
                <form method="post" accept-charset="utf-8" action="register.php">
                    <div style="display:none;"><input class="form-control" type="hidden" name="_method" value="POST">
                    </div>
                    <fieldset>
                        <legend>Đăng ký tài khoản</legend>
                        <?php
                        include_once('core/database/connect.php');
                        if (!empty($_POST["username"])
                            && !empty($_POST["fullname"])
                            && !empty($_POST["password"])
                            && !empty($_POST["address"])
                            && !empty($_POST["phone"])
                        ) {
                            $username = $conn->real_escape_string($_POST["username"]);
                            $password = $conn->real_escape_string($_POST["password"]);
                            $fullname = $conn->real_escape_string($_POST["fullname"]);
                            $address = $conn->real_escape_string($_POST["address"]);
                            $phone = $conn->real_escape_string($_POST["phone"]);
                            $role = 'User';

                            // Câu truy vấn
                            $sql = "SELECT * FROM users WHERE `username` = '" . $username . "'";
                            $query = $conn->query($sql);
                            $total = $query->num_rows;
                            if ($total === 0) {
                                $sql = "INSERT INTO `users` (`username`, `password`, `fullname`, `address`, `phone`, `role`) VALUES ('" . $username . "','" . $password . "','" . $fullname . "','" . $address . "','" . $phone . "','" . $role . "')";
                                $query = $conn->query($sql);
                                $_SESSION['user'] = $_POST;
                                $_SESSION['user']['role'] = 'User';
                                header("location:index.php");
                            } else {
                                echo "<p>Username đã tồn tại !!!</p>";
                            }
                        }
                        ?>

                        <div class="input form-group text required">
                            <label for="username">Username</label>
                            <input
                                class="form-control" type="text" name="username" required="required" maxlength="100"
                                id="username">
                        </div>
                        <div class="input form-group text">
                            <label for="fullname">Full Name</label>
                            <input
                                class="form-control" type="text" name="fullname" maxlength="100" id="fullname">
                        </div>
                        <div class="input form-group password required">
                            <label for="password">Password</label>
                            <input
                                class="form-control" type="password" name="password" required="required" id="password">
                        </div>
                        <div class="input form-group address required">
                            <label for="address">Address</label>
                            <input
                                class="form-control" type="text" name="address" required="required" maxlength="100"
                                id="address">
                        </div>
                        <div class="input form-group phone required">
                            <label for="phone">Phone</label>
                            <input
                                class="form-control" type="text" name="phone" required="required" maxlength="100"
                                id="phone">
                        </div>
                    </fieldset>
                    <button class="btn btn-primary" type="submit">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</div>
