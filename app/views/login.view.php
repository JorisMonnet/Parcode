<?php
    $title = "Login page";
    require('partials/header.php');
?>
<form class="log" action="login" method="post">
  <h1>Login</h1>
  <label for="username">Username:</label>
  <input type="text" name="user" id="username"><br>
  <label for="password">Password:</label>
  <input type="password" name="pass" id="password"><br>
  <input type="submit" value="submit">
</form>
<?php if(Logger::lastLogEventisFalseLog()):?>
  <div id = "falseLog">
    <br> user not found <br>
    please try again <br>
  </div>
<?php endif; ?>
<?php require('partials/footer.php'); ?>
