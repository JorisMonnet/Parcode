<!DOCTYPE html>
<html>
<head>
	<title><?= htmlentities($title) ?></title>
	<link rel="stylesheet" href="app/public/css/style.css">
	<link rel="icon" type="image/png" href="app/views/partials/logo.png" />
	<script type = "text/javascript" src="app/public/js/script.js"></script>
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
			</div>
		</div>
	<?php endif;?>
