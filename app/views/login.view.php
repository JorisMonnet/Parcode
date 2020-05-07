<?php
    $title = "Login page";
    require('partials/header.php');
?>
<form id="log" class="logForm" action="login" method="post">
  <span class="logo_parcode">PARCODE</span>
    <h1>Login</h1>
  <label for="username">Username:</label>
  <input type="text" name="user" id="username" class="inputText" required><br>
  <label for="password">Password:</label>
  <input type="password" name="pass" id="password" class="inputText" required><br>
  <input type="submit" class="button" value="Submit">
  <label for="signUpBut">Fresh with us ? If not please sign Up :</label>
</form>

<form id="signUpButton" action="showSignUp" method="post">
  <input id="signUpBut" type="submit" class="button" value="Sign up">
</form>

<form class="logCancel" action="loginCancel" method="post">
  <input type="submit" class="button" value="Cancel">
</form>

<?php if(Logger::lastLogEventisFalseLog()):?>
  <div id = "falseLog">
    user not found <br>
    please try again
  </div>
<?php endif; require("partials/footer.php");?>
