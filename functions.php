<?php

ADD_ACTION('init','permaslug');
function permaslug(){
  $permaslug = "portal";
}

function portal_theme_styles()
{
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), '4.0.0', 'all');
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.0.10/css/all.css', array(), '5.0.10', 'all');
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '0.00.00.52', 'all');
    wp_enqueue_style('woocommerce', get_template_directory_uri() . '/woocommerce.css', array(), '0.00.00.30', 'all');
}
add_action('wp_enqueue_scripts', 'portal_theme_styles');
function portal_theme_scripts()
{
		wp_deregister_script('jquery');
    wp_deregister_script('wc-checkout');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null, false);
    wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js', array('jquery'), '4.0.0', false);
    wp_deregister_script( 'wc-single-product' );
    wp_enqueue_script('wc-single-product', get_template_directory_uri() . '/lib/js/single-product.js', array('jquery'), '0.0.3', false);
    wp_enqueue_script('wc-single-product', get_template_directory_uri() . '/lib/js/checkout.min.js', array('jquery'), '0.0.3', false);

}
add_action('wp_enqueue_scripts', 'portal_theme_scripts');

function portal_theme_support()
{
    /* post formats*/
    add_theme_support('post-formats', array(
        'aside',
        'quote'
    ));

    /* post thumbnails */
    add_theme_support('post-thumbnails', array(
        'post',
        'page',
        'project',
        'slider'
    ));

    add_theme_support('custom-logo');

    add_filter( 'get_custom_logo', 'change_logo_class' );
    function theme_prefix_the_custom_logo() {

    	if ( function_exists( 'the_custom_logo' ) ) {
    		the_custom_logo();
    	}

    }

    /*WooCommerce */
    add_theme_support('woocommerce');

    /* HTML5 */
    add_theme_support('html5');

    /* Menus */
    add_theme_support('menus');

    add_theme_support('automatic-feed-links');

    include('customizer.php');

    require_once get_template_directory() . '/lib/class-wp-bootstrap-navwalker.php';

    include_once get_template_directory() . '/woocommerce/woo-functions.php';

  	load_theme_textdomain( 'order-intranet' );
  	// Add default posts and comments RSS feed links to head.
  	add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form' ) );
  	/*
  	 * Let WordPress manage the document title.
  	 * By adding theme support, we declare that this theme does not use a
  	 * hard-coded <title> tag in the document head, and expect WordPress to
  	 * provide it for us.
  	 */
  	add_theme_support( 'title-tag' );
  	/*
  	 * Switch default core markup for search form, comment form, and comments
  	 * to output valid HTML5.
  	 */
  	add_theme_support(
  		'html5', array(
  			'comment-form',
  			'comment-list',
  			'gallery',
  			'caption',
  		)
  	);
  	/*
  	 * Enable support for Post Formats.
  	 *
  	 * See: https://codex.wordpress.org/Post_Formats
  	 */
  	add_theme_support(
  		'post-formats', array(
  			'aside',
  			'image',
  			'video',
  			'quote',
  			'link',
  			'gallery',
  			'audio',
  		)
  	);
  	// Add theme support for selective refresh for widgets.
  	add_theme_support( 'customize-selective-refresh-widgets' );
  	// Define and register starter content to showcase the theme on new sites.
  	$starter_content = array(
  		'widgets'     => array(
  			// Place three core-defined widgets in the sidebar area.
  			'sidebar-1' => array(
  				'text_business_info',
  				'search',
  				'text_about',
  			),
        'sidebar-product' => array(
  				'text_business_info',
  				'search',
  				'text_about',
          'related_products',
  			),
  			// Add the core-defined business info widget to the footer 1 area.
  			'sidebar-2' => array(
  				'text_business_info',
  			),
  			// Put two core-defined widgets in the footer 2 area.
  			'sidebar-3' => array(
  				'text_about',
  				'search',
  			),
  		),
  	);
  	/**
  	 * Filters Twenty Seventeen array of starter content.
  	 *
  	 * @since Twenty Seventeen 1.1
  	 *
  	 * @param array $starter_content Array of starter content.
  	 */
  	$starter_content = apply_filters( 'order-intranet_starter_content', $starter_content );
  	add_theme_support( 'starter-content', $starter_content );
}
add_action('after_setup_theme', 'portal_theme_support');


function portal_nav_menus()
{
  register_nav_menus(array(
      'primary' => __('Primary Menu', permaslug()),
      'floating' => __('Floating Menu', permaslug()),
      'footer' => __('Footer Navigation', permaslug())
  ));
}
add_action('after_setup_theme', 'portal_nav_menus');

require_once get_template_directory() . '/lib/TGM/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'portal_register_required_plugins' );

function portal_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Elementor Page Builder', // The plugin name.
			'slug'               => 'elementor', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/TGM/plugins/elementor.1.9.8.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		)

	);
  $config = array(
    'id'           => '1698753', // your unique TGMPA ID
    'default_path' => get_stylesheet_directory() . '/lib/TGM/plugins/elementor.1.9.8.zip', // default absolute path
    'menu'         => 'install-required-plugins', // menu slug
    'has_notices'  => true, // Show admin notices
    'dismissable'  => false, // the notices are NOT dismissable
    'dismiss_msg'  => 'I really, really need you to install these plugins, okay?', // this message will be output at top of nag
    'is_automatic' => true, // automatically activate plugins after installation
    'message'      => '', // message to output right before the plugins table
    'strings'      => array(),
  );

  tgmpa( $plugins, $config );

}

function portal_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Custom', permaslug() ),
            'id' => 'sidebar',
            'description' => __( 'Theme Custom Sidebar', permaslug() ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'portal_sidebar' );
/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {

    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
    if ( $count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        <?php
    }
        ?></a><?php

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );

function global_menu($location,$class){
  wp_nav_menu( array(
    'theme_location'  => $location,//primary
    'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
    'container'       => null,
    'menu_class'      => $class,//navbar-nav mr-auto
    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
    'walker'          => new WP_Bootstrap_Navwalker(),
  ) );
}
add_filter( 'menu-init', 'global_menu' );

?>
