<?php		
	include('manga_types.php');
	require_once('includes/config.php');
	
	$num = filter_input(INPUT_GET,"num",FILTER_SANITIZE_STRING);
	if (!empty($num) && ctype_digit($num))
	{
		$result = $db->prepare("SELECT * FROM series WHERE id=:id");
		$result->execute(array(':id' => $num));
		
		if ($result->rowCount() > 0) {	
			$row = $result->Fetch();
			
			$title = $row["title"];
			$orig_title = $row["orig_title"];
			$publisher_id = $row["publisher_id"]; 
			$orig_publisher_id = $row["orig_publisher_id"]; 
			$year = $row["year"];
			if ($year == null) $year = "Unknown";
			$orig_num = $row["orig_num"];
			$edition = $row["edition"];
			$description = nl2br(htmlspecialchars($row["description"]));
			$type = $row["type"];
			$tags = $row["tags"];
			$orig_state = $row["orig_state"];
			$state = $row["state"];
		}
		else $title = "Serie not found";
	}
	else $title = "Wrong id format";
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- METADATA --> 
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $description; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta http-equiv="cleartype" content="on"> 
    
  <!-- CSS/JAVASCRIPT -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/mangatypes.css">
  <link rel="stylesheet" href="/css/general.css">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>  
    
  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/images/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/images/favicon/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/images/favicon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/images/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/images/favicon/manifest.json">
	<link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="/images/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="/images/favicon/mstile-144x144.png">
	<meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "BreadcrumbList",
	  "itemListElement": [{
		"@type": "ListItem",
		"position": 1,
		"item": {
		  "@id": "http://licensedmanga.com/series",
		  "name": "Series"
		}
	  },{
		"@type": "ListItem",
		"position": 2,
		"item": {
		  "@id": "http://licensedmanga.com/series/<?php echo $num; ?>",
		  "name": "<?php echo $title; ?>"
		}
	  }]
	}
	</script>
  
  <style>	  
	 
	@media (max-width: 767px) {
		.portfolio>.clear:nth-child(4n)::before {
		  content: '';
		  display: table;
		  clear: both;
		}
	}
	@media (min-width: 768px) and (max-width: 1199px) {
		.portfolio>.clear:nth-child(8n)::before {
		  content: '';
		  display: table;
		  clear: both;
		}
	}
	@media (min-width: 1200px) {
		.portfolio>.clear:nth-child(12n)::before {  
		  content: '';
		  display: table;
		  clear: both;
		}
	}
	
	#mod {
		font-size: 14px;
		float: right;
		vertical-align: middle;
		line-height: 24px;		
	}
	
  </style>

</head>
<body>
	

<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/blog">
		  <img src="/images/lm2.jpg" width="30px">
	  </a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/blog">Blog</a></li>
      <li><a href="/calendar">Calendar</a></li>
      <li><a href="/series">Series</a></li>
      <li><a href="/authors">Authors</a></li>
      <li><a href="/publishers">Publishers</a></li>
      <li><a href="/announcements">New licenses</a></li>
      <li><a href="/links">Links</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
			<a class="navbar-brand" href="http://twitter.com/licensedmanga"> <img src="/images/twitter.png" width="30px"  > </a>
		<?php		
		if($user->is_logged_in()) 
		{
		?>				
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['username'];?> </a>
          <ul class="dropdown-menu">    
			  <?php if($user->is_admin()) {        ?>
                <li><a href="/addAuthor.php">Add author</a></li>
                <li><a href="/addPublisher.php">Add publisher</a></li>
                <li><a href="/addSerie.php">Add serie</a></li>
                <li><a href="/admin/index.php">Blog administration</a></li>
                <br>
              <?php
				}?>
                <li><a href="/editProfile.php">Change mail/password</a></li>
              
				<div class="container-fluid">
					<br><li><a class="small" href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
				</div> 	
          </ul>
        </li>	
		
		
		
		<?php
		}
		elseif(!empty($_POST['username']) && !empty($_POST['password']))
		{
					$username = trim($_POST['username']);
					$password = trim($_POST['password']);
					
					if($user->login($username,$password)){ 
						header("Location: ".$_SERVER['HTTP_REFERER']); 
						exit;
					} 
					else {
						$_SESSION['error'] = "Wrong username/password. Please try again.";
						header("Location: ".$_SERVER['HTTP_REFERER']); 
						exit;
					} 
		}
		else
		{
			?>
		
				
       <!-- <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li> -->
        
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Login <span class="glyphicon glyphicon-log-in"></span></a>
          <div class="dropdown-menu">
            <form form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form container-fluid">
              <div class="form-group">
                <label for="username">Name:</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <button type="submit" id="login" name="login" class="btn btn-block">Login</button>
            </form>
            <div class="container-fluid">
              <br>
              <a class="small" href="#">Forgot password?</a>
            </div> 	
          </div>
        </li>
        <?php 
        }
        ?>
      </ul>    
  </div>
  
