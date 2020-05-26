<?php
    $title = "Codes page";
    require_once('partials/header.php');
    $_SESSION['currentPage'] ="codes";
?>
<main>
    <h1>Parcode All Codes</h1>
	<?php 	
		if (isset($codeAddSuccess)&&$codeAddSuccess!="0")
        	echo "<p class='successMessage'> SUCCESS - code ". ($codeAddSuccess=="1"? "added":"updated" )."</p>";
        else if(isset($codeAddFailure)&&$codeAddFailure!="")
        	echo "<p class='successMessage'>".htmlentities($codeAddFailure)."</p>";
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

    <script>showSortCodes("<?=$codesSort?>","<?=$codesOrder?>")</script>
    <?php foreach ($codes as $code)
    	    echo $code->asHTMLTableRow();
    ?>
</main>

<?php require_once('partials/footer.php'); ?>
