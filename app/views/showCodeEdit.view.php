<?php
    $title = "Code page";
    require_once('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId();
?>

<main>
    <h1>Selected Code</h1>
    <form action="updateForm" method="post" class="formEditCode">
        <p>This form allow you to edit the code</p>
        <label for="title">Title of the code (maximum length : 100):</label>
        <input type="text" name="title" class="titleInput" class="inputText" pattern="^.{0,100}$" required value="<?= htmlentities($currentCode->getTitle()); ?>">
        <textarea class="bigTextarea" name="content" required><?= htmlentities($currentCode->getContent()); ?>  </textarea>
        <input type="hidden"  name="id" value="<?= htmlentities($currentCode->getId()); ?>"><br>
        <input class="inputText" type="text" name="groups" value="<?= htmlentities($currentCode->getGroups()); ?>" pattern="^([\w]+([.]?[\w]+)+)+$" required>
        <input type="submit" class="button" value="Submit">
        <?php echo "<a href=code?id=".$currentCode->getId()."   id='discard'>Discard all changes</a>";?>
    </form>
</main>

<?php require_once('partials/footer.php'); ?>
