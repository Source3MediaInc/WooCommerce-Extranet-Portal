<?php //Template Name: Cart Page Template

get_header();

?>
<div class="pt-slim-container pt-single">
  <h2 class="text-center"><?php the_title();?></h2>
  <div class="row">
    <?php the_content();?>
    <?php echo do_shortcode('[woocommerce_cart]'); ?>
  </div>
</div>

<?php

get_footer();

?>
