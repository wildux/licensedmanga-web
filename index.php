<?php require('includes/config.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>   
  <!-- METADATA --> 
  <meta charset="utf-8">
  <title>Licensed Manga</title>
  <meta name="description" content="Licensed manga is a new website intended to provide information about all manga and light novels published in english (worldwide).">
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
	
	<style>
		.post {
			margin-bottom: 50px;
		}
		
		
		
		#title {
			color: orange;
		}
		
		#title:hover {
			text-decoration: none;
			color: #22aaee;
		}
		
		#paging {
			position: absolute;
			bottom: 20px;
			
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
      <li class="active"><a href="/blog">Blog</a></li>
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

	<div class="container-fluid col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

		<h1>Blog</h1>
		<hr />

		<?php
			try {
					
				// Find out how many items are in the table
				$total = $db->query('SELECT COUNT(*) FROM blog_posts')->fetchColumn();
				$limit = 5; // How many items to list per page
				$pages = ceil($total / $limit); // How many pages will there be

				// What page are we currently on?
				$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
					'options' => array('default'   => 1,'min_range' => 1,),
				)));

				$offset = ($page - 1)  * $limit; // Calculate the offset for the query

				// CONTENT
				$start = $offset + 1;
				$end = min(($offset + $limit), $total);				

				
				// Prepare the paged query
				$stmt = $db->prepare('
					SELECT postID, postTitle, postDesc, postDate, postSlug
					FROM blog_posts
					ORDER BY postID DESC
					LIMIT
						:limit
					OFFSET
						:offset
				');

				// Bind the query params
				$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
				$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
				$stmt->execute();
			?>
			
			<div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>
			<?php	
				while($row = $stmt->fetch()){
					
					echo '<div class="post">';
						echo '<h1><a id="title" href="blog/'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>'; 						
						echo '<p id="date"><i>'.date('M jS Y', strtotime($row['postDate'])).'</i> <a href="blog/'.$row['postSlug'].'#disqus_thread"></a></p>';
						echo '<br><p>'.$row['postDesc'].'</p>';				
						echo '<br><p><a href="blog/'.$row['postSlug'].'">Read More</a></p>';				
					echo '</div>';
				}
			?>
			</div>	
			<div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
				<a class="twitter-timeline"  
					href="https://twitter.com/licensedmanga"
					data-widget-id="718496974476034048"
					data-chrome="nofooter noborders transparent">>
					Tweets by @licensedmanga
				</a>
				<script>
					!function(d,s,id){
						var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
						if(!d.getElementById(id)){
							js=d.createElement(s);
							js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);
						}
					}(document,"script","twitter-wjs");
				</script>
			</div>
          <?php
				$prevlink = ($page > 1) ? '
				<a href="?page=1" title="First page">&laquo;</a>
				<a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '	
				<span class="disabled glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="disabled glyphicon glyphicon glyphicon-menu-left" aria-hidden="true"></span>';
				
				$nextlink = ($page < $pages) ? '
				<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> 
				<a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '
				<span class="disabled glyphicon glyphicon glyphicon-menu-right" aria-hidden="true"></span>
				<span class="disabled glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
				
				// Display the paging information
				//<p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p>
				echo '<div id="paging">
				<span><p>', $prevlink, '</span>
				Page ', $page, ' of ', $pages ,
				$nextlink, ' </p>
				</div>';
				

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>

	</div>
	<script id="dsq-count-scr" src="//licensedmanga.disqus.com/count.js" async></script>

	
</body>
</html>
