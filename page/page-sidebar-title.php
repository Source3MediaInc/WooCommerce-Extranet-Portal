<?php //Template Name: Page Template with Title & Sidebar

get_header();

?>

<div class="container">
  <div class="col-md-9">
    <h3 class="text-center"><?php the_title();?></h3>
    <div>
      <?php the_content();?>
    </div>
  </div>
  <div class="col-md-3">
    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar' ); ?>
    <?php endif; ?>
  </div>
</div>

<?php

get_footer();

?>
