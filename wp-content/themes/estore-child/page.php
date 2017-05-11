<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 19-Apr-17
 * Time: 22:39
 */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */

get_header();

do_action( 'estore_before_body_content' );

$estore_layout = estore_layout_class();
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
<div id="content" class="site-content">
    <main id="main" class="clearfix <?php echo esc_attr($estore_layout); ?>">
        <div class="tg-container full-width-ipad padding-clear">
            <div id="primary">
                <div class="col-md-3 menu-cates hidden-ipad">
                    <div class="cata">
                        <?php
                        if ($current_language == 'en') {
                            $categories_custom = get_field('en_category_create', 'option');
                        }
                        else {
                            $categories_custom = get_field('vn_category_create', 'option');
                        }
//                        var_dump($categories_custom);
                        foreach ($categories_custom as $category_custom) {
                            echo '<div class="box">
                                        <div class="title">
                                            <h4>'. $category_custom['title_category'] . '</h4>
                                        </div>';
                            $sub_categories_custom = $category_custom['list_sub_categories'];
                            if($sub_categories_custom) {
                                echo '<div class="content">
                                            <ul>';
                                foreach($sub_categories_custom as $sub_category_custom) {
                                    $permalink = get_term_link($sub_category_custom->slug, 'product_cat');
                                    $permalink = str_replace( './', '', $permalink );
                                    echo  '<li><a href="'. $permalink .'"><i class="fa fa-caret-right icon-left-menu" aria-hidden="true"></i>' . $sub_category_custom->name .'</a></li>';
                                }
                                echo '</ul>
                                       </div>';
                            }
                            echo '</div>';
                        }
                        ?>
                        <?php
                        $box_info = get_field('box_info', 'option');
                        $rows_info = $box_info[0]['row_info'];
//                        var_dump($rows_info);
                        if ($box_info != ''):
                        ?>
                        <div class="box-comments" style="background: <?php echo $box_info[0]['background_color']; ?>">
                            <div class="title" style="background: <?php echo $box_info[0]['background_title']; ?>">
                                <h4 style="color: <?php echo $box_info[0]['color_title']; ?>; font-size: <?php echo $box_info[0]['font_size_title']; ?>px;">
                                    <?php
                                        if ($current_language == 'en') {
                                            echo $box_info[0]['title_en'];
                                        }
                                        else {
                                            echo $box_info[0]['title'];
                                        }
                                    ?>
                                </h4>
                            </div>
                            <div class="content">
                                <ul>
                                    <?php foreach ($rows_info as $key => $row_info): ?>
                                    <li>
                                        <span class="icon-lht"><i class="fa <?php echo $row_info['icon_info']; ?>" style="color: <?php echo $row_info['color_icon_option_admin']; ?>; font-size: <?php echo $row_info['size_icon_option_admin']; ?>px;" aria-hidden="true"></i></span>
                                        <p class="text-custom" style="color: <?php echo $row_info['color_content_info_option_admin']; ?>; font-size: <?php echo $row_info['font_size_content_info_option_admin']; ?>px;"><?php echo $row_info['content_info']; ?></p>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-7 content-page full-width-ipad">
                    <!-- Add slider images-->
                    <?php
                    $sliders = get_field('slider_images');
