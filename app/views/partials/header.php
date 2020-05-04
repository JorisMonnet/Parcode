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
	if ($title!="Login page"):?>
		<div class="upperpage">
			<?php if(isset($_SESSION['userid'])):?>
				Welcome <?= htmlentities($_SESSION['user']);?>
				<a href="logout">logout</a>
				<a href="addCode">Add Code</a>
			<?php else: ?>
				<a href="loginPage">login</a>
			<?php endif;?>
			<a href="index">HOME</a>
			<a href="codes">Codes</a>
		</div>
	<?php endif;?>
