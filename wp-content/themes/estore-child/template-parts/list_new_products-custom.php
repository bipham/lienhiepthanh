<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying add list new products section custom.
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */
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
<?php
$number_products_display_auto = get_field('number_products_display_auto');
$new_products = get_posts( array(
    'post_type' => 'product',
    'lang' => $current_language, // query posts in all languages
    'showposts' => $number_products_display_auto,
) );
if ($new_products):
    $title_list_new_product_auto = get_field('title_list_new_product_auto');
    $color_title_list_new_product_auto = get_field('color_title_list_new_product_auto');
    $font_size_title_list_new_product_auto = get_field('font_size_title_list_new_product_auto');
    $display_device = get_field('display_device');
    ?>
    <div class="list-new-products-auto list-products-custom row row-fluid <?php if ($display_device == 0) echo 'hidden_class'; ?>">
        <div class="title">
            <h4 style="color: <?php echo $color_title_list_new_product_auto; ?>; font-size:  <?php echo $font_size_title_list_new_product_auto; ?>px;">
                <span class="underline-title">
                    <?php echo $title_list_new_product_auto; ?>
                </span>
            </h4>
        </div>
        <?php foreach ($new_products as $k => $new_product): ?>
            <div class="card col-xxs-12 col-xs-6 col-sm-4 col-md-4 product-item">
                <div class="card-top-thumbnail">
                    <a class="img-middle-custom" href="<?php echo $new_product->guid; ?>">
                        <?php
                        $image_id = get_post_thumbnail_id($new_product->ID);
                        $size = 'full';
                        $image_url = wp_get_attachment_image_src($image_id, $size, false);
                        if ($image_url) {
                            $image = wp_get_attachment_image( get_post_thumbnail_id( $new_product->ID ), '', '', array( "class" => "img-vertical-center img-responsive img-product-custom" ) );
                            echo $image;
                        }
                        else { ?>
                            <img class="img-vertical-center img-responsive img-product-custom" src="<?php echo ( has_post_thumbnail() ) ? esc_url( $image_url[0] ) : estore_woocommerce_placeholder_img_src(); ?>">
                        <?php } ?>
                    </a>
                    <?php if ( get_theme_mod( 'estore_woocommerce_product_thumb_mask', '' ) != 1) : ?>
                        <div class="frame-hover-product w3-animate-top">
                            <div class="button-area-product-item">
                                <span class="btn favorite-product btn-for-product">
                                    <a href="<?php echo $new_product->guid; ?>">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </span>
                                <span class="btn zoom-product btn-for-product">
                                    <a href="<?php echo $image_url[0]; ?>" class="zoom" data-rel="prettyPhoto">
                                        <i class="fa fa-search-plus"> </i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-block card-body-product">
                    <span class="name-product">
                        <a href="<?php echo $new_product->guid; ?>">
                            <h6 class="card-title title-product"><?php echo $new_product->post_title; ?></h6>
                        </a>
                    </span>
                </div>
                <div class="card-footer card-footer-product">
                    <div class="detail">
                        <a href="#" title="Chọn cửa hàng trực tuyến" class="btn btn-detail" data-toggle="modal" data-target=".bd-select-store-modal-lg-<?php echo $new_product->ID; ?>">
                            <?php echo $title_button_buy; ?>
                        </a>
                        <div class="modal fade bd-select-store-modal-lg-<?php echo $new_product->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                        $address_buy = get_field('address_buy', $new_product->ID);
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
        <?php endforeach; ?>
    </div>
<?php endif; ?>
