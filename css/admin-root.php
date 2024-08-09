<?php

function global_site_variables_admin(){ ?>

    <style>

        <?php
        /*
        $base_name = '';
        $base_short = '';
        $base = get_theme_mod('SCSSvar_font-family-base');
        if ( $base ) {
            $base_name = $base;
            $base_short = preg_replace('/[^a-z\d ]/i', '', $base);
            $base_short = str_replace(' ', '-', $base_short);
            $base_short = strtolower($base_short);
            $base_short = 'https://cdn.jsdelivr.net/fontsource/fonts/'. $base_short .':vf@latest/latin-wght-normal.woff2';
            //
            ?>
            @font-face {
                font-family:"<?=$base_name?>";
                font-style:normal;
                font-display:swap;
                font-weight:100 200 300 400 500 600 700 800 900;
                src:url(<?=$base_short?>) format('woff2-variations');
                unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            <?php
        }
        
        $sans_name = '';
        $sans_short = '';
        $sans_serif = get_theme_mod('SCSSvar_font-family-sans-serif');
        if ( $sans_serif ) {
            $sans_name = $sans_serif;
            $sans_short = preg_replace('/[^a-z\d ]/i', '', $sans_serif);
            $sans_short = str_replace(' ', '-', $sans_short);
            $sans_short = strtolower($sans_short);
            $sans_short = 'https://cdn.jsdelivr.net/fontsource/fonts/'. $sans_short .':vf@latest/latin-wght-normal.woff2';
            ?>
            @font-face {
                font-family:"Open Sans";
                font-style:normal;
                font-display:swap;
                font-weight:100 200 300 400 500 600 700 800 900;
                src:url(<?=$sans_short?>) format('woff2-variations');
                unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            <?php
        }

        $mono_name = '';
        $mono_short = '';
        $monospace = get_theme_mod('SCSSvar_font-family-monospace');
        if ( $monospace ) {
            $mono_name = $monospace;
            $mono_short = preg_replace('/[^a-z\d ]/i', '', $monospace);
            $mono_short = str_replace(' ', '-', $mono_short);
            $mono_short = strtolower($mono_short);
            $mono_short = 'https://cdn.jsdelivr.net/fontsource/fonts/'. $mono_short .':vf@latest/latin-wght-normal.woff2';
            ?>
            @font-face {
                font-family:"Open Sans";
                font-style:normal;
                font-display:swap;
                font-weight:100 200 300 400 500 600 700 800 900;
                src:url(<?=$mono_short?>) format('woff2-variations');
                unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            <?php
        }
        */

        $colors = [
            'primary',
            'secondary',
            'success',
            'info',
            'danger',
            'warning',
            'light',
            'dark',
            'white',
        ];

        echo ':root {';
            echo '--bs-text: ' . get_theme_mod('SCSSvar_body-color') . ';';
            foreach ( $colors as $color ) {
                if ( get_theme_mod('SCSSvar_' . $color) ) {
                    echo '--bs-' . $color . ': ' . get_theme_mod('SCSSvar_' . $color) . ';';
                }
            }
            echo '--bs-white: #ffffff;';
        echo '}';

        ?>
    </style>
<?php }
add_action('admin_head', 'global_site_variables_admin');