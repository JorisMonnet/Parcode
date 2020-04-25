<?php
    $title = "Code page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="code?id=".$currentCode->getId(); //never go to this page directly, only frome the code page
?>

<div class="main">
    <main>
        <h1>Selected Code</h1>
        <?php if($user==$currentCode->getAuthor()):?>
            <div class="buttonEditCode">
                <form action="updateForm" method="post" class="buttonEditCode">
                    <p>This form allow you to edit the code</p>
                    <textarea name="content" required><?= htmlentities($currentCode->getContent()); ?>  </textarea>
                    <input type="hidden"  name="id" value="<?= htmlentities($currentCode->getId()); ?>">
                    <input type="submit" class="button" value="Submit">
                </form>
                </br>           <!--must be removed after some css-->
                <form action="deleteForm" method="post" class="buttonEditCode">
                    <input type="hidden" name="id" value="<?=htmlentities($currentCode->getId()); ?>">
                    <input type="submit" class="button" value="Delete Code">
                </form>
                <br>
                <?php echo "<a href=code?id=".$currentCode->getId()."   class='discard'>Discard all changes</a>";
            endif;?>
            <br>  <!--must be removed after some css-->
            <a href="codes" class="showRef">Show all codes</a>
        </div>
    </main>
</div>
<br>
<?php require('partials/footer.php'); ?>
