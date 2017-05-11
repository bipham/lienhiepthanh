<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $post;
$size = 'full';
if ( has_post_thumbnail() ) {
    $image_id = get_post_thumbnail_id($post->ID);
    $image_url = wp_get_attachment_image_src($image_id, $size, false);
}
//var_dump($product->get_id());
//Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$current_language = pll_current_language();
if ($current_language == 'en') {
    $title_button_buy = get_field('title_button_buy_en', 'option');
    $title_button_detail = get_field('title_button_detail_en', 'option');
    $title_modal_select_store = get_field('title_modal_select_store_en', 'option');
    $title_button_exit = get_field('title_button_exit_en', 'option');
}
else {
    $title_button_buy = get_field('title_button_buy', 'option');
    $title_button_detail = get_field('title_button_detail', 'option');
    $title_modal_select_store = get_field('title_modal_select_store', 'option');
    $title_button_exit = get_field('title_button_exit', 'option');
}
?>
<div class="card col-xxs-12 col-xs-6 col-sm-4 col-md-4 product-item">
        <div class="card-top-thumbnail store-item-inner">
            <a class="img-middle-custom" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" alt="<?php the_title(); ?>">
                <img class="img-vertical-center img-responsive img-product-custom" src="<?php echo ( has_post_thumbnail() ) ? esc_url( $image_url[0] ) : estore_woocommerce_placeholder_img_src(); ?>">
            </a>
            <?php if ( get_theme_mod( 'estore_woocommerce_product_thumb_mask', '' ) != 1) : ?>
                <div class="frame-hover-product w3-animate-top">
                    <div class="button-area-product-item">
                                                    <span class="btn favorite-product btn-for-product">
                                                        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                        <span class="btn zoom-product btn-for-product">
                                                        <a href="<?php echo $image_url[0]; ?>" class="zoom" data-rel="prettyPhoto"><i class="fa fa-search-plus"> </i></a>
                                                    </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-block card-body-product">
                                            <span class="name-product">
                                                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
                                                    <h6 class="card-title title-product"><?php echo esc_html(get_the_title()); ?></h6>
                                                </a>
                                            </span>
        </div>
        <div class="card-footer card-footer-product">
            <div class="detail">
                <a href="#" title="Chọn cửa hàng trực tuyến" class="btn btn-detail" data-toggle="modal" data-target=".bd-select-store-modal-lg-<?php echo $product->get_id(); ?>">
                    <?php echo $title_button_buy; ?>
                </a>
                <div class="modal fade bd-select-store-modal-lg-<?php echo $product->get_id(); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="selectOnlineStore">
                                    <?php echo $title_modal_select_store; ?>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $address_buy = get_field('address_buy', $product->get_id());
                                $store_selected = $address_buy[0]['select_address'];
                                $stores_added = $address_buy[0]['add_new_store'];
                                ?>
                                <?php if ((sizeof($store_selected) != 0) || ($stores_added != false)): ?>
                                    <?php $i = 0; ?>
                                    <ul class="list-online-store">
                                        <?php if (sizeof($store_selected) != 0): ?>
                                            <?php foreach ($store_selected as $key => $store): ?>
                                                <?php if ($store == '0'): ?>
                                                    <li>
                                                        <a target="_blank" title="A Đây Rồi" href="https://www.adayroi.com/tim-kiem?q=lht">
                                                            <img class="img-<?php echo $i; $i+=1; ?>" alt="A Đây Rồi" src="/data/upload/QC/download.png">
                                                        </a>
                                                    </li>
                                                <?php elseif($store == '1'): ?>
                                                    <li>
                                                        <a target="_blank" title="Tiki" href="http://tiki.vn/search?q=lht">
                                                            <img class="img-<?php echo $i; $i+=1; ?>" alt="Tiki" src="/data/upload/QC/1_tiki.jpg">
                                                        </a>
                                                    </li>
<!--                                                --><?php //elseif($store == '2'): ?>
<!--                                                    <li>-->
<!--                                                        <a target="_blank" title="Liên Hiệp Thành" href="http://www.lienhiepthanh.com/lien-he">-->
<!--                                                            <img class="img---><?php //echo $i; $i+=1; ?><!--" alt="Liên Hiệp Thành" src="/data/upload/QC/logolhtaaa020612.jpg">-->
<!--                                                        </a>-->
<!--                                                    </li>-->
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if ($stores_added != false): ?>
                                            <?php foreach ($stores_added as $key => $store_added): ?>
                                                <li>
                                                    <a target="_blank" title="<?php echo $store_added['name_store']; ?>" href="<?php echo $store_added['link_to_store']; ?>">
                                                        <img class="img-<?php echo $i; $i+=1; ?>" alt="<?php  echo $store_added['image_brand_store']['title']; ?>" src="<?php echo $store_added['image_brand_store']['url']; ?>">
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success btn-custom" data-dismiss="modal">
                                    <?php echo $title_button_exit; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>