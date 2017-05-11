<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying slider custom.
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
