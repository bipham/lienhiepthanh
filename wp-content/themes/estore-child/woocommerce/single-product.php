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
            <!-- Add category left sidebar-->
            <?php get_template_part( 'template-parts/left_sidebar', 'custom' ); ?>

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

            <!-- Add right sidebar-->
            <?php get_template_part( 'template-parts/right_sidebar', 'custom' ); ?>

        </div> <!-- Primary end -->
    </div>
</div>

<?php get_footer( 'shop' ); ?>
