<?php
    $title = "Tasks page";
    require('partials/header.php');
?>
<div class="main">
<main>
   <?php
        if (isset($task_added_success) && $task_added_success === true) {
        ?>
          <p class="success">
            <?php  "SUCCESS - task added"; ?>
          </p>
        <?php
        }
        ?>

    <h1>My tasks</h1>

    <div class="flex-container">

    <?php foreach ($tasks as $task) {
    	echo $task->asHTMLTableRow();
    }?>
    </div>

    <a href="add_task">Add Task</a>

    </form>

</main>
<br />
</div>

<?php require('partials/footer.php'); ?>
