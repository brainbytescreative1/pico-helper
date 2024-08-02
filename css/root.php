<?php

function global_site_variables_admin(){ ?>
    <style>
        <?php

        $base = get_theme_mod('SCSSvar_font-family-base');
        if ( $base ) {
            $base = str_replace('"', '', $base);
            ?>
            @font-face {
                font-family:'<?=ucfirst($base)?>';
                font-style:normal;
                font-display:swap;
                font-weight:100 200 300 400 500 600 700 800 900;
                src:url(https://cdn.jsdelivr.net/fontsource/fonts/<?=strtolower($base)?>:vf@latest/latin-wght-normal.woff2) format('woff2-variations');
                unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            <?php
        }
        
        $sans_serif = get_theme_mod('SCSSvar_font-family-sans-serif');
        if ( $sans_serif ) {
            $sans_serif = str_replace('"', '', $sans_serif);
            ?>
            @font-face {
                font-family:'<?=ucfirst($sans_serif)?>';
                font-style:normal;
                font-display:swap;
                font-weight:100 200 300 400 500 600 700 800 900;
                src:url(https://cdn.jsdelivr.net/fontsource/fonts/<?=strtolower($sans_serif)?>:vf@latest/latin-wght-normal.woff2) format('woff2-variations');
                unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            <?php
        }

        $monospace = get_theme_mod('SCSSvar_font-family-monospace');
        if ( $monospace ) {
            $monospace = str_replace('"', '', $monospace);
            ?>
            @font-face {
                font-family:'<?=ucfirst($monospace)?>';
                font-style:normal;
                font-display:swap;
                font-weight:100 200 300 400 500 600 700 800 900;
                src:url(https://cdn.jsdelivr.net/fontsource/fonts/<?=strtolower($monospace)?>:vf@latest/latin-wght-normal.woff2) format('woff2-variations');
                unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            <?php
        }

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