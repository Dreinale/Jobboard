<?php
$url_local_host = "http://localhost:";
$url_port = $_SERVER['SERVER_PORT'];
$url_path = dirname($_SERVER['PHP_SELF']) . "/..";
$url_api_create = "/api_job_board/users/read_user/";
$id = $_GET['id'];
$api_url = $url_local_host . $url_port . $url_path . $url_api_create . $id;
//echo $api_url;
$job = json_decode(file_get_contents($api_url));

// $job = json_decode(file_get_contents("http://localhost:8888/full_app/api_job_board/jobs/read_job/".$_GET["id"]));

// var_dump($job);
// echo "<br>1code<br>";
// print_r($job);
// $row2 = json_decode($row1);
// echo "<br>1dec<br>";
// var_dump(json_decode($row1));
// echo "<br>2dec<br>";
// var_dump($row2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View User</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?= $job->name ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <p><b><?= $job->password ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <p><b><?= $job->phone ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?= $job->email ?></b></p>
                    </div>
                    <p><a href="users_view.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>