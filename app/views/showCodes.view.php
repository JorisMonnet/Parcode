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
    <label for="sort">Trier Par</label>
    <form action="parseFormSort" method="post" name="formSort" id="formSort">
      <select id="sortSelect" name="sort">
        <option value="date">Date</option>
        <option value="id">Id</option>
        <option value="author">Author</option>
      </select>
      
      <label for="order">Par Ordre</label>
      <select id="orderSelect" name="order">
        <option value="desc">Décroissant</option>
        <option value="asc">Croissant</option>
      </select>
      <input type="submit" class="button" value="Submit">
    </form>
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
