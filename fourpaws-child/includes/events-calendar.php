<?php
add_action( 'tribe_template_after_include:events/v2/month/mobile-events', function( $file, $name, $template ) {
    echo '<button>My Button</button>';
  }, 10, 3 );

  add_action( 'tribe_template_before_include:events/v2/components/events-bar/views', function( $file, $name, $template ) {
    echo '<a href="#">My Link</a>';
  }, 10, 3 );