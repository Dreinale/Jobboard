<?php
ob_start();
session_start();

?>
<?php if (isset($_SESSION['uid']) && isset($_SESSION['name'])):?>
<h1>welcome, <?php echo $_SESSION['name']; ?></h1><br>
<?php if (isset($_SESSION['status'])) {?>
    <h2>Status : <?php 
    if ($_SESSION['name'] == "admin") echo('Administator');
    else if ($_SESSION['status'] == 1) echo('Job Seeker'); 
    else if ($_SESSION['status'] == 2) echo('Company'); ?></h2>
    <?php }?>
    <h2>Email : <?php echo $_SESSION['email']; ?></h2>
    <?php if (isset($_SESSION['phone'])) {?>
        <h2>Phone number : <?php echo $_SESSION['phone']; ?></h2>
    <?php }?>
<p class="form__text">
    <a href="register/logout.php" class="form__link">logout</a>
</p>
<?php else: ?>
<h1>sign in (for admin mode name: admin, password: admin)</h1>
<a class="btn btn-primary" href="./register/index.php">sign in</a>
<?php endif; ?>
<?php

$content = ob_get_clean();
require_once("template.php");

// USE test1;

// CREATE TABLE `companies` (
//   `id` int(11) NOT NULL,
//   `name` varchar(100) NOT NULL,
//   `address` varchar(255) NOT NULL,
//   `salary` int(10) NOT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

// INSERT INTO `companies` (`id`, `name`, `address`, `salary`) VALUES
// (39, 'sdsaaq', 'asd', 431),
// (42, 'thisisatest', 'asd', 3231),
// (45, 'fsad', 'asdf', 1313),
// (49, 'sdfnjlkansjkdfnjkandfjknasdfljkn', 'asdnfkjlaksndg', 2415145),
// (50, 'dfkladnklf', 'asdfgasdg', 3);
?>

