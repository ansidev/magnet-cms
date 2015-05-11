<?php
session_start();
if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'Administrator') {
}
else {
    header('location:../login.php');
}
?>
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

    <div id="users">
        <div class="row">
            <div class="col-lg-12">
                <?php
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
                                                   class="btn btn-primary">Edit</a>
                                                <a href="user.php?id=<?= $user['id'] ?>&action=delete"
                                                   class="btn btn-danger">Delete</a>
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
