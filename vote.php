<?php include('session.php') ?>
<?php include "db.php" ?>
<?php
$user = auth('id');

if (isset($_POST['vote'])) {
    $casted = false;
    unset($_POST['user']);
    foreach ($_POST as $key => $value) {
        if ($key != 'vote' && !empty($value)) {
            mysqli_query($db, "INSERT INTO polls(user_id,position_id, contestant_id) VALUE('$user', '$key', '$value')") or die(mysqli_error($db));
            $casted = true;
        }
    }

    if ($casted) {
        mysqli_query($db, "UPDATE users SET voted = '1' WHERE id='$user'") or die(mysqli_error($db));
        $_SESSION['message'] = 'Thank you for casting your vote!';
    }

    $_SESSION['user']->voted = 1;
    header('location:vote.php');
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

<div class="container">

    <div class="col-md-offset-2 col-md-8">
        <?php include "header.php" ?>

        <div class="content">
          <?php if (auth('voted') == 1) : ?>
              <h4>Vote Casted</h4>

              <?php include "message.php" ?>

              <p>Thank you for casting your vote <?php echo auth('name') ?>!</p>

              <?php $results = mysqli_query($db, "SELECT * FROM polls WHERE user_id='$user'") ?>
              <?php $results = mysqli_query($db, "
          SELECT polls.*,
          positions.name AS p_name,
          contestants.*,
          users.name AS pick_name,
          users.id AS pick_id
          FROM polls
          INNER JOIN  positions ON polls.position_id = positions.id
          INNER JOIN contestants ON polls.contestant_id = contestants.id
          INNER JOIN users ON contestants.user_id= users.id
          WHERE polls.user_id='$user'") or trigger_error(mysqli_error($db)) ?>

                <table border="4px" width="50%">
                    <tr class="">
                        <th>Position</th>
                        <th>Picked</th>
                    </tr>
                    <?php while ($result = mysqli_fetch_object($results)) : ?>
                        <tr>
                            <td><b><?php echo $result->p_name ?> : </b></td>
                            <td><?php echo $result->pick_name ?></td>
                        </tr>
                    <?php endwhile ?>
                </table>

            <?php else: ?>
                <form method="post" action="">
                    <h4 class="pull-left">Voting Page</h4>
                    <div class="pull-right">
                        <a href="" class="btn btn-default">Reset</a>
                        <input type="submit" class="btn btn-polls" name="vote" value="Cast Vote!">
                    </div>
                    <br>
                    <input type="hidden" name="user" value="<?php echo auth('id') ?>">
                    <table class="table table-bordered">
                        <?php $positions = mysqli_query($db, "SELECT * FROM positions") ?>
                        <?php while ($position = mysqli_fetch_object($positions)): ?>
                            <tr>
                                <th colspan="3" class="active"><?php echo $position->name ?></th>
                            </tr>

                            <?php $contestants = mysqli_query($db, "SELECT * FROM contestants WHERE position_id='$position->id'") ?>
                            <?php while ($contestant = mysqli_fetch_object($contestants)): ?>
                                <?php $user = mysqli_query($db, "SELECT * FROM users WHERE id='$contestant->user_id'")->fetch_object() ?>

                                <tr <?php if ($user->id == auth('id')): ?> style="font-weight: bold;" <?php endif ?>>
                                    <td style="width: 20%"></td>
                                    <td><?php echo $user->name ?></td>
                                    <td class="center"><input type="radio" name="<?php echo $position->id ?>"
                                                              value="<?php echo $contestant->id ?>"
                                                              required <?php if ($user->id == auth('id')): ?> checked <?php endif ?>>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        <?php endwhile ?>
                    </table>
                </form>
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
