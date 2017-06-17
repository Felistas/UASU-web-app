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

    <div class="col-md-offset-1 col-md-9">
        <?php include "header.php" ?>

        <div class="content">

            <!--        --><?php //if (auth('role') != 'admin') : ?>
            <!--            <br>-->
            <!--            <div class="alert alert-polls">-->
            <!--                Sorry, you are not authorized to access this page.-->
            <!--            </div>-->
            <!--            --><?php //exit() ?>
            <!--        --><?php //endif ?>

            <h4>Polls Page</h4>

            <?php include "message.php" ?>

            <div class="well">
                <?php $casted = mysqli_query($db, "SELECT * FROM users WHERE voted=1")->num_rows ?>
                <?php $users = mysqli_query($db, "SELECT * FROM users")->num_rows ?>

                Vote results in progress<br>
                Total votes Casted => <b><?php echo $casted ?></b><br>
                Total voters registered => <b><?php echo $users ?></b><br>
                Remaining votes => <b><?php echo($users - $casted) ?></b> to go<br>
            </div>

            <div class="progress">
                <div class="progress-bar"
                     style="width:<?php echo number_format(($casted / $users) * 100, 0) ?>%">
                    <?php echo number_format(($casted / $users) * 100, 0) ?>%
                </div>
            </div>

            <table class="table table-bordered">
                <tr class="active">
                    <th width="20%">Position</th>
                    <th>Contestant</th>
                    <th>Votes</th>
                    <th>Graph</th>
                </tr>
                <?php $positions = mysqli_query($db, "SELECT * FROM positions") ?>
                <?php while ($position = mysqli_fetch_object($positions)): ?>
                    <tr>
                        <th class="bg-info"><?php echo $position->name ?></th>
                        <th colspan="3"></th>
                    </tr>

                    <?php $contestants = mysqli_query($db, "SELECT * FROM contestants WHERE position_id='$position->id'") ?>
                    <?php while ($contestant = mysqli_fetch_object($contestants)): ?>
                        <?php $user = mysqli_query($db, "SELECT * FROM users WHERE id='$contestant->user_id'")->fetch_object() ?>

                        <?php $polls = mysqli_query($db, "SELECT * FROM polls WHERE contestant_id='$contestant->id'")->num_rows ?>
                        <?php $all_polls = mysqli_query($db, "SELECT * FROM polls WHERE position_id='$position->id'")->num_rows ?>

                        <tr>
                            <th></th>
                            <td><a href=""><?php echo $user->name ?></a></td>
                            <td><?php echo $polls ?></td>
                            <td style="width: 40%">
                                <div class="progress">
                                    <div class="progress-bar"
                                         style="width:<?php echo number_format(($polls / $all_polls) * 100, 0) ?>%">
                                        <?php echo number_format(($polls / $all_polls) * 100, 0) ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile ?>
                <?php endwhile ?>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
