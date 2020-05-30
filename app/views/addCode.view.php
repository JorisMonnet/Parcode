<?php
    $title = "Add New Code";
    require_once('partials/header.php');
    $_SESSION['currentPage'] ="addCode";
?>

<main>
    <h1>Add New Code</h1>
    <p>The following form allow you to add a new code </p>
    <form action = "addForm" method="post" class="formEditCode">
        <h2>Code :</h2>
        <label for="title">Title of the code (maximum length : 100):</label>
        <input type="text" name="title" class="titleInput" class="inputText" pattern="^.{0,100}$" required>
        <textarea name="content" class="bigTextarea" required></textarea>
        <h2>Groups(only characters and numbers) :</h2>
        <p>You can add a group by putting a "." between the two groups <br>A group can have 30 letters Maximum <br> (example: appWeb.php.projects)</p>
        <input type="text" name="groups" class="inputText" id="inputTextGroups" pattern="^([\w]+([.]?[\w]+)+)+$" required>
        <input type="submit" class="button" value="Submit">
    </form>
</main>

<?php require_once('partials/footer.php') ?>
