<?php
    $title = "Add New Task";
    require('partials/header.php')
?>
<div class="main">
<h1>Add New Task</h1>
<main>

    <p>
        The following form allow you to add a new task
    </p>

    <form action = "parse_add_form" method="post">
      <input type="text" name="description" required>
      <input type="checkbox" name="completed">
      <!--
        input type="date" is not activated by default in Firefox.
        However, it is supported  since version 51 (January 26, 2017), but it is not activated by default (yet)
        To activate it:

        about:config
        dom.forms.datetime -> set it to true

        Possible variant
        <input type="datetime-local" name="deadline" />
      -->
      <input type="date" name="deadline">
      <input type="submit" value="Submit">
    </form>
    <p>
        <a href="tasks">Show all tasks</a>
    </p>
</main>
</div>
<?php require('partials/footer.php') ?>
