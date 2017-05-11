<?php
/**
 * Template Name: Stores Online
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since 1.0
 */

get_header();

$current_language = pll_current_language();
if ($current_language == 'en') {
    $title_modal_show_store_trans = get_field('title_modal_show_store_trans_en', 'option');
    $title_search_store_trans = get_field('title_search_store_trans_en', 'option');
    $title_select_city_trans = get_field('title_select_city_trans_en', 'option');
    $title_please_select_city_first_trans = get_field('title_please_select_city_first_trans_en', 'option');
    $title_loading_stores_trans = get_field('title_loading_stores_trans_en', 'option');
    $title_sorry_custom_trans = get_field('title_sorry_custom_trans_en', 'option');
    $title_no_store_area_trans = get_field('title_no_store_area_trans_en', 'option');
    $title_button_exit = get_field('title_button_exit_en', 'option');
    $title_updating_custom_trans = get_field('title_updating_custom_trans_en', 'option');
}
else {
    $title_modal_show_store_trans = get_field('title_modal_show_store_trans', 'option');
    $title_search_store_trans = get_field('title_search_store_trans', 'option');
    $title_select_city_trans = get_field('title_select_city_trans', 'option');
    $title_please_select_city_first_trans = get_field('title_please_select_city_first_trans', 'option');
    $title_loading_stores_trans = get_field('title_loading_stores_trans', 'option');
    $title_sorry_custom_trans = get_field('title_sorry_custom_trans', 'option');
    $title_no_store_area_trans = get_field('title_no_store_area_trans', 'option');
    $title_button_exit = get_field('title_button_exit', 'option');
    $title_updating_custom_trans = get_field('title_updating_custom_trans', 'option');
}
?>

