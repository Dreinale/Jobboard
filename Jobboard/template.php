<?php

//Todo
// companie can update only own jobs
// apply send mail to company
// check
// Enzo:
// create company using the create account

// CREATE DATABASE IF NOT EXISTS JobBoard;
// USE JobBoard;
// CREATE TABLE IF NOT EXISTS companies
// (
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
//     name varchar(255) NOT NULL,
//     description TEXT(65535) NULL,
//     img_url TEXT(65535) NOT NULL
// ) ENGINE = INNODB;

// CREATE TABLE IF NOT EXISTS users
// (
//   //uid VARCHAR(255) PRIMARY KEY,
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
//     name VARCHAR(255) NOT NULL,
//     password VARCHAR(255) NOT NULL,
//     phone VARCHAR(16) NULL,
//     email VARCHAR(255) NOT NULL,
//     status INT (1) NULL,
//     companie_id INT UNSIGNED NULL,
//     img_url TEXT(65535) NOT NULL
// ) ENGINE = INNODB;

// CREATE TABLE IF NOT EXISTS advertisements
// (
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     name varchar(255) NOT NULL,
//     date DATETIME NULL,
//     description TEXT(65535) NOT NULL,
//     wage INT UNSIGNED NULL,
//     workingHours INT UNSIGNED NULL,
//     position VARCHAR(255) NOT NULL,
//     user_id VARCHAR(255) NOT NULL,
//     companie_id INT UNSIGNED NOT NULL,
//     img_url TEXT(65535) NOT NULL
// ) ENGINE = INNODB;

// $url_home_page = dirname($_SERVER['PHP_SELF']) . "/../";
$url_back = dirname($_SERVER['PHP_SELF']);
// echo $url_back . "<br>";
// $full_url = 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
$base_name_url = basename($_SERVER['REQUEST_URI']);
// echo $base_name_url;
$url_home_page = "";
$url_jobs_page = "";
$url_users_page = "";
$url_comps_page = "";

$color_acc = "";
$color_job = "";
$color_users = "";
$color_comp = "";

if ($base_name_url == "Jobboard" || $base_name_url == "JobBoard" || $base_name_url == "index.php") {
    $url_home_page = $url_back . "/";
    $url_jobs_page = $url_back . "/CRUD_Jobs/jobs_view.php";
    $url_users_page = $url_back . "/CRUD_Users/users_view.php";
    $url_comps_page = $url_back . "/CRUD_Comps/comps_view.php";
    $color_acc = "green";
} elseif($base_name_url == "jobs_view.php") {
    $url_home_page = $url_back . "/../";
    $url_jobs_page = $url_back . "/jobs_view.php";
    $url_users_page = $url_back . "/../CRUD_Users/users_view.php";
    $url_comps_page = $url_back . "/../CRUD_Comps/comps_view.php";
    $color_job = "green";
}   elseif($base_name_url == "users_view.php") {
    $url_home_page = $url_back . "/../";
    $url_jobs_page = $url_back . "/../CRUD_Jobs/jobs_view.php";
    $url_users_page = $url_back . "/users_view.php";
    $url_comps_page = $url_back . "/../CRUD_Comps/comps_view.php";
    $color_users = "green";
}   elseif($base_name_url == "comps_view.php") {
    $url_home_page = $url_back . "/../";
    $url_jobs_page = $url_back . "/../CRUD_Jobs/jobs_view.php";
    $url_users_page = $url_back . "/../CRUD_Users/users_view.php";
    $url_comps_page = $url_back . "/comps_view.php";
    $color_comp = "green";
}

if (isset($_SESSION['status'])) {
    $acc_lv = $_SESSION['status'];
    if ($_SESSION['name'] == "admin")
    $acc_lv = 3;
    $connect = true;
} else {
    $acc_lv = 0;
    $connect = false;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a style="color: <?=$color_acc?>;" class="nav-link" href=<?=$url_home_page?>>
                            Acc
                        </a>
                    </li>
                    <?php if ($connect == true): ?>
                    <li class="nav-item">
                        <a style="color: <?=$color_job?>;" class="nav-link" href=<?=$url_jobs_page?>>Jobs</a>
                    </li>
                    <?php endif; ?>
                    <?php if ($connect == true): ?>
                    <li class="nav-item">
                        <a style="color: <?=$color_users?>;" class="nav-link" href=<?=$url_users_page?>>users</a>
                    </li>
                    <?php endif; ?>
                    <?php if ($connect == true): ?>
                    <li class="nav-item">
                        <a style="color: <?=$color_comp?>;" class="nav-link" href=<?=$url_comps_page?>>Comp</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= $content ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
</body>
</html>