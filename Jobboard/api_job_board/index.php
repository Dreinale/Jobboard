<?php
require_once("./api.php");
try {
    if (!empty($_GET['demande'])) {
        $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case 'users':
                if (empty($url[1])) {
                    users_info();
                    break;
                } else {
                    switch ($url[1]) {
                        case 'create_user':
                            create_user();
                            break;

                        case 'read_user':
                            if (!empty($url[2])) {
                                user_info($url[2]);
                            }
                            else {
                                throw new Exception("the id is missing from read");
                            }
                            break;
                        case 'update_user':
                            if (!empty($url[2])) {
                                update_user($url[2]);
                            }
                            else {
                                throw new Exception("the id is missing from update");
                            }
                            break;

                        case 'delete_user':
                            echo $userId = $url[2];
                            delete_user($userId);
                            break;
                        default:
                            throw new Exception("api_job_board/index.php | Theres a problem with the users case");
                            break;
                    }
                }
                break;

            case 'companies':
                if (empty($url[1])) {
                    comps_info();
                    break;

                } else {
                    switch ($url[1]) {
                        case 'create_comp':
                            echo "test here";
                            create_comp();
                            break;

                        case 'read_comp':
                            if (!empty($url[2])) {
                                // echo $url[2];
                                comp_info($url[2]);
                            }
                            else {
                                throw new Exception("the id is missing from read");
                            }
                            break;

                        case 'update_comp':
                            if (!empty($url[2])) {
                                update_comp($url[2]);
                            }
                            else {
                                throw new Exception("the id is missing from update");
                            }
                            break;

                        case 'delete_comp':
                            echo $compId = $url[2];
                            delete_comp($compId);
                            break;

                        default:
                            throw new Exception("api_job_board/index.php | There's a problem with the companies case");
                            break;

                    }
                }
                break;
            
            case 'jobs':
                if (empty($url[1])) {
                    jobs_info();
                    break;
                } else {
                    switch ($url[1]) {
                        case 'create_job':
                            create_job();
                            break;

                        case 'read_job':
                            if (!empty($url[2])) {
                                job_info($url[2]);
                            }
                            else {
                                throw new Exception("the id is missing from read");
                            }
                            break;

                        case 'update_job':
                            if (!empty($url[2])) {
                                update_job($url[2]);
                            }
                            else {
                                throw new Exception("the id is missing from update");
                            }
                            break;

                        case 'delete_job':
                            echo $jobId = $url[2];
                            delete_job($jobId);
                            break;
                        default:
                            throw new Exception("api_job_board/index.php | Theres a problem with the jobs case");
                            break;

                    }
                }
                break;
            
            case 'job_aplications':
                break;

            case 'new_job':
                // create_job();
                break;

            default:
                throw new Exception("fuck this isnt workings :|");
                break;
        }
    } else {
        throw new Exception("api_job_board/index.php | Theres a problem getting the demand");
    }
} catch (Exception $e) {
    $erreur =[
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}

?>