<?php //Template Name: My Account Page Template

get_header();

?>
<div class="pt-slim-container pt-single">
  <h2 class="text-center"><?php the_title();?></h2>
  <div class="row">
    <?php the_content();?>
    <?php echo do_shortcode('[woocommerce_my_account]'); ?>
  </div>
</div>

<?php

get_footer();

?>
