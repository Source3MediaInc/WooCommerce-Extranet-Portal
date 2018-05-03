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
        <?php global_menu('primary','navbar-nav mr-auto'); ?>
        <a href="/cart/" title="View Shopping Cart Contents"><i class="fas fa-shopping-bag cart-icon"></i><span class="cart-contents-counter"><?php echo WC()->cart->get_cart_contents_count();?></span></a>

      </div>
    </div>
  </nav>
