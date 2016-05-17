<?php	
	include('dbconnection.php');
	require_once('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- METADATA --> 
  <meta charset="utf-8">
  <title>Calendar</title>
  <meta name="description" content="Calendar of manga and light novels releases.">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta http-equiv="cleartype" content="on"> 
    
  <!-- CSS/JAVASCRIPT -->
  <link rel="stylesheet" href="/css/bootstrap.min.css"> 
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
		  "@id": "http://licensedmanga.com/calendar",
		  "name": "Calendar"
		}
	  }]
	}
	</script>

<style>		
		
	.myTable {
	  display: table;
	  width: 100%;
	}
	.myTable a {
	  display: table-row;	  
	}
	.myTable a span {
	  display: table-cell;
	  padding: 10px 20px;
	}
	
	.myTable a:nth-of-type(odd){
		background-color: #f4f8ed;
	}
	
	.myTable a:hover {
		color: white;
		background-color: #aac8be;
		text-decoration:none;
	}
	
	#panel-heading {				
		text-shadow: 0 0 1px #555555;		
		border-radius: 8px 8px 0 0;
		background-color:#9dc059;
	}
	
	#panel {		
		border: none;
		border-radius: 0;
	}
	
	#panel-body {
		padding: 0;
		border-width: 0 1px 1px 1px;
		border-style: solid;
		border-color: #9dc059;
	}
	
</style>

</head>



<body>
	
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
		  <img src="/images/lm2.jpg" width="30px">
	  </a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/blog">Blog</a></li>
      <li class="active"><a href="/calendar">Calendar</a></li>
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


<div class="container">
	
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
	
	$month = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT, ['options'=>['min_range' => 1    , 'max_range' => 12]]);
	$year  = filter_input(INPUT_GET, 'year' , FILTER_VALIDATE_INT, ['options'=>['min_range' => 1900 , 'max_range' => 9999]]);

	if($month && $year) $date = new DateTimeImmutable($year."-".$month."-15");
	
	else {
		$today = new DateTime();
		$year = $today->format("Y");
		$month = $today->format("n");
		$date = new DateTimeImmutable($year."-".$month."-15");
	}
		
		$interval = new DateInterval('P1M');
		$previous = $date->sub($interval);		
		
		
		echo "<div class='panel' style='border-color:#9dc059'><div class='panel-body' style='font-size: 18px; '>
		<p style='float: left; width: 33.3%; text-align: left; margin: auto'> <a href='/calendar/".$previous->format("n"). "/".$previous->format("Y")."'>
		<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span> Previous</a></p>";
		
		echo "<p style='float: left; width: 33.3%; text-align: center; margin: auto'><strong>".$date->format("F")." ".$date->format("Y")."</strong></p>";	
						
		$next = $date->add($interval);
		echo "<p style='float: left; width: 33.3%; text-align: right; margin: auto'> <a href='/calendar/".$next->format("n"). "/".$next->format("Y")."'>
		Next <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a></p></div></div><br><br>";
		
		$sql = "SELECT volumes.id_serie,volumes.number,volumes.release_date,volumes.type,series.title FROM volumes JOIN series ON volumes.id_serie = series.id 
		AND extract(YEAR_MONTH from volumes.release_date) = ".$year.$date->format("m")." ORDER BY volumes.release_date";
		
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$release_date = $row["release_date"];		   
		    if (substr_compare($release_date,'00',8,2) == 0) $release_date = "TBA";
			echo "<div class='panel' id='panel'><div class='panel-heading' id='panel-heading'>" .$release_date. "</div><div class='panel-body' id='panel-body'><div class='myTable'>";
			
			$type = $row["type"];
				if ($type == 3) echo "<a href='/series/".$row["id_serie"]."'><span>".$row["title"]."<div class='label label-default' style='float:right'>1 vol.</div></span></a>";
				else {		
					echo "<a href='/series/".$row["id_serie"]."'><span>" .$row["title"]. " #".$row["number"];			 					
					if ($type == 1) echo "<div class='label label-info' style='float:right'>New</div></span>";
					else if ($type == 2) echo "<div class='label label-danger' style='float:right'>End</div></span>";
					echo "</a>";
					
				}
			while($row = $result->fetch_assoc()) {
				$release_date2 = $row["release_date"];
				if (substr_compare($release_date2,'00',8,2) == 0) $release_date2 = "TBA";
				if($release_date !== $release_date2) {            
					$release_date = $release_date2;
					echo "</div></div></div><div class='panel' id='panel'><div class='panel-heading' id='panel-heading'>" .$release_date. "</div><div class='panel-body' id='panel-body'><div class='myTable'>";
				}
				$type = $row["type"];
				if ($type == 3) echo "<a href='/series/".$row["id_serie"]."'><span>".$row["title"]."<div class='label label-default' style='float:right'>1 vol.</div></span></a>";
				else {		
					echo "<a href='/series/".$row["id_serie"]."'><span>" .$row["title"]. " #".$row["number"];			 					
					if ($type == 1) echo "<div class='label label-info' style='float:right'>New</div></span>";
					else if ($type == 2) echo "<div class='label label-danger' style='float:right'>End</div></span>";
					echo "</a>";
					
				}				
			}
			echo "</div></div></div>";
		} 
		else echo "0 results"; 

?>

</div>

</body>
</html>
