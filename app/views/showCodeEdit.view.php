<?php
    $title = "Code page";
    require_once('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId();
?>

<main>
    <h1>Selected Code</h1>
    <?php if($user==$currentCode->getAuthor()):?>
        <form action="updateForm" method="post" class="formEditCode">
            <p>This form allow you to edit the code</p>
            <textarea class="bigTextarea" name="content" required><?= htmlentities($currentCode->getContent()); ?>  </textarea>
            <input type="hidden"  name="id" value="<?= htmlentities($currentCode->getId()); ?>"><br>
            <input class="inputText" type="text" name="groups" value="<?= htmlentities($currentCode->getGroups()); ?>" required>
            <input type="submit" class="button" value="Submit">
            <?php echo "<a href=code?id=".$currentCode->getId()."   id='discard'>Discard all changes</a>";?>
        </form>
    <?php endif;?>
</main>

<?php require_once('partials/footer.php'); ?>
