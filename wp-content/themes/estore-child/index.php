
<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 19-Apr-17
 * Time: 22:31
 */
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
    <?php
    if( is_home() && !( is_front_page() ) ) {
        $queried_id = get_option( 'page_for_posts' );
    }
    ?>
    <main id="main" class="clearfix <?php echo esc_attr($estore_layout); ?>">
        <div class="tg-container full-width-ipad padding-clear">
            <div id="primary">
                <!-- Add category left sidebar-->
                <?php get_template_part( 'template-parts/left_sidebar', 'custom' ); ?>

                <div class="col-md-7 content-page full-width-ipad">
                    <!-- Add slider images-->
                    <?php get_template_part( 'template-parts/slider', 'custom' ); ?>

                    <div class="page-content-custom">
                        <!-- Add posts-->
                        <?php if ( have_posts() ) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', get_post_format() );
                                ?>

                            <?php endwhile;

                            get_template_part( 'navigation', 'none' );

                        else : ?>

                            <?php get_template_part( 'template-parts/content', 'none' ); ?>

                        <?php endif; ?>
                    </div> <!-- page-content-custom end -->
                    <?php estore_sidebar_select(); ?>

                    <!-- Add preview post-->
                    <?php get_template_part( 'template-parts/preview_post_section', 'custom' ); ?>

                    <!--  Add list products-->
                    <?php get_template_part( 'template-parts/list_products_section', 'custom' ); ?>

                    <!--  Add list new products-->
                    <?php get_template_part( 'template-parts/list_new_products', 'custom' ); ?>

                    <!-- Add customers-->
                    <?php get_template_part( 'template-parts/customer_typical', 'custom' ); ?>

                    </div>
                </div>

                <!-- Add right sidebar-->
                <?php get_template_part( 'template-parts/right_sidebar', 'custom' ); ?>

            </div> <!-- Primary end -->
            <?php estore_sidebar_select(); ?>
        </div>
    </main>
</div><!-- #content .site-content -->

<?php do_action( 'estore_after_body_content' ); ?>

<?php get_footer(); ?>
