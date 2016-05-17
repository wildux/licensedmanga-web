<?php	
	include('config.php');
	include('dbconnection.php');
	require_once('includes/config.php');
	if(!$user->is_admin()){ header('Location: /index.php'); }
?>

<!DOCTYPE html>
<html>
<head>
<title>Add serie</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap-select.min.js"></script>
	
	<!-- (Optional) Latest compiled and minified JavaScript translation files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>

  
</head>

<body>


<div class="container">	
	
	
	<?php
	
	if(isset($_POST['add'])) {
		$title = $_POST['title'];
        $date = mysqli_real_escape_string($conn, $_POST['date']);                      
                
        $sql = "INSERT INTO announcements (id_serie, day) VALUES ('".$title."', '".$date."')";
         
        if ($conn->query($sql) === TRUE) {
				header('Location: addAnnouncement.php'); 
				exit();
		}		
		else { echo "Error: " . $sql . "<br>" . $conn->error;	}	  
	}	
	else { 
	
	?>
	
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h3>Add Announcement</h3>
		<hr>	
		
		<div class="form-group col-md-6">
		<label for="title">Title:</label>
			<select id="title" name="title" class="selectpicker show-tick show-menu-arrow form-control" data-live-search="true">
			  <?php 
					$sql = "SELECT id,title FROM series ORDER BY title";
					$result = $conn->query($sql);					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row['id']."'>".$row['title']."</option>";
						}
					}
				?>	
			</select>
		</div>
		
			
		<div class="form-group col-md-6">
		  <label for="date">Date:</label>
		  <input type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date" id="date">
		</div>
							
		<button type="submit" name="add" id="add" class="btn btn-default" style="float:right">Submit</button>
				
	</form>	
	
	<?php
	} 
	$conn->close();
	?>
	
	
</div><br><br>
</body>
</html>
