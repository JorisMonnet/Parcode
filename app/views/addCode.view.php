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
    <form action = "addForm" method="post">
      <textarea type="text" name="content" required></textarea>
      <input type="submit" value="Submit">
    </form>
    <p>
        <a href="codes">Show all codes</a>
    </p>
</main>
</div>
<?php require('partials/footer.php') ?>
