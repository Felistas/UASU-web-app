<?php include "db.php" ?>
<?php

if (isset($_POST['register'])) {
    session_start();
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $ek = trim($_POST['ek_no']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    // Cache submited data incase of errors
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }

    if ($confirm !== $password) {
        $message = 'Passwords do not match!';
    } else {

        $check_1 = mysqli_query($db, "SELECT * FROM employees WHERE ek_no='$ek' LIMIT 1");
        //$check = mysqli_query($db, "SELECT * FROM employees WHERE name='$name' LIMIT 1");
        $check_2 = mysqli_query($db, "SELECT * FROM users WHERE ek_no='$ek' LIMIT 1");
        $check_3 = mysqli_query($db, "SELECT * FROM users WHERE email='$email' LIMIT 1");

        //var_dump($check_2); die();

        if ($check_1->num_rows == 0) {
            $message = 'EK NO NOT AVAILABLE!';
        } elseif($check_2->num_rows == 1){
            $message = 'EK No. already taken!';
        } elseif($check_3->num_rows == 1){
               $message = 'E-Mail already taken!';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($db, "INSERT INTO users(name, phone, ek_no, address, email, password) VALUES('$name','$phone','$ek','$address','$email','$password')") or die(mysqli_error($db));
            foreach ($_POST as $key => $value) {
                unset($_SESSION[$key]);
            }
            $message = 'Details saved successfully!';
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


    <div class="col-md-offset-3 col-md-6">
        <div class="content">
            <h4 class="center">Register</h4>

            <?php include('message.php') ?>

            <form method="post" action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-4">Full Name*</label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" value="<?php echo @$_SESSION['name'] ?>"
                               required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Phone</label>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" value="<?php echo @$_SESSION['phone'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">EK No.</label>
                    <div class="col-md-6">
                        <input type="text" name="ek_no" class="form-control" value="<?php echo @$_SESSION['ek_no'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Address</label>
                    <div class="col-md-6">
                        <input type="text" name="address" class="form-control"
                               value="<?php echo @$_SESSION['address'] ?>"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">E-Mail*</label>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" value="<?php echo @$_SESSION['email'] ?>"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Password*</label>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control"
                               value="<?php echo @$_SESSION['password'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" name="confirm" class="form-control"
                               value="<?php echo @$_SESSION['confirm'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <input type="submit" name="register" class="btn btn-polls" value="Submit">
                        <a href="index.php" class="btn btn-default">Login</a>
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
