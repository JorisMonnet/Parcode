<?php
    $title = "Add New Code";
    require('partials/header.php');
    $_SESSION['currentPage'] ="addCode";
?>
<div class="main">
<h1>Add New Code</h1>
<main>
    <p>
        The following form allow you to add a new code
    </p>
    <form action = "addForm" method="post" class="buttonEditCode">
      <textarea type="text" name="content" required></textarea>
      <input type="submit" class="button" value="Submit">
    </form>
    <p class="buttonEditCode">
        <a href="codes" class="showRef">Show all codes</a>
    </p>
</main>
</div>
<?php require('partials/footer.php') ?>
