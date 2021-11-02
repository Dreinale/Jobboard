<?php
$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "jobboard";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);


if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "select * from users where email='$email'";
    $run = mysqli_query($conn, $query);
    if (mysqli_num_rows($run)>0) {
        $row = mysqli_fetch_array($run);
        $db_email = $row['uid'];
        $token = uniqid(md5(time()));
        $query = "INSERT INTO password_reset (uid, email, token) VALUES(NULL, '$email','$token')";
        if (mysqli_query($conn, $query)) {
            $to = $db_email;
            $subect = "Password reset link";
            $message = "Click <a = href='http://localhost/register/reset.php?token=$token' 
            here</a> to reset your password.";
            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers = 'From: <demo@demo.com>' . "\r\n";
            mail($to, $subject, $message, $headers);
            $msg = "<div class='alert alert-success'>Password reset link has been sent to the email<\div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>User not found<\div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" href="login.css" />
</head>
<body>
	<div class="container">

    <form action="" method="post" class="form" id="login">
     	<h2 class="form__title">Forgot Password</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="form__message form__message--error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        <div class="form__input-group">
			<label>Enter Email</label>
            <input type="email" class="form__input" name="email">
        </div>

     	<button class="form__button" type="submit">Submit</button>

		<p class="form__text">
          <a href="signup.php" class="ca">Don't have an account? Create an account</a>
		</p>
	</form>
	</div>
</body>
</html>