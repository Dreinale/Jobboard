<?php
$url_local_host = "http://localhost:";
$url_port = $_SERVER['SERVER_PORT'];
$url_path = dirname($_SERVER['PHP_SELF']) . "/..";
$url_api_create = "/api_job_board/jobs/read_job/";
$id = $_GET['id'];
$api_url = $url_local_host . $url_port . $url_path . $url_api_create . $id;
// echo $api_url;
$job = json_decode(file_get_contents($api_url));

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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?= $job->name ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <p><b><?= $job->description ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>wage</label>
                        <p><b><?= $job->wage ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>workingHours</label>
                        <p><b><?= $job->workingHours ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>position</label>
                        <p><b><?= $job->position ?></b></p>
                    </div>
                    <p><a href="jobs_view.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>