<!-- ******************* The Navbar Area ******************* -->
<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

    <a class="skip-link visually-hidden-focusable" href="#theme-main">
        <?php esc_html_e('Skip to content', 'picostrap5'); ?>
    </a>

    <?php
    // header options
    $navbar_bg = null;
    if ( function_exists('if_array_value') ) { 
        $options_bg = if_array_value( get_field('main_menu_background', 'header'), 'theme_colors');
    };
    if ( $options_bg ) {
        $navbar_bg = 'bg-' . $options_bg;
    } else {
        $navbar_bg = get_theme_mod('picostrap_header_navbar_color_choice', 'bg-white');
    }

    // top menu
    //require_once( __DIR__ . '../header-navbar-top.php');
    echo navbar_inner_top();
    
    ?>
    
    <nav data-bs-theme="<?php echo get_theme_mod('picostrap_header_navbar_color_scheme_attr', 'light') ?>"
        class="navbar <?php echo get_theme_mod('picostrap_header_navbar_expand', 'navbar-expand-lg'); ?> <?php echo $navbar_bg; ?>"
        aria-label="Main Navigation" id="navbar-main">
        
        <?php echo navbar_inner('navbarNavOffcanvas'); ?>

    </nav> <!-- .site-navigation -->

    <nav data-bs-theme="<?php echo get_theme_mod('picostrap_header_navbar_color_scheme_attr', 'light') ?>"
        class="navbar d-none <?php echo get_theme_mod('picostrap_header_navbar_expand', 'navbar-expand-lg'); ?> <?php echo $navbar_bg; ?>"
        aria-label="Sticky Navigation" id="navbar-sticky">

        <?php echo navbar_inner('navbarNavOffcanvasSticky'); ?>

    </nav> <!-- .site-navigation -->

</div><!-- #wrapper-navbar end -->