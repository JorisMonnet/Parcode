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
		<div class="upperpage">
			<?php if(isset($_SESSION['userid'])):?>
				<span>Welcome <?= htmlentities($_SESSION['user']);?></span>
				<div class="upperpageA">
				<a href="logout">Logout</a>
				<a href="addCode">Add Code</a>
			<?php else: ?>
				<div class="upperpageA">
				<a href="loginPage">Login</a>
			<?php endif;?>
			<a href="index">HOME</a>
			<a href="codes">Codes</a>
			<script>
				function showNav(blocked){
					let nav = document.getElementById("navGroups");
					if(nav.style.display == "none")
						nav.style.display = "block";
					else
						nav.style.display = "none";
				}
				function hoverShowNav(in){
					let nav = document.getElementById("navGroups");
					nav.style.display = in?"block":"none";
				}
			</script>
			<nav>
				<button id="groupsButton" onmouseout="hoverShowNav(false)" onmouseover="hoverShowNav(true)">Groups</button>
				<div id="navGroups">
				<?php 
					foreach ($groups as $group)
						echo '<a href = "codes?group='.urlencode($group).'">'.htmlentities($group).'</a>';
				?>
				</div>
			</nav>
			</div>
		</div>
	<?php endif;?>
