<?php
    $title = "Codes page";
    require('partials/header.php');
?>
<div class="main">
<main>
   <?php
        if (isset($code_added_success) && $code_added_success === true) {
        ?>
          <p class="success">
            <?php  "SUCCESS - code added"; ?>
          </p>
        <?php
        }
        ?>

    <h1>My codes</h1>

    <div class="flex-container">

    <?php foreach ($codes as $code) {
    	echo $tacodesk->asHTMLTableRow();
    }?>
    </div>

    <a href="add_task">Add Task</a>

    </form>

</main>
<br />
</div>

<?php require('partials/footer.php'); ?>
