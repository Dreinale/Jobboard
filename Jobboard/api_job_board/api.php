<?php
// define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS'])? "https" : "https") . "://" . $_SERVER["PHP_HOST"] . $_SERVER["PHP_SELF"]));
// ALTER TABLE i_love_you ADD id int not  null AUTO_INCREMENT PRIMARY key FIRST

function getFormations() {
    $pdo = getConnection();
    $req = "SELECT f.id, f.libelle, f.description, f.image, c.libelle as 'categorie'
    from formation f inner join categorie c on f.categorie_id = c.id";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < count($formations); $i++) { 
        $formations[$i]['image'] = URL . "images/cours/" . $fonrmations[$i]['image'];
    }
    $stmt->closeCursor();
    sendJSON($formations);
}

function getFormationsByCategorie($categorie) {
    $pdo = getConnection();
    $req = "SELECT f.id, f.libelle, f.description, f.image, c.libelle as 'categorie'
    from formation f inner join categorie c on f.categorie_id = c.id
    where c.libelle = :categorie";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":categorie", $categorie, PDO::PARAM_STR);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < count($formations); $i++) { 
        $formations[$i]['image'] = URL . "images/cours/" . $fonrmations[$i]['image'];
    }
    $stmt->closeCursor();
    sendJSON($formations);
}

function getFormationById($id) {
    $pdo = getConnection();
    $req = "SELECT f.id, f.libelle, f.description, f.image, c.libelle as 'categorie'
    from formation f inner join categorie c on f.categorie_id = c.id
    where f.id = :id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    // $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $formations = $stmt->fetch(PDO::FETCH_ASSOC);
    $formations['image'] = URL . "images/cours/" . $fonrmations['image'];
    $stmt->closeCursor();
    sendJSON($formations);
}
//<!-- CRUD for jobs -->

//<!-- Create job start -->
function create_job() {
    require_once "config.php";
    // Define variables and initialize with empty values
    $name = $description = $wage = $workingHours = $position = "";
    $name_err = $description_err = $wage_err = $workingHours_err = $position_err = "";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate name
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $wage = trim($_POST["wage"]);
        $workingHours = trim($_POST["workingHours"]);
        $position = trim($_POST["position"]);
        // Check input errors before inserting in database
        if(empty($name_err) && empty($address_err) && empty($salary_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO advertisements (name, description, wage, workingHours, position) VALUES (?, ?, ?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_description, $param_wage, $param_workingHours, $param_position);
                // Set parameters
                $param_name = $name;
                $param_description = $description;
                $param_wage = $wage;
                $param_workingHours = $workingHours;
                $param_position = $position;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records created successfully. Redirect to landing page
                    header("location: ../../CRUD_Jobs/jobs_view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);
    }
    // echo "im here";
}
//<!-- Create job end -->

//<!-- Read job start -->
function jobs_info() {
    $pdo = getConnection();
    // $req = "SELECT * FROM employees";
    $req = "SELECT * FROM advertisements";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}

function job_info($id) {
    $pdo = getConnection();
    $req = "SELECT * FROM advertisements WHERE id = :id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $formations = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}
//<!-- Read job end -->

//<!-- Update job start -->
function update_job($id) {
    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $name = $description = $wage = $workingHours = $position = "";
    $name_err = $description_err = $wage_err = $workingHours_err = $position_err = "";

    // Processing form data when form is submitted
    // if(isset($_POST["id"]) && !empty($_POST["id"])){
    if(isset($id) && !empty($id)) {
        // Get hidden input value
        // $id = $_POST["id"];

        // Validate name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
        } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name.";
            header("location: ../../../CRUD_Jobs/update_job_error.php?id=$id");
        } else{
            $name = $input_name;
        }

        // Validate address address
        $input_description = trim($_POST["description"]);
        if(empty($input_description)){
            $description_err = "Please enter an address.";
        } else{
            $description = $input_description;
        }

        // Validate salary
        $input_wage = trim($_POST["wage"]);
        if(empty($input_wage)){
            $wage_err = "Please enter the salary amount.";     
        } elseif(!ctype_digit($input_wage)){
            $wage_err = "Please enter a positive integer value.";
            header("location: ../../../CRUD_Jobs/update_job_error.php?id=$id");
        } else{
            $wage = $input_wage;
        }

        $workingHours = trim($_POST["workingHours"]);
        $position = trim($_POST["position"]);
        // Check input errors before inserting in database
        if(empty($name_err) && empty($address_err) && empty($salary_err)){
            // Prepare an update statement
            $sql = "UPDATE advertisements SET name=?, description=?, wage=?, workingHours=?, position=? WHERE id=?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssi", $param_name, $param_description, $param_wage, $param_workingHours, $param_position, $param_id);
                // Set parameters
                $param_name = $name;
                $param_description = $description;
                $param_wage = $wage;
                $param_workingHours = $workingHours;
                $param_position = $position;
                $param_id = $id;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    header("location: ../../../CRUD_Jobs/jobs_view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);
    } else{
        // Check existence of id parameter before processing further
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            // Get URL parameter
            $id =  trim($_GET["id"]);

            // Prepare a select statement
            $sql = "SELECT * FROM employees WHERE id = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                // Set parameters
                $param_id = $id;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
    
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $row1 = json_encode($row, JSON_UNESCAPED_UNICODE);
                        // Retrieve individual field value
                        $name = $row["name"];
                        $address = $row["address"];
                        $salary = $row["salary"];
                    } else{
                        // URL doesn't contain valid id. Redirect to error page
                        header("location: ../error_page.php");
                        exit();
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
            // Close connection
            mysqli_close($link);
        }  else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: ../error_page.php");
            exit();
        }
    }
}
//<!-- Update job end -->

