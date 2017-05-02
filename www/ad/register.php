<?php
# import db connection
	include "config/db.php";

	# include functions
	include "config/includes/functions.php";

	# import header
	include "config/includes/header.php";

	# handle form errors
	$errors = [];

	#ensure user clicks the submit button
	if(key_exists('register', $_POST)){

		#VALIDATE FIRST NAME
		if(!empty($_POST['fname'])){
			$fname = $_POST['fname'];
		}else{
			   $errors ['fname'] ="Kindly enter your First Name";
		}

		#VALIDATE LAST NAME
		if(!empty($_POST['lname'])){
			$lname = $_POST['lname'];
		}else{
			   $errors ['lname'] = "Kindly enter your Last Name";
		}

		#VALIDATE EMAIL
		if(!empty($_POST['email'])){
			$email = $_POST['email'];

		   #DO CHECK IF EMAIL EXIST
			$chk = doesEmailExists($dbcon, $email);

			if($chk){
				      $errors ['email'] = "Email already exists";
			}else{
				   $errors ['email'] = "Kindly enter a valid Email";
			}

			#VALIDATE PASSWORD
			if(!empty($_POST['password'])){
				$password = $_POST['password'];
			}else{
				   $error ['password'] = "Kindly enter a password";
			}

			#VALIDATE SECOND PASSWORD
			if(!empty($_POST['pword'])){
				  $pword = $_POST['pword'];
                  #VALIDATE CONFIRM PASSWORD
                  if($password !== $pword){
                  	      $errors['pword'] = "Password mismatch";
                  }
			}else{
				   $errors['pword']	= "Kindly re-enter a password";		
				}

            if(empty($errors)){
            	#SAVE ADMIN TO DB....
            	registerAdmin($dbcon, $fname, $lname, $email, $pword);

            	#REDIRECT TO LOGIN
            	header('Location:login.php');
            }
	}

	?>

	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register" method ="POST" action="register.php" >
			<div>

                <?php display_errors('fname', $errors); ?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
                
                <?php display_errors('lname', $errors); ?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>

			    <?php display_errors('email', $errors); ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>

			    <?php display_errors('password', $errors); ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>

			    <?php display_errors('pword', $errors); ?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account?<a href="login.php">login</a></h4>
	</div>

	<?php

	#import footer
	include "config/includes/footer.php";

    ?>



