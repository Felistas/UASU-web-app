<?php include('session.php') ?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    session_destroy();

    header('location:index.php');
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
<?php include "db.php" ?>
<div class="container">
    <div class="col-md-offset-2 col-md-8">
        <?php include "header.php" ?>
        <div class="content">
            <h4>My Profile</h4>

            <?php include('message.php') ?>

            <?php if (!isset($_SESSION['user'])) : ?>
                <div class="text-danger">
                    Your not logged in. <a href="login.php">lOGIN</a>
                </div>
            <?php else: ?>

                <a href="profile.php?logout=true" class="btn btn-polls pull-right">Logout</a>

                <b>Name :</b> <?php echo auth('name') ?><br>
                <b>Phone :</b> <?php echo auth('phone') ?><br>
                <b>E-Mail :</b> <?php echo auth('email') ?><br>
                <b>EK No. :</b> <?php echo auth('ek_no') ?><br>

            <?php endif ?>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
