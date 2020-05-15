<?php
    $title = "Codes page";
    require('partials/header.php');
    $_SESSION['currentPage'] ="codes";
?>
<main>
  <nav>
    <?php 
      foreach ($groups as $group)
        echo '<a href = "codes?group='.urlencode($group).'">'.htmlentities($group).'</a>';
    ?>
  </nav>
    <h1>My codes</h1>
    <?php
        if (isset($codeAddSuccess)&&$codeAddSuccess!="0")
          echo "<p class='successMessage'> SUCCESS - code ". ($codeAddSuccess=="1"? "added":"updated" )."</p>";
        else
          echo "<p class='successMessage'>".$codeAddFailure."</p>";
    ?>
    <form action="parseFormSort" method="post" name="formSort" id="formSort">
      	<label for="sortSelect">Trier Par</label>
      	<select id="sortSelect" name="sort" class="button">
        	<option value="date">Date</option>
        	<option value="id">Id</option>
        	<option value="author">Author</option>
      	</select>
      
      	<label for="orderSelect">Par Ordre</label>
      	<select id="orderSelect" name="order" class="button">
        	<option value="desc">Décroissant</option>
        	<option value="asc">Croissant</option>
      	</select>
      	<input type="submit" class="button" value="Submit">
    </form>
    <?php foreach ($codes as $code)
    	    echo $code->asHTMLTableRow();
    ?>
</main>

<?php require('partials/footer.php'); ?>
