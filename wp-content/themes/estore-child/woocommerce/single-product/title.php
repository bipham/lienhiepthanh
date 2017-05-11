<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$current_language = pll_current_language();
if ($current_language == 'en') {
    $title_product_trans = get_field('title_product_trans_en', 'option');
}
else {
    $title_product_trans = get_field('title_product_trans', 'option');
}
?>
<div class="title-product-custom woo-custom-product">
    <h6 class="title-product-custom woo-custom-inline"><?php echo $title_product_trans; ?>: </h6>
    <?php
        the_title( '<span class="title-content-product-custom">', '</span>' );
    ?>
</div>
