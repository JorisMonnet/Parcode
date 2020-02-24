<!DOCTYPE html>

<html>
<head>
	<title><?= htmlentities($title) ?></title>
	<link rel="stylesheet" href="app/public/css/style.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>

	<?php
	if(isset($_SESSION['user'])):?>
	<div class="upperpage">
		Welcome <?= htmlentities($_SESSION['user']);	?>
		<a href="logout">logout</a>
	</div>
	<?php endif; ?>
