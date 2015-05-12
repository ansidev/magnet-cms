<?php
include_once('check_role.php');
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
    <link href="../resources/css/sb-admin-2.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>
<?php
include_once('../core/layout/dashboard_header.php');
include_once('../core/database/connect.php');
?>

<div class="container" style="padding-top: 70px;">
    <?php
    $sql = "SELECT * FROM `users`";
    $query = $conn->query($sql);
    $total_users = $query->num_rows;
    $sql = "SELECT * FROM `posts`";
    $query = $conn->query($sql);
    $total_books = $query->num_rows;
    ?>
    <div id="users">
        <?php include_once('../core/layout/messages.php'); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $total_users ?></div>
                                <div>Người dùng</div>
                            </div>
                        </div>
                    </div>
                    <a href="user.php">
                        <div class="panel-footer">
                            <span class="pull-left">Quản lý tài khoản</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tag fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $total_books ?></div>
                                <div>Bài viết</div>
                            </div>
                        </div>
                    </div>
                    <a href="post.php">
                        <div class="panel-footer">
                            <span class="pull-left">Quản lý bài viết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
