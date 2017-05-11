<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 25-Apr-17
 * Time: 11:59
 */
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and starting from <footer> tag.
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */
$current_language = pll_current_language();
?>

<footer id="colophon">
    <?php get_sidebar( 'footer' ); ?>
    <?php
    if ($current_language == 'en') {
        $config_footer_option_admin = get_field('config_footer_option_admin_en', 'option');
    }
    else {
        $config_footer_option_admin = get_field('config_footer_option_admin', 'option');
    }
    $background_color_top_footer = get_field('background_color_top_footer', 'option');
    $background_color_bottom_footer = get_field('background_color_bottom_footer', 'option');
    $color_copyright_bottom_footer = get_field('color_copyright_bottom_footer', 'option');
    if ($config_footer_option_admin):
    ?>
    <div class="container-fluid footer-container" style="background: <?php echo $background_color_top_footer; ?>;">
        <div class="container">
            <div class="row">
                <?php
                $collumn_first_footer_option_admin = $config_footer_option_admin[0]['collumn_first_footer_option_admin'];
                $rows_info_footer = $collumn_first_footer_option_admin[0]['row_info_footer'];
                $allow_display_icon_collumn_1_footer = $collumn_first_footer_option_admin[0]['allow_display_icon_collumn_1_footer'];
                if ($allow_display_icon_collumn_1_footer == 0) {
                    $class_custom_add = 'hidden_class';
                }
                else {
                    $class_custom_add = 'icon_lht_custom';
                }
                if ($collumn_first_footer_option_admin != ''):
                ?>
                <div class="col-md-6 col-xs-6">
                    <h3 class="title-custom" style="color: <?php echo $collumn_first_footer_option_admin[0]['color_title_collumn_first_footer']; ?>; font-size: <?php echo $collumn_first_footer_option_admin[0]['font_size_title_collumn_first_footer']; ?>px;"> <?php echo $collumn_first_footer_option_admin[0]['title_collumn_first_footer']; ?></h3>
                    <ul class="footer-first ul-custom">
                        <?php foreach ($rows_info_footer as $key => $row_info_footer): ?>
                            <li>
                                <span class="icon-lht <?php echo $class_custom_add; ?>"><i class="fa <?php echo $row_info_footer['icon_row_info_footer']; ?>" style="color: <?php echo $row_info_footer['color_icon_row_info_footer']; ?>; font-size: <?php echo $row_info_footer['font_size_icon_row_info_footer']; ?>px;" aria-hidden="true"></i></span>
                                <p class="text-custom" style="color: <?php echo $row_info_footer['color_content_info_row_footer']; ?>; font-size: <?php echo $row_info_footer['font_size_content_row_info_footer']; ?>px;"><?php echo $row_info_footer['content_info_row_footer']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php
                $collumn_second_footer_option_admin = $config_footer_option_admin[0]['collumn_second_footer_option_admin'];
                $info_second_row_footers = $collumn_second_footer_option_admin[0]['info_second_row_footer'];
                if ($collumn_second_footer_option_admin != ''):
                ?>
                <div class="col-md-4 col-xs-6">
                    <h3 class="title-custom" style="color: <?php echo $collumn_second_footer_option_admin[0]['color_title_collumn_second_footer']; ?>; font-size: <?php echo $collumn_second_footer_option_admin[0]['font_size_title_collumn_second_footer']; ?>px;"> <?php echo $collumn_second_footer_option_admin[0]['title_collumn_second_footer']; ?></h3>
                    <ul class="footer-second ul-custom">
                        <?php
                        if ($info_second_row_footers):
                        foreach ($info_second_row_footers as $key => $info_second_row_footer): ?>
                            <li>
                                <a href="<?php echo $info_second_row_footer['link_to_post_second_info_footer']; ?>">
                                    <p class="text-custom" style="color: <?php echo $collumn_second_footer_option_admin[0]['color_title_info_second_footer']; ?>; font-size: <?php echo $collumn_second_footer_option_admin[0]['font_size_second_info_footer']; ?>px;"><?php echo $info_second_row_footer['title_row_second_info_footer']; ?></p>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php
                $info_socials_footer = $config_footer_option_admin[0]['info_socials_footer'];
                $socials_footer = $info_socials_footer[0]['socials_footer'];
                if ($info_socials_footer != ''):
                ?>
                <div class="col-md-2 col-xs-12 ">
                    <h3 class="title-custom" style="color: <?php echo $info_socials_footer[0]['color_title_collumn_socials_footer']; ?>; font-size: <?php echo $info_socials_footer[0]['font_size_title_collumn_socials_footer']; ?>px;"> <?php echo $info_socials_footer[0]['title_socials_footer']; ?></h3>
                    <div class="footer-social list-socials-custom">
                        <?php foreach ($socials_footer as $key => $social_footer): ?>
                                <span class="icon-lht">
                                    <a href="<?php echo $social_footer['link_to_social_footer']; ?>">
                                        <i class="fa <?php echo $social_footer['icon_social_footer']; ?>" style="color: <?php echo $social_footer['color_icon_social_info_footer']; ?>; font-size: <?php echo $social_footer['font_size_icon_socials_info_footer']; ?>px;" aria-hidden="true"></i>
                                    </a>
                                </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!--/.row-->
    </div>
    <?php endif; ?>
    <div id="bottom-footer" class="clearfix" style="background: <?php echo $background_color_bottom_footer; ?> none repeat scroll 0 0">
        <div class="tg-container">
            <div class="copy-right" style="color: <?php echo $color_copyright_bottom_footer; ?>">
                Copyright © 2017 LIEN HIEP THANH Group. All Rights Reserved
            </div>
            <?php
            $logos = array();
            for ( $i = 1; $i < 5; $i++ ) {
                $paymentlogo = get_theme_mod('estore_payment_logo'.$i);
                if($paymentlogo) {
                    array_push($logos, $paymentlogo);
                }
            }
            $totallogo = count($logos);
            if($totallogo > 0){ ?>
                <div class="payment-partner-wrapper">
                    <ul>
                        <?php for($j = 0; $j < $totallogo; $j++ ) { ?>
                            <li><img src="<?php echo esc_url($logos[$j])?>" /></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</footer>
<a href="#" class="scrollup"><i class="fa fa-angle-up"> </i> </a>
</div> <!-- Page end -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOuEmR5i6R9prqNfNgLzwdb1bKdfRzxGI" async></script>
<?php wp_footer(); ?>
</body>
</html>
