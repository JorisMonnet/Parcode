<?php
    $title = "Add New Code";
    require('partials/header.php');
    $_SESSION['currentPage'] ="addCode";
?>

<main>
    <h1>Add New Code</h1>
    <p>The following form allow you to add a new code </p>
    <form action = "addForm" method="post" class="buttonEditCode">
        <h2>Code :</h2>
        <textarea name="content" class="bigTextarea" required></textarea>
        <h2>Groups(only characters and numbers) :</h2>
        <p>You can add a group by putting a "." between the two groups <br>(example: appWeb.php.projets)</p>
        <input type="text" name="groups" class="inputText" id="inputTextGroups" pattern="^([\w]+([.]?[\w]+)+)+$" required>
        <input type="submit" class="button" value="Submit">
    </form>
</main>

<?php require('partials/footer.php') ?>
