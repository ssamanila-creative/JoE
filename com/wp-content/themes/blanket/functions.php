<?php
include __DIR__ . "/inc/globals.php";

/**
 * Features
 * Enable more features for the theme
 *
 */
if (function_exists('add_theme_support'))
{
    add_theme_support('menus');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('title-tag');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true);
    add_image_size('medium', 250, '', true);
    add_image_size('small', 120, '', true);
    add_image_size('custom-size', 700, 200, true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain(BLANKET_TEXT_DOMAIN, __DIR__ . '/languages');
}

/**
 * Enqueue Styles & Scripts
 *
 */
add_action('login_enqueue_scripts', 'blanket_enqueue_login_styles', 10);
add_action('login_enqueue_scripts', 'blanket_enqueue_login_scripts', 1);
add_action('admin_head', 			'blanket_enqueue_admin_styles');
add_action('init',  				'blanket_enqueue_editor_styles');
add_action('wp_enqueue_scripts', 	'blanket_enqueue_styles');
add_action('init', 					'blanket_enqueue_header_scripts');
add_action('wp_print_scripts',  	'blanket_enqueue_footer_scripts');

function blanket_enqueue_login_styles()
{
    wp_enqueue_style('paralikha-login', get_template_directory_uri() . '/login-style.css', false, BLANKET_VERSION);
}

function blanket_enqueue_login_scripts()
{
    wp_enqueue_script('paralikha-login', get_template_directory_uri() . '/js/login.js', true, BLANKET_VERSION);
}

function blanket_enqueue_admin_styles() {
    wp_register_script('paralikha-admin', get_template_directory_uri() . '/js/admin.js', array(), BLANKET_VERSION);
    wp_enqueue_script('paralikha-admin');
}

function blanket_enqueue_editor_styles() {
    add_editor_style(get_template_directory_uri() . '/editor-style.css');
}

function blanket_enqueue_styles()
{
	# Vendor (CDN)
	wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', array(), '4.6.3', 'all');
    wp_enqueue_style('font-awesome');

    wp_register_style('animate.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', array(), '3.5.2', 'all');
    wp_enqueue_style('animate.css');

    wp_register_style('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.3/css/tether.min.css', array(), '1.3.3', 'all');
    wp_enqueue_style('tether');

	# Vendor (Local & Core)
    //

	# Main
    wp_register_style('blanket', get_template_directory_uri() . '/app.min.css', array(), BLANKET_VERSION, 'all');
    wp_enqueue_style('blanket');

    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), BLANKET_VERSION, 'all');
    wp_enqueue_style('style'); // Enqueue it!
}

function blanket_enqueue_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0');
        wp_enqueue_script('conditionizr');

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1');
        wp_enqueue_script('modernizr');

        // wp_register_script('animatron', "http://player.animatron.com/latest/bundle/animatron.min.js", array());
        // wp_enqueue_script('animatron');

        # Vendor (Local & Core)
		wp_register_script('smoothState', get_template_directory_uri() . '/vendor/smoothstate/jquery.smoothState.min.js', array('jquery'), BLANKET_VERSION, true);
	    wp_enqueue_script('smoothState');
    }
}

function blanket_enqueue_footer_scripts()
{
	# Vendor (CDN)
    wp_register_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.3/js/tether.min.js', array('jquery'), '1.3.3', true);
    wp_enqueue_script('tether');

	# Vendor (Local & Core)
    wp_register_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/dist/js/bootstrap.min.js', array('jquery'), '4.0.0-apha.3', true);
    wp_enqueue_script('bootstrap');

    # Main
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), BLANKET_VERSION, true);
    wp_enqueue_script('scripts');
}

/**
 * Navigation Menus
 *
 */

add_action('init', 'blanket_register_nav_menus');

function blanket_register_nav_menus()
{
    register_nav_menus(array(
        'landing-menu' 	=> __('Landing Page Menu', BLANKET_TEXT_DOMAIN),
        'main-menu' 	=> __('Main Menu', BLANKET_TEXT_DOMAIN),
        'social-menu' 	=> __('Social Menu', BLANKET_TEXT_DOMAIN),
        'header-menu' 	=> __('Header Menu', BLANKET_TEXT_DOMAIN),
        'sidebar-menu' 	=> __('Sidebar Menu', BLANKET_TEXT_DOMAIN),
        'extra-menu' 	=> __('Extra Menu', BLANKET_TEXT_DOMAIN),
    ));
}

function pl_landing_nav()
{
    wp_nav_menu(array(
        'theme_location'  => 'landing-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="menu-list">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
    ));
}

function pl_main_nav()
{
    wp_nav_menu(array(
        'theme_location'  => 'main-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="menu-list">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
    ));
}

function pl_social_nav()
{
	wp_nav_menu(array(
        'theme_location'  => 'social-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="social-menu">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
    ));
}

/**
 * Favicons
 *
 */
add_action('login_head', 'paraluman_print_favicons');
add_action('admin_head', 'paraluman_print_favicons');
add_action('wp_head', 	 'paraluman_print_favicons');

function paraluman_print_favicons()
{ ?>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_site_url(); ?>/apple-touch-icon-57x57.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_site_url(); ?>/apple-touch-icon-60x60.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_site_url(); ?>/apple-touch-icon-72x72.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_site_url(); ?>/apple-touch-icon-76x76.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_site_url(); ?>/apple-touch-icon-114x114.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_site_url(); ?>/apple-touch-icon-120x120.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_site_url(); ?>/apple-touch-icon-144x144.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_site_url(); ?>/apple-touch-icon-152x152.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_site_url(); ?>/apple-touch-icon-180x180.png?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="icon" type="image/png" href="<?php echo get_site_url(); ?>/favicon-32x32.png?v=<?php echo BLANKET_VERSION; ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo get_site_url(); ?>/favicon-96x96.png?v=<?php echo BLANKET_VERSION; ?>" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo get_site_url(); ?>/favicon-16x16.png?v=<?php echo BLANKET_VERSION; ?>" sizes="16x16">
    <link rel="manifest" href="<?php echo get_site_url(); ?>/manifest.json?v=<?php echo BLANKET_VERSION; ?>">
    <link rel="mask-icon" href="<?php echo get_site_url(); ?>/safari-pinned-tab.svg?v=<?php echo BLANKET_VERSION; ?>" color="#ee3025">
    <link rel="shortcut icon" href="<?php echo get_site_url(); ?>/favicon.ico?v=<?php echo BLANKET_VERSION; ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_site_url(); ?>/mstile-144x144.png?v=<?php echo BLANKET_VERSION; ?>">
    <meta name="msapplication-config" content="<?php echo get_site_url(); ?>/browserconfig.xml?v=<?php echo BLANKET_VERSION; ?>">
    <meta name="theme-color" content="#ffffff">
    <!-- /Favicons -->
    <?php
}


/**
 * SEO & Analytics
 */

function get_analytics()
{
	return; // some analytic scripts here
}