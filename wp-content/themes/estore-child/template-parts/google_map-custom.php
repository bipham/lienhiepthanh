<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying google maps custom.
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

$location = get_field('gg_maps');
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

