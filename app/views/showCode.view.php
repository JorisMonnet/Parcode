<?php
    $title = "Task page";
    require('partials/header.php');
?>
<div class="main">

<main>
    <h1>Selected Task</h1>

    <div class="flex-container">
    <?php echo $currentTask->asHTMLTableRowWithEdit(); ?>

    </div>

    <p>
        <a href="tasks">Show all tasks</a>
    </p>
    <form id='hiddenForm' action="parse_update_form" method="post">
      <p>This form allow you to edit the task</p>
      <input type="text" name="description" value="<?= htmlentities($currentTask->getDescription()); ?>" required >
      <input type="checkbox" name="completed" <?php if($currentTask->isComplete()) { echo "checked";} ?>>
      <input type="date" name="deadline" value="<?= htmlentities($currentTask->getDeadline()); ?>">
      <input type="hidden" name="login" value="<?= htmlentities($currentTask->getLogin()); ?>">
      <input type="hidden" name="id" value="<?= htmlentities($currentTask->getId()); ?>">
      <input type="submit" value="Submit">
    </form>

    <form action="delete_form" method="post">
      <input type="hidden" name="id" value="<?= htmlentities($currentTask->getId()); ?>">
      <input type="submit" value="Delete task">
    </form>


</main>
<br />
</div>

<?php require('partials/footer.php'); ?>
