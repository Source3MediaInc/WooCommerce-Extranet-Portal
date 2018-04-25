<?php //Template Name: Home Page Template

get_header();

?>
<div class="pt-container pt-hero" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
  <div class="text-center">
    <?php
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    if ( has_custom_logo() ) {
            echo '<img class="img-responsive img-hero" src="'. esc_url( $logo[0] ) .'">';
    }
    ?>
  </div>
  <h1 id="landinghead"><?php echo get_theme_mod( 'cd_landing_head', 'Change In Customizer' ) ?></h1>
  <h4 id="landingpara"><?php echo get_theme_mod('cd_landing_para','Change In Customizer');?></h4>
  <?php if( get_theme_mod( 'cd_button_display', 'show' ) == 'show' ) : ?>
      <a href="<?php echo get_theme_mod('cd_button_link','//google.com');?>" id='landing-button' class='btn btn-custom'><?php echo get_theme_mod('cd_button_text','Change Me');?></a>
  <?php endif ?>
  <?php if( get_theme_mod( 'cd_button_two_display', 'show' ) == 'show' ) : ?>
      <a href="<?php echo get_theme_mod('cd_button_two_link','//google.com');?>" id='landing-button' class='btn btn-custom-border'><?php echo get_theme_mod('cd_button_two_text','Change Me');?></a>
  <?php endif ?>
</div>

<div class="pt-slim-container pt-details">
  <h2 id="cta-head"><?php echo get_theme_mod( 'cd_call_to_attention_header', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' ) ?></h2>
  <p id="cta-body"><?php echo get_theme_mod('cd_call_to_attention_body','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac turpis eu elit iaculis blandit. Quisque ligula tortor, lobortis ac ex in, malesuada eleifend ligula. Proin et mi at nulla viverra');?></p>
</div>

<div class="pt-container pt-cta">
  <h2 id="ctaction-head"><?php echo get_theme_mod( 'cd_call_to_action_header', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' ) ?></h2>
  <p id="ctaction-body"><?php echo get_theme_mod('cd_call_to_action_body','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac turpis eu elit iaculis blandit. Quisque ligula tortor, lobortis ac ex in, malesuada eleifend ligula. Proin et mi at nulla viverra');?></p>
</div>


<div class="pt-slim-container pt-shop">
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
