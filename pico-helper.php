<?php
/**
 * BBC Custom Snippets
 *
 * @package       BBC
 * @author        Brain Bytes Creative
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Pico Helper
 * Plugin URI:    https://www.brainbytescreative.com/
 * Description:   Helper plugin for Pico starter theme
 * Version:       1.0.0
 * Author:        Brain Bytes Creative
 * Author URI:    https://www.brainbytescreative.com/
 * Text Domain:   bbc-landing-pages
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the logic required to run the plugin.
 * To add some functionality, you can simply define the WordPres hooks as followed: 
 * 
 * add_action( 'init', 'some_callback_function', 10 );
 * 
 * and call the callback function like this 
 * 
 * function some_callback_function(){}
 * 
 * HELPER COMMENT END
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*** acf load functions ***/

/** Start: Detect ACF Pro plugin. Include if not present. */
if ( !class_exists('acf') ) { // if ACF Pro plugin does not currently exist

    /** Start: Customize ACF path */
    add_filter('includes/acf/settings/path', 'cysp_acf_settings_path');
    function cysp_acf_settings_path( $path ) {
        $path = plugin_dir_path( __FILE__ ) . 'includes/acf/';
        return $path;
    }
    /** End: Customize ACF path */

    /** Start: Customize ACF dir */
    add_filter('includes/acf/settings/dir', 'cysp_acf_settings_dir');
    function cysp_acf_settings_dir( $path ) {
        $dir = plugin_dir_url( __FILE__ ) . 'includes/acf/';
        return $dir;
    }
    /** End: Customize ACF path */

    /** Start: Hide ACF field group menu item */
    add_filter('includes/acf/settings/show_admin', '__return_true');
    /** End: Hide ACF field group menu item */

    /** Start: Include ACF */
    include_once( plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' );
    /** End: Include ACF */

    /** Start: Create JSON save point */
    add_filter('includes/acf/settings/save_json', 'cysp_acf_json_save_point');
    function cysp_acf_json_save_point( $path ) {
        $path = plugin_dir_path( __FILE__ ) . 'acf-json/';
        return $path;
    }
    /** End: Create JSON save point */

    /** Start: Create JSON load point */
    add_filter('includes/acf/settings/load_json', 'cysp_acf_json_load_point');
    /** End: Create JSON load point */

    /** Start: Stop ACF upgrade notifications */
    add_filter( 'site_transient_update_plugins', 'cysp_stop_acf_update_notifications', 11 );
    function cysp_stop_acf_update_notifications( $value ) {
        unset( $value->response[ plugin_dir_path( __FILE__ ) . 'includes/acf/acf.php' ] );
        return $value;
    }
    /** End: Stop ACF upgrade notifications */

} else { // else ACF Pro plugin does exist

    /** Start: Create JSON load point */
    add_filter('includes/acf/settings/load_json', 'cysp_acf_json_load_point');
    /** End: Create JSON load point */

} // end-if ACF Pro plugin does not currently exist

/** End: Detect ACF Pro plugin. Include if not present. */

/** Start: Function to create JSON load point */
function cysp_acf_json_load_point( $paths ) {
    $paths[] = plugin_dir_path( __FILE__ ) . 'acf-json';
    return $paths;
}
/** End: Function to create JSON load point */  

// load json
function my_acf_json_load_point( $paths ) {
    // Remove the original path (optional).
    unset($paths[0]);

    // Append the new path and return it.
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

$theme = wp_get_theme(); // gets the current theme
if ( 'picostrap5' === $theme->parent_theme ) {

    // add gutenberg styles
    add_action( 'after_setup_theme', 'pico_gutenberg_css' );
    function pico_gutenberg_css(){
        add_theme_support( 'editor-styles' );
        add_editor_style( get_stylesheet_directory_uri() . '/css-output/bundle.css' );
        add_editor_style( plugin_dir_url( __FILE__ ) . '/css/bbc-style.css' );
    }

    // enqueue custom stylesheet
    function bbc_stylesheet_css_js() {
        wp_enqueue_style( 'bbc_style', plugin_dir_url( __FILE__ ) . 'css/bbc-style.css', array(), null );
    }
    add_action( 'wp_enqueue_scripts', 'bbc_stylesheet_css_js' );

    // enqueue admin stylesheet
    add_action( 'admin_enqueue_scripts', 'load_admin_style' );
    function load_admin_style() {
        wp_enqueue_style( 'admin_style', plugin_dir_url( __FILE__ ) . 'css/bbc-admin-style.css', array(), null );
    }

    // add styles to pages with ACF included
    add_action('acf/input/admin_enqueue_scripts', 'load_bundle_admin');
    function load_bundle_admin() {
        wp_enqueue_style( 'bundle_style', get_stylesheet_directory_uri() . '/css-output/bundle.css', array(), null );
        wp_enqueue_style( 'bbc_style', plugin_dir_url( __FILE__ ) . 'css/bbc-style.css', array(), null );
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
    function add_code_to_body() {
        echo '<header>';
            include_once( __DIR__ . '/partials/header-navbar.php');
        echo '</header>';
    }
    add_action( 'wp_body_open', 'add_code_to_body' );

    // font awesome
    add_action('wp_head', 'add_font_awesome');
    function add_font_awesome(){ ?>
        <script src="https://kit.fontawesome.com/ec15ef7364.js" crossorigin="anonymous"></script>
    <?php };

    // add footer functions
    function footer_widget() {

        echo '<footer>';
            dynamic_sidebar( 'footerfull' );
        echo '</footer>';

        echo '<button type="button" class="btn-back-to-top d-none" id="btn-back-to-top"><i class="fas fa-chevron-up"></i></button>';

    }
    add_action( 'wp_footer', 'footer_widget' );

    function initialize_functions(){

        // dynamic stylesheet
        include_once( __DIR__ . '/css/root.php');
        //include_once( __DIR__ . '/css/dynamic.php');

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

    function generate_options_css() {
        $ss_dir = __DIR__;
        ob_start(); // Capture all output into buffer
        require($ss_dir . '/css/dynamic.php'); // Grab the custom-style.php file
        $css = ob_get_clean(); // Store output in a variable, then flush the buffer
        file_put_contents($ss_dir . '/css/custom-styles.css', $css, LOCK_EX); // Save it as a css file
    }
    add_action( 'acf/save_post', 'generate_options_css', 20 ); //Parse the output and write the CSS file on post save (thanks Esmail Ebrahimi)
    wp_enqueue_style( 'custom-styles', plugin_dir_url( __FILE__ ) . 'css/custom-styles.css' );

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

}