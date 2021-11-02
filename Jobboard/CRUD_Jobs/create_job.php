<?php
// echo htmlspecialchars($_SERVER["PHP_SELF"]);
$url_local_host = "http://localhost:";
$url_port = $_SERVER['SERVER_PORT'];
$url_path = dirname($_SERVER['PHP_SELF']) . "/..";
$url_api_create = "/api_job_board/jobs/create_job";
// $id = $_GET['id'];
$api_url = $url_local_host . $url_port . $url_path . $url_api_create;
$name = "";
$description = "";
$wage = "";
$workingHours = "";
$position = "";
// $api_url = $url_local_host . $url_port . "/T-WEB-501-NCE-5-1-jobboard-jad.chammas/BackEnd" . $url_api_create . $id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action=<?=$api_url?> method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>wage</label>
                            <input type="text" name="wage" class="form-control <?php echo (!empty($wage_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $wage; ?>">
                            <span class="invalid-feedback"><?php echo $wage_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>workingHours</label>
                            <input type="text" name="workingHours" class="form-control <?php echo (!empty($workingHours_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $workingHours; ?>">
                            <span class="invalid-feedback"><?php echo $workingHours_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>position</label>
                            <input type="text" name="position" class="form-control <?php echo (!empty($position_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $position; ?>">
                            <span class="invalid-feedback"><?php echo $position_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="jobs_view.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>