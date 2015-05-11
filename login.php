<?php include_once('core/layout/header.php'); ?>
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
                $username = $conn->real_escape_string($_POST["username"]);
                $password = $conn->real_escape_string($_POST["password"]);

                // Câu truy vấn
                $sql = "SELECT * FROM users WHERE `username` = '" . $username . "' AND " . "`password` = '" . $password . "' LIMIT 1";
                $query = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($query);
                if ($total > 0) {
                    $userInfo = mysqli_fetch_assoc($query);
                    session_start();
                    $_SESSION['user'] = $userInfo;
                    $_SESSION['messages'][] = 'Chào bạn, ' . $userInfo['username'];
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
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
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
