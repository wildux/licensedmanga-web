<h1>Blog</h1>
<ul id='adminmenu'>
	<li><a href='index.php'>Posts</a></li>
	<?php if($user->is_superuser()){ ?><li><a href='users.php'>Users</a></li><?php } ?>
	<li><a href="../" target="_blank">Return to website</a></li>	
</ul>
<div class='clear'></div>
<hr />
