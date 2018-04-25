<?php
add_action('customize_register', 'cd_customizer_settings');
function cd_customizer_settings($wp_customize)
{
    if (class_exists('WP_Customize_Control')) {
        class WP_Customize_Range extends WP_Customize_Control
        {
            public $type = 'range';

            public function __construct($manager, $id, $args = array())
            {
                parent::__construct($manager, $id, $args);
                $defaults = array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 1
                );
                $args     = wp_parse_args($args, $defaults);

                $this->min  = $args['min'];
                $this->max  = $args['max'];
                $this->step = $args['step'];
            }

            public function render_content()
            {
?>
       <label>
            <span class="customize-control-title"><?php
                echo esc_html($this->label);
?></span>
            <input class='range-slider' min="<?php
                echo $this->min;
?>" max="<?php
                echo $this->max;
?>" step="<?php
                echo $this->step;
?>" type='range' <?php
                $this->link();
?> value="<?php
                echo esc_attr($this->value());
?>" oninput="jQuery(this).next('input').val( jQuery(this).val() )">
            <input onKeyUp="jQuery(this).prev('input').val( jQuery(this).val() )" type='text' value='<?php
                echo esc_attr($this->value());
?>'>

        </label>
        <?php
            }
        }
    }
    $wp_customize->add_section('cd_colors', array(
        'title' => 'Colors',
        'description' => 'This section sets font sizes for the entire site, changes applied here are considered global.',
        'priority' => 30
    ));
    $wp_customize->add_section('cd_navbar', array(
        'title' => 'Navbar',
        'description' => 'This section sets font sizes for the entire site, changes applied here are considered global.',
        'priority' => 30
    ));
    $wp_customize->add_section('cd_font_sizes', array(
        'title' => 'Font Orientation',
        'description' => 'This section sets font sizes for the entire site, changes applied here are considered global.',
        'priority' => 30
    ));

    $wp_customize->add_section('cd_landing', array(
        'title' => 'Landing Settings',
        'description' => 'This section sets first thing you see when you enter the website, these are not global settings.',
        'priority' => 30
    ));
    $wp_customize->add_section('cd_call_to_attention', array(
        'title' => 'Call To Attention',
        'description' => 'As soon as people scroll down, they will see this area with an in depth description of what it is that you do.',
        'priority' => 31
    ));
    $wp_customize->add_section('cd_call_to_action', array(
        'title' => 'Call To Action',
        'description' => 'As soon as people scroll down, they will see this area with an in depth description of what it is that you do.',
        'priority' => 31
    ));
    $wp_customize->add_section('cd_shop', array(
        'title' => 'Shop Settings',
        'description' => '',
        'priority' => 32
    ));
    $wp_customize->add_setting('background_color', array(
        'default' => '#fff',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
        'label' => 'Background Color',
        'section' => 'cd_colors',
        'settings' => 'background_color'
    )));
    $wp_customize->add_setting('heading_color', array(
        'default' => '#000',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'heading_color', array(
        'label' => 'Heading Colors',
        'section' => 'cd_colors',
        'settings' => 'heading_color'
    )));
    $wp_customize->add_setting('border_color', array(
        'default' => '#000',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'border_color', array(
        'label' => 'Headline Border Color',
        'section' => 'cd_colors',
        'settings' => 'border_color'
    )));
    $wp_customize->add_setting('paragraph_color', array(
        'default' => '#000',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'paragraph_color', array(
        'label' => 'Paragraph Colors',
        'section' => 'cd_colors',
        'settings' => 'paragraph_color'
    )));
    $wp_customize->add_setting('navbar_color', array(
        'default' => '#000',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_color', array(
        'label' => 'Navbar Colors',
        'section' => 'cd_navbar',
        'settings' => 'navbar_color'
    )));
    $wp_customize->add_setting('navbar_text_color', array(
        'default' => '#fff',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_text_color', array(
        'label' => 'Navbar Text Colors',
        'section' => 'cd_navbar',
        'settings' => 'navbar_text_color'
    )));
    $wp_customize->add_setting('navbar_text_background_color', array(
        'default' => '#000',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_text_background_color', array(
        'label' => 'Navbar Text Background Colors',
        'section' => 'cd_navbar',
        'settings' => 'navbar_text_background_color'
    )));

    $wp_customize->add_setting( 'cd_text_align',
       array(
          'default' => 'left',
          'transport' => 'refresh'
       )
      );

      $wp_customize->add_control( 'cd_text_align',
       array(
          'label' => __( 'Text Align' ),
          'description' => esc_html__( 'Change The Way Landing Text Is Aligned' ),
          'section' => 'cd_landing',
          'settings' => 'cd_text_align',
          'priority' => 10, // Optional. Order priority to load the control. Default: 10
          'type' => 'radio',
          'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
          'choices' => array( // Optional.
             'left' => ( 'Left' ),
             'right' => ( 'Right' ),
             'center' => ( 'Center' ),
             'justified' => ( 'Justified' )
          )
       )
      );


    $wp_customize->add_setting( 'regular-font-sizer' , array(
        'default'     => 14,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'regular-font-sizer', array(
    	'label'	=>  'Regular Font Size',
        'min' => 4,
        'max' => 132,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'regular-font-sizer'
    ) ) );

    $wp_customize->add_setting( 'header1-font-sizer' , array(
        'default'     => 32,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'header1-font-sizer', array(
    	'label'	=>  'H1 Font Size',
        'min' => 4,
        'max' => 264,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'header1-font-sizer'
    ) ) );
    $wp_customize->add_setting( 'header2-font-sizer' , array(
        'default'     => 28,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'header2-font-sizer', array(
    	'label'	=>  'H2 Font Size',
        'min' => 4,
        'max' => 264,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'header2-font-sizer'
    ) ) );
    $wp_customize->add_setting( 'header3-font-sizer' , array(
        'default'     => 24,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'header3-font-sizer', array(
    	'label'	=>  'H3 Font Size',
        'min' => 4,
        'max' => 264,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'header3-font-sizer'
    ) ) );
    $wp_customize->add_setting( 'header4-font-sizer' , array(
        'default'     => 20,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'header4-font-sizer', array(
    	'label'	=>  'H4',
        'min' => 4,
        'max' => 264,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'header4-font-sizer'
    ) ) );
    $wp_customize->add_setting( 'header5-font-sizer' , array(
        'default'     => 16,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'header5-font-sizer', array(
    	'label'	=>  'H5',
        'min' => 4,
        'max' => 264,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'header5-font-sizer'
    ) ) );
    $wp_customize->add_setting( 'header6-font-sizer' , array(
        'default'     => 12,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'header6-font-sizer', array(
    	'label'	=>  'H6',
        'min' => 4,
        'max' => 264,
        'step' => 2,
    	'section' => 'cd_font_sizes',
      'settings' => 'header6-font-sizer'
    ) ) );

    $wp_customize->add_setting( 'navbar_link_padding' , array(
        'default'     => 0,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'navbar_link_padding', array(
    	'label'	=>  'Link Padding',
        'min' => 0,
        'max' => 32,
        'step' => 1,
    	'section' => 'cd_navbar',
      'settings' => 'navbar_link_padding'
    ) ) );

    $wp_customize->add_setting( 'background-image' );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,'theme_header_bg',array(
                'label' => 'Background Image',
                'section' => 'cd_colors',
                'settings' => 'background-image',
                'priority' => 2
            )
        )
    );
    $wp_customize->add_setting( 'cd_landing_head' , array(
        'default'     => 'Change me in customizer',
        'transport'   => 'postMessage',
    ) );

    $wp_customize->add_control( 'cd_landing_head', array(
        'label' => 'Header Text',
    'section'	=> 'cd_landing',
    'settings' => 'cd_landing_head',
    'type'	 => 'text',
    ) );

    $wp_customize->add_setting( 'cd_landing_para' , array(
        'default'     => 'Change me in customizer',
        'transport'   => 'postMessage',
    ) );

    $wp_customize->add_control( 'cd_landing_para', array(
        'label' => 'Sub Header Text',
    'section'	=> 'cd_landing',
    'settings' => 'cd_landing_para',
    'type'	 => 'text',
    ) );

    $wp_customize->add_setting( 'cd_button_text' , array(
        'default'     => 'Change Me',
        'transport'   => 'postMessage',
    ) );

    $wp_customize->add_control( 'cd_button_text', array(
        'label' => 'Primary Button Text',
    'section'	=> 'cd_landing',
    'settings' => 'cd_button_text',
    'type'	 => 'text',
    ) );


    $wp_customize->add_setting( 'cd_button_link' , array(
        'default'     => '//google.com',
        'transport'   => 'postMessage',
    ) );

    $wp_customize->add_control( 'cd_button_link', array(
        'label' => 'Primary Button Link',
        'description' => 'Please include "//" or "http://"',
    'section'	=> 'cd_landing',
    'settings' => 'cd_button_link',
    'type'	 => 'text',
    ) );

  $wp_customize->add_setting( 'cd_button_display' , array(
      'default'     => true,
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'cd_button_display', array(
    'label' => 'Show Primary Button?',
    'section' => 'cd_landing',
    'settings' => 'cd_button_display',
    'type' => 'radio',
    'type' => 'radio',
    'priority' => 2,
    'choices' => array(
      'show' => 'Show Button',
      'hide' => 'Hide Button',
    ),
  ) );

  $wp_customize->add_setting('button_background_color', array(
      'default' => '#000',
      'transport' => 'refresh'
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_background_color', array(
      'label' => 'Primary Button Background Color',
      'section' => 'cd_landing',
      'settings' => 'button_background_color'
  )));

  $wp_customize->add_setting('button_text_color', array(
      'default' => '#000',
      'transport' => 'refresh'
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
      'label' => 'Primary Button Text Color',
      'section' => 'cd_landing',
      'settings' => 'button_text_color'
  )));

  $wp_customize->add_setting( 'cd_button_two_text' , array(
      'default'     => 'Change Me',
      'transport'   => 'postMessage',
  ) );

  $wp_customize->add_control( 'cd_button_two_text', array(
      'label' => 'Secondary Button Text',
  'section'	=> 'cd_landing',
  'settings' => 'cd_button_two_text',
  'type'	 => 'text',
  ) );


  $wp_customize->add_setting( 'cd_button_two_link' , array(
      'default'     => '//google.com',
      'transport'   => 'postMessage',
  ) );

  $wp_customize->add_control( 'cd_button_two_link', array(
      'label' => 'Secondary Button Link',
      'description' => 'Please include "//" or "http://"',
  'section'	=> 'cd_landing',
  'settings' => 'cd_button_two_link',
  'type'	 => 'text',
  ) );

