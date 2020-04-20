<?php
    $title = "Code ".$currentCode->getId();
    require('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId();
?>

<div class="main">
<main>
  <h1>Selected Code</h1>

  <div class="flex-container">
    <?php echo $currentCode->asHTMLTableRowWithEdit($user); ?>
  </div>
  <a href="codes">Show all codes</a>
  <div class="commentContainer">
      <?php foreach ($comments as $comment)
    	        echo $comment->asHTMLTableRowWithEdit($user); ?>
  </div>
  <br>        <!--must be removed after some css-->
  <?php if(isset($_SESSION['userid'])):?>
    <span>Leave a comment :</span>
    <form class ="addComment" action = "addComment" method="post">
      <textarea type="text" name="content" required></textarea>
      <input type="hidden" name="codesid" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Submit">
    </form>
    <?php if(isset($currentComment)):?>
      <form action="updateComment" method="post">
        <p>Edit the comment : </p>
        <textarea name="content" required><?= htmlentities($currentComment->getContent()); ?></textarea>
        <input type="hidden"  name="id" value="<?= htmlentities($currentComment->getId()); ?>">
        <input type="hidden" name="codesid" value="<?= htmlentities($currentCode->getId()); ?>">
        <input type="submit" class="button" value="Submit">
      </form>
      </br>           <!--must be removed after some css-->
      <form action="deleteComment" method="post">
        <input type="hidden" name="id" value="<?= htmlentities($currentComment->getId()); ?>">
        <input type="submit" class="button" value="Delete Comment">
      </form>
    <?php endif;?>
  <?php endif;?>
</main>
</div>

<?php require('partials/footer.php'); ?>