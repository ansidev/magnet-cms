<?php
include_once('check_role.php');
include_once('../core/layout/header.php');
?>

<body>
<?php include_once('../core/layout/dashboard_header.php'); ?>
<div class="container" style="padding-top: 70px;">
    <?php if (empty($_GET['action']) && empty($_GET['id'])) { ?>
        <div id="users">
            <?php include_once('../core/layout/messages.php'); ?>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <a href="user.php" class="btn btn-primary">Quản lý tài khoản</a>
                    <a href="post.php" class="btn btn-danger">Quản lý bài viết</a>
                </div>
            </div>
        </div>
        <!-- /#users -->
    <?php } else {
        if (isset($_GET['action']) && isset($_GET['id'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
            include_once('../core/database/connect.php');
            switch ($action) {
                case 'create':
                    break;
                case 'edit':
                    $sql = "SELECT * FROM `users` WHERE `id` = '" . $id . "' LIMIT 1";
                    $query = $conn->query($sql);
                    $total = $query->num_rows;
                    if ($total > 0) {
                        while ($user = $query->fetch_assoc()) { ?>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="users">
                                        <form method="post" accept-charset="utf-8" action="edit_user.php">
                                            <div style="display:none;">
                                                <input class="form-control" type="hidden"
                                                       name="_method" value="POST">
                                            </div>
                                            <fieldset>
                                                <legend>Sửa thông tin người dùng</legend>
                                                <div class="input form-group text required">
                                                    <label for="username">Username</label>
                                                    <input
                                                        class="form-control" type="text" name="username"
                                                        required="required" maxlength="100"
                                                        id="username" value="<?= $user['username'] ?>">
                                                </div>
                                                <div class="input form-group text">
                                                    <label for="fullname">Full Name</label>
                                                    <input
                                                        class="form-control" type="text" name="fullname" maxlength="100"
                                                        id="fullname" value="<?= $user['fullname'] ?>">
                                                </div>
                                                <div class="input form-group password">
                                                    <label for="password">Password</label>
                                                    <input
                                                        class="form-control" type="password" name="password"
                                                        id="password">
                                                </div>
                                                <div class="input form-group address required">
                                                    <label for="address">Address</label>
                                                    <input
                                                        class="form-control" type="text" name="address"
                                                        required="required" maxlength="100"
                                                        id="address" value="<?= $user['address'] ?>">
                                                </div>
                                                <div class="input form-group phone required">
                                                    <label for="phone">Phone</label>
                                                    <input
                                                        class="form-control" type="text" name="phone"
                                                        required="required" maxlength="100"
                                                        id="phone" value="<?= $user['phone'] ?>">
                                                </div>
                                                <div class="input form-group role required">
                                                    <label for="role">Role</label>
                                                    <select class="form-control" name="role">
                                                        <option
                                                            value="Administrator" <?php if (strcmp($user['role'], 'Administrator') === 0) {
                                                            echo 'selected = "true"';
                                                        } ?>>Administrator
                                                        </option>
                                                        <option
                                                            value="User" <?php if (strcmp($user['role'], 'User') === 0) {
                                                            echo 'selected = "true"';
                                                        } ?>>User
                                                        </option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo 'User does not exist';
                        $_SESSION['messages'][] = 'Người dùng không tồn tại !!!';
                        header('location:user.php');
                    }
                    break;
                case 'delete':
                    $sql = "SELECT * FROM `users` WHERE `id` = '" . $id . "' LIMIT 1";
                    $query = $conn->query($sql);
                    $total = $query->num_rows;

                    if ($total > 0) {
                        while ($user = $query->fetch_assoc()) { ?>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="users">
                                        <h1>Xóa người dùng</h1>

                                        <p>Bạn có muốn xóa người dùng
                                            <strong><?= $user['username'] ?></strong>?
                                        </p>

                                        <form action="delete_user.php" method="post">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?= $id ?>"/>
                                                <input type="submit" class="btn btn-primary" name="delete" value="Có"/>
                                                <input type="submit" class="btn btn-danger" name="delete"
                                                       value="Không"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                    break;
            }
        }
    } ?>
    <?php include_once('../core/database/disconnect.php'); ?>
</div>
<!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../resources/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../resources/js/bootstrap.js"></script>
</body>
</html>
