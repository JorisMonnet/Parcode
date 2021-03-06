<?php
    $title = "Code ".$currentCode->getId();
    require_once('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId();
?>

<main>
  	<h1>Code <?= htmlentities($currentCode->getId())." : ".htmlentities($currentCode->getTitle()); ?></h1>
  
  	<?php echo $currentCode->asHTMLTableRowWithEdit($user); ?>
  	<h2>Commentaires</h2>
  	<hr class="bigHR">

  	<?php if(isset($_SESSION['userid'])):?>
    	<form action = "addComment" method="post">
      		<label for="contentAddComment">Leave a comment : </label>
			<textarea class ="flex-container" id="contentAddComment" name="content" required></textarea>
			<input type="hidden" name="codesid" value="<?= htmlentities($currentCode->getId()); ?>">
			<input type="submit" class="button" value="Submit">
    	</form>

    <hr class="bigHR">
  	<?php endif;
    $i=0;   
    foreach ($comments as $comment)
        echo $comment->asHTMLTableRowWithEdit($user,$i++);
    ?>
</main>
<?php require_once('partials/footer.php'); ?>