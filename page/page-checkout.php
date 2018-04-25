<?php //Template Name: Checkout Page Template

get_header();

?>
<div class="pt-slim-container pt-single">
  <h2 class="text-center"><?php the_title();?></h2>
  <div class="row">
    <?php the_content();?>
    <?php echo do_shortcode('[woocommerce_checkout]'); ?>
  </div>
</div>

<?php

get_footer();

?>