//<!-- Delete job start -->
function delete_job($id) {
    echo $id;
    $pdo = getConnection();
    $req = "DELETE FROM advertisements WHERE id = '$id'";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $stmt->closeCursor();
}
// <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); 
//<!-- Delete job end -->

//<!-- end CRUD for jobs -->

////////////////////////////////////////////////////////////////
// USERS

//<!-- Create user start -->
function create_user() {
    require_once "config.php";
    // Define variables and initialize with empty values
    $name = $password = $phone = $email = "";
    $name_err = $password_err = $phone_err = $email_err = "";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
            header("location: ../../CRUD_Users/create_user_error.php");
        }
        elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name.";
            header("location: ../../CRUD_Users/create_user_error.php");
        }
        else{
            $name = $input_name;
        }
        // Validate address
        $input_password = trim($_POST["password"]);
        if(empty($input_password)){
            $password_err = "Please enter an address.";
            // header("location: ../../CRUD_Users/create_user_error.php");
            echo "here1";
        } else{
            $password = $input_password;
        }
        // Validate salary
        $input_phone = trim($_POST["phone"]);
        if(empty($input_phone)){
            $phone_err = "Please enter the salary amount.";
            // header("location: ../../CRUD_Users/create_user_error.php");
            echo "here2";
        } elseif(!ctype_digit($input_phone)){
            $phone_err = "Please enter a positive integer value.";
            // header("location: ../../CRUD_Users/create_user_error.php");
            echo "here";

        } else{
            $phone = $input_phone;
        }

        $email = trim($_POST["email"]);
        // Check input errors before inserting in database
        if(empty($name_err) && empty($address_err) && empty($salary_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO users (name, password, phone, email) VALUES (?, ?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_password, $param_phone, $param_email);
                // Set parameters
                $param_name = $name;
                $param_password = $password;
                $param_phone = $phone;
                $param_email = $email;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records created successfully. Redirect to landing page
                    header("location: ../../CRUD_Users/users_view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.1";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);
    }
    // echo "im here";
}
//<!-- Create user end -->

//<!-- Read user start -->
function users_info() {
    $pdo = getConnection();
    $req = "SELECT * FROM users";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}

function user_info($id) {
    // echo "test12";
    $pdo = getConnection();
    $req = "SELECT * FROM users WHERE uid = :id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $formations = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}
//<!-- Read user end -->

//<!-- Update user start -->
function update_user($id) {
    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $name = $password = $phone = $email = "";
    $name_err = $password_err = $phone_err = $email_err = "";

    // Processing form data when form is submitted
    // if(isset($_POST["id"]) && !empty($_POST["id"])){
    if(isset($id) && !empty($id)) {
        // Get hidden input value
        // $id = $_POST["id"];

        // Validate name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
        } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name.";
            header("location: ../../../CRUD_Users/update_user_error.php?id=$id");
        } else{
            $name = $input_name;
        }

        // Validate address address
        $input_password = trim($_POST["password"]);
        if(empty($input_password)){
            $password_err = "Please enter an address.";
        } else{
            $password = $input_password;
        }

        // Validate salary
        $phone = trim($_POST["phone"]);
        $email = trim($_POST["email"]);
        echo $name . " " . $password . " " . $phone . " " . $email;
        // Check input errors before inserting in database
        echo"maybe1";
        if(empty($name_err) && empty($password_err) && empty($phone_err)){
            // Prepare an update statement
            $sql = "UPDATE users SET name=?, password=?, phone=?, email=? WHERE uid=?";
            if($stmt = mysqli_prepare($link, $sql)){
                echo "here brooooo";
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_password, $param_phone, $param_email, $param_id);
                // Set parameters
                $param_name = $name;
                $param_password = $password;
                $param_phone = $phone;
                $param_email = $email;
                $param_id = $id;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    header("location: ../../../CRUD_Users/users_view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                echo "else<br>";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        echo"maybe3";
        // Close connection
        mysqli_close($link);
    } else{
        echo "nope";
        // Check existence of id parameter before processing further
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            // Get URL parameter
            $id =  trim($_GET["id"]);

            // Prepare a select statement
            $sql = "SELECT * FROM employees WHERE id = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                // Set parameters
                $param_id = $id;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
    
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $row1 = json_encode($row, JSON_UNESCAPED_UNICODE);
                        // Retrieve individual field value
                        $name = $row["name"];
                        $address = $row["address"];
                        $salary = $row["salary"];
                    } else{
                        // URL doesn't contain valid id. Redirect to error page
                        header("location: ../error_page.php");
                        exit();
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
            // Close connection
            mysqli_close($link);
        }  else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: ../error_page.php");
            exit();
        }
    }
}

