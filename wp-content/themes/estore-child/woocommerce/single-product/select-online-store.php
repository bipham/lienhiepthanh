<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 23-Apr-17
 * Time: 15:50
 */

/**
 * Single select online store
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/select-online-store.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;

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
<div class="woo-custom-product btn-buy-custom">
    <button class="btn btn-success btn-detail" data-toggle="modal" data-target=".selectOnlineStore-modal-lg">
        <?php echo $title_button_buy; ?>
    </button>
</div>

<div class="modal fade selectOnlineStore-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectOnlineStore">
                    <?php echo $title_modal_select_store; ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $address_buy = get_field('address_buy');
                $store_selected = $address_buy[0]['select_address'];
                $stores_added = $address_buy[0]['add_new_store'];
                ?>
                <?php if ((sizeof($store_selected) != 0) || ($stores_added != false)): ?>
                    <?php $i = 0; ?>
                    <ul class="list-online-store">
                        <?php if (sizeof($store_selected) != 0): ?>
                            <?php foreach ($store_selected as $key => $store): ?>
                                <?php if ($store == '0'): ?>
                                    <li>
                                        <a target="_blank" title="A Đây Rồi" href="https://www.adayroi.com/tim-kiem?q=lht">
                                            <img class="img-<?php echo $i; $i+=1; ?>" alt="A Đây Rồi" src="/data/upload/QC/download.png">
                                        </a>
                                    </li>
                                <?php elseif($store == '1'): ?>
                                    <li>
                                        <a target="_blank" title="Tiki" href="http://tiki.vn/search?q=lht">
                                            <img class="img-<?php echo $i; $i+=1; ?>" alt="Tiki" src="/data/upload/QC/1_tiki.jpg">
                                        </a>
                                    </li>
<!--                                --><?php //elseif($store == '2'): ?>
<!--                                    <li>-->
<!--                                        <a target="_blank" title="Liên Hiệp Thành" href="http://www.lienhiepthanh.com/lien-he">-->
<!--                                            <img class="img---><?php //echo $i; $i+=1; ?><!--" alt="Liên Hiệp Thành" src="/data/upload/QC/logolhtaaa020612.jpg">-->
<!--                                        </a>-->
<!--                                    </li>-->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($stores_added != false): ?>
                            <?php foreach ($stores_added as $key => $store_added): ?>
                                <li>
                                    <a target="_blank" title="<?php echo $store_added['name_store']; ?>" href="<?php echo $store_added['link_to_store']; ?>">
                                        <img class="img-<?php echo $i; $i+=1; ?>" alt="$store_added['image_brand_store']['title']" src="<?php echo $store_added['image_brand_store']['url']; ?>">
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-custom" data-dismiss="modal">
                    <?php echo $title_button_exit; ?>
                </button>
            </div>
        </div>
    </div>
</div>
