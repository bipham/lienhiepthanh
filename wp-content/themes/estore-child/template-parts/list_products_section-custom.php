<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying add list products section custom.
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
$list_products = get_field('list_products');
if ($list_products):
    foreach ($list_products as $key => $list_product):
        $product_features = $list_product['product'];
        ?>
        <?php if ($product_features): ?>
        <div class="list-products-custom row row-fluid">
            <div class="title">
                <h4 style="color: <?php echo $list_product['color_title']; ?>; font-size: <?php echo $list_product['font_size_title']; ?>px;">
                    <span class="underline-title">
                        <?php echo $list_product['title_list']; ?>
                    </span>
                </h4>
            </div>
            <?php foreach ($product_features as $k => $product_feature): ?>
                <div class="card col-xxs-12 col-xs-6 col-sm-4 col-md-4 product-item">
                    <div class="card-top-thumbnail">
                        <a class="img-middle-custom" href="<?php echo $product_feature->guid; ?>">
                            <?php
                            $image_id = get_post_thumbnail_id($product_feature->ID);
                            $size = 'full';
                            $image_url = wp_get_attachment_image_src($image_id, $size, false);
                            if ($image_url) {
                                $image = wp_get_attachment_image( get_post_thumbnail_id( $product_feature->ID ), '', '', array( "class" => "img-vertical-center img-responsive img-product-custom" ) );
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
                                        <a href="<?php echo $product_feature->guid; ?>">
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
                            <a href="<?php echo $product_feature->guid; ?>">
                                <h6 class="card-title title-product"><?php echo $product_feature->post_title; ?></h6>
                            </a>
                        </span>
                    </div>
                    <div class="card-footer card-footer-product">
                        <div class="detail">
                            <a href="#" title="Chọn cửa hàng trực tuyến" class="btn btn-detail" data-toggle="modal" data-target=".bd-select-store-modal-lg-<?php echo $product_feature->ID; ?>">
                                <?php echo $title_button_buy; ?>
                            </a>
                            <div class="modal fade bd-select-store-modal-lg-<?php echo $product_feature->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                            $address_buy = get_field('address_buy', $product_feature->ID);
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
    <?php endforeach; ?>
<?php endif; ?>
