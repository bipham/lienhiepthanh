<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 23-Apr-17
 * Time: 15:50
 */

/**
 * Single SKU product
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sku-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;

$current_language = pll_current_language();
if ($current_language == 'en') {
    $title_product_code_trans = get_field('title_product_code_trans_en', 'option');
}
else {
    $title_product_code_trans = get_field('title_product_code_trans', 'option');
}
?>
<div class="sku-product-custom woo-custom-product">
    <h6 class="title-sku-product-custom woo-custom-inline"><?php echo $title_product_code_trans; ?>: </h6>
    <span class="sku-content-product-custom">
        <?php
            $sku_product = get_field('sku_product');
            echo $sku_product;
        ?>
    </span>
</div>
