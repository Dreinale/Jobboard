<!DOCTYPE html>
<html>
<head>
	<title>Connection</title>
	<link rel="stylesheet" href="login.css" />
</head>
<body>
	<div class="container">

    <form action="login.php" method="post" class="form" id="login">
     	<h2 class="form__title">LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="form__message form__message--error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        <div class="form__input-group">
			<label>Name</label>
            <input type="text" class="form__input" name="name" autofocus placeholder="Name">
        </div>
        <div class="form__input-group">
			<label>Password</label>
            <input type="password" class="form__input" name="password" autofocus placeholder="Password">
        </div>

     	<button class="form__button" type="submit">Login</button>
		<p class="form__text">
                    <a href="forget-password.php" class="form__link">Forgot your password?</a>
                </p>
		<p class="form__text">

          <a href="signup.php" class="ca">Don't have an account? Create an account</a>
		  </p>
	</form>
	</div>
</body>
</html>