$wp_customize->add_setting( 'cd_button_two_display' , array(
    'default'     => true,
    'transport'   => 'refresh',
) );

$wp_customize->add_control( 'cd_button_two_display', array(
  'label' => 'Show Secondary Button?',
  'section' => 'cd_landing',
  'settings' => 'cd_button_two_display',
  'type' => 'radio',
  'type' => 'radio',
  'priority' => 2,
  'choices' => array(
    'show' => 'Show Button',
    'hide' => 'Hide Button',
  ),
) );

$wp_customize->add_setting('button_two_background_color', array(
    'default' => '#000',
    'transport' => 'refresh'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_two_background_color', array(
    'label' => 'Secondary Button Background Color',
    'section' => 'cd_landing',
    'settings' => 'button_two_background_color'
)));

$wp_customize->add_setting('button_two_text_color', array(
    'default' => '#000',
    'transport' => 'refresh'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_two_text_color', array(
    'label' => 'Secondary Text Color',
    'section' => 'cd_landing',
    'settings' => 'button_two_text_color'
)));



  $wp_customize->add_setting( 'vertical_padding' , array(
    'default'     => 0,
    'transport'   => 'postMessage',
  ) );
  $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'vertical_padding', array(
  	'label'	=>  'Vertical Padding',
      'min' => 0,
      'max' => 600,
      'step' => 1,
      'settings' => 'vertical_padding',
      'section'	=> 'cd_landing',
      'prority' => 0,
  ) ) );
  $wp_customize->add_setting( 'horizontal_padding' , array(
    'default'     => 0,
    'transport'   => 'postMessage',
  ) );

  $wp_customize->add_control( new WP_Customize_Range( $wp_customize, 'horizontal_padding', array(
  	'label'	=>  'Horizontal',
      'min' => 0,
      'max' => 600,
      'step' => 1,
      'settings' => 'horizontal_padding',
      'section'	=> 'cd_landing',
      'prority' => 0,
  ) ) );

  $wp_customize->add_setting('cd_call_to_attention_header', array(
    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'transport'=>'postMessage',
  ));
  $wp_customize->add_control('cd_call_to_attention_header', array(
    'label'   =>    'Call To Attention Header',
    'section' =>    'cd_call_to_attention',
    'settings'=>    'cd_call_to_attention_header',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('cd_call_to_attention_body', array(
    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac turpis eu elit iaculis blandit. Quisque ligula tortor, lobortis ac ex in, malesuada eleifend ligula. Proin et mi at nulla viverra',
    'transport'=>'postMessage',
  ));
  $wp_customize->add_control('cd_call_to_attention_body', array(
    'label'   =>    'Call To Attention Header',
    'section' =>    'cd_call_to_attention',
    'settings'=>    'cd_call_to_attention_body',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('cd_call_to_action_background', array(
      'default' => '#fff',
      'transport' => 'refresh'
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cd_call_to_action_background', array(
      'label' => 'Area Background Color',
      'section' => 'cd_call_to_action',
      'settings' => 'cd_call_to_action_background'
  )));

  $wp_customize->add_setting('cd_call_to_action_color', array(
      'default' => '#fff',
      'transport' => 'refresh'
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cd_call_to_action_color', array(
      'label' => 'Area Text Color',
      'section' => 'cd_call_to_action',
      'settings' => 'cd_call_to_action_color'
  )));

  $wp_customize->add_setting('cd_call_to_action_header', array(
    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'transport'=>'postMessage',
  ));
  $wp_customize->add_control('cd_call_to_action_header', array(
    'label'   =>    'Call To Attention Header',
    'section' =>    'cd_call_to_action',
    'settings'=>    'cd_call_to_action_header',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('cd_call_to_action_body', array(
    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac turpis eu elit iaculis blandit. Quisque ligula tortor, lobortis ac ex in, malesuada eleifend ligula. Proin et mi at nulla viverra',
    'transport'=>'postMessage',
  ));
  $wp_customize->add_control('cd_call_to_action_body', array(
    'label'   =>    'Call To Attention Header',
    'section' =>    'cd_call_to_action',
    'settings'=>    'cd_call_to_action_body',
    'type'    => 'textarea'
  ));
}
add_action('wp_head', 'cd_customizer_css');
function cd_customizer_css()
{
?>
<style type="text/css">
   body { background: #<?php
    echo get_theme_mod('background_color', 'fff');
?>; }
   h1,h2,h3,h4,h5,h6 { color: <?php
    echo get_theme_mod('heading_color', '#000');
?>; }
h1 { font-size: <?php
 echo get_theme_mod('header1-font-sizer', '32');
?>px; }
h2 { font-size: <?php
 echo get_theme_mod('header2-font-sizer', '28');
?>px; }
h3 { font-size: <?php
 echo get_theme_mod('header3-font-sizer', '24');
?>px; }
h4 { font-size: <?php
 echo get_theme_mod('header4-font-sizer', '20');
?>px; }
h5 { font-size: <?php
 echo get_theme_mod('header5-font-sizer', '16');
?>px; }
h6 { font-size: <?php
 echo get_theme_mod('header6-font-sizer', '12');
?>px; }
   p,span,div,i { color: <?php
    echo get_theme_mod('paragraph_color', '#000');
?>; }
   p,span,div,i { font-size: <?php
    echo get_theme_mod('regular-font-sizer', '14');
?>px; }
   .pt-hero h1{border-color: <?php
    echo get_theme_mod('border_color', '#000');
?>;}
   .navbar{background-color: <?php
    echo get_theme_mod('navbar_color', '#000');
?>;}
   .navbar li a{color: <?php
    echo get_theme_mod('navbar_text_color', '#fff');
?>!important;}
   .navbar li a{background-color: <?php
    echo get_theme_mod('navbar_text_background_color', '#000');
?>!important;}
.navbar li{margin:0px <?php
 echo get_theme_mod('navbar_link_padding', '15');
?>px!important;}

body{background-image: url('<?php
 echo get_theme_mod('background-image', '');
?>')!important; background-size: cover;}
.pt-hero{ text-align:<?php
 echo get_theme_mod('cd_text_align', 'left')?>!important;}

.pt-hero{ padding:<?php
 echo get_theme_mod('vertical_padding', '5') .'% ' . get_theme_mod('horizontal_padding', '5');
?>% !important;}

.btn-custom{ background-color: <?php
 echo get_theme_mod('button_background_color', '#ff3d3d');
?>!important;}
.btn-custom{ color: <?php
 echo get_theme_mod('button_text_color', '#fff');
?>!important;}

.btn-custom-border{ border-color: <?php
 echo get_theme_mod('button_two_background_color', '#ff3d3d');
?>!important;}
.btn-custom-border{ color: <?php
 echo get_theme_mod('button_two_text_color', '#fff');
?>!important;}
.pt-cta{ background-color: <?php
 echo get_theme_mod('cd_call_to_action_background', '#fff');
?>!important;}
.pt-cta h2,.pt-cta p{color: <?php
 echo get_theme_mod('cd_call_to_action_color', '#fff');
?>!important;}

 </style>
<?php
}
add_action('customize_preview_init', 'cd_customizer');
function cd_customizer()
{
    wp_enqueue_script('cd_customizer', get_template_directory_uri() . '/lib/js/customizer.js', array(
        'jquery',
        'customize-preview'
    ), '0.0.002.9', false);
}

?>
