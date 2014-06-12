<?php
/**
 * @package Project Name
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="row collapse">
	    <?php if (is_search()) {
	    	$buscapor = $_GET['s']; ?>
		    <div class="">
		        <input type="text" value="" placeholder="<?php echo $buscapor ?>" name="s" id="s" />
		    </div>
		<?php } else { ?>
		    <div class="">
		        <input type="text" value="" placeholder="Faça sua busca" name="s" id="s" />
		    </div>
		<?php } ?>
    </div>
</form>
