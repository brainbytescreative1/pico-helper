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

        // icons
        $add_icon = get_field('add_icon', $item);
        
        if ( $add_icon ) {
           
            $bootstrap_icon = null;
            $fa_icon = null;
            $image_icon = null;

            $styles = get_field('icon_styles', $item);
            if ( $styles ) {

                $icon_classes = [];
                $icon_styles = [];

                $svg_color = '';
                $svg_width = '';
                $svg_height = '';
                
                $wrapper_classes[] = 'menu-icon';
                $wrapper_classes[] = $add_icon . '-icon';

                $wrapper_classes[] = 'd-flex';
                $wrapper_classes[] = 'align-items-center';
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
                
                $icon_classes = implode(' ', $icon_classes);
                $icon_styles = implode(' ', $icon_styles);
                
            }

            $icon = $icon_classes;
            
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