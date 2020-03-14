<?php
    $title = "Code page";
    require('partials/header.php');
?>
<div class="main">

<main>
    <h1>Selected Code</h1>

    <div class="flex-container">
    <?php echo $currentCode->asHTMLTableRowWithEdit(); ?>

    </div>

    <p>
        <a href="codes">Show all codes</a>
    </p>
    <form id='hiddenForm' action="parse_update_form" method="post">
      <p>This form allow you to edit the code</p>
      <input type="text" name="content" value="<?= htmlentities($currentCode->getContent()); ?>" required >
      <!--<input type="date" name="date" value="<?= //htmlentities($currentCode->getDate()); ?>">
      <input type="hidden" name="login" value="<?= //htmlentities($currentCode->getAuthor()); ?>">    //think it's useless but keep it until i test it
      <input type="hidden" name="id" value="<?= //htmlentities($currentCode->getId()); ?>">-->
      <input type="submit" value="Submit">
    </form>

    <form action="delete_form" method="post">
      <input type="hidden" name="id" value="<?= htmlentities($currentCode->getId()); ?>">
      <input type="submit" value="Delete task">
    </form>


</main>
<br />
</div>

<?php require('partials/footer.php'); ?>
