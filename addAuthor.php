<?php	
	include('config.php');
	include('dbconnection.php');
	require_once('includes/config.php');
	if(!$user->is_admin()){ header('Location: /index.php'); }
?>

<!DOCTYPE html>
<html>
<head>
<title>Add author</title>
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
        $date = $_POST['date'];
        $place = mysqli_real_escape_string($conn, $_POST['place']);       
        $gender = $_POST['gender'];
        $comments = mysqli_real_escape_string($conn, $_POST['comments']);
        
        $sql = "INSERT INTO authors (id, name, date, place, gender, comments) VALUES (NULL, '".$name."', '".$date."', '".$place."', '".$gender."', '".$comments."')";
        
        if ($conn->query($sql) === TRUE) {
				//echo "New record created successfully";
				header('Location: addAuthor.php');
				exit();
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}	
	else { 
	
	?>
	
	
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h3>Add Author</h3>
		<hr>
		<div class="form-group col-md-6">
		  <label for="name">Name:</label>
		  <input type="text" class="form-control" name="name" id="name" required>
		</div>
		
		<div class="form-group col-md-6">
		  <label for="gender">Gender:</label>
		  <select class="form-control" id="gender" name="gender">
			  <option value="Unknown">Unknown</option>
			  <option value="Male">Male</option>
			  <option value="Female">Female</option>			  			  
			  <option value="Others">Others</option>
		  </select>
		</div>
		
		<div class="form-group col-md-6">
		  <label for="date">Birth Date (yyyy-mm-dd):</label>
		  <input type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date" id="date">
		</div>
		<div class="form-group col-md-6">
		  <label for="place">Birth place:</label>
		  <input type="text" class="form-control" id="place" name="place">
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
