<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
$estore_layout = estore_woocommerce_layout_class();

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
            <div class="col-md-7 content-page page-woo-content full-width-ipad">
                <div class="page-header clearfix">
                    <?php
                        the_title( '<h1 class="product_title entry-title">', '</h1>' );
                    ?>
                    <h3 class="entry-sub-title"><?php woocommerce_breadcrumb(); ?></h3>
                </div>
                <main id="main" class="clearfix <?php echo esc_attr($estore_layout); ?>">
                    <div class="tg-container full-width-ipad padding-clear">
                        <?php
                        /**
                         * woocommerce_before_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         * Removed woocommerce_breadcrumb. See inc/woocommerce.php
                         *
                         */
                        do_action( 'woocommerce_before_main_content' );
                        ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php wc_get_template_part( 'content', 'single-product' ); ?>

                        <?php endwhile; // end of the loop. ?>

                        <?php
                        /**
                         * woocommerce_after_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action( 'woocommerce_after_main_content' );
                        ?>

                        <?php
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        do_action( 'woocommerce_sidebar' );
                        ?>
                    </div>

                </main>
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
    </div>
</div>

<?php get_footer( 'shop' ); ?>