<div id="content" class="site-content">
    <main id="main" class="clearfix <?php echo esc_attr($estore_layout); ?>">
        <div class="tg-container full-width-ipad padding-clear">
            <div id="primary">
                <div class="col-md-3 menu-cates hidden-ipad">
                    <div class="cata">
                        <?php
                        if ($current_language == 'en') {
                            $categories_custom = get_field('en_category_create', 'option');
                        }
                        else {
                            $categories_custom = get_field('vn_category_create', 'option');
                        }
                        //                        var_dump($categories_custom);
                        foreach ($categories_custom as $category_custom) {
                            echo '<div class="box">
                                        <div class="title">
                                            <h4>'. $category_custom['title_category'] . '</h4>
                                        </div>';
                            $sub_categories_custom = $category_custom['list_sub_categories'];
                            if($sub_categories_custom) {
                                echo '<div class="content">
                                            <ul>';
                                foreach($sub_categories_custom as $sub_category_custom) {
                                    $permalink = get_term_link($sub_category_custom->slug, 'product_cat');
                                    $permalink = str_replace( './', '', $permalink );
                                    echo  '<li><a href="'. $permalink .'"><i class="fa fa-caret-right icon-left-menu" aria-hidden="true"></i>' . $sub_category_custom->name .'</a></li>';
                                }
                                echo '</ul>
                                       </div>';
                            }
                            echo '</div>';
                        }
                        ?>
                        <?php
                        $box_info = get_field('box_info', 'option');
                        $rows_info = $box_info[0]['row_info'];
                        //                        var_dump($rows_info);
                        if ($box_info != ''):
                            ?>
                            <div class="box-comments" style="background: <?php echo $box_info[0]['background_color']; ?>">
                                <div class="title" style="background: <?php echo $box_info[0]['background_title']; ?>">
                                    <h4 style="color: <?php echo $box_info[0]['color_title']; ?>; font-size: <?php echo $box_info[0]['font_size_title']; ?>px;">
                                        <?php
                                        if ($current_language == 'en') {
                                            echo $box_info[0]['title_en'];
                                        }
                                        else {
                                            echo $box_info[0]['title'];
                                        }
                                        ?>
                                    </h4>
                                </div>
                                <div class="content">
                                    <ul>
                                        <?php foreach ($rows_info as $key => $row_info): ?>
                                            <li>
                                                <span class="icon-lht"><i class="fa <?php echo $row_info['icon_info']; ?>" style="color: <?php echo $row_info['color_icon_option_admin']; ?>; font-size: <?php echo $row_info['size_icon_option_admin']; ?>px;" aria-hidden="true"></i></span>
                                                <p class="text-custom" style="color: <?php echo $row_info['color_content_info_option_admin']; ?>; font-size: <?php echo $row_info['font_size_content_info_option_admin']; ?>px;"><?php echo $row_info['content_info']; ?></p>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-7 content-page full-width-ipad">
                    <div class="page-content-custom">
                        <!-- Add posts-->
                        <div class="page-title">
                            <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                        </div>
                        <div class="local-map row">
                            <div class="col-md-7 content-map-image full-width-ipad">
                                <div class="local-map map-photo">
                                    <?php
                                    $image_map = get_field('image_maps');
                                    ?>
                                    <img class="img-custom img-local-map" src="<?php echo $image_map['url']; ?>" alt="<?php echo $image_map['title']; ?>" />
                                    <?php
                                    $list_city_loc =  $wpdb->get_results('SELECT * FROM wp_city', OBJECT );
                                    foreach ($list_city_loc as $index_city_loc => $city_loc):
                                        $list_stores = $wpdb->get_results(
                                            $wpdb->prepare('
                                                SELECT * FROM wp_customers 
                                                WHERE city_id=%d',
                                                $city_loc->id
                                            ), OBJECT
                                        );
                                        if (sizeof($list_stores) != 0):
                                        ?>
                                        <div class="loc-box loc-box-small" id="pos-<?php echo $city_loc->short_name; ?>">
                                            <div class="loca-box-inner">
                                                <div class="loca-icon">
                                                    <i class="fa fa-star icon-loc-custom" data-toggle="modal" data-target=".showStores-<?php echo $city_loc->id; ?>" aria-hidden="true"></i>
                                                    <div class="modal fade showStores showStores-<?php echo $city_loc->id; ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        <?php echo $title_modal_show_store_trans . ' ' . $city_loc->name; ?>
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul class="list_store_map">
                                                                    <?php
                                                                    foreach ($list_stores as $index_store => $store_result):
                                                                        $city_name = $wpdb->get_results(
                                                                            $wpdb->prepare('
                                                                                SELECT name FROM wp_city 
                                                                                WHERE id=%d',
                                                                                $store_result->city_id
                                                                            ), OBJECT
                                                                        );
                                                                        $district_name = $wpdb->get_results(
                                                                            $wpdb->prepare('
                                                                                SELECT name FROM wp_district 
                                                                                WHERE id=%d',
                                                                                $store_result->district_id
                                                                            ), OBJECT
                                                                        );
                                                                        $city_store = $city_name[0]->name;
                                                                        $district_store = $district_name[0]->name;
                                                                        if ($store_result->website != '') {
                                                                            $web_store = $store_result->website;
                                                                        }
                                                                        else $web_store = $title_updating_custom_trans;
                                                                        if ($store_result->phone != '') {
                                                                            $phone_store = $store_result->phone;
                                                                        }
                                                                        else $phone_store = $title_updating_custom_trans;
                                                                        if ($store_result->tele != '') {
                                                                            $tele_store = $store_result->tele;
                                                                        }
                                                                        else $tele_store = $title_updating_custom_trans;
                                                                        ?>
                                                                        <li class="stores-result-item">
                                                                            <div class="name-store-result"><?php echo $store_result->name; ?></div>
                                                                            <ul class="detail-store-item">
                                                                                <li class="info-detail-store-item">
                                                                                    <i class="fa fa-map-marker icon-info-store-custom" aria-hidden="true"></i>
                                                                                    <span class="info-store-item"><?php echo $store_result->address; ?>, <?php echo $district_store; ?>, <?php echo $city_store; ?></span>
                                                                                </li>
                                                                                <li class="info-detail-store-item">
                                                                                    <i class="fa fa-globe icon-info-store-custom" aria-hidden="true"></i>
                                                                                    <span class="info-store-item">
                                                                                        <?php if($web_store != $title_updating_custom_trans): ?>
                                                                                        <a href="http://<?php echo $web_store; ?>" target="_blank">
                                                                                            <?php echo $web_store; ?>
                                                                                        </a>
                                                                                        <?php endif; ?>
                                                                                        <?php
                                                                                        if ($web_store == $title_updating_custom_trans) {
                                                                                            echo $web_store;
                                                                                        }
                                                                                        ?>
                                                                                    </span>
                                                                                </li>
                                                                                <li class="info-detail-store-item">
                                                                                    <i class="fa fa-phone icon-info-store-custom" aria-hidden="true"></i>
                                                                                    <span class="info-store-item"><?php echo $phone_store; ?></span>
                                                                                </li>
                                                                                <li class="info-detail-store-item">
                                                                                    <i class="fa fa-mobile icon-info-store-custom" aria-hidden="true"></i>
                                                                                    <span class="info-store-item"><?php echo $tele_store; ?></span>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                    </ul>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        <?php echo $title_button_exit; ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="loca-name hidden_class"><?php echo $city_loc->name; ?></div>
                                                <div class="list-local">

                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    endforeach;
                                    ?>
                                    <div class="print-map">
                                        <div class="print-map-inner">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 detail-list-stores full-width-ipad">
                                <div class="locbuypro">
                                    <h4 class="title-custom-store">
                                        <?php echo $title_search_store_trans; ?>
                                    </h4>
                                    <div class="select-local">
                                        <div class="list-city-stores">
                                            <select class="select-city-new-store list-new-store-city input-data-add-new" placeholder="Thành phố" name="city-new-store">
                                                <option value="" selected="selected">
                                                    <?php echo $title_select_city_trans; ?>
                                                </option>
                                                <?php
                                                $list_city =  $wpdb->get_results('SELECT * FROM wp_city', OBJECT );

                                                foreach ($list_city as $index_city => $city):
                                                    ?>
                                                    <option value="<?php echo $city->id; ?>"> <?php echo $city->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="list-district-stores">
                                            <select class="select-district-new-store list-new-store-district input-data-add-new" placeholder="Quận/huyện" name="district-new-store">
                                                <option value="" selected="selected">
                                                    <?php echo $title_please_select_city_first_trans; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="lisshop-area" id="lisshop-area">
                                    <div class='alert alert-success alert-custom-success hidden_class' role='alert'>
                                        <?php echo $title_loading_stores_trans; ?>!
                                    </div>
                                    <div class='alert alert-danger alert-custom-danger hidden_class' role='alert'><strong><?php echo $title_sorry_custom_trans; ?>!</strong> <?php echo $title_no_store_area_trans; ?>! </div>
                                    <ul class="store_list_result hidden_class">

                                    </ul>
                                    <div class="loader hidden_class"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 list-customers hidden-ipad">
                    <?php
                    if ($current_language == 'en') {
                        $title_section_premium_logo = get_field('title_section_premium_logo_en', 'option');
                    }
                    else {
                        $title_section_premium_logo = get_field('title_section_premium_logo', 'option');
                    }
                    $logo_premium_quality = get_field('logo_premium_quality', 'option');
                    if ($logo_premium_quality):
                        ?>
                        <div class="premium-logo-section">
                            <img class="img-vertical-center img-responsive logo-quality-custom" alt="<?php  echo $logo_premium_quality['title']; ?>" src="<?php echo $logo_premium_quality['url']; ?>">
                            <!--                        <div class="page-title">-->
                            <!--                            <h4 class="entry-title-custom">-->
                            <!--                                --><?php //echo $title_section_premium_logo; ?>
                            <!--                            </h4>-->
                            <!--                        </div>-->
                            <!--                        <div class="content-post content-img-center">-->
                            <!--                            <img class="img-vertical-center img-responsive logo-quality-custom" alt="--><?php // echo $logo_premium_quality['title']; ?><!--" src="--><?php //echo $logo_premium_quality['url']; ?><!--">-->
                            <!--                        </div>-->
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
            </div> <!-- Primary end -->
            <?php estore_sidebar_select(); ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
