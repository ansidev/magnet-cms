<?php
include_once('check_role.php');
include_once('../core/layout/header.php');
?>
<body>
<?php include_once('../core/layout/dashboard_header.php'); ?>
<div class="container" style="padding-top: 70px;">
    <?php if (empty($_GET['action'])) { ?>
        <div id="users">
            <div class="row">
                <div class="col-lg-12">
                    <?php include_once('../core/layout/messages.php'); ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thông tin tài khoản</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered table-hover" id="user-table">
                        <thead>
                        </thead>
                        <tbody>
                        <?php
                        include_once('../core/database/connect.php');
                        $sql = "SELECT * FROM `users` WHERE `id` ='" . $_SESSION['user']['id'] . "'";
                        $query = $conn->query($sql);
                        $total = $query->num_rows;
                        if ($total > 0) {
                            while ($user = $query->fetch_assoc()) { ?>
                                <tr>
                                    <th>Username</th>
                                    <td><?= $user['username'] ?></td>
                                </tr>
                                <tr>
                                    <th>Full name</th>
                                    <td><?= $user['fullname'] ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?= $user['address'] ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?= $user['phone'] ?></td>
                                </tr>
                                <tr>
                                    <th class="actions">Actions</th>
                                    <td class="actions">
                                        <a href="user.php?action=edit"
                                           class="btn btn-primary">Sửa</a>
                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#users -->
    <?php } else {
        $action = $_GET['action'];
        $id = $_SESSION['user']['id'];
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
                                        <input type="hidden" name="id" id="id" value="<?= $id ?>">

                                        <div style="display:none;">
                                            <input class="form-control" type="hidden"
                                                   name="_method" value="POST">
                                        </div>
                                        <fieldset>
                                            <legend>Sửa thông tin người dùng</legend>
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
                                        </fieldset>
                                        <button class="btn btn-primary" type="submit">Cập nhật thông tin</button>
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
