<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="resources/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>
<div class='container'>
    <div class="row">
    </div>
    <div class='row'>
        <div class='col-md-4 col-md-offset-4'>
            <h1>Đăng nhập</h1>
            <?php
            include_once('core/database/connect.php');
            if (!empty($_POST["username"]) && !empty($_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                // Câu truy vấn
                $sql = "SELECT * FROM users WHERE `username` = '" . $username . "' AND " . "`password` = '" . $password . "' LIMIT 1";
                $query = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($query);
                if ($total > 0) {
                    $userInfo = mysqli_fetch_assoc($query);
                    $_SESSION['user'] = $userInfo;
                    header("location:admin/index.php");
                } else {
                    echo "<p>Username hoặc password không đúng !!!</p>";
                }
            }
            ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="resources/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="resources/js/bootstrap.js"></script>
</body>
</html>
<?php
include_once('core/database/disconnect.php');
?>
