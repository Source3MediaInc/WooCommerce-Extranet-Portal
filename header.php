<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php bloginfo( 'description' ); ?> | <?php bloginfo( 'name' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container nav-container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
        wp_nav_menu( array(
        	'theme_location'  => 'primary',
        	'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
        	'container'       => null,
        	'menu_class'      => 'navbar-nav mr-auto',
        	'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        	'walker'          => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
        <ul class="navbar-nav ml-auto">
          <li>
            <?php $count = WC()->cart->cart_contents_count; ?>
            <a href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
              <i class="shopping-cart"></i>
              <span style="display: inline-block;"><?php echo esc_html( $count ); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
