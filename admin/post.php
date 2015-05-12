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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>
<?php include_once('../core/layout/dashboard_header.php'); ?>
<div class="container" style="padding-top: 70px;">
    <?php if (empty($_GET['action']) && empty($_GET['id'])) { ?>
        <div id="users">
            <?php include_once('../core/layout/messages.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1>Quản lý bài viết</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div style="padding-bottom: 15px;">
                        <a href="post.php?action=create" class="btn btn-success">Tạo bài viết mới</a>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Danh sách bài viết
                        </div>
                        <!-- /.panel-heading -->
                        <table class="panel-body table table-striped table-bordered table-hover" id="user-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Tác giả</th>
                                <th class="actions">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include_once('../core/database/connect.php');
                            $sql = "SELECT * FROM `posts`";
                            $query = $conn->query($sql);
                            $total = $query->num_rows;
                            if ($total > 0) {
                                while ($post = $query->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $post['id'] ?></td>
                                        <td><?= $post['title'] ?></td>
                                        <td><?= $post['content'] ?></td>
                                        <td><?= $post['user_id'] ?></td>
                                        <td class="actions">
                                            <a href="post.php?id=<?= $post['id'] ?>&action=edit"
                                               class="btn btn-primary">Sửa</a>
                                            <a href="post.php?id=<?= $post['id'] ?>&action=delete"
                                               class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                <?php }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#users -->
    <?php } else {
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
            }
            include_once('../core/database/connect.php');
            switch ($action) {
                case 'create':
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="users">
                                <form method="post" accept-charset="utf-8" action="create_post.php">
                                    <input type="hidden" name="id" id="id" value="<?= $id ?>">

                                    <div style="display:none;">
                                        <input class="form-control" type="hidden"
                                               name="_method" value="POST">
                                    </div>
                                    <fieldset>
                                        <legend>Tạo bài viết mới</legend>
                                        <div class="input form-group text">
                                            <label for="title">Title</label>
                                            <input
                                                class="form-control" type="text" name="title" maxlength="100"
                                                id="title">
                                        </div>
                                        <div class="input form-group text">
                                            <label for="content">Content</label>
                                            <textarea
                                                class="form-control" type="text" name="content" maxlength="255"
                                                rows="10"
                                                id="content"></textarea>
                                        </div>
                                    </fieldset>
                                    <button class="btn btn-primary" type="submit">Đăng bài</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
                case 'edit':
                    $sql = "SELECT * FROM `posts` WHERE `id` = '" . $id . "' LIMIT 1";
                    $query = $conn->query($sql);
                    $total = $query->num_rows;
                    if ($total > 0) {
                        while ($post = $query->fetch_assoc()) { ?>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="users">
                                        <form method="post" accept-charset="utf-8" action="edit_post.php">
                                            <input type="hidden" name="id" id="id" value="<?= $id ?>">

                                            <div style="display:none;">
                                                <input class="form-control" type="hidden"
                                                       name="_method" value="POST">
                                            </div>
                                            <fieldset>
                                                <legend>Sửa bài viết</legend>
                                                <div class="input form-group text">
                                                    <label for="title">Title</label>
                                                    <input
                                                        class="form-control" type="text" name="title" maxlength="100"
                                                        id="title" value="<?= $post['title'] ?>">
                                                </div>
                                                <div class="input form-group text">
                                                    <label for="content">Content</label>
                                            <textarea
                                                class="form-control" type="text" name="content" maxlength="255"
                                                rows="10"
                                                id="content"><?= $post['content'] ?></textarea>
                                                </div>
                                            </fieldset>
                                            <button class="btn btn-primary" type="submit">Cập nhật bài viết</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        $_SESSION['messages'][] = 'Bài viết không tồn tại !!!';
                        header('location:post.php');
                    }
                    break;
                case 'delete':
                    $sql = "SELECT * FROM `posts` WHERE `id` = '" . $id . "' LIMIT 1";
                    $query = $conn->query($sql);
                    $total = $query->num_rows;
                    if ($total > 0) {
                        while ($post = $query->fetch_assoc()) { ?>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="users">
                                        <h1>Xóa bài viết</h1>

                                        <p>Bạn có muốn xóa bài viết
                                            <strong><?= $post['title'] ?></strong>?
                                        </p>

                                        <form action="delete_post.php" method="post">
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
        } else {
            header('location:user.php');
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
