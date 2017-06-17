<?php include "db.php" ?>
<?php
if (isset($_POST['login'])) {
    session_start();
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $_SESSION['username'] = $username;

    $query = mysqli_query($db, "SELECT * FROM users WHERE ek_no='$ek_no' LIMIT 1");

    if ($query->num_rows == 0) {
        $message = 'Credentials not found!';

    } elseif ($query->num_rows == 1) {
        $user = $query->fetch_object();

        if (!password_verify($password, $user->password)) {
            $message = 'You entered wrong password!';

        } else {
            $_SESSION['user'] = $user;
            unset($_SESSION['username']);

            $message = 'Successfully logged in!';
            header('location:home.php');
        }
    }
    $_SESSION['message'] = $message;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Polls</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<div class="container" style="margin-top: 40px">


    <div class="col-md-6 col-md-offset-3">
        <div class="content">
            <h4 class="center">Login</h4>

            <?php if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-polls" style="color: orange">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $_SESSION['message']; ?>
                </div>
            <?php endif ?>

            <form method="post" action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-3">Username</label>
                    <div class="col-md-6">
                        <input type="text" name="username" class="form-control"
                               value="<?php echo @$_SESSION['username'] ?>">
                    </div>
                </div>
                <div class="form-group <?php if (isset($_SESSION['username'])) : ?> has-error <?php endif ?>">
                    <label class="control-label col-md-3">Password</label>
                    <div class="col-md-6">
                        <input type="password" name="password"
                               class="form-control" <?php if (isset($_SESSION['username'])) : ?> autofocus <?php endif ?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <input type="submit" name="login" class="btn btn-polls" value="Login">
                        <a class="btn btn-juicy" href="register.php" style="color: #008000">Create Account?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<?php include 'footer.php' ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
