<?php		
	require_once('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>  
  <!-- METADATA --> 
  <meta charset="utf-8">
  <title>New licenses</title>
  <meta name="description" content="New manga and light novels licenses.">
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
		  "@id": "http://licensedmanga.com/announcements",
		  "name": "Announcements"
		}
	  }]
	}
	</script>
	
</head>

<style>		
		
	html {
	  position: relative;
	  min-height: 100%;
	}
	body {  
	  margin-bottom: 80px;
	}
	.footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;	  
		  height: 60px;
		  background-color: #1a1a1a;
	}

	.footer p {
		margin: 20px 50px;
	}


	
</style>

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
      <li class="active"><a href="/announcements">New licenses</a></li>
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
						header('Location:'.$_SERVER['PHP_SELF']);
						exit;
					} 
					else {
						$_SESSION['error'] = "Wrong username/password. Please try again.";
						header('Location:'.$_SERVER['PHP_SELF']);
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

<h2>Licenses</h2>	
<br>



<?php
	$today = new DateTime();
	$year = $today->format("Y");    
         
    $result = $db->prepare("SELECT a.id_serie,month(a.day) as date,s.title 
    FROM announcements as a JOIN series as s ON a.id_serie = s.id 
    WHERE YEAR(a.day) =:year
    ORDER by a.day");
    
    $result->execute(array('year' => $year)); 
        
    if ($result->rowCount() > 0) {
		$row = $result->Fetch();
		$month = $row["date"]; 
		$id = $row["id_serie"];
		$title = $row["title"];
		$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F');
		echo "<h4>".$monthName." ".$year."</h4><ul>"; 
		echo "<li><a href='/series/".$id."'>".$title."</a></li>";
		
		while($row = $result->Fetch()) {
			$title = $row["title"];
			$date = $row["date"];
			$id = $row["id_serie"];
			if ($date != $month) {
				$month = $date;				
				$dateObj   = DateTime::createFromFormat('!m', $month);
				$monthName = $dateObj->format('F');
				echo "</ul><br><h4>".$monthName." ".$year."</h4><ul>";
			}
			echo "<li><a href='/series/".$id."'>".$title."</a></li>";
		}
	}
?>
</ul>

</div>

<!--
<footer class="footer">      
        <p class="text-muted">Wildux 2016 | licensedmanga.com</p>      
</footer>
-->

</html>
