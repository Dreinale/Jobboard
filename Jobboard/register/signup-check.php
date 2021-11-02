<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['password']) && isset($_POST['name']) 
	&& isset($_POST['re_password']) && isset($_POST['email'])
	&& isset($_POST['status']) && isset($_POST['phone'])
	&& isset($_POST['name_com']) && isset($_POST['description_com'])) {

		//fonction pour prendre la bonne data
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	//création des variables
	$name = validate($_POST['name']);
	$pass = validate($_POST['password']);
	$re_pass = validate($_POST['re_password']);
	$email = validate($_POST['email']);
	$phone = validate($_POST['phone']);
	$status = validate($_POST['status']);
	$name_com = validate($_POST['name_com']);
	$description_com = validate($_POST['description_com']);
	
	$user_data = '&name='. $name. '&email='. $email;

	// Gestion d'erreur si c'est vide
	if (empty($name)) {
		header("Location: signup.php?error=Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=you need to Confirm the Password&$user_data");
	    exit();
	}
	else if(empty($email)){
        header("Location: signup.php?error=Email is required&$user_data");
	    exit();
	}
	else if(empty($phone)){
        header("Location: signup.php?error=Phone is required&$user_data");
	    exit();
	}
	else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{
		//encodage en md5 du password
        $pass = md5($pass);

		//prend les données SQL en fonction du nom de l'user
	    $sql = "SELECT * FROM users WHERE name='$name' ";
		$result = mysqli_query($conn, $sql);

		//renvoie une erreur si on met un name deja existant
		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The name is taken try another&$user_data");
	        exit();
		}else {
			//on envoie les données à la db
           $sql2 = "INSERT INTO users(password, name, email, status, phone, name_com, description_com)
		    VALUES('$pass', '$name', '$email', '$status', '$phone', '$name_com', '$description_com')";
           $result2 = mysqli_query($conn, $sql2);
		   
		   $sql3 = "INSERT INTO companies(name, description)
		   VALUES('$name_com', '$description_com')";
		   $result3 = mysqli_query($conn, $sql3);
		  
           if ($result2) {
			   header("Location: index.php?success=Your account has been created successfully");
	         	exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
} else {
	header("Location: signup.php");
	exit();
}