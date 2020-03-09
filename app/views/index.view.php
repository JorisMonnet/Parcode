<?php
    $title = "Home";
    require('partials/header.php');
    if(!isset($_SESSION['user']))
      return require('login.view.php');
?>
<div class="main">
 <h1>Home</h1>

 <p>
     Nothing to do here go to <a href="codes">Code</a>
 </p>
</div>

<?php require('partials/footer.php'); ?>
