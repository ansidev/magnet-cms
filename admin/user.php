<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Magnet: A micro CMS built with PHP</title>

    <!-- Bootstrap -->
    <link href="../resources/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>
<?php include_once('header.php'); ?>

<div class="container" style="padding-top: 70px;">
    <?php if (empty($_GET['action']) && empty($_GET['id'])) { ?>
        <div id="users">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    session_start();
                    if (!empty($_SESSION['messages'])) {
                        foreach ($_SESSION['messages'] as $message) { ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <?php
                                echo $message;
                                array_shift($_SESSION['messages']);
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Quản lý người dùng</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Danh sách người dùng
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="user-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Full name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once('../core/database/connect.php');
                                    $sql = "SELECT * FROM `users`";
                                    $query = $conn->query($sql);
                                    $total = $query->num_rows;
                                    if ($total > 0) {
                                        while ($user = $query->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['username'] ?></td>
                                                <td><?= $user['fullname'] ?></td>
                                                <td><?= $user['address'] ?></td>
                                                <td><?= $user['phone'] ?></td>
                                                <td><?= $user['role'] ?></td>
                                                <td class="actions">
                                                    <a href="user.php?id=<?= $user['id'] ?>&action=edit"
                                                       class="btn btn-primary">Sửa</a>
                                                    <a href="user.php?id=<?= $user['id'] ?>&action=delete"
                                                       class="btn btn-danger">Xóa</a>
                                                </td>
                                            </tr>
                                        <?php }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
                                                <input type="submit" class="btn btn-danger" name="delete" value="Không"/>
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
