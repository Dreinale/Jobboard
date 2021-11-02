<?php
$url_local_host = "http://localhost:";
$url_port = $_SERVER['SERVER_PORT'];
$url_path = dirname($_SERVER['PHP_SELF']) . "/..";
// echo $url_path;
$url_api_jobs = "/api_job_board/companies";
//$id = $_GET['id'];
$api_url = $url_local_host . $url_port . $url_path . $url_api_jobs;
// echo $api_url;
// $api_url = $url_local_host . $url_port . "/T-WEB-501-NCE-5-1-jobboard-jad.chammas/BackEnd/" . $url_api_jobs;
// $jobs = json_decode(file_get_contents("http://localhost:8888/Full_APP/api_job_board/jobs"));
// echo "<br>" . $api_url . "<br>" . getcwd() . "<br>" . parse_url( $_SERVER[ 'REQUEST_URI' ], PHP_URL_PATH ) . "<br>" . pathinfo($_SERVER['REQUEST_URI']);
// echo "step1<br>";
// echo realpath('./../') . PHP_EOL;
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
// echo "<br>step2<br>" . $rootDir . "<br>step3";
$jobs = json_decode(file_get_contents($api_url));
// print_r($formations);
ob_start();

session_start();
$acc_lv = $_SESSION['status'];
if ($_SESSION['name'] == "admin")
$acc_lv = 3;
//echo ($acc_lv);
?>

<style>
.wrapper{
    width: 600px;
    margin: 0 auto;
}
table tr td:last-child{
    width: 120px;
}
</style>
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Comps Details</h2>
                    <?php if ($acc_lv == 3): ?>
                    <a href="create_comp.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Company</a>
                    <?php endif; ?>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>company name</th>
                            <th>company description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($jobs as $job) : ?>
                            <tr>
                                <td><?= $job->id ?></td>
                            <td><?= $job->name ?></td>
                            <td><?= $job->description ?></td>
                            <td>
                                <a href="read_comp.php?id=<?= $job->id ?>" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                <?php if ($acc_lv == 3): ?>
                                <a href="update_comp.php?id=<?= $job->id ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                <a href="delete_comp.php?id=<?= $job->id ?>" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once("../template.php");
?>