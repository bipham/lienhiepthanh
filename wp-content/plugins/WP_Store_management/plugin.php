<?php
/*
Plugin Name: WP_Store_management
Plugin URI: https://www.facebook.com/kyobmt1412
Description: Demo on how WP_Store_management works
Version: 1.0
Author: Bi Pham
Author URI: https://www.facebook.com/kyobmt1412
*/
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

function load_WP_Store_management_libs() {
    wp_enqueue_script('tether-js-admin', plugin_dir_url(__FILE__) . '/libs/tether/tether.min.js', array('jquery'), false, true);
    // Enqueue the script
//    wp_enqueue_script('jquery-js-admin', plugin_dir_url(__FILE__) . '/libs/jquery/jquery.min.js', array('jquery'), false, true);
    // Enqueue the script
    wp_enqueue_script('bx-slider-js-admin', plugin_dir_url(__FILE__) . '/libs/bxslider/jquery.bxslider.js', array('jquery'), false, true);
    // Enqueue the script
    wp_enqueue_script('bootstrap-js-admin', plugin_dir_url(__FILE__) . '/libs/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);
    // Enqueue the style
    wp_enqueue_style('bootstrap-css-admin', plugin_dir_url(__FILE__) . '/libs/bootstrap/css/bootstrap.min.css');
    // Enqueue the script
    wp_enqueue_script('dataTable-js-admin', plugin_dir_url(__FILE__) . '/libs/dataTable/js/jquery.dataTables.min.js', array('jquery'), false, true);
    // Enqueue the style
    wp_enqueue_style('dataTable-css-admin', plugin_dir_url(__FILE__) . '/libs/dataTable/css/jquery.dataTables.min.css');
    // Enqueue the style
    wp_enqueue_style('custom-css-admin', plugin_dir_url(__FILE__) . '/public/admin/custom-admin.css');
    // Enqueue the script
    wp_enqueue_script('custom-admin-js', plugin_dir_url(__FILE__) . '/public/admin/custom-admin.js', array('jquery'), false, true);
}
add_action( 'admin_enqueue_scripts', 'load_WP_Store_management_libs' );

function theme_settings_page()
{
    global $wpdb;
    ?>
    <div class="wrap page-store-management">
        <h1 class="title-store-management">Quản lý cửa hàng</h1>
        <button class="btn btn-success btn-add-store" data-toggle="modal" data-target=".addNewStore">Thêm cửa hàng</button>
        <div class="modal fade addNewStore modal-add-new" tabindex="-1" role="dialog" aria-labelledby="addNewStore" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title title-edit-info-store">Thêm cửa hàng</h5>
                        <button type="button" class="close btn-close-edit" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group group-name-new-store">
                            <span class="input-group-addon">Tên cửa hàng</span>
                            <input type="text" class="form-control input-name-new-store input-data-add-new" placeholder="Tên cửa hàng" value="">
                        </div>
                        <div class="input-group group-phone-new-store">
                            <span class="input-group-addon">Điện thoại</span>
                            <input type="text" class="form-control input-phone-new-store input-data-add-new" placeholder="Điện thoại" value="">
                        </div>
                        <div class="input-group group-tele-new-store">
                            <span class="input-group-addon">Di động</span>
                            <input type="text" class="form-control input-tele-new-store input-data-add-new" placeholder="Di động" value="">
                        </div>
                        <div class="input-group group-web-new-store">
                            <span class="input-group-addon">Website</span>
                            <input type="text" class="form-control input-web-new-store input-data-add-new" placeholder="Website" value="">
                        </div>
                        <div class="input-group group-address-new-store">
                            <span class="input-group-addon">Địa chỉ</span>
                            <input type="text" class="form-control input-address-new-store input-data-add-new" placeholder="Địa chỉ" value="">
                        </div>
                        <div class="input-group group-district-new-store">
                            <span class="input-group-addon ">Quận/huyện</span>
                            <select class="select-district-new-store list-new-store-district input-data-add-new" placeholder="Quận/huyện" name="district-new-store">
                                <option value="" selected="selected">Vui lòng chọn thành phố trước</option>
                            </select>
                        </div>
                        <div class="input-group group-city-new-store">
                            <span class="input-group-addon ">Thành phố</span>
                            <select class="select-city-new-store list-new-store-city input-data-add-new" placeholder="Thành phố" name="city-new-store">
                                <option value="" selected="selected">Chọn thành phố </option>
                                <?php
                                $list_city =  $wpdb->get_results('SELECT * FROM wp_city', OBJECT );

                                foreach ($list_city as $index_city => $city):
                                    ?>
                                    <option value="<?php echo $city->id; ?>"> <?php echo $city->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-custom btn-add-new-store" disabled>Tạo</button>
                        <button type="button" class="btn btn-secondary btn-custom btn-close-edit" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        display_table_stores();
        ?>
    </div>
    <?php
}
function add_theme_menu_item()
{
    add_menu_page("Quản lý cửa hàng", "Quản lý cửa hàng", "manage_options", "store-management", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");

function display_table_stores()
{
    global $wpdb;
    $results = $wpdb->get_results( 'SELECT * FROM wp_customers', OBJECT );
    $dir = plugin_dir_path( __FILE__ );
    ?>
    <button class="btn btn-delete-mutli-stores btn-danger" data-toggle="modal" data-target=".deleteMultiStores" disabled>Xóa đồng loạt</button>
    <div class="modal fade deleteMultiStores">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa thông tin cửa hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa những cửa hàng này ko?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-delete-mutli-stores-action">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>
    <table id="list-stores-table" class="table datatable">
        <thead>
            <tr>
                <th><label><input class="select-all-stores" name="all-stores" type="checkbox" value="all">Chọn</label></th>
                <th>STT </th>
                <th>Tên </th>
                <th>Điện thoại </th>
                <th>Di động </th>
                <th>Website </th>
                <th>Địa chỉ </th>
                <th>Quận/huyện </th>
                <th>Thành phố </th>
                <th>Thao tác </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $key => $rows) :?>
            <tr class="item_row item-store-<?php echo $rows->ID; ?>">
                <td><input type="checkbox" name="item-store" value="<?php echo $rows->ID; ?>"></td>
                <td><?php echo $key+1 ?></td>
                <td> <?php echo $rows->name ?></td>
                <td> <?php echo $rows->phone ?></td>
                <td> <?php echo $rows->tele ?></td>
                <td> <?php echo $rows->website ?></td>
                <td> <?php echo $rows->address ?></td>
                <td>
                    <?php
                    $district_query =  $wpdb->get_results(
                        $wpdb->prepare('
                            SELECT name FROM wp_district 
                            WHERE id=%d',
                            $rows->district_id
                        ), OBJECT
                    );
                    echo $district_store = $district_query[0]->name;
                    ?>
                </td>
                <td>
                    <?php
                    $city_query =  $wpdb->get_results(
                        $wpdb->prepare('
                            SELECT name FROM wp_city 
                            WHERE id=%d',
                            $rows->city_id
                        ), OBJECT
                    );
                    echo $city_store = $city_query[0]->name;
                    ?>
                </td>
                <td>
                    <button class="btn btn-edit-custom-admin btn-info btn-admin-custom" data-toggle="modal" data-target=".infoStore-<?php echo $rows->ID; ?>" data-id="<?php echo $rows->ID; ?>">Sửa</button>
                    <div class="modal fade infoStore-<?php echo $rows->ID; ?> modal-edit" tabindex="-1" role="dialog" aria-labelledby="infoStore-<?php echo $rows->ID; ?>" aria-hidden="true" data-id-info="<?php echo $rows->ID; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title title-edit-info-store">Sửa thông tin cửa hàng</h5>
                                    <button type="button" class="close btn-close-edit" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group group-name-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon">Tên</span>
                                        <input type="text" class="form-control input-name-store-<?php echo $rows->ID; ?> input-data-edit" placeholder="Tên cửa hàng" value="<?php echo $rows->name; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                    </div>
                                    <div class="input-group group-phone-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon">Số điện thoại</span>
                                        <input type="text" class="form-control input-phone-store-<?php echo $rows->ID; ?> input-data-edit" placeholder="Số điện thoại" value="<?php echo $rows->phone; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                    </div>
                                    <div class="input-group group-tele-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon">Di động</span>
                                        <input type="text" class="form-control input-tele-store-<?php echo $rows->ID; ?> input-data-edit" placeholder="Di động" value="<?php echo $rows->tele; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                    </div>
                                    <div class="input-group group-web-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon">Website</span>
                                        <input type="text" class="form-control input-web-store-<?php echo $rows->ID; ?> input-data-edit" placeholder="Website" value="<?php echo $rows->website; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                    </div>
                                    <div class="input-group group-address-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon">Địa chỉ</span>
                                        <input type="text" class="form-control input-address-store-<?php echo $rows->ID; ?> input-data-edit" placeholder="Địa chỉ" value="<?php echo $rows->address; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                    </div>
                                    <div class="input-group group-district-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon ">Quận/huyện</span>
                                        <select class="select-district-store-<?php echo $rows->ID; ?> list-store-district input-data-edit" placeholder="Quận/huyện" name="district-store-<?php echo $key + 1; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                            <?php
                                            $list_district =  $wpdb->get_results(
                                                $wpdb->prepare('
                                                    SELECT * FROM wp_district 
                                                    WHERE city_id=%d',
                                                    $rows->city_id
                                                ), OBJECT
                                            );
                                            foreach ($list_district as $index_district => $district):
                                                ?>
                                                <option value="<?php echo $district->id; ?>" <?php if ($district->id == $rows->district_id) echo 'selected="selected"' ?>> <?php echo $district->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-group group-city-store-<?php echo $rows->ID; ?>">
                                        <span class="input-group-addon ">Thành phố</span>
                                        <select class="select-city-store-<?php echo $rows->ID; ?> list-store-city input-data-edit" placeholder="Thành phố" name="city-store-<?php echo $key + 1; ?>" data-id-info="<?php echo $rows->ID; ?>">
                                            <?php
                                            $list_city =  $wpdb->get_results(
                                                '
                                                    SELECT * FROM wp_city 
                                                    '
                                                , OBJECT
                                            );
                                            foreach ($list_city as $index_city => $city):
                                                ?>
                                                <option value="<?php echo $city->id; ?>" <?php if ($city->id == $rows->city_id) echo 'selected="selected"' ?>> <?php echo $city->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-custom btn-update-info btn-update-<?php echo $rows->ID; ?>" disabled data-id-info="<?php echo $rows->ID; ?>">Cập nhật</button>
                                    <button type="button" class="btn btn-secondary btn-custom btn-close-edit" data-dismiss="modal">Thoát</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-delete-custom-admin btn-danger btn-admin-custom" data-toggle="modal" data-target=".deleteStore-<?php echo $rows->ID; ?>" data-id="<?php echo $rows->ID; ?>">Xóa</button>
                    <div class="modal fade deleteStore-<?php echo $rows->ID; ?>" data-id-info="<?php echo $rows->ID; ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xóa thông tin cửa hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa cửa hàng <b><?php echo $rows->name; ?></b> này ko?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-delete-store btn-delete-store-<?php echo $rows->ID; ?>" data-id-info="<?php echo $rows->ID; ?>">Xóa</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php
}

add_action('wp_ajax_my_action', 'my_ajax_update_action');
function my_ajax_update_action(){
    global $wpdb;
    $action_type = $_POST['type_action'];
    if ($action_type == 'change_city') {
        $idCity = $_POST['idCity'];
        $list_district =  $wpdb->get_results(
            $wpdb->prepare('
                    SELECT * FROM wp_district 
                    WHERE city_id=%d',
                $idCity
            ), OBJECT
        );
        ?>
        <option value="" selected="selected">Chọn quận huyện</option>
        <?php
        foreach ($list_district as $index_district => $district):
            ?>
            <option value="<?php echo $district->id; ?>"> <?php echo $district->name; ?></option>
        <?php endforeach;
    }
    elseif($action_type == 'update') {
        $id  = $_POST['id'];
        $name  = $_POST['name'];
        $phone  = $_POST['phone'];
        $tele  = $_POST['tele'];
        $web  = $_POST['website'];
        $address  = $_POST['address'];
        $district = $_POST['district'];
        $city  = $_POST['city'];
        if ($name == '') {
            echo $status = "Bạn chưa nhập tên cửa hàng!";
        }
        elseif ($address == '') {
            echo $status = "Bạn chưa nhập địa chỉ cửa hàng!";
        }
        else if ($district == '') {
            echo $status = "Bạn chưa nhập quận/huyện cho cửa hàng!";
        }
        //        else if ($phone == '') {
//            echo $status = "Bạn chưa nhập số điện thoại cửa hàng!";
//        }
//        else if ($tele == '') {
//            echo $status = "Bạn chưa nhập số di động của cửa hàng!";
//        }
//        else if ($web == '') {
//            echo $status = "Bạn chưa nhập địa chỉ website cửa hàng!";
//        }
        else {
            $wpdb->update(
                'wp_customers',
                array(
                    'name' => $name,	// string
                    'phone' => $phone,	// string
                    'tele' => $tele,	// string
                    'website' => $web,	// string
                    'address' => $address,	// string
                    'city_id' => $city,	// integer (number)
                    'district_id' => $district // integer (number)
                ),
                array( 'ID' =>  $id ),
                array(
                    '%s',	// value1
                    '%s',	// value2
                    '%s',	// value3
                    '%s',	// value4
                    '%s',	// value5
                    '%d',
                    '%d',
                    '%d'
                ),
                array( '%d' )
            );
            echo $status = 'OK';
        }
    }
    elseif ($action_type == 'delete') {
        $idInfo = $_POST['id'];
        $wpdb->delete(
                'wp_customers',
                array( 'ID' => $idInfo ),
                array(
                    '%d' ,
                    '%d'
                )
        );
        echo $status = 'OK';
    }
    elseif($action_type == 'add_new') {
        $name  = $_POST['name'];
        $phone  = $_POST['phone'];
        $tele  = $_POST['tele'];
        $web  = $_POST['website'];
        $address  = $_POST['address'];
        $district = $_POST['district'];
        $city  = $_POST['city'];
        if ($name == '') {
            echo $status = "Bạn chưa nhập tên cửa hàng!";
        }
        elseif ($address == '') {
            echo $status = "Bạn chưa nhập địa chỉ cửa hàng!";
        }
        else if ($district == '') {
            echo $status = "Bạn chưa nhập quận/huyện cho cửa hàng!";
        }
//        else if ($phone == '') {
//            echo $status = "Bạn chưa nhập số điện thoại cửa hàng!";
//        }
//        else if ($tele == '') {
//            echo $status = "Bạn chưa nhập số di động của cửa hàng!";
//        }
//        else if ($web == '') {
//            echo $status = "Bạn chưa nhập địa chỉ website cửa hàng!";
//        }
        else {
            $wpdb->insert(
                'wp_customers',
                array(
                    'name' => $name,	// string
                    'phone' => $phone,	// string
                    'tele' => $tele,	// string
                    'website' => $web,	// string
                    'address' => $address,	// string
                    'city_id' => $city,	// integer (number)
                    'district_id' => $district // integer (number)
                ),
                array(
                    '%s',	// value1
                    '%s',	// value2
                    '%s',	// value3
                    '%s',	// value4
                    '%s',	// value5
                    '%d',
                    '%d',
                    '%d'
                ),
                array( '%d' )
            );
            echo $status = 'OK';
        }
    }
    elseif ($action_type == 'delete_multi') {
        $listID = $_POST['list_selected'];
        foreach ($listID as $key_id => $id) {
            $wpdb->delete(
                'wp_customers',
                array( 'ID' => $id ),
                array(
                    '%d' ,
                    '%d'
                )
            );
        }
        echo $status = 'OK';
    }
    //Don't forget to always exit in the ajax function.
    exit();

}