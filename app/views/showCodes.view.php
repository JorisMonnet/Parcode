<?php
    $title = "Codes page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="codes";
?>
<div class="main">
<main>
   <?php
        if (isset($code_added_success) && $code_added_success === true) {
    ?>
          <p class="success">
            <?php  "SUCCESS - code added"; ?>
          </p>
        <?php
        }
        ?>

    <h1>My codes</h1>
        
    <div class="flex-container">
      <?php foreach ($codes as $code)
    	        echo $code->asHTMLTableRow();
      ?>
    </div>
    <?php if(isset($_SESSION['userid'])):?>
        <a href="addCode">Add Code</a>
    <?php endif; ?>
    </form>
</main>
<br />
</div>
<?php require('partials/footer.php'); ?>
