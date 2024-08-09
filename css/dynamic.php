<?php //Header ("Content-type: text/css; charset=utf-8"); ?>
<style>
<?php
echo ':root {'; // root start
// header root
$header_height = get_field('header_height', 'header');
if ( $header_height ) {
    echo '--header-height: ' . $header_height . 'px;';
    echo '--header-height-neg: -' . $header_height . 'px;';
} else {
    echo '--header-height: 0px;';
}
if ( $header_height && is_user_logged_in() ) {
    $header_height_desktop = $header_height + 32;
    echo '--header-height-logged-in: ' . $header_height_desktop . 'px;';
    $header_height_mobile = $header_height + 46;
    echo '--header-height-logged-in-mobile: ' . $header_height_mobile . 'px;';
} else {
    echo '--header-height-logged-in: 32px;';
    echo '--header-height-logged-in-mobile: 46px;';
}

$header_mobile_breakpoint = get_theme_mod('picostrap_header_navbar_expand' );
if ( $header_mobile_breakpoint ) {
    switch ($header_mobile_breakpoint) {
        case 'navbar-expand-sm':
            $header_mobile_breakpoint = '576px';
            break;
        case 'navbar-expand-md':
            $header_mobile_breakpoint = '768px';
            break;
        case 'navbar-expand-lg':
            $header_mobile_breakpoint = '992px';
            break;
        case 'navbar-expand-xl':
            $header_mobile_breakpoint = '1200px';
            break;
        case 'navbar-expand-xxl':
            $header_mobile_breakpoint = '1468px';
            break;
        default:
            $header_mobile_breakpoint = '';
    }
    echo '--header-mobile-breakpoint: '. $header_mobile_breakpoint .';';
}

echo '}';

// gutters
$column_width_half = null;
$column_gutter_width = get_field('column_gutter_width', 'layout');
if ( $column_gutter_width ) {
    $column_width_half = $column_gutter_width / 2;
    echo '.row > * {';
        echo 'padding-right: '.$column_width_half.'rem;';
        echo 'padding-left: '.$column_width_half.'rem;';
    echo '}';
    echo '.wp-block-group,';
    echo '.editor-styles-wrapper .row > * {';
        echo 'padding-right: '.$column_width_half.'rem !important;';
        echo 'padding-left: '.$column_width_half.'rem !important;';
    echo '}';
}

// containers
$container_max_width = get_field('container_max_width', 'layout');
if ( $container_max_width ) {
    echo '.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {';
        echo 'max-width: '. $container_max_width .'px !important;';
        echo 'padding-right: ' . $column_width_half . 'rem;';
        echo 'padding-left: ' . $column_width_half . 'rem;';
    echo '}';
    echo '.editor-styles-wrapper .container {';
        echo 'max-width: 1600px;';
    echo '}';
    echo 'html :where(.wp-block) {';
        echo 'max-width: 1600px;';
    echo '}';
}

// header options

// logo width
$logo_width = get_field('logo_width', 'header');
if ( $logo_width ) {
    echo '.custom-logo-link {';
        echo 'max-width: '.$logo_width.'px;';
    echo '}';
}

// main menu padding
$main_menu_padding = get_field('main_menu_padding', 'header');
if ( $main_menu_padding !== 'default' ) {
    if ( $main_menu_padding === 'custom' ) {
        $main_menu_padding_custom = get_field('main_menu_padding_custom', 'header');
        if ( $main_menu_padding_custom ) {
            $main_menu_padding = $main_menu_padding_custom . 'rem';
        }
    }
}
if ( $main_menu_padding ) {
    echo 'nav.navbar { padding-top: '. $main_menu_padding .'; padding-bottom: '. $main_menu_padding .'; }';
}

// sticky logo
$sticky_logo = get_field('sticky_logo', 'header');
if ( $sticky_logo ) {
    echo '#navbar-main .navbar-brand.sticky-logo {';
        echo 'display: none;';
    echo '}';
    echo '#navbar-sticky .navbar-brand.custom-logo-link {';
        echo 'display: none;';
    echo '}';
    $sticky_logo_width = get_field('sticky_logo_width', 'header');
    if ( $sticky_logo_width ) {
        echo '.sticky-logo {';
            echo 'max-width: ' . $sticky_logo_width . 'px';
        echo '}';
    } else {
        echo 'max-width: ' . $logo_width . 'px';
    }
}