//                    var_dump($sliders);
                    ?>
                    <?php if ($sliders): ?>
                        <div class="slider-custom">
                            <ul class="bxslider slider-images-custom">
                                <?php
                                foreach ($sliders as $key => $slider):
                                    $image = $slider['image'];
                                    $title = $slider['title_image'];
                                    ?>
                                    <li><img class="img-slider-custom" src="<?php echo $image['url']; ?>" alt="<?php echo ($title != '') ? $title : $image['name']; ?>" /></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="page-content-custom">
                        <!-- Add posts-->
                        <div class="page-title">
                            <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                        </div>
                        <?php
                        while ( have_posts() ) : the_post();
                        if (get_post()->post_content != ''):
                        ?>
                            <div class="content-post">
                                <?php get_template_part( 'template-parts/content', 'page' ); ?>

                                <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;

                                get_template_part('navigation', 'none');
                                ?>
                            </div>
                        <?php
                        endif;
                        endwhile; // End of the loop.
                        ?>

                        <!-- Add preview post-->
                        <?php
                        $preview_posts = get_field('preview_post');
                        ?>
                        <?php if ($preview_posts) :?>
                            <?php foreach ($preview_posts as $key => $preview_post): ?>
                                <article class="mobile-hidden article-custom">
                                    <div class="title">
                                        <h4 style="color: <?php echo $preview_post['color_title_preview']; ?>; font-size: <?php echo $preview_post['font_size_title_preview']; ?>px;">
                                        <span class="underline-title">
                                            <?php echo $preview_post['title_preview']; ?>
                                        </span>
                                        </h4>
                                    </div>
                                    <div class="content">
                                        <?php echo $preview_post['content']; ?>
                                    </div>
                                    <div class="btn-readmore">
                                        <a class="btn btn-link" href="<?php echo $preview_post['link_to_detail']; ?>" title="<?php echo $preview_post['title_preview']; ?>">
                                            <?php echo $title_button_detail; ?>

                                        </a>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!--  Add list products-->
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
<!--                                                                                --><?php //elseif($store == '2'): ?>
<!--                                                                                    <li>-->
<!--                                                                                        <a target="_blank" title="Liên Hiệp Thành" href="http://www.lienhiepthanh.com/lien-he">-->
<!--                                                                                            <img class="img---><?php //echo $i; $i+=1; ?><!--" alt="Liên Hiệp Thành" src="/data/upload/QC/logolhtaaa020612.jpg">-->
<!--                                                                                        </a>-->
<!--                                                                                    </li>-->
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
                        <!--  Add list new products-->
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
<!--                                                                                --><?php //elseif($store == '2'): ?>
<!--                                                                                    <li>-->
<!--                                                                                        <a target="_blank" title="Liên Hiệp Thành" href="http://www.lienhiepthanh.com/lien-he">-->
<!--                                                                                            <img class="img---><?php //echo $i; $i+=1; ?><!--" alt="Liên Hiệp Thành" src="/data/upload/QC/logolhtaaa020612.jpg">-->
<!--                                                                                        </a>-->
<!--                                                                                    </li>-->
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
                        <!-- Add customers-->
                        <?php
                        $list_stores_lhts = get_field('list_stores_lht');
                        if ($list_stores_lhts):
                        ?>
                            <div class="list-stores-lht container">
                                <?php
                                $title_list_stores_lht = get_field('title_list_stores_lht');
                                if ($title_list_stores_lht != ''):
                                ?>
                                <div class="title">
                                    <h4>
                                        <span class="underline-title">
                                            <?php
                                            echo $title_list_stores_lht;
                                            ?>
                                        </span>
                                    </h4>
                                </div>
                                <?php endif; ?>
                                <div class="row">
                                    <?php $i = 0; ?>
                                    <?php foreach ($list_stores_lhts as $key => $list_stores_lht):?>
                                    <div class="col-xxs-12 col-xs-6 col-sm-3 col-md-3 store-item">
                                        <div class="store-item-inner">
                                            <a target="_blank" title="<?php echo $list_stores_lht['title_image']; ?>" href="<?php echo $list_stores_lht['link_to_store_lht']; ?>">
                                                <img class="img-vertical-center" class="img-<?php echo $i; $i+=1; ?>" alt="<?php  echo $list_stores_lht['title_image']; ?>" src="<?php echo $list_stores_lht['image']['url']; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

<!--                        add google maps-->
                        <?php
                        if (is_page('LIÊN HỆ') || is_page('CONTACT US')):
                        $location = get_field('gg_maps');
