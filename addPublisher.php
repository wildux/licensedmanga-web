<?php	
	include('config.php');
	include('dbconnection.php');
	require_once('includes/config.php');
	if(!$user->is_admin()){ header('Location: /index.php'); }
?>

<!DOCTYPE html>
<html>
<head>
<title>Add publisher</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">	
	
	
	<?php
	
	if(isset($_POST['update'])) {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
        $year = $_POST['year'];
        $web = mysqli_real_escape_string($conn, $_POST['web']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $type = $_POST['type'];
        $state = $_POST['state'];
        $comments = mysqli_real_escape_string($conn, $_POST['comments']);
        
        $sql = "INSERT INTO publishers (id, name, year, web, location, original, state, comments) VALUES (NULL, '".$name."', '".$year."-00-00', '".$web."', '".$location."', '".$type."', '".$state."', '".$comments."')";
        
        if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				header('Location: addPublisher.php');
				exit();
		} 
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}	
	else { 
	
	?>
	
	
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h3>Add Publisher</h3>
		<hr>
		<div class="form-group col-md-6">
		  <label for="name">Name:</label>
		  <input type="text" class="form-control" name="name" id="name" required>
		</div>
		<div class="form-group col-md-6">
		  <label for="year">Fundation:</label>
		  <input type="text" pattern="\d{4}" class="form-control" name="year" id="year">
		</div>
		<div class="form-group col-md-6">
		  <label for="web">Web:</label>
		  <input type="url" class="form-control" id="web" name="web">
		</div>	
		<div class="form-group col-md-6">
		  <label for="location">Location:</label>
		  <input type="text" class="form-control" id="location" name="location">
		</div>			
		
		<div class="form-group col-md-6">
		  <label for="type">Type:</label>
		  <select class="form-control" id="type" name="type">
			  <option value="0">English publisher</option>
			  <option value="1">Original publisher</option>
		  </select>
		</div>
		
		<div class="form-group col-md-6">
		  <label for="state">State:</label>
		  <select class="form-control" id="state" name="state">
			  <option value="1">Active</option>
			  <option value="0">Defunct</option>
			  <option value="2">Unknown</option>
		  </select>
		</div>		
		
		<div class="form-group col-md-12">
		  <label for="comments"><br>Comments:</label>
		  <textarea class="form-control" rows="5" id="comments" name="comments"></textarea>
		</div>
		<button type="submit" name="update" id="update" class="btn btn-default" style="float:right">Submit</button>
	</form>	
	<?php
	} 
	$conn->close();
	?>
	
	
</div>
	
</body>


</html>
