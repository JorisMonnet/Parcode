<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= htmlentities($title) ?></title>
	<link rel="stylesheet" href="app/public/css/generalStyle.css">
	<link rel="stylesheet" href="app/public/css/button.css">
	<?php if($title=="Login page"||$title=="SignUp page"):?>
		<link rel="stylesheet" href="app/public/css/logPage.css">
	<?php endif;
		 if(preg_match_all('/Code \d/i',$title)):?>
		<script src="app/public/js/votes.js"></script>
	<?php endif;?>
	<link rel="icon" type="image/png" href="app/views/partials/images/logo.png" />
	<script src="app/public/js/generalScript.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>
	<?php 
	if ($title!="Login page"&&$title!="SignUp page"):?>
		<nav>
			<ul>
			<?php if(isset($_SESSION['userid'])):?>
				<li><p>Welcome <?= htmlentities($_SESSION['user']);?></p></li>
				<li><a href="logout">Logout</a></li>
				<li><a href="addCode">Add Code</a></li>
			<?php else: ?>
				<li><a href="loginPage">Login</a></li>
			<?php endif;?>
			<li><a href="index">HOME</a></li>
			<li><a href="codes">Codes</a></li>
			<li class="groupsMenu"><a href="javascript:void(0)" id="groupsButton">Groups</a>
			<div id="navGroups">
				<a href="codes">Return to all</a>
				<?php 
					foreach ($groups as $group)
						echo '<a href = "codes?group='.urlencode($group).'">'.htmlentities($group).'</a>';
				?>
			</div>
			</li>
			</ul>
		</nav>
	<?php endif;?>
