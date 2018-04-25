<?php
/*
 * Template Name: Single Post Full Width Contained
 * Template Post Type: post
 */

 get_header();  ?>

 <div class="container">
     <h3 class="text-center"><?php the_title();?></h3>
     <h6 class="text-center"><span><?php echo get_the_date();?></span> | <span><?php echo get_the_author();?></span></h6>
     <?php the_content();?>
 </div>

 <?php get_footer();?>
