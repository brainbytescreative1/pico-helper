<?php

// google tag manager
add_action('wp_head', 'bbc_gtm_head');
function bbc_gtm_head(){ 
    $add_gtm = get_field('add_gtm', 'integrations');
    $gtm = get_field('gtm_container_id', 'integrations');
    if ( ( $add_gtm === 'enqueue' ) && $gtm ) { ?>

        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?=$gtm?>');
        </script>
        <!-- End Google Tag Manager -->
         
    <?php }
}

add_action('wp_body_open', 'bbc_gtm_body');
function bbc_gtm_body() {
    $add_gtm = get_field('add_gtm', 'integrations');
    $gtm = get_field('gtm_container_id', 'integrations');
    if ( ( $add_gtm === 'enqueue' ) && $gtm ) { ?>

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=$gtm?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

    <?php }
}

// font awesome
add_action('wp_head', 'add_font_awesome');
function add_font_awesome(){ 
    $add_fa = get_field('enqueue_font_awesome', 'integrations');
    if( $add_fa === 'enqueue' ) {

        $fa_id = get_field('font_awesome_kit_id', 'integrations');
        if ( $fa_id ) {
            echo '<script src="https://kit.fontawesome.com/'. $fa_id .'.js" crossorigin="anonymous"></script>';
        } else {
            echo '<script src="https://kit.fontawesome.com/ec15ef7364.js" crossorigin="anonymous"></script>';
        }

    }
}