<?php
    $title = "Home " . $company;
    require('partials/header.php')
?>
<div class="main">
  <h1>About <?= htmlentities($company) ?></h1>
</div>
<?php require('partials/footer.php') ?>
