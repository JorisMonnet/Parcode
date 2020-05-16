<?php
    $title = "SignUp page";
    require_once('partials/header.php');
?>

<form id="signUp" class="logForm" action="signUp" method="post">
  
  	<span class="logo_parcode">PARCODE</span>
  	<h1>Sign up</h1>
  	<label for="username">Username :</label>
  	<input type="text" name="user" id="username" class="inputText" required>
  	<label for="password">Password :</label>
  	<input type="password" name="pass" id="password" class="inputText" required>
  	<label for="confirmedPassword">Confirm password :</label>
  	<input type="password" name="confirmedPassword" id="confirmedPassword" class="inputText" required>
  	<input type="submit" class="button" value="Submit">
</form>

<form class="logCancel" action="signUpCancel" method="post">
  	<input type="submit" class="button" value="Cancel">
</form>

<?php if(isset($_SESSION['badSignUp'])):?>
	<div id = "falseLog">
		<?php echo $_SESSION['badSignUp'];unset($_SESSION['badSignUp']);?>
		Please try again
	</div>
<?php  endif; require_once("partials/footer.php");?>
