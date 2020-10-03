<?php
/**
 * The template for displaying search form.
 *
 * @package Allo
 * @since 1.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="searchform">
	<div class="search-box">
	    <div class="input-group stylish-input-group">
	        <input type="search" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search &hellip;', 'allo' ); ?>" value="<?php echo esc_html( get_search_query() ); ?>" required >
	        <span class="input-group-addon">
	            <button type="submit">
	                <span class="glyphicon glyphicon-search"></span>
	            </button>  
	        </span>
	    </div>
	</div>
</form> 