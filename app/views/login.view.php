<?php
    $title = "Login page";
    require('partials/header.php');
?>
<form id="log" class="logForm" action="login" method="post">
  <h1>
    <div id="logo_parcode">PARCODE</div>
    <br/>Login</h1>
  <label for="username">Username:</label>
  <input type="text" name="user" id="username" class="input_text" required><br>
  <label for="password">Password:</label>
  <input type="password" name="pass" id="password" class="input_text"required><br>
  <input type="submit" class="button" value="submit"><br>
  <label for="signUpBut">Fresh with us ? If not please sign Up :</label>
</form><br>

<form id="signUpButton" action="showSignUp" method="post">
  <input id="signUpBut"type="submit" class="button" value="Sign up">
</form><br>

<form class="logCancel" action="loginCancel" method="post">
  <input type="submit" class="button" value="Cancel">
</form><br>

<?php if(Logger::lastLogEventisFalseLog()):?>
  <div id = "falseLog">
    user not found <br>
    please try again <br>
  </div>
<?php endif; require("partials/footer.php");?>
