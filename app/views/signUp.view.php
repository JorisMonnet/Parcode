<?php
    $title = "SignUp page";
    require_once('partials/header.php');
?>

<form id="signUp" class="logForm" action="signUp" method="post">
  
  	<span class="logo_parcode">PARCODE</span>
  	<h1>Sign up</h1>
  	<label for="username">Username (20 characters maximum):</label>
  	<input type="text" name="user" id="username" class="inputText" pattern="^.{0,25}$" required>
  	<label for="password">Password (40 characters maximum):</label>
  	<input type="password" name="pass" id="password" class="inputText" pattern="^.{0,40}$" required>
  	<label for="confirmedPassword">Confirm password :</label>
  	<input type="password" name="confirmedPassword" id="confirmedPassword" class="inputText" required>
  	<input type="submit" class="button" value="Submit">
</form>

<form class="logCancel" action="signUpCancel" method="post">
  	<input type="submit" class="button" value="Cancel">
</form>

<?php if(isset($_SESSION['badSignUp'])):?>
	<div id = "falseLog">
		<?php echo htmlentities($_SESSION['badSignUp']);unset($_SESSION['badSignUp']);?>
		Please try again
	</div>
<?php  endif; 
require_once("partials/footer.php");?>
