<?php
$url_local_host = "http://localhost:";
$url_port = $_SERVER['SERVER_PORT'];
$url_path = dirname($_SERVER['PHP_SELF']) . "/..";
$url_api_jobs = "/api_job_board/jobs";
$api_url = $url_local_host . $url_port . $url_path . $url_api_jobs;
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
$jobs = json_decode(file_get_contents($api_url));
ob_start();

session_start();
$acc_lv = $_SESSION['status'];
if ($_SESSION['name'] == "admin")
$acc_lv = 3;
//echo ($acc_lv);
?>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .card {
        /* display: inline-block; */
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 10%vw;
        /* width: 300px; */
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        width: 1200px;
        padding: 2px 16px;
    }

    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    .wrapper {
        margin: 0 auto;
    }

    table tr td:last-child {
        width: 120px;
    }
</style>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Job Details</h2>
                    <?php echo $_SESSION['uid'];?>
                    <?php if ($acc_lv == 3 || $acc_lv == 2): ?>
                    <a href="create_job.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Job
                        Ad</a>
                    <?php endif; ?>
                </div>
                <div class="w3-row-padding">
                    <?php foreach($jobs as $job) : ?>
                    <div class="w3-third w3-container w3-margin-bottom">
                    <div class="card">
                        <a href="read_job.php?id=<?= $job->id ?>"><img
                                src="https://c4.wallpaperflare.com/wallpaper/500/442/354/outrun-vaporwave-hd-wallpaper-preview.jpg"
                                alt="Norway" style="width:100%" class="w3-hover-opacity"></a>
                                <div class="container">
                        <div class="w3-container">
                            <p><b>Job name: <?= $job->name ?></b></p>
                            <p>Wage: <?= $job->wage ?></p>
                            <p>Working Hours: <?= $job->workingHours ?></p>
                            <p>Job Position: <?= $job->position ?></p>
                            <p>Description: <?= $job->description ?></p>
                        </div>
                    </div>
                    <a href="read_job.php?id=<?= $job->id ?>" class="mr-3" title="View Record"
                        data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                    <?php if ($acc_lv == 3): ?>
                    <a href="update_job.php?id=<?= $job->id ?>" class="mr-3" title="Update Record"
                        data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                    <a href="delete_job.php?id=<?= $job->id ?>" title="Delete Record" data-toggle="tooltip"><span
                            class="fa fa-trash"></span></a>
                    <?php endif; ?>
                    <button onclick="document.getElementById('contact_job').style.display='block'"
                        style="width: auto; border-radius: 3%;">Apply</button>
                        </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contact_job" class="modal">
    <form class="modal-content animate" action="mail_handler.php" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('contact_job').style.display='none'" class="close"
                title="Close Modal">&times;</span>
            <h1>test</h1>
            <!--A MODIFIER:: mettre le titre du job-->
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>
        <div class="container_">
            <label class="txt" for="Name"><b>Name</b></label>
            <input type="text" placeholder="Name" name="Name"  value="<?=$_SESSION['name']?>" required><br><br>
            <label for="Email"><b>Email</b></label><br>
            <input class="email" type="email" placeholder="Email" name="Email" value="<?=$_SESSION['email']?>" required><br><br>
            <label for="Phone"><b>Phone</b></label><br>
            <input class="tel" type="tel" placeholder="01 23 45 67 89" name="Phone" minlength="14" maxlength="14"
                pattern="[0-9]{10}" value="<?=$_SESSION['phone']?>" ><br><br>
            <label for="Message"><b>Message</b></label><br>
            <textarea class="msm" type="text" placeholder="Message to the owner..." name="Message" cols="30" rows="3"
                required></textarea><br>
            <input type="submit" name="submit" value="send" class="sub-btn">
            <!-- <button type="submit">Apply</button> -->
        </div>
    </form>
</div>

<?php
// $to = $_POST['email'];
// $subject = "Email Subject";

// $message = 'Dear '.$_POST['name'].',<br>';
// $message .= "We welcome you to be part of family<br><br>";
// $message .= "Regards,<br>";

// // Always set content-type when sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // More headers
// $headers .= 'From: <enquiry@example.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

// mail($to,$subject,$message,$headers);
?>

<?php
$content = ob_get_clean();
require_once("../template.php");
?>