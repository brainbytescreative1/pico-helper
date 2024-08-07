<?php

function get_responsive_image_bbc($image_id, $image_size, $max_width, $alt = false, $classes = false, $styles = false ){

	// check the image ID is not blank
	if($image_id !== '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// generate the markup for the responsive image
		return '<img fetchpriority="lazy" decoding="async" class="'. $classes .'" style="'. $styles .'" alt="'. $alt .'" src="'. $image_src .'" srcset="'. $image_srcset. '" sizes="(max-width: '. $max_width .') 100vw, '. $max_width .'" />';

	}

}

function upload_svg_files( $allowed ) {
    if ( !current_user_can( 'manage_options' ) )
        return $allowed;
    $allowed['svg'] = 'image/svg+xml';
    return $allowed;
}
add_filter( 'upload_mimes', 'upload_svg_files');