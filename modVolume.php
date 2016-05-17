<?php	
	include('config.php');
	include('dbconnection.php');
	require_once('includes/config.php');
	if(!$user->is_admin()){ header('Location: /index.php'); }
?>


<!DOCTYPE html>
<html>
<head>
<title>Modify volume</title>
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
			$id_volume = $_POST['id_volume'];
			$number = $_POST['number'];
			$release_date = $_POST['release_date'];
			$price = $_POST['price'];
			$price_can = $_POST['price_can'];
			$type = $_POST['type'];
			$comments = $_POST['comments'];
			
			$sql = "UPDATE volumes
			SET id_serie='".$id_serie."', number='".$number."', release_date='".$release_date."', price='".$price."', price_can='".$price_can."', type='".$type."', comments='".$comments."'
			WHERE id='".$id_volume."'";
			
			if ($conn->query($sql) === TRUE) {					
					header('Location: serie_info.php?num='.$id_serie);
					exit();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}	
			
		}	
		else { 
			$num = filter_input(INPUT_GET,"num",FILTER_SANITIZE_STRING);
			if (!empty($num) && ctype_digit($num)) {
				
				$sql = "SELECT id_serie,number,release_date,price,price_can,type,comments FROM volumes WHERE id='".$num."'";
				$result = $conn->query($sql);
		
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$number = $row["number"];
					$release_date = $row["release_date"];
					$price = $row["price"];
					$price_can = $row["price_can"];
					$type = $row["type"];
					$comments = $row["comments"];
					$id_serie = $row["id_serie"];
		
		?>
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<h3>Modify volume "<?php echo $number; ?>"</h3>
						<hr>
						<div class="form-group col-md-6">
						  <label for="number">Number:</label>
						  <input type="text" class="form-control" name="number" id="number" value="<?php echo $number; ?>" required>
						</div>	
						
						<div class="form-group col-md-6">
						  <label for="release_date">Release date (yyyy-mm-dd):</label>
						  <input type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="release_date" id="release_date" value="<?php echo $release_date; ?>">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="price">Price (USA):</label>
						  <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
						</div>	
						
						<div class="form-group col-md-6">
						  <label for="price_can">Price (CAN):</label>
						  <input type="text" class="form-control" id="price_can" name="price_can" value="<?php echo $price_can; ?>">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="type">Type:</label>
						  <select class="form-control" id="type" name="type" required>							  
							  <option <?php if($type == '0'){echo("selected='selected'");}?> value="0">Normal volume</option>
							  <option <?php if($type == '1'){echo("selected='selected'");}?> value="1">First volume</option>
							  <option <?php if($type == '2'){echo("selected='selected'");}?> value="2">Last volume</option>
							  <option <?php if($type == '3'){echo("selected='selected'");}?> value="3">Single volume manga</option>
						  </select>
						</div>
						
						<div class="form-group col-md-12">
						  <label for="comments"><br>Comments:</label>
						  <textarea class="form-control" rows="5" id="comments" name="comments" value="<?php echo $comments; ?>"></textarea>
						</div>
						
						<?php
						echo "<input type='hidden' name='id_serie' value='".$id_serie."'>";
						echo "<input type='hidden' name='id_volume' value='".$num."'>";	
						
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
