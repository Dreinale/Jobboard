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
          <label>Status</label>
          <input class="form-check-input" type="radio" name="status" id="seeker" value=1 onClick="validateRadio1();" checked>
          <label class="form-check-label" for="seeker">
          seeker
          </label>
          <input class="form-check-input" type="radio" name="status" id="company" value=2 onClick="validateRadio();">
          <label class="form-check-label" for="company" id="company1">
          company
          </label>
          </div>


          <script>
               function validateRadio() {
                    var d1 = document.getElementById('company1');
                    d1.insertAdjacentHTML('afterend', '<div id="com" class="form__input-group"> <br><label>Name of the company</label> <input type="text" name="name_com" id="signupUsername" class="form__input" autofocus placeholder="Company name"><br> <label>Desctiption of your company</label> <textarea class="form__input" type="text" placeholder="Description of your company" name="description_com"></textarea></div>');
               }
               function validateRadio1() {
                    var el = document.getElementById('com');
                    el.remove();
               }
          </script>

          <div class="form__input-group">
               <label>Phone number</label>
               <input class="form-check-input" type="tel" placeholder="0623133087" name="phone" minlength="10"
               maxlength="10" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
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