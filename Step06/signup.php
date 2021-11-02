<!DOCTYPE html>
<html>
<head>
	<title>Create an account</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
     <div class="container">
     <form action="signup-check.php" method="post" class="form" id="signup">
     	<h2 class="form__title">SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="form__message form__message--error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="form__message--success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <div class="form__input-group">
          <label>Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" name="name" 
               id="signupUsername" class="form__input" autofocus placeholder="Name" 
               value="<?php echo $_GET['name']; ?>"><br>
          <?php } else { ?>
               <input type="text" name="name" id="signupUsername" class="form__input" autofocus placeholder="Name"><br>
          <?php }?>
          </div>

          <div class="form__input-group">
          <label>Email</label>
          <?php if (isset($_GET['email'])) { ?>
               <input type="email" name="email" 
               id="signupUsername" class="form__input" autofocus placeholder="Email" 
               value="<?php echo $_GET['email']; ?>"><br>
          <?php } else { ?>
               <input type="email" name="email" id="signupUsername" class="form__input" autofocus placeholder="Email"><br>
          <?php }?>
          </div>

          <div class="form__input-group">
          <label>Username</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" name="uname" 
                      id="signupUsername" class="form__input" autofocus placeholder="Username"
                       value="<?php echo $_GET['uname']; ?>"><br>
          <?php } else { ?>
               <input type="text" name="uname" id="signupUsername" class="form__input" autofocus placeholder="Username"><br>
          <?php }?>
          </div>

          <div class="form__input-group">
     	<label>Password</label>
     	<input type="password" name="password" class="form__input" autofocus placeholder="Password"><br>
          </div>

          <div class="form__input-group">
          <label>Confirm Password</label>
          <input type="password" name="re_password" class="form__input" autofocus placeholder="Confirm password"><br>
          </div>


     	<button class="form__button" type="submit">Sign Up</button>
          <p class="form__text">
               <a class="form__link" href="index.php">Already have an account?</a>
          </p>

     </form>
     </div>
</body>
</html>