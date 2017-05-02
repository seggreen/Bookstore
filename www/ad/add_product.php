<?php
      session_start();

	# title...
	$title = "add products";

	# import db connection
	include "config/db.php";

	# include functions
	include "config/includes/functions.php";

	# import header
	include "config/includes/dashboard_header.php";

	#ERROR.....
	$errors = [];

	#MAX FILE SIZE
	define("MAX_FILE_SIZE", "2097152");

	#ALLOWED DOWNLOAD EXTENSION...
	$text = ["image/png", "image/jpeg,", "image/jpg"];

    #VALIDATION........
    if(key_exists('addProduct', $_POST)){

    	#VALIDATE PRODUCT NAME FIELDS......
    	if(empty($_POST['pname'])){
    		$errors['pname'] = "Kindly enter Product name";
    	}
      
        #VALIDATE PRODUCT AUTHOR FIELDS........
    	if(empty($_POST['pauth'])){
    		$errors['pauth'] = "Kindly enter product author";
    	}

    	#VALIDATE PRODUCT CATEGORY........
    	if(empty($_POST['cat'])){
    		$errors['cat'] = "Kindly select category";

    	}

        #VALIDATE PRODUCT DESCRIPTTION........
    	if(empty($_POST['desc'])){
    		$errors['desc'] = "Kindly enter Product Description";
    	}

        #VALIDATE PRODUCT PRICE..........
    	if(empty($_POST['price'])){
    		$errors['price'] = "Kindly enter Product price";
    	}

        #CHEK IF PIC FILE WAS UPLOADED.........
    	if(empty($_FILES['pic']['name'])){
    		$errors['pic'] = "Kindly choose image";
    	}

    	#CHK FOR FILE SIZE......
    	if($_FILES['pic']['size'] > MAX_FILE_SIZE){
    		$errors['pic'] = "exceed maximun file size: " . MAX_FILE_SIZE;
    	}

    	if(empty($errors)){
    		#UPLOAD FILE.......
    		$func = doFileupload($_FILES, 'uploads/');

    	    if($func[0]){
                
                $clean = array_map('trim', $_POST);
                $clean['image_loc'] = $func[1];

                insertproduct($dbcon, $clean);
    	    }

            
    	}


    }
?>

     <div class="wrapper">
		<div id="stream">
			<h1 id="register-label">Add Product</h1>
			<hr>

			<form id="register" method="POST" enctype="multipart/form-data">
			<div>
			    <?php display_errors('pname', $errors); ?>
				<label>Name</label>
				<input type="text" name="pname" placeholder="product name">
			</div>
			<div>
			    <?php display_errors('pauth', $errors); ?>
				<label>Author</label>
				<input type="text" name="pauth" placeholder="product author">
			</div>
			<div>
			    <?php display_errors('cat', $errors); ?>
				<label>select category</label>
				<select name="cat">
					<?php echo retrieveCategory($dbcon); ?>
				</select>

			</div>
			<div>
			    <?php display_errors('desc', $errors); ?>
				<label>Description:</label>
				<textarea placeholder="content" name="desc" class="post-box"></textarea>
			</div>
			<div>
			    <?php display_errors('price', $errors); ?>
				<label>Price</label>
				<input type="text" name="price" placeholder="price">
			</div>

			<div>
			    <?php display_errors('', $errors); ?>
				<label>image</label>
				<input type="file" name="pic">
			</div>

			<input type="submit" name="addProduct" value="add product">

			</form>
		</div>
	</div>

#import footer

<?php include "config/includes/footer.php"; ?>

