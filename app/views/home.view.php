<?php
    $title = "Home " . $company;
    require('partials/header.php')
?>
<div class="main">
  <h1>Home <?= htmlentities($company) ?></h1>
</div>
<?php require('partials/footer.php') ?>