//<!-- Update user end -->

//<!-- Delete user start -->
function delete_user($id) {
    echo $id;
    $pdo = getConnection();
    $req = "DELETE FROM users WHERE uid = '$id'";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $stmt->closeCursor();
}
// <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); 
//<!-- Delete user end -->

////////////////////////////////////////////////////////////////
// COMPanies

//<!-- Create comp start -->
function create_comp() {
    // echo "<br>fuck maybe?";
    require_once "config.php";
    // Define variables and initialize with empty values
    $name = $description = "";
    $name_err = $description_err = "";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name = trim($_POST["name"]);

        $description = trim($_POST["description"]);
        // Check input errors before inserting in database
        if(empty($name_err) && empty($address_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO companies (name, description) VALUES (?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                // echo "<br> sure why not";
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_description);
                // Set parameters
                $param_name = $name;
                $param_description = $description;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    echo "<br>not.....";
                    // Records created successfully. Redirect to landing page
                    header("location: ../../CRUD_Comps/comps_view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);
    }
    // echo "im here";
}
//<!-- Create comp end -->

//<!-- Read comp start -->
function comps_info() {
    $pdo = getConnection();
    $req = "SELECT * FROM companies";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}

function comp_info($id) {
    $pdo = getConnection();
    $req = "SELECT * FROM companies WHERE id = :id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $formations = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($formations);
}
//<!-- Read comp end -->

//<!-- Update comp start -->
function update_comp($id) {
    echo "<br>fuck maybe?";
    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $name = $description = "";
    $name_err = $description_err = "";

    // Processing form data when form is submitted
    // if(isset($_POST["id"]) && !empty($_POST["id"])){
    if(isset($id) && !empty($id)) {
        // Get hidden input value
        // $id = $_POST["id"];
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);

        // Check input errors before inserting in database
        if(empty($name_err) && empty($description_err)){
            // Prepare an update statement
            $sql = "UPDATE companies SET name=?, description=? WHERE id=?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_description, $param_id);
                // Set parameters
                $param_name = $name;
                $param_description = $description;
                $param_id = $id;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    header("location: ../../../CRUD_Comps/comps_view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);
    } else{
        // Check existence of id parameter before processing further
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            // Get URL parameter
            $id =  trim($_GET["id"]);

            // Prepare a select statement
            $sql = "SELECT * FROM companies WHERE id = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                // Set parameters
                $param_id = $id;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
    
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $row1 = json_encode($row, JSON_UNESCAPED_UNICODE);
                        // Retrieve individual field value
                        $name = $row["comp_name"];
                        $address = $row["comp_address"];
                        $salary = $row["budget"];
                    } else{
                        // URL doesn't contain valid id. Redirect to error page
                        header("location: ../error_page.php");
                        exit();
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
            // Close connection
            mysqli_close($link);
        }  else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: ../error_page.php");
            exit();
        }
    }
}

//<!-- Update user end -->

//<!-- Delete user start -->
function delete_comp($id) {
    echo $id;
    $pdo = getConnection();
    $req = "DELETE FROM companies WHERE id = '$id'";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $stmt->closeCursor();
}
// <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); 
//<!-- Delete user end -->


////////////////////////////////////////////////////////////////
// imp functions
function getConnection() {
    return new PDO("mysql:host=localhost;dbname=jobboard;charset=utf8", "root", "");
}

function sendJSON($infos) {
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json");
    echo json_encode($infos, JSON_UNESCAPED_UNICODE);
}
?>