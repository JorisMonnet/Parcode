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
<?php if(Logger::lastLogEventisFalseLog()){
  echo '<div id = "falseLog">';
    echo '<br> user not found <br>';
    echo 'please try again <br>';
  echo '</div>';
} ?>
<?php require('partials/footer.php'); ?>
