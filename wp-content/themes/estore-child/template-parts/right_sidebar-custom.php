<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying right sidebar custom.
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
<div class="col-md-2 list-customers hidden-ipad">
    <?php
    if ($current_language == 'en') {
        $title_section_premium_logo = get_field('title_section_premium_logo_en', 'option');
        $sologan_lht = get_field('sologan_lht_custom_en', 'option');
    }
    else {
        $title_section_premium_logo = get_field('title_section_premium_logo', 'option');
        $sologan_lht = get_field('sologan_lht_custom', 'option');
    }
    $logo_premium_quality = get_field('logo_premium_quality', 'option');
    if ($logo_premium_quality):
        ?>
        <div class="premium-logo-section">
            <img class="img-vertical-center img-responsive logo-quality-custom" alt="<?php  echo $logo_premium_quality['title']; ?>" src="<?php echo $logo_premium_quality['url']; ?>">
        </div>
    <?php endif; ?>
    <?php
    if ($sologan_lht):
        ?>
        <div class="sologan_lht">
            <?php foreach ($sologan_lht as $index_sologan => $sologan): ?>
                <p class="sologan_custom" style="font-size: <?php echo $sologan['font_size_sologan_lht']; ?>px; color: <?php echo $sologan['color_sologan_lht']; ?>">
                    <?php echo $sologan['sologan_row_lht']; ?>
                </p>
            <?php endforeach; ?>
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
