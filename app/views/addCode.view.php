<?php
    $title = "Add New Code";
    require('partials/header.php');
    $_SESSION['currentPage'] ="addCode";
?>

<main>
    <h1>Add New Code</h1>
    <p>The following form allow you to add a new code </p>
    <form action = "addForm" method="post" class="buttonEditCode">
        <p>Code :</p>
        <textarea name="content" class="bigTextarea" required></textarea>
        <p>Groups(only characters and numbers) :</p>
        <input type="text" name="groups" class="inputText" id="inputTextGroups" pattern="\w{1,}" required>
        <input type="submit" class="button" value="Submit">
    </form>
</main>

<?php require('partials/footer.php') ?>
