<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11-May-17
 * Time: 23:40
 */
/**
 * Template part for displaying category left sidebar.
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
