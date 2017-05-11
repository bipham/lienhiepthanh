<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */
get_header();

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
    <div class="tg-container full-width-ipad padding-clear">
        <div id="primary">
            <!-- Add category left sidebar-->
            <?php get_template_part( 'template-parts/left_sidebar', 'custom' ); ?>

            <div class="col-md-7 content-page page-woo-content full-width-ipad">
                <div class="page-header clearfix">
                    <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                    <h3 class="entry-sub-title"><?php estore_breadcrumbs(); ?></h3>
                </div>
                <main id="main" class="clearfix <?php echo esc_attr($estore_layout); ?>">
                    <div class="tg-container full-width-ipad padding-clear">
                        <?php
                        while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'template-parts/content', 'single' ); ?>

                            <?php the_post_navigation(); ?>

                            <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                            get_template_part('navigation', 'none');

                        endwhile; // End of the loop. ?>
                    </div>
                    <?php estore_sidebar_select(); ?>
                </main>
            </div>

            <!-- Add right sidebar-->
            <?php get_template_part( 'template-parts/right_sidebar', 'custom' ); ?>

        </div> <!-- Primary end -->
    </div>
</div>
<?php get_footer(); ?>
