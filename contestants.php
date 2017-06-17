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
<?php
if (isset($_POST['contestant'])) {
    $user = $_POST['user'];
    $position = $_POST['position'];

    mysqli_query($db, "INSERT INTO contestants(user_id, position_id) VALUES ('$user', '$position')") or die(mysqli_error($db));
    $_SESSION['message'] = 'Registered successfully!';
}
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    mysqli_query($db, "DELETE from contestants WHERE id='$id'");
    $_SESSION['message'] = 'Contestant removed!';
}

?>
<div class="container">
    <div class="col-md-offset-2 col-md-8">
        <?php include "header.php" ?>


        <div class="content">
            <?php include "message.php" ?>
            <h4>Contestants</h4>

            <div class="well">
                <h5 class="center">Register as a Contestant</h5 class="center">
                <form method="post" action="" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">Select Name</label>
                        <div class="col-md-4">
                            <select name="user" class="form-control">
                                <?php $users = mysqli_query($db, "SELECT * FROM users"); ?>
                                <?php while ($user = mysqli_fetch_object($users)): ?>
                                    <?php $contestant = mysqli_query($db, "SELECT * FROM contestants WHERE user_id='$user->id'")->fetch_object() ?>
                                    <?php if (!$contestant) : ?>
                                        <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
                                    <?php endif ?>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Position</label>
                        <div class="col-md-4">
                            <select name="position" class="form-control">
                                <?php $positions = mysqli_query($db, "SELECT * FROM positions"); ?>
                                <?php while ($position = mysqli_fetch_object($positions)): ?>
                                    <option value="<?php echo $position->id ?>"><?php echo $position->name ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" name="contestant" class="btn btn-polls" value="Submit">
                        </div>
                    </div>
                </form>
            </div>

            <?php $can_vote = @date_create($day->body)->diff(date_create(date('Y-m-d h:m:s')))->invert ?>

            <table class="table table-bordered">
                <?php $positions = mysqli_query($db, "SELECT * FROM positions") ?>
                <?php while ($position = mysqli_fetch_object($positions)): ?>
                    <tr>
                        <th colspan="6" class="active"><?php echo $position->name ?></th>
                    </tr>

                    <?php $contestants = mysqli_query($db, "SELECT * FROM contestants WHERE position_id='$position->id'") ?>
                    <?php while ($contestant = mysqli_fetch_object($contestants)): ?>
                        <?php $user = mysqli_query($db, "SELECT * FROM users WHERE id='$contestant->user_id'")->fetch_object() ?>

                        <tr>
                            <td style="width: 20%"></td>
                            <td><?php echo $user->name ?></td>
                            <td><?php echo $user->phone ?></td>
                            <td><?php echo $user->email ?></td>
                            <td style="width: 20%">
                                <a href="contestants.php?remove=<?php echo $contestant->id ?>"
                                   class="btn btn-polls btn-table remove">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile ?>

                <?php endwhile ?>
            </table>
        </div>
    </div>
</div>
</body>
<?php include 'footer.php' ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
