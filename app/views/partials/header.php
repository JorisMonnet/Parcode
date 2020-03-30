<!DOCTYPE html>
<html>
<head>
	<title><?= htmlentities($title) ?></title>
	<link rel="stylesheet" href="app/public/css/style.css">
	<script type = "text/javascript" src="app/public/js/script.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>
	<div class="upperpage">
	<?php if(isset($_SESSION['user'])):?>
		Welcome <?= htmlentities($_SESSION['user']);	?>
		<a href="logout">logout</a>
	<?php else: ?>
		<a href="loginPage">login</a>
	<?php endif;?>
	</div>
