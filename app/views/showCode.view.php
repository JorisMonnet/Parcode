<?php
    $title = "Code page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="codes";  //if we login here, we want the user to return to the codes page, if he want to add some
?>

<div class="main">
<main>
  <h1>Selected Code</h1>

  <div class="flex-container">
    <?php echo $currentCode->asHTMLTableRowWithEdit($user); ?>
  </div>
  <div class="commentContainer">
      <?php 
          foreach ($comments as $comment)
    	        echo $comment->asHTMLTableRow();
      ?>
  </div>
  <br>        <!--must be removed after some css-->
  <?php if(isset($_SESSION['userid'])):?>
      <span>Add Comment</span>
  <p>
    <form action = "addComment" method="post">
      <textarea type="text" name="content" required></textarea>
      <input type="hidden" name="codesid" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Submit">
    </form>
    <a href="codes">Show all codes</a>
  </p>
  <?php endif;?>
  <div id="hiddenForm">
    <form action="updateForm" method="post">
      <p>This form allow you to edit the code</p>
      <textarea name="content" required><?= htmlentities($currentCode->getContent()); ?></textarea>
      <input type="hidden"  name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Submit">
    </form>
    </br>           <!--must be removed after some css-->
    <form action="deleteForm" method="post">
      <input type="hidden" name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" class="button" value="Delete Code">
    </form>
  </div>
</main>
</div>

<?php require('partials/footer.php'); ?>