</nav>

	

<div class="container-fluid col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
  
<!-- SHOW ERRORS -->
<?php 
if (!empty($_SESSION['error'])) {	
	echo "<div class='alert alert-danger'>
	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<strong>Error: </strong>".$_SESSION['error']."</div>";
	unset($_SESSION['error']);
}
?>

<?php
	if ($title == "Serie not found") echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Serie not found</strong></div>";
	else if ($title == "Wrong id format") echo "<div class='alert alert-warning'>
	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<strong>Error:</strong> Incorrect id format. Please enter a valid id.</div>";
	else		
	{		
		
			switch ($state) {
				case '1':
					$label = 'success';
					$state = 'Ongoing';
					break;
				case '2':
					$label = 'primary';
					$state = 'Complete';
					break;
				case '3':
					$label = 'default';
					$state = 'Hiatus';
					break;
				case '4':
					$label = 'danger';
					$state = 'Dropped';
					break;
				case '5':
					$label = 'warning';
					$state = 'Incomplete';
					break;
				default:
					$label = 'default';
					$state = 'Unknown';
			}
			
			switch ($orig_state) {
				case '1':
					$orig_label = 'success';
					$orig_state = 'Ongoing';
					break;
				case '2':
					$orig_label = 'primary';
					$orig_state = 'Complete';
					break;
				case '3':
					$orig_label = 'default';
					$orig_state = 'Hiatus';
					break;
				case '4':
					$orig_label = 'danger';
					$orig_state = 'Dropped';
					break;			
				default:
					$orig_label = 'default';
					$orig_state = 'Unknown';
			}
			
			$next = $num+1;	
			$prev = $num-1;
			echo "
			<div itemscope itemtype='http://schema.org/Book' itemid='#serie'>
			<meta itemprop='inLanguage' content='en'>
			<h2><span itemprop='name'>".$title."</span>";
			if($user->is_admin()) echo "<a style='float:right;' href='/series/".$next."' >Next</a><a style='float:right;padding-right:20px;' href='/series/".$prev."' >Previous</a>";
			
			
			echo "</h2><br><ul><li><b>Original title:</b><span itemprop='alternateName'> ".$orig_title."</span></li>";				
			
							
			echo "<li><b>Writer/s:</b> "; 
			$result = $db->prepare("SELECT id,name FROM authors inner join SeriesWriters on authors.id = SeriesWriters.id_writer WHERE SeriesWriters.id_serie=:id ORDER BY name");
			$result->execute(array('id' => $num));			
			if ($result->rowCount() > 0) {
				$first = 1;
				while($row = $result->Fetch()) { 
					$writer = $row["name"];
					echo "<span itemprop='author' itemscope itemtype='http://schema.org/Person' itemid='#author'>
					<link itemprop='sameAs' href='/authors/".$row["id"]."'>
					<meta itemprop='name' content='".$writer."'>";
					if ($first == 1) {
						$first = 0;
						echo "<a href='/authors/".$row["id"]."'>".$writer."</a>";
					}
					else echo ", <a href='/authors/".$row["id"]."'>".$writer."</a>";
					echo "</span>";
					
				}
			}	
			echo "</li>";
			
			echo "<li><b>Artist/s:</b> ";
			$result = $db->prepare("SELECT id,name FROM authors inner join SeriesArtists on authors.id = SeriesArtists.id_artist WHERE SeriesArtists.id_serie=:id ORDER BY name");
			$result->execute(array('id' => $num));		
			if ($result->rowCount() > 0) {
				$first = 1;
				while($row = $result->Fetch()) { 
					$artist = $row["name"];
					echo "<span itemprop='illustrator' itemscope itemtype='http://schema.org/Person' itemid='#illustrator'>
					<link itemprop='sameAs' href='/authors/".$row["id"]."'>
					<meta itemprop='name' content='".$writer."'>";
					if ($first == 1) {
						$first = 0;
						echo "<a href='/authors/".$row["id"]."'>".$artist."</span></a>";
					}
					else echo ", <a href='/authors/".$row["id"]."'>".$artist."</span></a>";
					echo "</span>";
					
				}
			}	
			echo "</li>";
			
			
			if ($year == '0000') $year = "Unknown";
			
			echo "<li><b>Year:</b><span itemprop='dateCreated'> ".$year."</span></li>";
			echo "<li><b>Original volumes:</b> ".$orig_num." <span class='label label-".$orig_label."'>".$orig_state."</li>";
			echo "<li><b>English edition:</b><span itemprop='bookEdition'> ".$edition." </span><span class='label label-".$label."'>".$state."</li>";
						
			$result = $db->prepare("SELECT name,original FROM publishers WHERE id=:id_pub OR id=:id_opub ORDER BY original DESC");
			$result->execute(array('id_pub' => $publisher_id, 'id_opub' => $orig_publisher_id));
			if ($result->rowCount() > 0) {
				while($row = $result->Fetch()) { 
					$publisher = $row["name"];
					if ($row["original"] == 0) echo "<li><b>English publisher:</b> <a href='/publishers/".$publisher_id."'><span itemprop='publisher'>".$publisher."</span></a></li>";
					else echo "<li><b>Original publisher:</b> <a href='/publishers/".$orig_publisher_id."'>".$publisher."</a></li>";
				}
			}
			
			echo "<li><b>Type:</b> <a href='/series?type=".$type."'><span itemprop='audience'>".$types[$type][0]."</span></a></li><br>";
			
			$tags = explode(',', $tags);
			echo "<li><b>Genre:</b><span itemprop='genre'> ";
			foreach($tags as $tag)
				echo "<span class='label label-default'>".$tag."</span> ";
			echo "</span></li>";	
			echo "<br>
			<dl class='dl'>
			  <dt>Synopsis:</dt>
			  <dd><span itemprop='description'>".$description."</span>
			  </dd>
			</dl>";	
			echo "</ul><br>";
			
			
			$result4 = $db->prepare("SELECT id, id_serie, number, release_date, price, price_can, type, comments, DAY(release_date) AS day, MONTH(release_date) AS month, YEAR(release_date) AS year FROM volumes WHERE id_serie=:id ORDER BY number DESC,release_date DESC");
			$result4->execute(array('id' => $num));
			$numVols = $result4->rowCount();
			echo "<h3>Volumes in english <span class='badge'>".$numVols."</span>";
								
			if($user->is_admin()) echo"
			<div class='btn-group' style='float:right'>
			  <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
				<span class='glyphicon glyphicon-cog' aria-hidden='true'></span>
			  </button>
			  <ul class='dropdown-menu'>
				  <li><a href='/modSerie.php?num=".$num."'>Modify Serie</li>
				  <li><a href='/addVolume.php?num=".$num."'>Add new volume</a></li>
				  <li role='separator' class='divider'></li>
				  <li><a href='mailto:licensedmanga@gmail.com'>Notify error/duplicate</a></li>
			  </ul>
			</div>";
					
			echo "</h3><hr><br>";
			//<a href='modVolume.php?num=".$id."'>Modify</a><a href='#' style='float:right'>Add image</a>
			if ($numVols > 0) {
				echo "<div class='portfolio'>";
				while ($row4 = $result4->Fetch()) { 
					$id = $row4['id'];				
					echo
						"
						  <div class='col-lg-2 col-md-3 col-sm-3 col-xs-6'>
							<div itemprop='hasPart' itemscope itemtype='http://schema.org/PublicationVolume' itemid='#vol".$id."'>
								<div class='thumbnail'>							
									<link itemprop='author' href='#author'>
									<link itemprop='author' href='#illustrator'>
									<meta itemprop='inLanguage' content='en'>
									  <img src='/images/series/".$num."/".$id.".jpg' itemprop='image' style='width:150px;height:220px;'  onerror=\"this.src='/images/cover.png'\">
									  <div class='caption'>";
										$tp = $row4['type'];
										
										if ($tp == 1) echo "<h3>#<span itemprop='volumeNumber'>".$row4["number"]."</span> *";							
										else if ($tp == 2) echo "<h3>#<span itemprop='volumeNumber'>".$row4["number"]."</span> END";
										else if ($tp == 3) echo "<h3>Single vol.";
										else echo "<h3>#<span itemprop='volumeNumber'>".$row4["number"]."</span>";
										echo "</h3>";									
										
										$year = $row4['year'];
										$month = $row4['month'];
										$day = $row4['day'];
										
										if ($year == '0000') $date = "TBA";
										else if ($day == '00') {
												if ($month == '00') $date = $year;
												else {
													$bd = new DateTime($year."-".$month."-15");
													$date = $bd->format("M Y");
												}
										}
										else {
											$bd = new DateTimeImmutable($year.'-'.$month.'-'.$day);
											$date = $bd->format("F d, Y");
										}										
										
										echo "<span itemprop='datePublished'>".$date."</span><br>";										
										$price = $row4['price'];
										if ($price == '' || $price == 0) echo "$ ??";
										else echo "$".$price;
										$price_can = $row4['price_can'];
										if ($price_can != "" && $price_can != 0) echo " | CND ".$price_can;
										echo "<br>".nl2br(htmlspecialchars($row4['comments']));
										if($user->is_admin()) echo "<span id='mod'><a href='/modVolume.php?num=".$id."'>Modify</a></span><br>";																								
									  echo"</div>
								</div>
							</div>
						  </div>	
						  <div class='clear'></div>";			
				}
				echo "</div>";
			}	
			echo "</div>";	
		
	}
	
  
?>




</div>

</body>
</html>
