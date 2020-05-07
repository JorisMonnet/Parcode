<?php
    $title = "Login page";
    require('partials/header.php');
?>
<form id="log" class="logForm" action="login" method="post">
  <h1>
    <div id="logo_parcode">PARCODE</div>
    <br/>Login</h1>
  <label for="username">Username:</label>
  <input type="text" name="user" id="username" class="inputText" required><br>
  <label for="password">Password:</label>
  <input type="password" name="pass" id="password" class="inputText"required><br>
  <input type="submit" class="button" value="Submit">
  <label for="signUpBut"style="margin-bottom:10px">Fresh with us ? If not please sign Up :</label>
</form>

<form id="signUpButton" action="showSignUp" method="post">
  <input id="signUpBut"type="submit" class="button" value="Sign up" style="margin-bottom:20px">
</form>

<form class="logCancel" action="loginCancel" method="post"style="margin-bottom:20px">
  <input type="submit" class="button" value="Cancel">
</form>

<?php if(Logger::lastLogEventisFalseLog()):?>
  <div id = "falseLog">
    user not found <br>
    please try again
  </div>
<?php endif; require("partials/footer.php");?>
