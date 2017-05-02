<?php

    #display errors inline
    function display_errors($key, $arr){

    	if(key_exists($key,$arr)){
    		echo '<span class="err">'.$arr[$key].'</span>';
    	}
    }

    #register admin into the admin table
    #sf= fname, $l=lname, $e=email, $p=passwoed
    function registerAdmin($dbcon,$f,$l,$e,$p){
    	#prepare statement...
    	$statement = $dbcon->prepare("INSERT INTO admin(firstname,lastname,email,hash)VALUES(:fn, :ln, :em, :hs)");

    	#hash password
    	$hash = password_hash($p, PASSWORD_BCRYPT);

    	#bind params...
    	$data = [':fn'=>$f, ':ln'=>$l, ':em'=>$e, ':hs'=>$hash];
    	$statement->execute($data);
    }

    #AUTHENTICATE ADMIN
    function authenticateAdmin($dbconn, $e, $p){
    	#SET FLAG
    	$rest = true;

    	$stmnt = $dbconn->prepare("SELECT admin_id, email, hash FROM admin  WHERE email=:e");
    	$stmnt->execute([":e" => $e]);

    	#FETCH

    	$rows = $stmnt->fetch(PDO::FETCH_ASSOC);
    	$result = $stmnt->rowCount();

    	#IF THER ARE NO MATCH.....
    	if($result <= 0){
    		$rest = false;
        }
    		if(!password_verify($p, $rows['hash'])){
    			$rest = false;
    		}

    		return [$rest, $rows];
    }

    #check if email exsist
    function doesEmailExists($dbcon,$e){
    	#SET FLAG
    	$result = false;

    	$statement = $dbcon->prepare("SELECT email from admin WHERE email=:e");

    	#bind params
    	#$statements->execute(":e", $e);
    	$statement->execute([':e'=>$e]);

    	#get number of rows returned
    	$count = $statement->rowCount();

    	if($count > 0){
    		$result = true;
    	}

           return $result;

    }
    #ADD TO CATEGORY
    function addCategory($dbcon, $cname){
    	#PREPARE STATEMENT......
    	$statement = $dbcon->prepare("INSERT INTO category(category_name)VALUES (:cat)");
    	$statement->execute([':cat'=>$cname]);
    }

    #DO FILE UPLOAD.....
    function doFileupload($file, $uploaddir){
    	#SET FLAG......
    	$result = false;

    	#generate random number to append file
    	$rnd = rand(000000, 999999);

    	#strip file name for space
    	$strip_name = str_replace(" ", "_", $file['pic']['name']);

        $filename = $rnd.$strip_name;
        $dest = $uploaddir.$filename;

        $bool = move_uploaded_file($file['pic']['tmp_name'], $dest);

        if($bool){
        	$result = true;
        }

        return [$result, $dest];
    }

    #RETRIEVE CATEGORY
    function retrieveCategory($dbcon){
    	#TEMPLATE FOR APPEND.....
    	$template ="";

    	$statement = $dbcon->prepare("SELECT * FROM category");
    	$statement->execute();

    	while ($row = $statement->fetch(PDO::FETCH_BOTH)){ 

    		$template .= '<option value="'.$row[0].'">'. $row[1]. '</option>';
    	}

        return $template;
    }

    #INSERT PRODUCT
    function insertProduct($dbconn, $data){
    	#PREPARE STATEMENT.....
    	$statement = $dbconn->prepare("INSERT INTO product(category_id, product_name, price, image_loc, product_author, description)VALUES (:cat, :pn, :prc, :img_loc, :pauth, :des)");

    	extract($data);

    	#BIND PARAMS.......

    	$val = [':cat' => $cat, ':pn' => $pname, ':prc' => $price, ':img_loc' => $image_loc, ':pauth' => $pauth, ':des' => $desc];

    	//print_r($val);

    	$statement->execute($val);

    }


