<?php
/*
 * Template Name: Single Post with Sidebar
 * Template Post Type: post
 */

 get_header();  ?>

 <div class="container">
   <div class="col-md-9">
     <h3 class="text-center"><?php the_title();?></h3>
     <h6 class="text-center"><span><?php echo get_the_date();?></span> | <span><?php echo get_the_author();?></span></h6>
     <?php the_content();?>
   </div>
   <div class="col-md-3">
     <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
         <?php dynamic_sidebar( 'sidebar' ); ?>
     <?php endif; ?>
   </div>
 </div>

 <?php get_footer();?>
