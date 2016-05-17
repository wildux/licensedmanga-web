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
	
	
	<?php //MODIFICAR PER SERIE
	
	if(isset($_POST['update'])) {
		$title = mysqli_real_escape_string($conn, $_POST['title']);
        $original_title = mysqli_real_escape_string($conn, $_POST['original_title']);
        $writers = $_POST['writers'];
        $artists = $_POST['artists'];
        $e_publ = $_POST['e_publ'];
        $o_publ = $_POST['o_publ'];
        $volumes = $_POST['volumes'];
        $edition = mysqli_real_escape_string($conn, $_POST['edition']);
        $type = $_POST['type'];
        $categories = $_POST['categories'];
        $synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']);       
        $year = $_POST['year'];
        $orig_status = $_POST['orig_status'];
        $status = $_POST['status'];        
                    
		$cat = "";
		  
		if(!empty($categories))
		{
			$N = count($categories);
			for($i = 0; $i < $N; $i++)
			{
				if ($i == 0) $cat = $categories[$i];
				else $cat = $cat.",".$categories[$i];			  
			}
		}
        
        $sql = "INSERT INTO series (id, title, orig_title, publisher_id, orig_publisher_id, year, orig_num, edition, description, type, tags, orig_state, state) 
        VALUES (NULL, '".$title."', '".$original_title."', '".$e_publ."', '".$o_publ."', '".$year."', '".$volumes."', '".$edition."',
         '".$synopsis."', '".$type."', '".$cat."', '".$orig_status."', '".$status."')";
         
        if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				//header('Location: addSerie.php');				
				$serie_id = mysqli_insert_id($conn);
				$error_sql = false;
								
				foreach($writers as $writer) {					
					$sql = "INSERT INTO SeriesWriters (id_serie, id_writer) VALUES ('".$serie_id."', '".$writer."')";
					if ($conn->query($sql) === TRUE) { echo "New record (writer) created successfully"; }
					else {
						echo "Error (writer): " . $sql . "<br>" . $conn->error; 
						$error_sql = true;
					}
				}
				foreach($artists as $artist) {					
					$sql = "INSERT INTO SeriesArtists (id_serie, id_artist) VALUES ('".$serie_id."', '".$artist."')";
					if ($conn->query($sql) === TRUE) { echo "New record (artist) created successfully"; }
					else { 
						echo "Error (artist): " . $sql . "<br>" . $conn->error; 
						$error_sql = true;
					}	
				}
				if(!$error_sql) { header('Location: addSerie.php'); exit();}
		}
		else { echo "Error: " . $sql . "<br>" . $conn->error;	}	  
	}	
	else { 
	
	?>
	
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h3>Add Serie</h3>
		<hr>
		<div class="form-group col-md-6">
		  <label for="title">Title:</label>
		  <input type="text" class="form-control" id="title" name="title">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="original_title">Original title:</label>
		  <input type="text" class="form-control" id="original_title" name="original_title">
		</div>
		
		<div class="form-group col-md-6">
		<label for="writers">Writer/s:</label>
			<select id="writers" name="writers[]" class="selectpicker show-tick show-menu-arrow form-control" data-live-search="true" multiple>
			  <?php 
					$sql = "SELECT id,name FROM authors ORDER BY name";
					$result = $conn->query($sql);					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row['id']."'>".$row['name']."</option>";
						}
					}
				?>	
			</select>
		</div>
		
		<div class="form-group col-md-6">
		<label for="artists">Artist/s:</label>
			<select id="artists" name="artists[]" class="selectpicker show-tick show-menu-arrow form-control" data-live-search="true" multiple>
			  <?php 
					$sql = "SELECT id,name FROM authors ORDER BY name";
					$result = $conn->query($sql);					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row['id']."'>".$row['name']."</option>";
						}
					}
				?>	
			</select>
		</div>
		
		<div class="form-group col-md-6">
		<label for="e_publ">English publisher:</label>
			<select id="e_publ" name="e_publ" class="selectpicker show-menu-arrow form-control" data-live-search="true">
			  <?php 
					$sql = "SELECT id,name FROM publishers WHERE original='0' ORDER BY name";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row['id']."'>".$row['name']."</option>";
						}
					}
				?>	
			</select>
		</div>
		
		<div class="form-group col-md-6">
		<label for="o_publ">Original publisher:</label>
			<select id="o_publ" name="o_publ" class="selectpicker show-menu-arrow form-control" data-live-search="true">
				<?php 
					$sql = "SELECT id,name FROM publishers WHERE original='1' ORDER BY name";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value='".$row['id']."'>".$row['name']."</option>";
						}
					}
				?>			  
			</select>
		</div>	
				
		<div class="form-group col-md-6">
		  <label for="type">Type:</label>
		  <select class="selectpicker show-menu-arrow form-control" id="type" name="type">			  
			  <option value="1">Shojo</option>
			  <option value="2">Josei</option>
			  <option value="3">Shonen</option>
			  <option value="4">Seinen</option>
			  <option value="5">Kodomo</option>
			  <option value="6">Yuri</option>
			  <option value="7">BL (yaoi)</option>
			  <option value="8">Manhua</option>
			  <option value="9">Manwha</option>	
			  <option value="10">Light novel</option>		  
			  <option value="11">Hentai</option>
			  <option value="12">Artbook</option>	
			  <option value="13">International</option>		  
			  <option value="14">Other</option>
	      </select>
		</div>
		
		<div class="form-group col-md-6">
		  <label for="year">Year:</label>
		  <input type="text" class="form-control" id="year" name="year">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="orig_status">Status (origin):</label>
		  <select class="selectpicker show-menu-arrow form-control" id="orig_status" name="orig_status">
			  <option value="1">Ongoing</option>
			  <option value="2">Completed</option>			  
			  <option value="3">Hiatus</option>
			  <option value="4">Dropped</option>
			  <option value="0">Unknown</option>
			  
	      </select>
		</div>
		
		<div class="form-group col-md-6">
		  <label for="status">Status (english):</label>
		  <select class="selectpicker show-menu-arrow form-control" id="status" name="status">
			  <option value="1">Ongoing</option>
			  <option value="2">Completed</option>			  
			  <option value="3">Hiatus</option>
			  <option value="4">Dropped</option>
			  <option value="5">Incomplete (origin)</option>
			  <option value="0">Unknown</option>
			  
	      </select>
		</div>
		
		<div class="form-group col-md-6">
		  <label for="volumes">Volumes (origin):</label>
		  <input type="number" min="0" class="form-control" id="volumes" name="volumes">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="edition">Edition (Single volumes, Omnibus, etc):</label>
		  <input type="text" class="form-control" id="edition" name="edition">
		</div>
			
		<div class="form-group col-md-12">
		<label for="categories">Categories:</label>
		<div class="control-group col-md-12" id="categories">				
			<div class="controls col-md-3">
				<label class="checkbox"><input type="checkbox" value="Action" id="inlineCheckbox1" name="categories[]"> Action</label>
				<label class="checkbox"><input type="checkbox" value="Adaptation" id="inlineCheckbox2" name="categories[]"> Adaptation</label>
				<label class="checkbox"><input type="checkbox" value="Adult" id="inlineCheckbox3" name="categories[]"> Adult</label>
				<label class="checkbox"><input type="checkbox" value="Adventure" id="inlineCheckbox4" name="categories[]"> Adventure</label>
				<label class="checkbox"><input type="checkbox" value="Comedy" id="inlineCheckbox5" name="categories[]"> Comedy</label>
				<label class="checkbox"><input type="checkbox" value="Documental" id="inlineCheckbox6" name="categories[]"> Documental</label>
			</div>
			<div class="controls col-md-3">
				<label class="checkbox"><input type="checkbox" value="Drama" id="inlineCheckbox1" name="categories[]"> Drama</label>
				<label class="checkbox"><input type="checkbox" value="Ecchi/Fanservice" id="inlineCheckbox2" name="categories[]"> Ecchi/Fanservice</label>
				<label class="checkbox"><input type="checkbox" value="Fantasy" id="inlineCheckbox3" name="categories[]"> Fantasy</label>
				<label class="checkbox"><input type="checkbox" value="Gore" id="inlineCheckbox4" name="categories[]"> Gore</label>
				<label class="checkbox"><input type="checkbox" value="Harem" id="inlineCheckbox5" name="categories[]"> Harem</label>
				<label class="checkbox"><input type="checkbox" value="Historical" id="inlineCheckbox6" name="categories[]"> Historical</label>
				
			</div>
			<div class="controls col-md-3">
				<label class="checkbox"><input type="checkbox" value="Horror" id="inlineCheckbox1" name="categories[]"> Horror</label>
				<label class="checkbox"><input type="checkbox" value="Military" id="inlineCheckbox2" name="categories[]"> Military</label>
				<label class="checkbox"><input type="checkbox" value="Mistery" id="inlineCheckbox3" name="categories[]"> Mistery</label>
				<label class="checkbox"><input type="checkbox" value="Psychological" id="inlineCheckbox4" name="categories[]"> Psychological</label>
				<label class="checkbox"><input type="checkbox" value="Romance" id="inlineCheckbox5" name="categories[]"> Romance</label>
				<label class="checkbox"><input type="checkbox" value="School Life" id="inlineCheckbox6" name="categories[]"> School Life</label>
				
			</div>
			<div class="controls col-md-3">
				<label class="checkbox"><input type="checkbox" value="Sci-Fi" id="inlineCheckbox1" name="categories[]"> Sci-Fi</label>
				<label class="checkbox"><input type="checkbox" value="Slice of Life" id="inlineCheckbox2" name="categories[]"> Slice of Life</label>
				<label class="checkbox"><input type="checkbox" value="Sports" id="inlineCheckbox3" name="categories[]"> Sports</label>
				<label class="checkbox"><input type="checkbox" value="Supernatural" id="inlineCheckbox4" name="categories[]"> Supernatural</label>
				<label class="checkbox"><input type="checkbox" value="Tragedy" id="inlineCheckbox5" name="categories[]"> Tragedy</label>
				<label class="checkbox"><input type="checkbox" value="Videogames" id="inlineCheckbox6" name="categories[]"> Videogames</label>				
			</div>
		</div>
		</div>
			
		
		<div class="form-group col-md-12">		
		  <label for="synopsis">Synopsis:</label>
		  <textarea class="form-control" rows="5" id="synopsis" name="synopsis"></textarea>
		</div>
		
		<button type="submit" name="update" id="update" class="btn btn-default" style="float:right">Submit</button>
				
	</form>	
	
	<?php
	} 
	$conn->close();
	?>
	
	
</div>
	<br><br>
</body>
</html>
