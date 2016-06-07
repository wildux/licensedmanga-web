<?php		
	require_once('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>  
  <!-- METADATA --> 
  <meta charset="utf-8">
  <title>Publishers</title>
  <meta name="description" content="List of manga and light novels publishers.">
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
		  "@id": "http://licensedmanga.com/publishers",
		  "name": "Publishers"
		}
	  }]
	}
	</script>
</head>
<body>
	
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
	
	.myTable .col-lg-6:nth-child(odd) {
		clear: both;		
	}
	
	.myTable a:nth-of-type(odd){
		background-color: #fff0ff;
	}
	
	.myTable a:hover {
		color: white;
		background-color: #e4b4e4;
		text-decoration:none;
	}	
	
	.panel-heading {
		color: white;		
		text-shadow: 0 0 2px #999999;		
		border-radius: 8px 8px 0 0;
		background-color:#4d004d;
	}
	
	.panel {		
		border: none;
		border-radius: 0;
	}
	
	.panel-body {
		padding: 0;
		border-width: 0 1px 1px 1px;
		border-style: solid;
		border-color: #4d004d;
	}
	
	.btn-default {
		margin-right: 3px; 
	}
	
</style>

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
      <li class="active"><a href="/publishers">Publishers</a></li>
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

//<!-- SQL -->
	$type = filter_input(INPUT_GET,"type",FILTER_SANITIZE_STRING);
	if($type == "0" || $type == "1") {
		$result = $db->prepare("SELECT id,name,state,location FROM publishers WHERE original=:tp ORDER BY name");
		$result->execute(array(':tp' => $type));	
	}
	else {
		$sql = "SELECT id,name,state,location FROM publishers ORDER BY name";
		$result = $db->query($sql);
		
	}	
    $publishers = $result->rowCount();
	echo "<h2>Publishers <span class='badge'>".$publishers."</span></h2>";
?>


<!-- A to Z search buttons -->	
	<div class="btn-toolbar id='alphabet'">
      <a href="##"><button class="btn btn-default">#</button></a>
      <a href="#A"><button class="btn btn-default">A</button></a>
      <a href="#B"><button class="btn btn-default">B</button></a>
      <a href="#C"><button class="btn btn-default">C</button></a>
      <a href="#D"><button class="btn btn-default">D</button></a>
      <a href="#E"><button class="btn btn-default">E</button></a>
      <a href="#F"><button class="btn btn-default">F</button></a>
      <a href="#G"><button class="btn btn-default">G</button></a>
      <a href="#H"><button class="btn btn-default">H</button></a>
      <a href="#I"><button class="btn btn-default">I</button></a>
      <a href="#J"><button class="btn btn-default">J</button></a>
      <a href="#K"><button class="btn btn-default">K</button></a>
      <a href="#L"><button class="btn btn-default">L</button></a>
      <a href="#M"><button class="btn btn-default">M</button></a>
      <a href="#N"><button class="btn btn-default">N</button></a>
      <a href="#O"><button class="btn btn-default">O</button></a>
      <a href="#P"><button class="btn btn-default">P</button></a>
      <a href="#Q"><button class="btn btn-default">Q</button></a>
      <a href="#R"><button class="btn btn-default">R</button></a>
      <a href="#S"><button class="btn btn-default">S</button></a>
      <a href="#T"><button class="btn btn-default">T</button></a>
      <a href="#U"><button class="btn btn-default">U</button></a>
      <a href="#V"><button class="btn btn-default">V</button></a>
      <a href="#W"><button class="btn btn-default">W</button></a>
      <a href="#X"><button class="btn btn-default">X</button></a>
      <a href="#Y"><button class="btn btn-default">Y</button></a>
      <a href="#Z"><button class="btn btn-default">Z</button></a>
      <script>       
	  
	  function updateUrlParameter(uri, key, value) {
		// remove the hash part before operating on the uri
		var i = uri.indexOf('#');
		var hash = i === -1 ? ''  : uri.substr(i);
			 uri = i === -1 ? uri : uri.substr(0, i);

		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
		var separator = uri.indexOf('?') !== -1 ? "&" : "?";
		if (uri.match(re)) {
			uri = uri.replace(re, '$1' + key + "=" + value + '$2');
		} else {
			uri = uri + separator + key + "=" + value;
		}
		return uri + hash;  // finally append the hash as well
	}  
      </script>
      
      
      
      <select class="selectpicker show-menu-arrow form-control" id="status" name="status" style="width: auto; float:right" onchange="if (this.value) window.location.href=updateUrlParameter(location.href,'type',this.value)">
		  <option value="all">All publishers</option>		  
		  <option <?php if($type == '0'){echo("selected='selected'");}?> value="0">English publishers</option>
		  <option <?php if($type == '1'){echo("selected='selected'");}?> value="1">Original publishers</option>
	  </select>	 
    </div>

	<div class="tab-content" data-spy="scroll" data-target="#alphabet">
	<br>
	
	<!-- Publishers list -->	
<?php	
	
	
	if ($publishers > 0) {
		$row = $result->Fetch();
		$name = $row["name"];
		$location = $row["location"];
		$initial = $name[0];
		$state = $row["state"];
		echo "<section id='".$initial."'><div class='panel'><div class='panel-heading'>" .$initial. "</div><div class='panel-body'><div class='myTable'>";
		echo "<a itemscope itemtype='http://schema.org/Organization' href='/publishers/".$row["id"]."'><span>".$name;
		$label = 'success';
		if ($state == '0') {
			$label = 'danger';
			$state = 'Defunct';
		}
		else if ($state == '2') {
			$label = 'default';
			$state = 'Unknown';
		}
		else $state = 'Active';
		echo "<link itemprop='sameAs' href='/publishers/".$id."'>
		<meta itemprop='name' content='".$name."'>
		<meta itemprop='address' content='".$location."'>
		<div class='label label-".$label."' style='float:right'>".$state."</div></span></a>";
		while($row = $result->Fetch()) {
			$name = $row["name"];
			$state = $row["state"];
			$location = $row["location"];
			$id = $row["id"];
			if($initial !== $name[0]) {            
				$initial = $name[0];
				echo "</div></div></div></section><section id='".$initial."'><div class='panel'><div class='panel-heading'>" .$initial. "</div><div class='panel-body'><div class='myTable'>";
			} 		
			echo "<a itemscope itemtype='http://schema.org/Organization' href='/publishers/".$id."'><span>".$name;	
			$label = 'success';
			if ($state == '0') {
				$label = 'danger';
				$state = 'Defunct';
			}
			else if ($state == '2') {
				$label = 'default';
				$state = 'Unknown';
			}
			else $state = 'Active';	
			echo "<link itemprop='sameAs' href='/publishers/".$id."'>
			<meta itemprop='name' content='".$name."'>
			<meta itemprop='address' content='".$location."'>
			<div class='label label-".$label."' id='label' style='float:right'>".$state."</div></span></a>";
		}
		echo "</div></div></div></section>";
		
	}
	else echo "0 results.";
  
?>

</div>
</div>

</body>
</html>
