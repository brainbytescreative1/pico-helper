<?php

function global_site_variables(){
    ?>
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

        echo '}'; // root end

        // header options

        // logo width
        $logo_width = get_field('logo_width', 'header');
        if ( $logo_width ) { ?>
            .custom-logo-link {
                max-width: <?=$logo_width?>px;
            }
        <?php }

        // padding
        $main_menu_padding = get_field('main_menu_padding', 'header');
        if ( $main_menu_padding !== 'default' ) {
            if ( $main_menu_padding === 'custom' ) {
                $main_menu_padding_custom = get_field('main_menu_padding_custom', 'header');
                if ( $main_menu_padding_custom ) {
                    $main_menu_padding = $main_menu_padding_custom . 'rem';
                }
            }
        }
        if ( $main_menu_padding ) { ?>
            nav.navbar { 
                padding-top: <?=$main_menu_padding?>;
                padding-bottom: <?=$main_menu_padding?>;
            }
        <?php }

        // sticky logo
        $sticky_logo = get_field('sticky_logo', 'header');
        if ( $sticky_logo ) { ?>
            #navbar-main .navbar-brand.sticky-logo {
                display: none;
            }
            #navbar-sticky .navbar-brand.custom-logo-link {
                display: none;
            }
            <?php
            $sticky_logo_width = get_field('sticky_logo_width', 'header');
            if ( $sticky_logo_width ) {
                echo '.sticky-logo {';
                    echo 'max-width: ' . $sticky_logo_width . 'px';
                echo '}';
            } else {
                echo 'max-width: ' . $logo_width . 'px';
            }
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
                                echo 'background-color: '. $color['background_color'].' !important;';
                            }
                        }
                        if ( isset( $color['text_color'] ) ) {
                            if ( $color['text_color'] ) {
                                echo 'color: '. $color['text_color'].' !important;';
                            }
                        }
                        if ( isset( $color['border_color'] ) ) {
                            if ( $color['border_color'] ) {
                                echo 'border-color: '. $color['border_color'].' !important;';
                            }
                        }

                    echo '}';

                    // text hover
                    if ( isset( $color['text_color'] ) ) {
                        if ( $color['text_color'] ) {
                            echo '.btn-'. $field .':hover {';

                                echo 'color: '. $color['text_color'].' !important;';

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
    <?php
}
//add_action('wp_head', 'global_site_variables');
//add_action('admin_head', 'global_site_variables');

function bbc_stylesheet_css_variables() {
    ob_start();

    $styles = ob_get_clean();
    wp_add_inline_style('bbc_style', $styles);
}
//add_action( 'wp_enqueue_scripts', 'bbc_stylesheet_css_variables' );

// get social icons
function get_social_icons_bbc( $social_icons ) {

    if ( $social_icons ) {

        // start content
        ob_start();

        $icon_list = $social_icons['icon_list'];

        echo '<ul class="social-icons-menu">'; // start social icons

        if ( $icon_list ) {
            
            foreach( $icon_list as $icon ) {

                // initialize classes arrays
                $icon_classes = [];
                $icon_styles = [];
                $text_classes = [];

                // get icon fields
                $link = $icon['link'];
                $separator = $icon['separator'];
                $text_content = $icon['text_content'];

                // add classes
                $icon_classes[] = 'icon';
                $icon_classes[] = 'lead';

                /*
                if ( $separator !== 'none' ) {
                    $icon_styles[] = 'border-' . $separator . ': 1px solid ' . $icon_color['theme_colors'];
                }
                */

                // process arrays
                $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );

                if ( $link ) {

                    $list_item_classes = [];

                    $value = $link['value'];
                    $title = $link['title'];
                    $target = $link['target'];

                    $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );

                    ?>
                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <a href="<?=$value?>" title="<?=$title?>" target="<?=$target?>">
                            <span class="<?=$icon_classes?>">
                                <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                    <?php
                } elseif ( $text_content ) { ?>

                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <span class="<?=$icon_classes?>">
                            <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                        </span>
                    </li>
                    
                <?php } else { ?>

                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <span class="<?=$icon_classes?>">
                            <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                        </span>
                    </li>

                <?php }

            }

        }

        echo '</ul>'; // end social icons

        // return content
        return ob_get_clean();

    }
}

// populate menu options
function my_acf_load_field( $field ) {

    $menus = [];
    
    $menus_list = wp_get_nav_menus();
    foreach ($menus_list as $menu) {
        $term_id = $menu->term_id;
        $name = $menu->name;
        $menus[] = [ $term_id, $name ];
    }

    $choices = [];

    // if enabled and exist
    foreach ($menus as $menu) {
        $choices += array( $menu[0] => __(ucfirst($menu[1]), 'bbc') );
    } 
	
	$field['choices'] = $choices;
	$field['default_value'] = null;
	return $field;

}
add_filter('acf/load_field/name=single_menu_select', 'my_acf_load_field');
add_filter('acf/load_field/name=left_menu_select', 'my_acf_load_field');
add_filter('acf/load_field/name=right_menu_select', 'my_acf_load_field');

// get custom menu
function get_menu_bbc( $menu_id ) {
    if ( $menu_id ) {
        ob_start();
        wp_nav_menu( array(
            'menu' => $menu_id,
            'container' => 'div',
            'container_class' => 'acf-nav-menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ) );
        return ob_get_clean();
    } else {
        return '';
    }
}