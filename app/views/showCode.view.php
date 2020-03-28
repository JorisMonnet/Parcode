<?php
    $title = "Code page";
    require('partials/header.php');
?>

<div class="main">
<main>
  <h1>Selected Code</h1>

  <div class="flex-container">
    <?php echo $currentCode->asHTMLTableRowWithEdit($user); ?>
  </div>

  <p>
    <a href="codes">Show all codes</a>
  </p>
  <div id="hiddenForm">
    <form action="parse_update_form" method="post">
      <p>This form allow you to edit the code</p>
      <input type="text" name="content" value="<?= htmlentities($currentCode->getContent()); ?>" required >
      <input type="hidden" name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" value="Submit">
    </form>
    </br>
    <form action="delete_form" method="post">
      <input type="hidden" name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" value="Delete Code">
    </form>
  </div>
</main>
</div>

<?php require('partials/footer.php'); ?>
