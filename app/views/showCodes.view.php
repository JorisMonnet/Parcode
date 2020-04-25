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
      <select id="sortSelect" name="sort" class="button">
        <option value="date">Date</option>
        <option value="id">Id</option>
        <option value="author">Author</option>
      </select>
      
      <label for="order">Par Ordre</label>
      <select id="orderSelect" name="order" class="button">
        <option value="desc">Décroissant</option>
        <option value="asc">Croissant</option>
      </select>
      <input type="submit" class="button" value="Submit">
    </form>
    <br>
    <?php if(isset($_SESSION['userid'])):?>
        <a href="addCode" class="buttonEditCode">Add Code</a>
    <?php endif; ?>
    <br>
    <div class="flex-container">
      <?php foreach ($codes as $code){
    	        echo $code->asHTMLTableRow();
              echo "<br>";
              }
      ?>
    
    </form>
</main>
</div>
<br>
<?php require('partials/footer.php'); ?>
