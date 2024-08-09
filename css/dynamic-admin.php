<?php ?>

<!-- dynamic admin styles -->
<style>

    <?php

    $choices = [];

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

    foreach ( $colors as $color ) {
        $hex_color = get_theme_mod('SCSSvar_' . $color);
        if ( $hex_color ) {
            $rgb_color = hex_to_rgb_values($hex_color);
            $contrast_color = rgb_bw_contrast($rgb_color['r'], $rgb_color['g'], $rgb_color['b']);

            echo '.button-color-select input[type="radio"][value="'.$color.'"]:checked::before {';
                echo 'background-color: '.$contrast_color.' !important;';
            echo '}';
        }
    }

    ?>

</style>