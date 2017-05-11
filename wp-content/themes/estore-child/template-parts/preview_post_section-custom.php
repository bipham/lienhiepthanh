<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying preview post section custom.
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
