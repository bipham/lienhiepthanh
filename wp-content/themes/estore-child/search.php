<?php
/**
 * The template for displaying Archive pages
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 1.0
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
    <div class="tg-container full-width-ipad padding-clear">
        <div id="primary">
            <!-- Add category left sidebar-->
            <?php get_template_part( 'template-parts/left_sidebar', 'custom' ); ?>

            <div class="col-md-7 content-page page-woo-content full-width-ipad">
                <div class="page-header clearfix">
                    <div class="tg-container">
                        <?php
                        the_archive_title('<h2 class="entry-title">', '</h2>');
                        ?>
                        <h3 class="entry-sub-title"><?php estore_breadcrumbs(); ?></h3>
                    </div>
                </div>
                <main id="main" class="clearfix <?php echo esc_attr($estore_layout); ?>">
                    <div class="tg-container full-width-ipad padding-clear">
                        <div id="primary" class="content-area">

                            <?php if ( have_posts() ) : ?>

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

                                <?php endwhile; ?>

                                <?php get_template_part( 'navigation', 'search' ); ?>

                            <?php else : ?>

                                <?php get_template_part( 'no-results', 'search' ); ?>

                            <?php endif; ?>

                        </div><!-- #primary -->
                        <?php estore_sidebar_select(); ?>
                    </div><!-- .tg-container -->
                </main>
            </div>

            <!-- Add right sidebar-->
            <?php get_template_part( 'template-parts/right_sidebar', 'custom' ); ?>

        </div> <!-- Primary end -->
    </div>
</div>

<?php do_action( 'estore_after_body_content' ); ?>

<?php get_footer(); ?>
