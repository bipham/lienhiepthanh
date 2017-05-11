<?php
/**
 * The template for displaying search forms in estore.
 *
 * @package ThemeGrill
 * @subpackage estore
 * @since estore 1.0
 */
$current_language = pll_current_language();
?>
<form role="search" method="get" class="searchform woocommerce-product-search" action="<?php echo esc_url( home_url( '/' . '/' ) ); ?>">
	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="searchsubmit" name="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>"><i class="fa fa-search"></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>