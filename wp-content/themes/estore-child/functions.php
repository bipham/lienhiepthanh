<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 19-Apr-17
 * Time: 21:31
 */
/**
 * ThemeGrill Starter functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

function my_site_WI_dequeue_script() {
    wp_dequeue_script( 'bxslider' ); //If you're using disqus, etc.
}

add_action( 'wp_print_scripts', 'my_site_WI_dequeue_script', 100 );

function load_styles() {
    wp_enqueue_script('tether-js', get_stylesheet_directory_uri() . '/libs/tether/tether.min.js', array('jquery'), false, true);
    // Enqueue the script
//    wp_enqueue_script( 'bxslider', get_template_directory_uri().'/js/jquery.bxslider' . $suffix . '.js', array('jquery'), false, true );
    wp_enqueue_script('jquery-js', get_stylesheet_directory_uri() . '/libs/jquery/jquery.min.js', array('jquery'), false, true);
    // Enqueue the script
    wp_enqueue_script('bx-slider-js', get_stylesheet_directory_uri() . '/libs/bxslider/jquery.bxslider.js', array('jquery'), false, true);
    // Enqueue the script
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/libs/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);
    // Enqueue the style
    wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/libs/bootstrap/css/bootstrap.min.css');
    // Enqueue the style
    wp_enqueue_style('bx-slider-css', get_stylesheet_directory_uri() . '/libs/bxslider/jquery.bxslider.min.css');
    // Enqueue the script
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/public/js/custom.js', array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'load_styles' );

//Woocommerce:
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sku_product', 15 );
    function woocommerce_template_single_sku_product() {
        wc_get_template( 'single-product/sku-product.php' );
    }

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_select_online_store', 25 );
function woocommerce_template_single_select_online_store() {
    wc_get_template( 'single-product/select-online-store.php' );
}

//admin page

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Tùy chỉnh website',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Info Basic Web Settings',
        'menu_title'	=> 'Thông tin website',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Web Settings',
        'menu_title'	=> 'Tùy chỉnh header',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Web Settings',
        'menu_title'	=> 'Tùy chỉnh footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Category Web Settings',
        'menu_title'	=> 'Danh mục sản phẩm',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme VN-EN Translation',
        'menu_title'	=> 'VN-EN Translation',
        'parent_slug'	=> 'theme-general-settings',
    ));
}

function my_acf_init() {

    acf_update_setting('google_api_key', 'AIzaSyDOuEmR5i6R9prqNfNgLzwdb1bKdfRzxGI');
}

add_action('acf/init', 'my_acf_init');

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

function my_ajax_callback_function() {
    // Implement ajax function here
    global $wpdb;
    $current_language = pll_current_language();
    if ($current_language == 'en') {
        $title_select_district_custom_trans = get_field('title_select_district_custom_trans_en', 'option');
    }
    else {
        $title_select_district_custom_trans = get_field('title_select_district_custom_trans', 'option');
    }
    $action_type = $_POST['type_action'];
    if ($action_type == 'change_city') {
        $result = array();
        $idCity = $_POST['idCity'];
        $list_district =  $wpdb->get_results(
            $wpdb->prepare('
                    SELECT * FROM wp_district 
                    WHERE city_id=%d',
                $idCity
            ), OBJECT
        );
        $result['html'] = '<option value="" selected="selected">' . $title_select_district_custom_trans .'</option>';
        foreach ($list_district as $index_district => $district):
            $result['html'] .= '<option value=' . $district->id . '>' . $district->name . '</option>';
        endforeach;
         $list_stores = $wpdb->get_results(
            $wpdb->prepare('
                    SELECT * FROM wp_customers 
                    WHERE city_id=%d',
                $idCity
            ), OBJECT
        );
        $result['listStores'] = show_stores_result($list_stores);
        if ($result['listStores'] == '') $result['listStores'] = 'NO';
        header( "Content-Type: application/json" );
        echo json_encode($result);
    }
    elseif($action_type == 'change_district') {
        $result = array();
        $idCity = $_POST['idCity'];
        $idDistrict = $_POST['idDistrict'];
        if ($idDistrict == '') {
            $list_stores = $wpdb->get_results(
                $wpdb->prepare('
                    SELECT * FROM wp_customers 
                    WHERE city_id=%d',
                    $idCity
                ), OBJECT
            );
        }
        else {
            $list_stores = $wpdb->get_results(
                $wpdb->prepare('
                    SELECT * FROM wp_customers 
                    WHERE city_id=%d AND district_id=%d',
                    $idCity,
                    $idDistrict
                ), OBJECT
            );
        }
        $result['listStores'] = show_stores_result($list_stores);
        if ($result['listStores'] == '') $result['listStores'] = 'NO';
        header( "Content-Type: application/json" );
        echo json_encode($result);
    }
    die();
    //Don't forget to always exit in the ajax function.
    exit();
}
add_action( 'wp_ajax_my_action_name', 'my_ajax_callback_function' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_my_action_name', 'my_ajax_callback_function' );    // If called from front end

function show_stores_result ($list_stores) {
    global $wpdb;
    $current_language = pll_current_language();
    if ($current_language == 'en') {
        $title_updating_custom_trans = get_field('title_updating_custom_trans_en', 'option');
    }
    else {
        $title_updating_custom_trans = get_field('title_updating_custom_trans', 'option');
    }
    $result = '';
    if (sizeof($list_stores) != 0) {
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
            $result .= '<li class="stores-result-item">
                                                <div class="name-store-result">' . $store_result->name . '</div>
                                                <ul class="detail-store-item">
                                                    <li class="info-detail-store-item info-detail-store-address">
                                                        <i class="fa fa-map-marker icon-info-store-custom" aria-hidden="true"></i>
                                                        <span class="info-store-item">' . $store_result->address . ', ' . $district_store . ', ' . $city_store . '</span>
                                                    </li>
                                                    <li class="info-detail-store-item info-detail-store-web">
                                                        <i class="fa fa-globe icon-info-store-custom" aria-hidden="true"></i>
                                                        <span class="info-store-item">';
            if($web_store != $title_updating_custom_trans) {
                $result .= '<a href="http://' . $web_store .'" target="_blank">' . $web_store . '</a></span>';
            }
            else {
                $result .= $web_store . '</span>';
            }
            $result .= '</li>
                            <li class="info-detail-store-item info-detail-store-phone">
                                                        <i class="fa fa-phone icon-info-store-custom" aria-hidden="true"></i>
                                                        <span class="info-store-item">' . $phone_store . '</span>
                                                    </li>
                                                    <li class="info-detail-store-item info-detail-store-mobile">                                                   
                                                        <i class="fa fa-mobile icon-info-store-custom" aria-hidden="true"></i>
                                                        <span class="info-store-item">' . $tele_store . '</span>
                                                    </li>
                                                </ul>
                                            </li>';
        endforeach;
    }
    return $result;
}
