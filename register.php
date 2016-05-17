<?php //include config
require_once('includes/config.php');

/*
* 
* AFEGIR CSS
* ERRORS MACOS
* 
* 
*/ 

//if logged in, redirect to index
if($user->is_logged_in()){ header('Location: index.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
</head>
<body>

<div id="wrapper">

	<h2>Register</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username =='') $error[] = 'Please enter the username.';
		if($password =='') $error[] = 'Please enter the password.';
		if($passwordConfirm =='') $error[] = 'Please confirm the password.';
		if($password != $passwordConfirm) $error[] = 'Passwords do not match.';
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $error[] = 'Please enter a valid email address.';
		
		
		// CHECK IF USER ALREADY EXISTS
        $query = "SELECT 1 FROM blog_members WHERE username = :username";                
        $query_params = array(':username' => $username);          
        try 
        {            
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { die("Failed to run query."); }          
        
        $row = $stmt->fetch();         
        if($row) $error[] = "This username is already in use";  
         
        // CHECK IF MAIL ALREADY EXISTS 
        $query = "SELECT 1 FROM blog_members WHERE email = :email";         
        $query_params = array(':email' => $email); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { die("Failed to run query."); } 
         
        $row = $stmt->fetch();          
        if($row) $error[] = "This email address is already registered"; 
			
		
		// CHECK ERRORS
		if(!isset($error)){

			$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)') ;
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email
				));

				//redirect to index page
				//header('Location: users.php?action=added');
				header('Location: index.php');
				exit;

			} catch(PDOException $e) { echo $e->getMessage(); }

		}

	}

	// SHOW ERRORS
	if(isset($error)) {
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Username</label><br />
		<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Password</label><br />
		<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>

		<p><label>Email</label><br />
		<input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>
		
		<p><input type='submit' name='submit' value='Add User'></p>

	</form>

</div>
