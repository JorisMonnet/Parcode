<?php
    $title = "Login page";
    require('partials/header.php');
?>
<form id="log" action="login" method="post">
  <h1>
    <div id="logo_parcode">PARCODE</div>
    <br/>Login</h1>
  <label for="username">Username:</label>
  <input type="text" name="user" id="username" class="input_text" style="text-align: center;"><br>
  <label for="password">Password:</label>
  <input type="password" name="pass" id="password" class="input_text" style="text-align: center;"><br>
  <input type="submit" class="button" value="submit">
  <p >
  Fresh with us ?
  </p>
</form>
<form id="logCancel" action="loginCancel" method="post">
  <input type="submit" class="button" value="Cancel">
</form>
<?php if(Logger::lastLogEventisFalseLog()):?>
  <div id = "falseLog">
    user not found <br>
    please try again <br>
  </div>
<?php endif; require("partials/footer.php");?>
