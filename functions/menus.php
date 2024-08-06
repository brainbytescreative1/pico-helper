<?php

// register custom menus
function wpb_custom_new_menu() {
    register_nav_menus(
        array(
            'top-menu' => __( 'Top Menu' ),
        )
    );
}
add_action( 'init', 'wpb_custom_new_menu' );

// register custom widgets
add_action( 'widgets_init', 'custom_widgets_init' );
if ( ! function_exists( 'custom_widgets_init' ) ) {

    register_sidebar(
        array(
            'name'          => __( 'Global Reviews', 'bbc' ),
            'id'            => 'reviews',
            'description'   => __( 'Global reviews widget', 'bbc' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => __( 'Top Menu', 'bbc' ),
            'id'            => 'topmenu',
            'description'   => __( 'Top menu', 'bbc' ),
            'before_widget' => '<div id="%1$s" class="top-menu-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .top-menu-widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

}

// menu icons
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
    
    // loop
    foreach( $items as $item ) {
		
        $post_title = $item->title;

        $wrapper_classes = [];

        $icon = null;

        $icon_classes = [];
        $icon_styles = [];

        // icons
        $add_icon = get_field('add_icon', $item);
        
        if ( $add_icon ) {
           
            $bootstrap_icon = null;
            $fa_icon = null;
            $image_icon = null;

            $wrapper_classes[] = 'menu-icon';
            $wrapper_classes[] = $add_icon . '-icon';

            $wrapper_classes[] = 'd-flex';
            $wrapper_classes[] = 'align-items-center';

            $styles = get_field('icon_styles', $item);
            if ( $styles ) {

                $svg_color = '';
                $svg_width = '';
                $svg_height = '';
                
                $position = if_array_value($styles, 'position');
                if ( $position === 'right' ) {
                    $wrapper_classes[] = 'flex-row-reverse';
                    $wrapper_classes[] = 'hide-dropdown-arrows';
                }

                // color
                if ( $styles['custom_color'] ) {
                    $icon_styles[] = 'color: ' . $styles['custom_color'] . ';';
                    $svg_color = $styles['custom_color'];
                } elseif ( $styles['theme_colors'] ) {
                    $icon_classes[] = 'text-' . $styles['theme_colors'];
                    $svg_color = 'var(--bs-' . $styles['theme_colors'] . ')';
                }

                // font size
                if ( $styles['font_size']['value'] ) {
                    $icon_styles[] = 'font-size: ' . $styles['font_size']['value'] . $styles['font_size']['unit'] . ';';
                }

                // width
                if ( if_array_value($styles, 'width') && ( ( $add_icon === 'image' ) || ( $add_icon === 'svg' ) ) ) {
                    if ( $styles['width']['value'] ) {
                        $icon_styles[] = 'width: ' . $styles['width']['value'] . $styles['width']['unit'] . ';';
                        $svg_width = ceil($styles['width']['value']);
                    }
                }

                // height
                if ( if_array_value($styles, 'height') && ( ( $add_icon === 'image' ) || ( $add_icon === 'svg' ) ) ) {
                    if ( $styles['height']['value'] ) {
                        $icon_styles[] = 'height: ' . $styles['height']['value'] . $styles['height']['unit'] . ';';
                        $svg_height = ceil($styles['height']['value']);
                    }
                }

                if ( $styles['icon_classes'] ) {
                    $icon_classes[] = $styles['icon_classes'];
                }
                
            }

            $icon_classes = implode(' ', $icon_classes);
            $icon_styles = implode(' ', $icon_styles);

            if ( $icon_classes ) {
                $icon = $icon_classes;
            }
            
            $bootstrap_icon = get_field('bootstrap_icon', $item);
            $font_awesome_icon = get_field('font_awesome_icon', $item);
            $image_icon = get_field('image_icon', $item);
            $svg_icon = get_field('svg_icon', $item);

            if ( $bootstrap_icon && ( $add_icon === 'bootstrap' ) ) {
                $icon = $bootstrap_icon . ' ' . $icon;
                $icon = '<i class="bi bi-'. $icon .'" style="'. $icon_styles .'"></i>';
            } elseif ( $font_awesome_icon && ( $add_icon === 'fa' )  ) {
                $icon = $font_awesome_icon . ' ' . $icon;
                $icon = '<i class="'. $icon .'" aria-hidden="true" style="'. $icon_styles .'"></i>';
            } elseif ( $image_icon && ( $add_icon === 'image' )  ) {
                if ( $image_icon['url'] ) {
                    $icon = '<img class="'. $icon_classes .'" style="'. $icon_styles .'" src="'. $image_icon['url'] .'" alt="'. $post_title .'" />';
                }
            } elseif ( $svg_icon && ( $add_icon === 'svg' ) ) {
                $svg_icon = str_replace('<svg', '<svg style="'. $icon_styles .' fill: '. $svg_color .'" viewBox="0 0 '. $svg_width .' '. $svg_height .'"', $svg_icon);
                $icon = '<div class="'. $icon_classes .'">' . $svg_icon . '</div>';
            }

            $item->title = '<div class="menu-icon-wrapper">' . $icon . '</div><div class="menu-item-title">' . $post_title . '</div>';

        }

        // add menu link classes
        $menu_link_classes = get_field('menu_link_classes', $item);
        if ( $menu_link_classes ) {
            $wrapper_classes[] = $menu_link_classes;
        }
        
        // compile
        $wrapper_classes = implode(' ', $wrapper_classes);
        if ( $wrapper_classes ) {
            $item->title = '<div class="'. $wrapper_classes .'">' . $item->title . '</div>';
        }
        
    }
    
    // return
    return $items;
    
}

// add content neg margin
function content_negative_margin($classes) {
    $content_negative_margin = get_field('content_negative_margin', 'header');
    if ( $content_negative_margin === 'enabled' ) {
        $classes[] = 'body-negative-margin';
    }
    return $classes;
}
add_filter('body_class', 'content_negative_margin');

function navbar_inner( $menu = false, $menu_background = false ) {

    if ( !$menu ) {
        $menu = 'navbarNavOffcanvas';
    }

    if ( !$menu_background ) {
        $menu_background = 'bg-white';
    }

    ob_start();

    $container_classes = [];

    $header_width = get_field('header_width', 'header');
    if ( $header_width ) {
        $container_classes[] = $header_width;
    } else {
        $container_classes[] = 'container';
    }

    $header_style = get_field('header_style', 'header');
    if ( $header_style ) {
        $container_classes[] = 'header-' . get_field('header_style', 'header');
    }

    $cta_buttons = get_field('cta_buttons', 'header');

    if ( get_field('show_dropdown_indicators', 'header') === 'hide' ) {
        $container_classes[] = 'hide-dropdown-arrows';
    }

    if ( $container_classes ) {
        $container_classes = trim(implode(' ', $container_classes));
    }

    ?>

    <div class="<?=$container_classes?>">
        <div id="logo-tagline-wrap">
            <!-- Your site title as branding in the menu -->
            <?php if (!has_custom_logo()) { ?>

                <?php if (is_front_page() && is_home()): ?>

                    <div class="navbar-brand mb-0 h3"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>"
                            title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url">
                            <?php bloginfo('name'); ?>
                        </a>
                    </div>

                <?php else: ?>

                    <a class="navbar-brand mb-0 h3" rel="home" href="<?php echo esc_url(home_url('/')); ?>"
                        title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url">
                        <?php bloginfo('name'); ?>
                    </a>

                <?php endif; ?>

            <?php } else {

                $home_url = get_home_url();
                $logo_size = get_field('logo_size', 'header');
                $image = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), $logo_size );
                ?>
                <a href="<?=esc_attr($home_url)?>" class="navbar-brand custom-logo-link" rel="home" aria-current="page">
                    <?=$image?>
                </a>

                <?php
                $sticky_logo = get_field('sticky_logo', 'header');
                if ( $sticky_logo ) {
                    $sticky_logo = wp_get_attachment_image( $sticky_logo, $logo_size );
                    ?>
                    <a href="<?=esc_attr($home_url)?>" class="navbar-brand sticky-logo" rel="home" aria-current="page">
                        <?=$sticky_logo?>
                    </a>
                    <?php
                }

            } ?><!-- end custom logo -->


            <?php if (!get_theme_mod('header_disable_tagline')): ?>
                <small id="top-description" class="text-muted d-none d-md-block mt-n2">
                    <?php bloginfo("description") ?>
                </small>
            <?php endif ?>


        </div> <!-- /logo-tagline-wrap -->

        <?php
        $navbar_expand = get_theme_mod('picostrap_header_navbar_expand');
        if ( ( $navbar_expand === 'navbar-expand-none' ) && ( $header_style === 'toggle' ) ) {
            if ( $cta_buttons ) { // cta buttons start
                echo '<div class="cta-buttons-container">';
                    if ( function_exists('get_buttons_bbc') ) {
                        echo get_buttons_bbc($cta_buttons);
                    }
                echo '</div>';
            } // cta buttons end
        }
        ?>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#<?=$menu?>"
            aria-controls="<?=$menu?>"
            aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="<?=$menu?>">

            <div class="offcanvas-header justify-content-end">
                <button
                    class="btn-close text-reset"
                    type="button"
                    data-bs-dismiss="offcanvas"
                    aria-label="<?php esc_attr_e( 'Close menu', 'bbc' ); ?>"
                ></button>
            </div><!-- .offcancas-header -->

            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                )
            );
            ?>

            <?php if (get_theme_mod('enable_search_form')): ?>
                <form action="<?php echo bloginfo('url') ?>" method="get" id="header-search-form" class="me-4">
                    <input class="form-control" type="text" placeholder="<?php _e("Search", 'picostrap5') ?>" aria-label="<?php _e("Search", 'picostrap5') ?>" name="s"
                        value="<?php the_search_query(); ?>">
                </form>
            <?php endif ?>

            <?php if (get_theme_mod('enable_dark_mode_switch')): ?>
                <div class="d-flex align-items-center gap-1 mt-4 mt-md-0 navbar-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-sun-fill me-1" viewBox="0 0 16 16">
                        <path
                            d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                    </svg>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="theme-toggle">
                        <label class="form-check-label visually-hidden" for="theme-toggle"> <?php _e("Toggle Dark / Light mode", 'picostrap5') ?>
                        </label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                        class="bi bi-moon-fill" viewBox="0 0 16 16">
                        <path
                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                    </svg>
                </div>
            <?php endif; ?>

            

        </div> <!-- .collapse -->

        <?php

        // cta buttons start
        if ( $cta_buttons && ( $header_style === 'centered' ) ) {
            echo '<div class="cta-buttons-container">';
                if ( function_exists('get_buttons_bbc') ) {
                    echo get_buttons_bbc($cta_buttons);
                }
            echo '</div>';
        } // cta buttons end
        ?>

    </div> <!-- .container -->

    <?php

    return ob_get_clean();

}

