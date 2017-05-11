<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until </header>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeGrill
 * @subpackage eStore
 * @since eStore 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    wp_localize_script( 'FrontEndAjax', 'ajax', array(
        'url' => admin_url( 'admin-ajax.php' )
    ) );
    $content_meta_option_admin = get_field('content_meta_option_admin', 'option');
    if ($content_meta_option_admin != ''):
    ?>
    <meta name="description" content="<?php echo $content_meta_option_admin[0]['meta_name_description_option_admin']; ?>">
    <meta name="keywords" content="<?php echo $content_meta_option_admin[0]['meta_name_keyword_option_admin']; ?>">
    <?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'tg_before' ); ?>
	<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'estore' ); ?></a>

		<?php do_action( 'estore_before_header' ); ?>

		<?php if ( get_theme_mod( 'estore_header_media_placement', 'header_media_below_main_menu' ) == 'header_media_above_site_title' ) {
			estore_the_custom_header_markup();
		} ?>

		<header id="masthead" class="site-header" role="banner">
		<?php if( get_theme_mod( 'estore_bar_activation' ) == '1' ) : ?>
			<div class="top-header-wrapper clearfix">
				<div class="tg-container">
					<div class="left-top-header">
						<div id="header-ticker" class="left-header-block">
							<?php
							$header_bar_text = get_theme_mod( 'estore_bar_text' );
							echo wp_kses_post($header_bar_text);
							?>
						</div> <!-- header-ticker end-->
					</div> <!-- left-top-header end -->

					<div class="right-top-header">
						<div class="top-header-menu-wrapper">
							<?php wp_nav_menu(
								array(
									'theme_location' => 'header',
									'menu_id'        => 'header-menu',
									'fallback_cb'    => false
								)
							);
							?>
						</div> <!-- top-header-menu-wrapper end -->
						<?php
						if (class_exists('woocommerce')):
						if(get_theme_mod('estore_header_ac_btn', '' ) == '1' ):
						?>
						<div class="login-register-wrap right-header-block">
							<?php if ( is_user_logged_in() ) { ?>
									<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" title="<?php esc_attr__('My Account','estore'); ?>" class="user-icon"><?php esc_html_e('My Account', 'estore'); ?></a>
								<?php }
								else { ?>
									<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" title="<?php esc_attr__('Login/Register','estore'); ?>"class="user-icon"><?php esc_html_e('Login/ Register', 'estore'); ?><i class="fa fa-angle-down"> </i></a>
								<?php } ?>
						</div>
						<?php endif;
						if(get_theme_mod('estore_header_currency', '' ) == '1' ):
						?>
						<div class="currency-wrap right-header-block">
							<a href="#"><?php echo esc_html( get_woocommerce_currency()); ?><?php echo "(" . esc_html ( get_woocommerce_currency_symbol() ) . ")"; ?></a>
						</div> <!--currency-wrap end -->
						<?php endif; // header currency check ?>

						<?php
						if (function_exists('icl_object_id')) {
							if(get_theme_mod( 'estore_header_lang' ) == 1 ) {
								do_action('wpml_add_language_selector');
							}
						}
						endif; // woocommerce check
						?>
					</div>
				</div>
		  </div>
	  	<?php endif; ?>

		 <div class="middle-header-wrapper clearfix">
			<div class="tg-container">
			   <div class="logo-wrapper clearfix">
				<div class="site-title-wrapper <?php echo $screen_reader; ?>">
                    <?php
                    $current_language = pll_current_language();
                    if ($current_language == 'en') {
                        $header_image = get_field('header_image_en', 'option');
                    }
                    else {
                        $header_image = get_field('header_image', 'option');

                    }
                    $image_header_selected = $header_image[0]['image'];
                    ?>
                    <img style="width: 100%;" src="<?php echo $image_header_selected['url']; ?>" alt="<?php echo $header_image[0]['alt_image']; ?>">
                    <?php if ( is_front_page() || is_home() ) : ?>
                    <h1 id="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    </h1>
                    <?php endif; ?>
                    <div class="logo">
                        <a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class=""></a>
                    </div>
                </div>
			   </div><!-- logo-end-->

			<div class="wishlist-cart-wrapper clearfix">
				<?php
				if (function_exists('YITH_WCWL')) {
					$wishlist_url = YITH_WCWL()->get_wishlist_url();
					?>
					<div class="wishlist-wrapper">
						<a class="quick-wishlist" href="<?php echo esc_url($wishlist_url); ?>" title="Wishlist">
							<i class="fa fa-heart"></i>
							<span class="wishlist-value"><?php echo absint( yith_wcwl_count_products() ); ?></span>
						</a>
					</div>
					<?php
				}
				if ( class_exists( 'woocommerce' ) ) : ?>
					<div class="cart-wrapper">
						<div class="estore-cart-views">
							<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="wcmenucart-contents">
								<i class="fa fa-shopping-cart"></i>
								<span class="cart-value"><?php echo wp_kses_data ( WC()->cart->get_cart_contents_count() ); ?></span>
							</a> <!-- quick wishlist end -->
							<div class="my-cart-wrap">
								<div class="my-cart"><?php esc_html_e('Total', 'estore'); ?></div>
								<div class="cart-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div>
							</div>
						</div>
						<?php the_widget( 'WC_Widget_Cart', '' ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php get_sidebar( 'header' ); ?>

			</div>
		 </div> <!-- middle-header-wrapper end -->

		 <div class="bottom-header-wrapper clearfix">
			<div class="tg-container">
				<?php
				$menu_location  = 'secondary';
				$menu_locations = get_nav_menu_locations();
				$menu_object    = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
				$menu_name      = (isset($menu_object->name) ? $menu_object->name : '');
				if ( has_nav_menu( $menu_location ) ) {
				?>
				<div class="category-menu">
					<div class="category-toggle">
						<?php echo esc_html($menu_name); ?><i class="fa fa-navicon"> </i>
					</div>
					<nav id="category-navigation" class="category-menu-wrapper hide" role="navigation">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'menu_id'        => 'category-menu',
								'fallback_cb'    => 'false'
							)
						);
						?>
					</nav>
				</div>
				<?php } ?>

 				<div class="search-user-wrapper clearfix">
					<div class="search-wrapper search-user-block">
						<div class="search-icon">
							<i class="fa fa-search"> </i>
						</div>
						<div class="header-search-box">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div> <!-- search-user-wrapper -->
				<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="toggle-wrap"><span class="toggle"><i class="fa fa-reorder"> </i></span></div>
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
			    </nav><!-- #site-navigation -->
                <!-- Menu products -->
                <div class="btn-group btn-dropdown-products btn-product-menu">
                    <button type="button" class="btn btn-warning">Sản phẩm</button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        if ($current_language == 'en') {
                            $categories_custom = get_field('en_category_create', 'option');
                        }
                        else {
                            $categories_custom = get_field('vn_category_create', 'option');
                        }
                        //                        var_dump($categories_custom);
                        foreach ($categories_custom as $category_custom) {
                            echo '<div class="sub-menu-item-custom">
                                     <h6 class="dropdown-header dropdown-header-custom">'. $category_custom['title_category'] . '</h6>';
                            $sub_categories_custom = $category_custom['list_sub_categories'];
                            if($sub_categories_custom) {
                                foreach($sub_categories_custom as $sub_category_custom) {
                                    $permalink = get_term_link($sub_category_custom->slug, 'product_cat');
                                    $permalink = str_replace( './', '', $permalink );
                                    echo  '<a class="dropdown-item" href="'. $permalink .'"><i class="fa fa-caret-right icon-left-menu" aria-hidden="true"></i>' . $sub_category_custom->name .'</a>';
                                }
                                echo '<div class="dropdown-divider"></div>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
			</div>
		 </div> <!-- bottom-header.wrapper end -->
	</header>

	<?php if ( get_theme_mod( 'estore_header_media_placement', 'header_media_below_main_menu' ) == 'header_media_below_main_menu' ) {
		estore_the_custom_header_markup();
	} ?>

	<?php do_action( 'estore_after_header' ); ?>
	<?php do_action( 'estore_before_main' ); ?>
