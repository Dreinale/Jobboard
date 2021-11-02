<?php
require_once ("../api_job_board/api.php");
$id = $_GET['id'];
delete_job($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
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
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="jobs_view.php"/>
                            <p>This Job Ad has been deleted</p>
                            <p>
                                <!-- <input type="submit" value="Yes" class="btn btn-danger"> -->
                                <a href="jobs_view.php" class="btn btn-secondary">Continue</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>