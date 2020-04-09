<?php
    $title = "Code page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId();  //if we login here, we want the user to return to the codes page, if he want to add some
?>

<div class="main">
    <main>
        <h1>Selected Code</h1>
        <div class="flex-container">
            <?php if($user==$currentCode->getAuthor()):?>
                <form action="updateForm" method="post">
                    <p>This form allow you to edit the code</p>
                    <textarea class="flex-container" name="content" required><?= htmlentities($currentCode->getContent()); ?></textarea>
                    <input type="hidden"  name="id" value="<?= htmlentities($currentCode->getId()); ?>">
                    <input type="submit" class="button" value="Submit">
                </form>
                </br>           <!--must be removed after some css-->
                <form action="deleteForm" method="post">
                    <input type="hidden" name="id" value="<?= htmlentities($currentCode->getId()); ?>">
                    <input type="submit" class="button" value="Delete Code">
                </form>
            <?php endif;?>
            </div>
            <br>
            <?php echo "<a href=code?id=".$currentCode->getId().">Discard all changes</a>";?>
            <a href="codes">Show all codes</a>
    </main>
</div>

<?php require('partials/footer.php'); ?>
