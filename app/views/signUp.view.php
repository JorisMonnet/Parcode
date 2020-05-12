<?php
    $title = "SignUp page";
    require('partials/header.php');
?>

<form id="signUp" class="logForm" action="signUp" method="post">
  
  	<span class="logo_parcode">PARCODE</span>
  	<h1>Sign up</h1>
  	<label for="username">Username :</label>
  	<input type="text" name="user" id="username" class="inputText" required><br>
  	<label for="password">Password :</label>
  	<input type="password" name="pass" id="password" class="inputText" required><br>
  	<label for="confirmedPassword">Confirm password :</label>
  	<input type="password" name="confirmedPassword" id="confirmedPassword" class="inputText" required><br>
  	<input type="submit" class="button" value="Submit">
</form><br>

<form class="logCancel" action="signUpCancel" method="post">
  	<input type="submit" class="button" value="Cancel">
</form><br>

<?php if(isset($_SESSION['badSignUp'])):?>
	<div id = "falseLog">
		<?php echo $_SESSION['badSignUp'];unset($_SESSION['badSignUp']);?><br>
		Please try again <br>
	</div>
<?php  endif; require("partials/footer.php");?>
