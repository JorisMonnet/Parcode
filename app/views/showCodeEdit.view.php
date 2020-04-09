<?php
    $title = "Code page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId(); //never go to this page directly
?>

<div class="main">
    <main>
        <h1>Selected Code</h1>
        <?php if($user==$currentCode->getAuthor()):?>
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
            <br>
            <?php echo "<a href=code?id=".$currentCode->getId().">Discard all changes</a>";
        endif;?>
        <br><br>  <!--must be removed after some css-->
        <a href="codes">Show all codes</a>
    </main>
</div>

<?php require('partials/footer.php'); ?>
