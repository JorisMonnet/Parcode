<?php
    $title = "SignUp page";
    require('partials/header.php');
?>
<form id="signUp" class="logForm" action="signUp" method="post">
  <h1>
    <div id="logo_parcode">PARCODE</div>
    <br/>Sign up</h1>
  <label for="username">Username :</label>
  <input type="text" name="user" id="username" class="input_text" required><br>
  <label for="password">Password :</label>
  <input type="password" name="pass" id="password" class="input_text" required><br>
  <label for="confirmedPassword">Confirm password :</label>
  <input type="password" name="confirmedPassword" id="confirmedPassword" class="input_text" required><br>
  <input type="submit" class="button" value="submit">
</form><br>
<form class="logCancel" action="signUpCancel" method="post">
  <input type="submit" class="button" value="Cancel">
</form><br>
<?php require("partials/footer.php");?>