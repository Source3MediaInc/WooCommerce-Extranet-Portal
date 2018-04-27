<?php

if ( ! is_active_sidebar( 'sidebar-product' ) ) {
	return;
}
?>

<div class="row" role="complementary" aria-label="<?php esc_attr_e( 'Product Sidebar', permaslug() ); ?>">
  <ul>
    <li>
      Item
    </li>
    <li>
      Item
    </li>
  </ul>
</div>