//                        var_dump($location);
                        if( !empty($location) ):
                        ?>
                        <div class="acf-map">
                            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                        </div>
                        <?php endif; ?>
                            <div class="contact-area tg-container row">
                                <div class="col-md-6 col-xs-6 form-contact-custom">
                                    <?php
                                    if ($current_language == 'en') {
                                        echo do_shortcode('[ninja_form id=2]');
                                    }
                                    else {
                                        echo do_shortcode('[ninja_form id=1]');
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($current_language == 'en') {
                                    $config_footer_option_admin = get_field('config_footer_option_admin_en', 'option');
                                }
                                else {
                                    $config_footer_option_admin = get_field('config_footer_option_admin', 'option');
                                }
                                $collumn_first_footer_option_admin = $config_footer_option_admin[0]['collumn_first_footer_option_admin'];
                                $rows_info_footer = $collumn_first_footer_option_admin[0]['row_info_footer'];
                                if ($collumn_first_footer_option_admin):
                                    ?>
                                    <div class="col-md-6 col-xs-6 info-contact-custom">
                                        <h3 class="title-custom" style="font-size: <?php echo $collumn_first_footer_option_admin[0]['font_size_title_collumn_first_footer']; ?>px;"> <?php echo $collumn_first_footer_option_admin[0]['title_collumn_first_footer']; ?></h3>
                                        <ul class="footer-first ul-custom">
                                            <?php foreach ($rows_info_footer as $key => $row_info_footer): ?>
                                                <li>
                                                    <span class="icon-lht"><i class="fa <?php echo $row_info_footer['icon_row_info_footer']; ?>" style="color: <?php echo $row_info_footer['color_icon_row_info_footer']; ?>; font-size: <?php echo $row_info_footer['font_size_icon_row_info_footer']; ?>px;" aria-hidden="true"></i></span>
                                                    <p class="text-custom" style="font-size: <?php echo $row_info_footer['font_size_content_row_info_footer']; ?>px;"><?php echo $row_info_footer['content_info_row_footer']; ?></p>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-2 list-customers hidden-ipad">
                    <?php
                    if ($current_language == 'en') {
                        $title_section_premium_logo = get_field('title_section_premium_logo_en', 'option');
                    }
                    else {
                        $title_section_premium_logo = get_field('title_section_premium_logo', 'option');
                    }
                    $logo_premium_quality = get_field('logo_premium_quality', 'option');
                    if ($logo_premium_quality):
                    ?>
                    <div class="premium-logo-section">
                        <img class="img-vertical-center img-responsive logo-quality-custom" alt="<?php  echo $logo_premium_quality['title']; ?>" src="<?php echo $logo_premium_quality['url']; ?>">
<!--                        <div class="page-title">-->
<!--                            <h4 class="entry-title-custom">-->
<!--                                --><?php //echo $title_section_premium_logo; ?>
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div class="content-post content-img-center">-->
<!--                            <img class="img-vertical-center img-responsive logo-quality-custom" alt="--><?php // echo $logo_premium_quality['title']; ?><!--" src="--><?php //echo $logo_premium_quality['url']; ?><!--">-->
<!--                        </div>-->
                    </div>
                    <?php endif; ?>
                    <?php
                    $customer_stores = get_field('customer_stores', 'option');
                    if ($current_language == 'en') {
                        $title_section_customer_banner = get_field('title_section_customer_banner_en', 'option');
                    }
                    else {
                        $title_section_customer_banner = get_field('title_section_customer_banner', 'option');
                    }
                    if ($customer_stores != ''):
                    ?>
                        <div class="stores-online-sidebar">
                            <div class="page-title">
                                <h4 class="entry-title-custom">
                                    <?php echo $title_section_customer_banner; ?>
                                </h4>
                            </div>
                            <div class="content-post">
                                <ul class="bxslider stores_online">
                                    <?php $i = 0; ?>
                                    <?php foreach ($customer_stores as $key => $store): ?>
                                        <li>
                                            <a target="_blank" title="<?php echo $store['title']; ?>" href="<?php echo $store['link_to_store_option_admin']; ?>">
                                                <img class="img-<?php echo $i; $i+=1; ?>" alt="<?php  echo $store['title']; ?>" src="<?php echo $store['brand_image']['url']; ?>">
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div> <!-- Primary end -->
            <?php estore_sidebar_select(); ?>
        </div>
    </main>
</div>

<?php do_action( 'estore_after_body_content' ); ?>

<?php get_footer(); ?>
