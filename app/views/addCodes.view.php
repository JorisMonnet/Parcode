<?php
    $title = "Add New Code";
    require('partials/header.php')
?>
<div class="main">
<h1>Add New Code</h1>
<main>
    <p>
        The following form allow you to add a new code
    </p>
    <form action = "parse_add_form" method="post">
      <input type="text" name="content" required>
      <input type="submit" value="Submit">
    </form>
    <p>
        <a href="codes">Show all codes</a>
    </p>
</main>
</div>
<?php require('partials/footer.php') ?>
