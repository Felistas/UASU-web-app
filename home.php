<?php include('session.php') ?>
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
            <h4>Welcome to Polling!</h4>

            <?php include "message.php" ?>

            <?php $auth = auth('id'); ?>
            <?php $all_polls = mysqli_query($db, "SELECT * FROM polls")->num_rows ?>
            <?php $is_contestant = mysqli_query($db, "SELECT * FROM contestants WHERE user_id='$auth'")->fetch_object(); ?>

            <?php if ($is_contestant && $all_polls == 0) : ?>
                <div class="alert panel-default">
                    <h5>You are Contesting!</h5>
                    <?php $position = mysqli_query($db, "SELECT * FROM positions WHERE id='$contestant->position_id'")->fetch_object(); ?>

                    <b>Position : </b> <?php echo $position->name ?> <br>
                </div>

            <?php elseif ($all_polls > 0): ?>
                <div class="alert panel-default">
                    <h4>Polls Standing</h4>

                    <dl class="dl-horizontal">

                        <?php $positions = mysqli_query($db, "SELECT * FROM positions") ?>
                        <?php while ($position = mysqli_fetch_object($positions)): ?>
                            <?php $contestants = mysqli_query($db, "SELECT * FROM contestants WHERE position_id='$position->id'") ?>

                            <?php if ($contestants->num_rows > 0): ?>
                                <dt></dt>
                                <dd><h5><?php echo $position->name ?></h5></dd>
                                <?php while ($contestant = mysqli_fetch_object($contestants)): ?>
                                    <?php $user = mysqli_query($db, "SELECT * FROM users WHERE id='$contestant->user_id'")->fetch_object() ?>

                                    <?php $casted = mysqli_query($db, "SELECT * FROM polls WHERE contestant_id='$contestant->id'")->num_rows ?>
                                    <?php $polls = mysqli_query($db, "SELECT * FROM polls WHERE position_id='$position->id'")->num_rows ?>

                                    <dt><?php echo $user->name ?></dt>
                                    <dd>
                                        <div class="progress" style="width: 75%">
                                            <div class="progress-bar"
                                                 style="width:<?php echo number_format(($casted / $polls) * 100, 0) ?>%">
                                                <?php echo number_format(($casted / $polls) * 100, 0) ?>%
                                            </div>
                                        </div>
                                    </dd>
                                <?php endwhile ?>
                                <hr>
                            <?php endif ?>

                        <?php endwhile ?>
                    </dl>
                </div>
            <?php else: ?>
                No vote is casted so far!
            <?php endif ?>
        </div>
    </div>
</div>
</body>
<?php include 'footer.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
