<?php //Template Name: Home Page Template

get_header();

?>

<div class="pt-slim-container pt-shop" style="padding: 10%;">
  <h2 class="text-center">Our Products</h2>
  <div class="row">
    <?php product_query();?>
  </div>
</div>

<div class="pt-container pt-cta">
  <div>
      <?php the_content();?>
  </div>
</div>


<?php

get_footer();

?>
