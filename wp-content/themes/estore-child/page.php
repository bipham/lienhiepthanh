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
                <!-- Add category left sidebar-->
                <?php get_template_part( 'template-parts/left_sidebar', 'custom' ); ?>

                <div class="col-md-7 content-page full-width-ipad">
                    <!-- Add slider images-->
                    <?php get_template_part( 'template-parts/slider', 'custom' ); ?>

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
</div>

<?php do_action( 'estore_after_body_content' ); ?>

<?php get_footer(); ?>
