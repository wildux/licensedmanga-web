<?php	
	include('config.php');
	include('dbconnection.php');
	require_once('includes/config.php');
	if(!$user->is_admin()){ header('Location: /index.php'); }
?>


<!DOCTYPE html>
<html>
<head>
<title>Add volume</title>
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
			$id_serie = $_POST['id_serie'];		
			$number = mysqli_real_escape_string($conn, $_POST['number']);
			$release_date = $_POST['release_date'];
			$price = mysqli_real_escape_string($conn, $_POST['price']);
			$price_can = mysqli_real_escape_string($conn, $_POST['price_can']);
			$type = $_POST['type'];
			$comments = mysqli_real_escape_string($conn, $_POST['comments']);
			
			$sql = "INSERT INTO volumes (id, id_serie, number, release_date, price, price_can, type, comments) VALUES (NULL, '".$id_serie."', '".$number."', '".$release_date."', '".$price."', '".$price_can."', '".$type."', '".$comments."')";
			
			if ($conn->query($sql) === TRUE) {
					//header('Location: addVolume.php?num='.$id_serie);
					header('Location: serie_info.php?num='.$id_serie);
					exit();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}		
		}	
		else { 
			$num = filter_input(INPUT_GET,"num",FILTER_SANITIZE_STRING);
			if (!empty($num) && ctype_digit($num)) {
				
				$sql = "SELECT title FROM series WHERE id='".$num."'";
				$result = $conn->query($sql);
		
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$title = $row["title"];
		
		?>
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<h3>Add volume to "<?php echo $title; ?>"</h3>
						<hr>
						<div class="form-group col-md-6">
						  <label for="number">Number:</label>
						  <input type="text" class="form-control" name="number" id="number" required>
						</div>	
						
						<div class="form-group col-md-6">
						  <label for="release_date">Release date (yyyy-mm-dd):</label>
						  <input type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="release_date" id="release_date">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="price">Price (USA):</label>
						  <input type="text" class="form-control" id="price" name="price">
						</div>	
						
						<div class="form-group col-md-6">
						  <label for="price_can">Price (CAN):</label>
						  <input type="text" class="form-control" id="price_can" name="price_can">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="type">Type:</label>
						  <select class="form-control" id="type" name="type">
							  <option value="0">Normal volume</option>
							  <option value="1">First volume</option>
							  <option value="2">Last volume</option>
							  <option value="3">Single volume manga</option>
						  </select>
						</div>
						
						<div class="form-group col-md-12">
						  <label for="comments"><br>Comments:</label>
						  <textarea class="form-control" rows="5" id="comments" name="comments"></textarea>
						</div>
						
						<?php
						echo "<input type='hidden' name='id_serie' value='".$num."'>";
						?>
						
						<button type="submit" name="update" id="update" class="btn btn-default" style="float:right">Submit</button>
					</form>	
	<?php
				}
				else echo "<p>Serie not found.</p>"; 
			}
		else echo "<p>Wrong id format.</p>"; 
	  }		
	$conn->close();
	?>
	
	
</div>
	
</body>


</html>
