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
	<nav>
	<?php if ($title!="Login page"&&$title!="SignUp page"):?>
		<ul>
			<li><p>Welcome to Parcode <?= htmlentities($_SESSION['user']??"new user");?> !</p></li>
			<li><a href="index"><img src="app/views/partials/images/home.png" alt="" class="logoImg">Home</a></li>
			<li><a href="codes"><img src="app/views/partials/images/logo.png" alt="" class="logoImg">Codes</a></li>
			<?php if(isset($_SESSION['userid'])):?>
				<li><a href="addCode"><img src="app/views/partials/images/plus.png" alt="" class="logoImg">Add Code</a></li>
			<?php endif;
			require_once("app/controllers/CodeController.php"); 
			$groups = CodeController::getGroups();
			if($groups!=null):?>
			<li class="groupsMenu"><a href="javascript:void(0)" id="groupsButton"><img src="app/views/partials/images/menu.png" alt="" class="logoImg">Groups</a>
			<div id="navGroups">
				<?php 
					foreach ($groups as $group)
							echo '<a href = "codes?group='.urlencode($group).'">'.htmlentities($group).'</a>';
				?>
			</div>
			</li>
			<?php endif; 
				if(isset($_SESSION['userid'])):?>
				<li><a class="logNav" href="logout"><img src="app/views/partials/images/logout.png" alt="" class="logoImg">Logout</a></li>
			<?php else: ?>
				<li><a class="logNav" href="loginPage"><img src="app/views/partials/images/login.png" alt="" class="logoImg">Login</a></li>
			<?php endif;?>
		</ul>
	<?php endif;?>
	</nav>