<?php
    $title = "Code page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="code";
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
      <textarea name="content" required><?= htmlentities($currentCode->getContent()); ?></textarea>
      <input type="hidden"  name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Submit">
    </form>
    </br>
    <form action="delete_form" method="post">
      <input type="hidden" name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Delete Code">
    </form>
  </div>
</main>
</div>

<?php require('partials/footer.php'); ?>
