<header>
    <a href="home.php"><h1><span style="color:  orange">E-</span><span style="color: #a94442">Voter</span></h1></a>
</header>

<ul class="list-inline">
    <?php if (isset($_SESSION['user'])) : ?>
        <li><a href="home.php">Dashboard</a></li>
        <li><a href="vote.php">Cast</a></li>
        <li><a href="contestants.php">Contestants</a></li>

        <?php if (@$_SESSION['user']->role == 'admin') : ?>
        <li><a href="polls.php">Results</a></li>
        <?php endif ?>

        <li class="pull-right"><a href="profile.php?logout=true">Logout</a></li>
        <li class="pull-right"><a href="profile.php"><?php echo explode(' ', auth('name'))[0] ?></a></li>
    <?php else : ?>
        <li><a href="index.php">Login</a></li>
    <?php endif ?>
</ul>
