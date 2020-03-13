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
      <!--
        input type="date" is not activated by default in Firefox.
        However, it is supported  since version 51 (January 26, 2017), but it is not activated by default (yet)
        To activate it:

        about:config
        dom.forms.datetime -> set it to true

        Possible variant
        <input type="datetime-local" name="date" />
      -->
      <input type="date" name="date">
      <input type="submit" value="Submit">
    </form>
    <p>
        <a href="codes">Show all codes</a>
    </p>
</main>
</div>
<?php require('partials/footer.php') ?>
