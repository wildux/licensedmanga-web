<?php //include config
require_once('includes/config.php');


/*
 * FER COMPROVACIONS USERNAME/EMAIL
 * AFEGIR CSS
 * ERRORS MACOS
 * 
 * 
 */
 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit account</title>
</head>
<body>

<div id="wrapper">	

	<h2>Edit account</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username =='') $error[] = 'Please enter the username.';
		if( strlen($password) > 0) {
			if($password =='') $error[] = 'Please enter the password.';
			if($passwordConfirm =='') $error[] = 'Please confirm the password.';
			if($password != $passwordConfirm) $error[] = 'Passwords do not match.';
		}
		if($email =='') $error[] = 'Please enter the email address.';

		if(!isset($error)){

			try {

				if(strlen($password) > 0) {

					$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

					//update into database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, password = :password, email = :email WHERE id = :id') ;
					$stmt->execute(array(
						':username' => $username,
						':password' => $hashedpassword,
						':email' => $email,
						':id' => $id
					));


				} else {

					//update database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, email = :email WHERE id = :id') ;
					$stmt->execute(array(
						':username' => $username,
						':email' => $email,
						':id' => $id
					));

				}
				$_SESSION['user']['username'] = $username;
				$_SESSION['user']['email'] = $email;
				header('Location: index.php'); // MISSATGE OK
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {
			$stmt = $db->prepare('SELECT id, username, email FROM blog_members WHERE id = :id') ;
			$stmt->execute(array(':id' => $_SESSION['user']['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='id' value='<?php echo $row['id'];?>'>

		<p><label>Username</label><br />
		<input type='text' name='username' value='<?php echo $row['username'];?>'></p>

		<p><label>Password (only to change)</label><br />
		<input type='password' name='password' value=''></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' value=''></p>

		<p><label>Email</label><br />
		<input type='text' name='email' value='<?php echo $row['email'];?>'></p>

		<p><input type='submit' name='submit' value='Update User'></p>

	</form>

</div>

</body>
</html>	
