<?php
	include('dbconnection.php');
	include('manga_types.php');
	require_once('includes/config.php');

	$num = filter_input(INPUT_GET,"num",FILTER_SANITIZE_STRING);
	if (!empty($num) && ctype_digit($num))
	{
		$sql = "SELECT name,date,place,gender,comments,DAY(date) AS day, MONTH(date) AS month, YEAR(date) AS year FROM authors WHERE id='".$num."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$name = $row["name"];
			$date = $row["date"];
			$place = $row["place"];
			$gender = $row["gender"];
			$month = $row["month"];
			$year = $row["year"];
			$day = $row["day"];
			$comments = nl2br(htmlspecialchars($row["comments"]));
		}
		else $name = "Author not found";
	}
	else $name = "Wrong id format";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- METADATA -->
  <meta charset="utf-8">
  <title><?php echo $name; ?></title>
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
		  "@id": "http://licensedmanga.com/authors",
		  "name": "Authors"
		}
	  },{
		"@type": "ListItem",
		"position": 2,
		"item": {
		  "@id": "http://licensedmanga.com/authors/<?php echo $num; ?>",
		  "name": "<?php echo $name; ?>"
		}
	  }]
	}
	</script>
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

	$tp = filter_input(INPUT_GET,"type",FILTER_SANITIZE_STRING);
	if ($name == "Author not found") echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Author not found</strong></div>";
	else if ($name == "Wrong id format") echo "<div class='alert alert-warning'>
	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<strong>Error:</strong> Incorrect id format. Please enter a valid id.</div>";
	else
	{
			if ($place == "") $place = "Unknown";



			if ($year == '0000') {
				if ($day == '00') {
					if($month == '00') $date = "Unknown";
					else { 
						$bd = new DateTimeImmutable('0000-'.$month.'-15');
						$date = $bd->format("F");
					}
				}
				else {
					if($month == '00') $date = "Unknown";
					else {
						$bd = new DateTimeImmutable('0000-'.$month.'-'.$day);
						$date = $bd->format("F d");
					}
				}			
			}
			else if ($month == '00') $date = $year;
			else if ($day == '00') {
				$bd = new DateTime($year.'-'.$month.'-15');
				$date = $bd->format("F, Y");
			}
			else {
				$bd = new DateTimeImmutable($year.'-'.$month.'-'.$day);
				$date = $bd->format("F d, Y");
			}
			


			/*if ($date == "0000-00-00" || $date == "") $date = "Unknown";
			else {
				$bd = new DateTimeImmutable($date);
				if ($bd->format("Y") == "0000") $date = $bd->format("F j");
				else if ($month == "00") $date = $bd->format("Y");
				else $date = $bd->format("F j, Y");
			}*/
			
			
			//<img class='media-object' src='images/authors/".$num.".jpg' alt='".$name."'> //Dins media top
			$next = $num+1;
			$prev = $num-1;
			echo "<div itemscope itemtype='http://schema.org/Person'>
			<h2><span itemprop='name'>".$name;
			if($user->is_admin()) echo "<a style='float:right;' href='/authors/".$next."' >Next</a><a style='float:right;padding-right:20px;' href='/authors/".$prev."' >Previous</a>";

			echo "</span></h2><br>
			<div class='media'>
				<div class='media-left media-top'>
				</div>
				<div class='media-body'>
					<ul>
						<li><b>Birth date:</b><span itemprop='birthDate'> ".$date."</span></li>
						<li><b>Birth place:</b><span itemprop='birthPlace'> ".$place."</span></li>
						<li><b>Gender:</b><span itemprop='gender'> ".$gender."</span></a></li>
						<br>
						<dl class='dl'>
							<dt>Comments:</dt>
							<dd>".$comments."</dd>
						</dl>
					</ul>
				</div>
			</div>
			</div>";

			if (!empty($tp) && ctype_digit($tp) && $tp < sizeof($types)) {
				$sql2 = "SELECT id,title FROM series inner join SeriesArtists on series.id = SeriesArtists.id_serie WHERE type='".$tp."' AND SeriesArtists.id_artist='".$num."'
					UNION SELECT id,title FROM series inner join SeriesWriters on series.id = SeriesWriters.id_serie WHERE type='".$tp."' AND SeriesWriters.id_writer='".$num."' ORDER BY title";
				$tp_name = $types[$tp][0];
			}
			else {
				$tp_name = "series";
				$sql2 = "SELECT id,title FROM series inner join SeriesArtists on series.id = SeriesArtists.id_serie WHERE SeriesArtists.id_artist='".$num."'
					UNION SELECT id,title FROM series inner join SeriesWriters on series.id = SeriesWriters.id_serie WHERE SeriesWriters.id_writer='".$num."' ORDER BY title";
			}

			$result2 = $conn->query($sql2);

				echo "<br>
				<h3>Published ".$tp_name." <span class='badge'>".$result2->num_rows."</span>";

				if($user->is_admin()) echo "

				<div class='btn-group' style='float:right'>
			  <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
				<span class='glyphicon glyphicon-cog' aria-hidden='true'></span>
			  </button>
			  <ul class='dropdown-menu'>
				  <li><a href='/modAuthor.php?num=".$num."'>Modify author</li>
				  <li role='separator' class='divider'></li>
				  <li><a href='mailto:licensedmanga@gmail.com'>Notify error/duplicate</a></li>
			  </ul>
			</div>";



				echo "</h3><hr><div class='mangatypes'>";
				foreach($types as $type) {
					echo "<a style='background:".$type[1]."' href='/authors/".$num."/".$type[2]."'>".$type[0]."</a>";
				}
				echo "</div><br><br>";

			if ($result2->num_rows > 0) {
						echo "<ul>";
						while($row2 = $result2->fetch_assoc()) {
							$id = $row2["id"];
							$title = $row2["title"];
							echo "<li><a href='/series/".$id."'>".$title."</a></li>";
						}
						echo "</ul>";
			}
			else echo "<p>This author doesn't have any ".$tp_name." yet.</p>";
		//}
		/*else echo "<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Author not found</strong></div>";*/
	}
	/*else echo "<div class='alert alert-warning'>
	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<strong>Error:</strong> Incorrect id format. Please enter a valid id.</div>";*/

?>

</div>

</body>
</html>
