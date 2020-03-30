<?php
    $title = "Codes page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="codes";
?>
<div class="main">
<main>

    <h1>My codes</h1>
    <?php
        if (isset($codeAddSuccess)&&$codeAddSuccess!="0")
          echo "<p class='successMessage'> SUCCESS - code ". ($codeAddSuccess=="1"? "added":"updated" )."</p>";
        else
          echo "<p class='successMessage'>".$codeAddFailure."</p>";
    ?>
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
</div>
<?php require('partials/footer.php'); ?>
