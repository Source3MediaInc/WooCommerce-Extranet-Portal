(function($) {

  wp.customize('background_color', function(value) {
    value.bind(function(newval) {
      $('body').css('background-color', newval);
    });
  });

  wp.customize('heading_color', function(value) {
    value.bind(function(newval) {
      $("h1").css('color', newval);
    });
  });
  wp.customize('heading_color', function(value) {
    value.bind(function(newval) {
      $("h2").css('color', newval);
    });
  });
  wp.customize('heading_color', function(value) {
    value.bind(function(newval) {
      $("h3").css('color', newval);
    });
  });
  wp.customize('heading_color', function(value) {
    value.bind(function(newval) {
      $("h4").css('color', newval);
    });
  });
  wp.customize('heading_color', function(value) {
    value.bind(function(newval) {
      $("h5").css('color', newval);
    });
  });
  wp.customize('heading_color', function(value) {
    value.bind(function(newval) {
      $("h6").css('color', newval);
    });
  });
  wp.customize('border_color', function(value) {
    value.bind(function(newval) {
      $(".landing-container h1").css('border-color', newval);
    });
  });

  wp.customize("paragraph_color", function(value) {
    value.bind(function(newval) {
      $("p").css("color", newval);
    });
  });
  wp.customize("paragraph_color", function(value) {
    value.bind(function(newval) {
      $("span").css("color", newval);
    });
  });
  wp.customize("paragraph_color", function(value) {
    value.bind(function(newval) {
      $("div").css("color", newval);
    });
  });
  wp.customize("paragraph_color", function(value) {
    value.bind(function(newval) {
      $("i").css("color", newval);
    });
  });
  wp.customize("button_text_color", function(value) {
    value.bind(function(newval) {
      $(".btn-custom").css("color", newval);
    });
  });
  wp.customize("button_background_color", function(value) {
    value.bind(function(newval) {
      $(".btn-custom").css("background-color", newval);
    });
  });

  wp.customize("button_two_text_color", function(value) {
    value.bind(function(newval) {
      $(".btn-custom").css("color", newval);
    });
  });
  wp.customize("button_two_background_color", function(value) {
    value.bind(function(newval) {
      $(".btn-custom").css("background-color", newval);
    });
  });

  wp.customize('header1-font-sizer', function(value) {
    value.bind(function(newval) {
      $("h1").css('font-size', newval);
    });
  });
  wp.customize('header2-font-sizer', function(value) {
    value.bind(function(newval) {
      $("h2").css('font-size', newval);
    });
  });
  wp.customize('header3-font-sizer', function(value) {
    value.bind(function(newval) {
      $("h3").css('font-size', newval);
    });
  });
  wp.customize('header4-font-sizer', function(value) {
    value.bind(function(newval) {
      $("h4").css('font-size', newval);
    });
  });
  wp.customize('header5-font-sizer', function(value) {
    value.bind(function(newval) {
      $("h5").css('font-size', newval);
    });
  });
  wp.customize('header6-font-sizer', function(value) {
    value.bind(function(newval) {
      $("h6").css('font-size', newval);
    });
  });

  wp.customize("regular-font-sizer", function(value) {
    value.bind(function(newval) {
      $("p").css("font-size", newval);
    });
  });
  wp.customize("regular-font-sizer", function(value) {
    value.bind(function(newval) {
      $("span").css("font-size", newval);
    });
  });
  wp.customize("regular-font-sizer", function(value) {
    value.bind(function(newval) {
      $("div").css("font-size", newval);
    });
  });
  wp.customize("regular-font-sizer", function(value) {
    value.bind(function(newval) {
      $("i").css("font-size", newval);
    });
  });
  wp.customize("navbar_color", function(value) {
    value.bind(function(newval) {
      $(".navbar").css("color", newval);
    });
  });






  wp.customize("navbar_text_color", function(value) {
    value.bind(function(newval) {
      $(".navbar li a").css("color", newval);
    });
  });
  wp.customize("navbar_text_background_color", function(value) {
    value.bind(function(newval) {
      $(".navbar li a").css("background-color", newval);
    });
  });

  wp.customize( 'navbar_link_padding', function( value ) {
  	value.bind( function( newval ) {
  		$( '.navbar li' ).css("margin-right", newval );
  	} );
  } );

  wp.customize( 'navbar_link_padding', function( value ) {
  	value.bind( function( newval ) {
  		$( '.navbar li' ).css("margin-left", newval );
  	} );
  } );

  wp.customize( 'background-image', function( value ) {
  	value.bind( function( newval ) {
  		$( 'body' ).css("background-image", newval );
  	} );
  } );

  wp.customize('cd_landing_head', function(value) {
    value.bind(function(newval) {
      $('#landinghead').html(newval);
    });
  });

  wp.customize('cd_landing_para', function(value) {
    value.bind(function(newval) {
      $('#landingpara').html(newval);
    });
  });

  wp.customize('cd_call_to_attention_header', function(value) {
    value.bind(function(newval) {
      $('#cta-head').html(newval);
    });
  });

  wp.customize('cd_call_to_attention_body', function(value) {
    value.bind(function(newval) {
      $('#cta-body').html(newval);
    });
  });

  wp.customize('cd_call_to_action_header', function(value) {
    value.bind(function(newval) {
      $('#ctaction-head').html(newval);
    });
  });

  wp.customize('cd_call_to_action_body', function(value) {
    value.bind(function(newval) {
      $('#ctaction-body').html(newval);
    });
  });

  wp.customize("cd_call_to_action_background", function(value) {
    value.bind(function(newval) {
      $(".pt-cta").css("background-color", newval);
    });
  });

  wp.customize("cd_call_to_action_color", function(value) {
    value.bind(function(newval) {
      $(".pt-cta h2").css("color", newval);
    });
  });
  wp.customize("cd_call_to_action_color", function(value) {
    value.bind(function(newval) {
      $(".pt-cta p").css("color", newval);
    });
  });

  wp.customize('vertical_padding', function(value) {
    value.bind(function(newval) {
      $('.pt-hero').css('padding-top',newval);
      $('.pt-hero').css('padding-bottom',newval);
    });
  });
  wp.customize('horizontal_padding', function(value) {
    value.bind(function(newval) {
      $('.pt-hero').css('padding-left',newval);
      $('.pt-hero').css('padding-right',newval);
    });
  });
  wp.customize('cd_text_align', function(value) {
    value.bind(function(newval) {
      $('.landing-container').css('text-align',newval);
    });
  });
})(jQuery);
