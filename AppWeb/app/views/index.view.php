<?php
    $title = "Home";
    require('partials/header.php');
    if(!isset($_SESSION['user']))
      return require('login.view.php');
?>
<div class="main">
 <h1>Home</h1>

 <p>
     Nothing to do here go to <a href="tasks">Task</a>
 </p>
</div>

<?php require('partials/footer.php'); ?>
