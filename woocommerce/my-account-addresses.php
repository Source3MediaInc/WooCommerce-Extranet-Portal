<div class="addresses">
    <header class="title">
        <h3><?php _e( 'Other Shipping Addresses', permaslug() ); ?></h3>
        <a href="<?php echo add_query_arg( 'action', 'add', $form_url ); ?>" class="edit"><?php _e( 'Add Address', permaslug() ); ?></a>
    </header>

    <?php
    if ( empty($addresses) ) {
        echo '<i>'. __( 'No shipping addresses set up yet.', permaslug() ) .'</i> ';
        echo '<a href="'. add_query_arg( 'action', 'add', $form_url ) .'">'. __( 'Set up shipping addresses', permaslug() ) .'</a>';
    } else {
        foreach ( $addresses as $idx => $address ) {
            if ( $idx === 0 ) {
                // skip the default address
                continue;
            }

            wc_get_template(
                'address-block.php',
                array(
                    'address'   => $address,
                    'idx'       => $idx
                ),
                'multi-shipping',
                dirname( WC_Ship_Multiple::FILE )
            );
        }
        echo '<div class="clear: both;"></div>';
    }
    ?>
</div>