// images
$paragraph_margin_bottom = get_theme_mod('SCSSvar_paragraph-margin-bottom');
if ( $paragraph_margin_bottom ) {
    echo '.img.element {';
        echo 'margin-bottom: ' . $paragraph_margin_bottom;
    echo '}';
}

// colors array
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

// custom button colors
foreach ( $colors as $color ) {

    $field = $color;

    $color = get_field($color, 'buttons');
    if ( isset( $color ) ) {

        $enabled = false;
        if ( isset( $color['background_color'] ) ) {
            if ( $color['background_color'] ) {
                $enabled = true;
            }
        }
        if ( isset( $color['text_color'] ) ) {
            if ( $color['text_color'] ) {
                $enabled = true;
            }
        }
        if ( isset( $color['border_color'] ) ) {
            if ( $color['border_color'] ) {
                $enabled = true;
            }
        }

        if ( $enabled ) {
            echo '.btn-'. $field .' {';

                if ( isset( $color['background_color'] ) ) {
                    if ( $color['background_color'] ) {
                        echo 'background-color: '. $color['background_color'].';';
                    }
                }
                if ( isset( $color['text_color'] ) ) {
                    if ( $color['text_color'] ) {
                        echo 'color: '. $color['text_color'].';';
                    }
                }
                if ( isset( $color['border_color'] ) ) {
                    if ( $color['border_color'] ) {
                        echo 'border-color: '. $color['border_color'].';';
                    }
                }

            echo '}';

            // text hover
            if ( isset( $color['text_color'] ) ) {
                if ( $color['text_color'] ) {
                    echo '.btn-'. $field .':hover {';

                        echo 'color: '. $color['text_color'].';';

                    echo '}';
                }
            }
        }            
    }
}

// section dividers
$section_dividers = [];
$section_dividers = get_field('section_dividers', 'dividers');
if ( $section_dividers ) {
    foreach ( $section_dividers as $divider ) {

        $shape = $divider['shape'];
        $class = $divider['shape_class'];
        $width = $divider['width'];
        $height = $divider['height'];

        $tablet_height = $height / 2;
        $mobile_height = $height / 3;

        ?>
        <?='.'?><?=$class?> .divider-inner {
            mask: url('<?=$shape?>') no-repeat;
            -webkit-mask: url('<?=$shape?>') no-repeat;
            mask-size: <?=$width?>% <?=$height?>%;
            -webkit-mask-size: <?=$width?>% <?=$height?>px;
            width: <?=$width?>%;
            height: <?=$height?>px;
        }
        <?='.'?><?=$class?>-container-negative-margin-top {
            margin-top: -<?=$height?>px;
        }
        <?='.'?><?=$class?>-container-negative-margin-top .row {
            margin-top: <?=$height?>px;
        }
        <?='.'?><?=$class?>-container-negative-margin-bottom {
            margin-bottom: -<?=$height?>px;
        }
        <?='.'?><?=$class?>-container-negative-margin-bottom .row {
            margin-bottom: <?=$height?>px;
        }
        @media screen and (max-width: 991px) {
            <?='.'?><?=$class?> .divider-inner {
                mask-size: <?=$width?>% <?=$tablet_height?>% !important;
                -webkit-mask-size: <?=$width?>% <?=$tablet_height?>px !important;
                height: <?=$tablet_height?>px !important;
            }
            <?='.'?><?=$class?>-container-negative-margin-top {
                margin-top: -<?=$tablet_height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-top .row {
                margin-top: <?=$tablet_height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-bottom {
                margin-bottom: -<?=$tablet_height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-bottom .row {
                margin-bottom: <?=$tablet_height?>px;
            }
        }
        @media screen and (max-width: 768px) {
            <?='.'?><?=$class?> .divider-inner {
                mask-size: <?=$width?>% <?=$mobile_height?>% !important;
                -webkit-mask-size: <?=$width?>% <?=$mobile_height?>px !important;
                height: <?=$mobile_height?>px !important;
            }
            <?='.'?><?=$class?>-container-negative-margin-top {
                margin-top: -<?=$mobile_height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-top .row {
                margin-top: <?=$mobile_height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-bottom {
                margin-bottom: -<?=$mobile_height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-bottom .row {
                margin-bottom: <?=$mobile_height?>px;
            }
        }
        <?php
    }
}
?>
</style>