<?php
    session_start();
# import db connection
	include "config/db.php";

	# include functions
	include "config/includes/functions.php";

	# import header
	include "config/includes/header.php";

	# handle form errors
	$errors = [];

	#ENSURE ADMIN CLICKS LOGIN BUTTON
	if(key_exists('login', $_POST)){

		#VALIDATE EMAIL
		if(empty($_POST['email'])){
			   $errors['email'] = "Kindly enter an email";
	    }

		#VALIDATE PASSWORD
		if(empty($_POST['password'])){
			  $errors['password'] = "Kindly enter your password";
	    }

	    #ATTEMPT TO LOG ADMIN IN......
	    $chk = authenticateAdmin($dbcon, $_POST['email'], $_POST['password']);

	    if($chk[0] == false) {

	    	 $errors['email'] = "Either password or email is in-correct!";
	    }

	    if(empty($errors)){

            $data = $chk[1];

            $_SESSION['admin_id'] = $data['admin_id'];

            #REDIRECT.....
            header('Location: add_product.php');
	    }
    }

  ?>

	
	<div class="wrapper">
		<h1 id="login-label">Admin Login</h1>
		<hr>
		<form id = "login" method="POST" action="login.php">
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
			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

	<?php
	#import footer
	include "config/includes/footer.php";
    ?>

