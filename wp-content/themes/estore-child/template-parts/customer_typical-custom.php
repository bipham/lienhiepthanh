<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying add customers typical custom.
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
$list_stores_lhts = get_field('list_stores_lht');
if ($list_stores_lhts):
    ?>
    <div class="list-stores-lht container">
        <?php
        $title_list_stores_lht = get_field('title_list_stores_lht');
        if ($title_list_stores_lht != ''):
            ?>
            <div class="title">
                <h4>
                    <span class="underline-title">
                        <?php
                        echo $title_list_stores_lht;
                        ?>
                    </span>
                </h4>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php $i = 0; ?>
            <?php foreach ($list_stores_lhts as $key => $list_stores_lht):?>
                <div class="col-xxs-12 col-xs-6 col-sm-3 col-md-3 store-item">
                    <div class="store-item-inner">
                        <a target="_blank" title="<?php echo $list_stores_lht['title_image']; ?>" href="<?php echo $list_stores_lht['link_to_store_lht']; ?>">
                            <img class="img-vertical-center" class="img-<?php echo $i; $i+=1; ?>" alt="<?php  echo $list_stores_lht['title_image']; ?>" src="<?php echo $list_stores_lht['image']['url']; ?>">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
