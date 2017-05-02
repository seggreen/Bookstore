<?php
    session_start();
    
    #title.....
    $title = "add_category";

    # import db connection
	include "config/db.php";

	# include functions
	include "config/includes/functions.php";

	# import header
	include "config/includes/header.php";

	# handle form errors
	$errors = [];

    #VALIDATION
	if(key_exists('add_cat', $_POST)){
		#VALIDATE CATEGORY
		if(empty($_POST['category'])) {
			$errors['category'] = "KIndly add a category";
		}

		if(empty($errors)){
			#add category
			addcategory($dbcon, $_POST['category']);
			#redirect...
			header("Location: add_category.php");
		}

	}

?>
	     
	     <div class="wrapper">
		<div id="stream">
			<h1 id="register-label">Add Category</h1>
			<hr>

			<form id="register" method="POST">
			<div>
				<?php display_errors('category', $errors); ?>
				<label>category name:</label>
				<input type="text" name="category" placeholder="category name">
			</div>

			<input type="submit" name="add_cat" value="add">

			</form>
		</div>
	</div>


<?php 
#import footer 
include "config/includes/footer.php"; ?>

