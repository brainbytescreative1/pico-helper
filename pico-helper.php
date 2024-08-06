<?php
/**
 * BBC Custom Snippets
 *
 * @package       BBC
 * @author        Brain Bytes Creative
 * @version       1.0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Pico Helper
 * Plugin URI:    https://www.brainbytescreative.com/
 * Description:   Helper plugin for Pico starter theme
 * Version:       1.0.1
 * Author:        Brain Bytes Creative
 * Author URI:    https://www.brainbytescreative.com/
 * Text Domain:   bbc-landing-pages
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/*** acf load functions ***/

if ( !class_exists('acf') ) { // if ACF Pro plugin does not currently exist

    add_filter('includes/acf/settings/path', 'pico_acf_settings_path');
    function pico_acf_settings_path( $path ) {
        $path = plugin_dir_path( __FILE__ ) . 'includes/acf/';
        return $path;
    }

    add_filter('includes/acf/settings/dir', 'pico_acf_settings_dir');
    function pico_acf_settings_dir( $path ) {
        $dir = plugin_dir_url( __FILE__ ) . 'includes/acf/';
        return $dir;
    }

    add_filter('includes/acf/settings/show_admin', '__return_true');

    include_once( plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' );

    add_filter('includes/acf/settings/save_json', 'pico_acf_json_save_point');
    function pico_acf_json_save_point( $path ) {
        $path = plugin_dir_path( __FILE__ ) . 'acf-json/';
        return $path;
    }

    add_filter('includes/acf/settings/load_json', 'pico_acf_json_load_point');

    add_filter( 'site_transient_update_plugins', 'pico_stop_acf_update_notifications', 11 );
    function pico_stop_acf_update_notifications( $value ) {
        unset( $value->response[ plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' ] );
        return $value;
    }

} else {

    add_filter('includes/acf/settings/load_json', 'pico_acf_json_load_point');

}

// load json
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = plugin_dir_path( __FILE__ ) . '/acf-json';
    return $paths;    
}
add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );

// save json
function my_acf_json_save_point( $path ) {
    return plugin_dir_path( __FILE__ ) . 'acf-json';
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

/*** theme functions ***/

$theme = wp_get_theme(); 
if ( ( 'picostrap5' === $theme->parent_theme ) && class_exists('acf') ) {

    // add gutenberg styles
    add_action( 'after_setup_theme', 'pico_gutenberg_css' );
    function pico_gutenberg_css(){
        add_theme_support( 'editor-styles' );
        add_editor_style( '/css-output/bundle.css' );
    }

    // enqueue custom stylesheet
    add_action( 'wp_enqueue_scripts', 'bbc_stylesheet_css_js' , 100 );
    function bbc_stylesheet_css_js() {
        wp_enqueue_style( 'bbc_style', plugin_dir_url( __FILE__ ) . 'css/bbc-style.css', array(), null );
        wp_enqueue_style( 'dynamic_styles', plugin_dir_url( __FILE__ ) . 'css/dynamic-style.css' );
    }

    // enqueue admin stylesheet
    add_action( 'admin_enqueue_scripts', 'load_admin_style' );
    function load_admin_style() {
        wp_enqueue_style( 'admin_style', plugin_dir_url( __FILE__ ) . 'css/bbc-admin-style.css', array(), null );
        wp_enqueue_style( 'bbc_style', plugin_dir_url( __FILE__ ) . 'css/bbc-style.css', array(), null );
        wp_enqueue_style( 'dynamic_styles', plugin_dir_url( __FILE__ ) . 'css/dynamic-style.css', array(), null );
    }

    // register blocks
    add_action( 'init', 'register_acf_blocks' );
    function register_acf_blocks() {
        register_block_type( __DIR__ . '/template-parts/blocks/section' );
    }

    // hide default footer
    add_filter('picostrap_enable_footer_elements', '__return_false');

    // hide default header
    add_filter('picostrap_enable_header_elements', '__return_false');

    // add header from plugin
    function add_code_to_body() {
        echo '<header>';
            include_once( __DIR__ . '/partials/header-navbar.php');
        echo '</header>';
    }
    add_action( 'wp_body_open', 'add_code_to_body' );

    // font awesome
    //add_action('wp_head', 'add_font_awesome');
    function add_font_awesome(){ ?>
        <script src="https://kit.fontawesome.com/ec15ef7364.js" crossorigin="anonymous"></script>
    <?php };

    // add footer functions
    function footer_widget() {

        echo '<footer>';
            dynamic_sidebar( 'footerfull' );
        echo '</footer>';

        echo '<button type="button" class="btn-back-to-top d-none" id="btn-back-to-top"><i class="bi bi-chevron-up"></i></button>';

    }
    add_action( 'wp_footer', 'footer_widget' );

    function generate_options_css() {
        $ss_dir = __DIR__;
        ob_start(); // Capture all output into buffer
        require($ss_dir . '/css/dynamic.php'); // Grab the custom-style.php file
        $css = ob_get_clean(); // Store output in a variable, then flush the buffer
        file_put_contents($ss_dir . '/css/dynamic-style.css', $css, LOCK_EX); // Save it as a css file
    }
    add_action( 'acf/save_post', 'generate_options_css', 20 ); //Parse the output and write the CSS file on post save

    // modify the path to the icons directory
    add_filter('acf_icon_path_suffix', 'acf_icon_path_suffix');
    function acf_icon_path_suffix($path_suffix) {
        return '/vendor/twbs/bootstrap-icons/icons/';
    }

    // modify the path to the above prefix
    add_filter('acf_icon_path', 'acf_icon_path');
    function acf_icon_path($path_suffix) {
        return plugin_dir_path(__FILE__);
    }

    // modify the URL to the icons directory to display on the page
    add_filter('acf_icon_url', 'acf_icon_url');
    function acf_icon_url($path_suffix) {
        return plugin_dir_url( __FILE__ );
    }

    // override page templates
    function override_page_templates( $template ) {
        if ( is_page() ) {
            $template = plugin_dir_path(__FILE__) . 'page-templates/page.php';
        }
        elseif ( is_single() ) {
            $template = plugin_dir_path(__FILE__) . 'page-templates/single.php';
        }
        return $template;
    }
    add_filter( 'template_include', 'override_page_templates' );

    // mce fix
    function slug_editor_body_margin_fix( $settings ) {
        if ( isset( $settings['content_style'] ) ) {
            $settings['content_style'] .= ' body#tinymce { margin: 9px 10px; }';
        } else {
            $settings['content_style'] = 'body#tinymce { margin: 9px 10px; }';
        }
        return $settings;
    }
    add_filter( 'tiny_mce_before_init', 'slug_editor_body_margin_fix' );

    // prevent deferring custom functions
    add_filter( 'rocket_defer_inline_exclusions', function( $inline_exclusions_list ) {
        if ( ! is_array( $inline_exclusions_list ) ) {
            $inline_exclusions_list = array();
        }
    
        // Duplicate this line if you need to exclude more
        $inline_exclusions_list[] = 'essential-scripts';
        $inline_exclusions_list[] = 'firstElementSpacing';
        $inline_exclusions_list[] = 'headerHeight';
        $inline_exclusions_list[] = 'stickyNav';
        $inline_exclusions_list[] = 'backToTopButton';
    
        return $inline_exclusions_list;
    } );

    function initialize_functions(){

        // dynamic stylesheet
        include_once( __DIR__ . '/css/root.php');

        // include separate functions files
        include_once( __DIR__ . '/functions/blocks.php');
        include_once( __DIR__ . '/functions/menus.php');
        include_once( __DIR__ . '/functions/options-pages.php');
        include_once( __DIR__ . '/functions/post-types.php');
        include_once( __DIR__ . '/functions/shortcodes.php');

        // global functions
        include_once( __DIR__ . '/functions/advanced.php');
        include_once( __DIR__ . '/functions/background.php');
        include_once( __DIR__ . '/functions/borders.php');
        include_once( __DIR__ . '/functions/buttons.php');
        include_once( __DIR__ . '/functions/colors.php');
        include_once( __DIR__ . '/functions/dividers.php');
        include_once( __DIR__ . '/functions/flex.php');
        include_once( __DIR__ . '/functions/heading.php');
        include_once( __DIR__ . '/functions/images.php');
        include_once( __DIR__ . '/functions/js.php');
        include_once( __DIR__ . '/functions/page-width.php');
        include_once( __DIR__ . '/functions/responsive.php');
        include_once( __DIR__ . '/functions/spacing.php');
        include_once( __DIR__ . '/functions/text-styles.php');
        include_once( __DIR__ . '/functions/misc.php');

        if ( class_exists( 'GFCommon' ) ) {
            include_once( __DIR__ . '/functions/forms.php');
        }

    }
    add_action( 'init', 'initialize_functions', 10 );

}