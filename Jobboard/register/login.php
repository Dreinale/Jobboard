<?php 

session_start(); 
include "db_conn.php";

if (isset($_POST['name']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validate($_POST['name']);
	$pass = validate($_POST['password']);

	if (empty($name)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	} else if(empty($pass)) {
        header("Location: index.php?error=Password is required");
	    exit();
	} else {
        $pass = md5($pass);

		$sql = "SELECT * FROM users WHERE name='$name' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['name'] === $name && $row['password'] === $pass) {
            	$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['phone'] = $row['phone'];
				$_SESSION['status'] = $row['status'];
            	$_SESSION['uid'] = $row['uid'];
            	header("Location: ../");
		        exit();
            } else {
				header("Location: index.php?error=Incorect name or password");
		        exit();
			}
		} else {
			header("Location: index.php?error=Incorect name or password");
	        exit();
		}
	}
	
} else {
	header("Location: index.php");
	exit();
}