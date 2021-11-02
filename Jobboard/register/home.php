<?php 
session_start();

if ($_SESSION['uid'] && $_SESSION['name']) {

?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<body>
     <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
     <a href="logout.php">Logout</a>
</body>
</html>

<?php 
} else {
     header("Location: index.php");
     exit();
}
?>