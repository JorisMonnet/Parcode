<?php
    $title = "Login page";
    require('partials/header.php');
?>
<form class="log" action="login" method="post">
  <h1 class="login_elem" >
    <div id="logo_parcode">PARCODE</div>
    <br/>Login</h1>
  <label for="username">Username:</label>
  <input type="text" name="user" id="username" class="input_text"><br>
  <label for="password">Password:</label>
  <input type="password" name="pass" id="password" class="input_text"><br>
  <input type="submit" class="button" value="submit">
  <p class="login_elem">
  Fresh with us ?
  </p>
</form>
<?php if(Logger::lastLogEventisFalseLog()):?>
  <div id = "falseLog">
    user not found <br>
    please try again <br>
  </div>
<?php endif; ?>
