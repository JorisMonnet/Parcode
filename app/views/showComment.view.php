<?php
    $title = "Comment page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="codes";  //if we login here, we want the user to return to the codes page
?>

<div class="main">
<main>
  <h1>Selected Comment</h1>

  <div class="flex-container">
    <?php echo $currentComment->asHTMLTableRowWithEdit($user); ?>
  </div>

  <p>
    <a href="codes">Show all codes</a>
  </p>
  <div id="hiddenForm">
    <form action="updateComForm" method="post">
      <p>This form allow you to edit the comment</p>
      <textarea name="content" required><?= htmlentities($currentComment->getContent()); ?></textarea>
      <input type="hidden" name="id" value="<?= htmlentities($currentComment->getId()); ?>">
      <input type="submit" value="Submit">
    </form>
    </br>
    <form action="deleteComForm" method="post">
      <input type="hidden" name="id" value="<?= htmlentities($currentComment->getId()); ?>">
      <input type="submit" value="Delete Comment">
    </form>
  </div>
</main>
</div>

<?php require('partials/footer.php'); ?>