function navbar_inner_top() {
    ob_start();
    // top menu options
    $top_menu_select = get_field('top_menu_select', 'header');
    if ( get_field('top_menu_select', 'header') ) {

        $classes = [];
        $styles = [];

        $classes[] = 'top-menu';
        $classes[] = 'top-menu-' . $top_menu_select;
        
        // top menu background
        $top_menu_bg = if_array_value( get_field('top_menu_background', 'header'), 'theme_colors');
        if ( $top_menu_bg ) {
            $classes[] = 'bg-' . $top_menu_bg;
        }

        // top menu color
        $top_menu_color = if_array_value( get_field('top_menu_item_color', 'header'), 'theme_colors');
        if ( $top_menu_color ) {
            $classes[] = 'text-' . $top_menu_color;
        }

        // align
        $top_menu_align = get_field('top_menu_align', 'header');
        $top_menu_align_mobile = get_field('top_menu_align_mobile', 'header');

        if ( $top_menu_align ) {
            $top_menu_align = match ($top_menu_align) {
                'left' => 'text-lg-start',
                'center' => 'text-lg-center',
                'right' => 'text-lg-end',
            };
        } else {
            $top_menu_align = 'text-lg-end';
        }

        if ( $top_menu_align_mobile ) {
            $top_menu_align_mobile = match ($top_menu_align_mobile) {
                'left' => 'text-start',
                'center' => 'text-center',
                'right' => 'text-end',
            };
        } else {
            $top_menu_align_mobile = 'text-center';
        }

        // top menu padding
        $top_menu_padding = get_field('top_menu_padding', 'header');
        if ( $top_menu_padding !== 'default' ) {
            if ( $top_menu_padding === 'custom' ) {
                $top_menu_padding_custom = get_field('top_menu_padding_custom', 'header');
                if ( $top_menu_padding_custom ) {
                    $top_menu_padding = $top_menu_padding_custom . 'rem';
                }
            }
            if ( $top_menu_padding ) {
                $styles[] = 'padding-top: ' . $top_menu_padding . ';';
                $styles[] = 'padding-bottom: ' . $top_menu_padding . ';';
            }
        }

        $classes = trim( implode(' ', $classes) );
        $styles = trim( implode(' ', $styles) );

        echo '<div class="'. $classes .'" style="'. $styles .'">';
        if ( $top_menu_select === 'menu' ) {
            echo '<div class="'. get_field('header_width', 'header') .'">';
                echo '<div class="row">';
                    wp_nav_menu(
                        array(
                            'theme_location' => 'secondary',
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => '__return_false',
                            'items_wrap' => '<ul id="%1$s" class="navbar-top mb-0 '. $top_menu_align .' '. $top_menu_align_mobile .' %2$s">%3$s</ul>',
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        )
                    );
                echo '</div>';
            echo '</div>';
        } elseif ( $top_menu_select === 'widget' ) {
            dynamic_sidebar( 'topmenu' );
        }
        echo '</div>';

    }
    return ob_get_clean();
}