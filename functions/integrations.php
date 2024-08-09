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

// userway
add_action('wp_head', 'bbc_add_userway');
function bbc_add_userway(){ 
    $add_userway = get_field('add_userway', 'integrations');
    $userway_color = get_field('userway_color', 'integrations');
    if ( !$userway_color ) {
        $userway_color = '#FD24CC';
    }
    if ( $add_userway === 'enqueue' ) { ?>

        <script>
        (function(d){
        var s = d.createElement("script");
        s.setAttribute("data-color", "<?=$userway_color?>");
        s.setAttribute("data-account", "20ms6oN9h5");
        s.setAttribute("src", "https://cdn.userway.org/widget.js");
        (d.body || d.head).appendChild(s);
        })(document)
        </script>
        <noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website accessibility</a></noscript>
         
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

// add custom fonts
function bbc_get_fonts(){ 
    $custom_fonts = get_field('custom_fonts', 'integrations');
    if( $custom_fonts ) {
        echo $custom_fonts;
        add_action('init', 'bbc_add_fonts');
    }
}
add_action('admin_head', 'bbc_get_fonts');

function bbc_add_fonts() {
    $add_custom_fonts = get_field('custom_font_options', 'integrations');
    if ( $add_custom_fonts === 'admin' ) {
        add_action('admin_head', 'bbc_get_fonts');
    } elseif ( $add_custom_fonts === 'front' ) {
        add_action('admin_head', 'bbc_get_fonts');
        add_action('wp_head', 'bbc_get_fonts');
    }
}