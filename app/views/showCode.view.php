<?php
    $title = "Code ".$currentCode->getId();
    require('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId();
?>

<main>
  <h1>Code <?= htmlentities($currentCode->getId()); ?></h1>
  
  <?php echo $currentCode->asHTMLTableRowWithEdit($user); ?>
  <hr style="border-width: 3px;margin:1em">
  <?php if(isset($_SESSION['userid'])):?>
    <form action = "addComment" method="post">
      <label for="content" style="margin-bottom:10px">Leave a comment : </label>
      <textarea class ="flex-container" type="text" name="content" required></textarea>
      <input type="hidden" name="codesid" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Submit">
    </form>
  <?php endif;
    foreach ($comments as $comment)
    	  echo $comment->asHTMLTableRowWithEdit($user); 
    if(isset($_SESSION['userid'])&&isset($currentComment)&&$currentComment!==""):?>

      <form action="updateComment" method="post">
        <label for="content" style="margin-bottom:10px">Edit the comment : </label>
        <textarea class="flex-container" name="content" required><?= htmlentities($currentComment->getContent()); ?></textarea>
        <input type="hidden"  name="id" value="<?= htmlentities($currentComment->getId()); ?>">
        <input type="hidden" name="codesid" value="<?= htmlentities($currentCode->getId()); ?>">
        <input type="submit" class="button" value="Submit">
      </form>
      <form action="deleteComment" method="post" class="buttonEditCode">
        <input type="hidden" name="id" value="<?= htmlentities($currentComment->getId()); ?>">
        <input type="submit" class="button" value="Delete Comment">
      </form>
    <?php endif;?>
</main>
<?php require('partials/footer.php'); ?>