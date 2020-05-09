<?php
    $title = "Home";
    require('partials/header.php');
    $_SESSION['currentPage'] ="index";
?>
<main>
 <h1>Home</h1>
 <p>
    Hello ! This Application is useful to share some lines of codes from different studies project !
 </p>
 <p>
     Here you can go to the <a href="codes">Codes !</a>
 </p>
</main>

<?php require('partials/footer.php'); ?>
