<?php

// add blocks categories
add_filter( 'block_categories_all' , function( $categories ) {

    // Adding a new category.
	$categories[] = array(
		'slug'  => 'bbc',
		'title' => 'BBC Custom Blocks'
	);

	return $categories;
} );

// block variations - not in use yet, but keeping as reference
/*
function wpfieldwork_editor_assets() {
    wp_enqueue_script(
        'wpfieldwork-block-variations',
        get_template_directory_uri() . '/js/block-variations.js',
        array( 'wp-blocks' )
    );
}
add_action( 'enqueue_block_editor_assets', 'wpfieldwork_editor_assets' );
*/

// add styles to block editor
function mytheme_enqueue_block_editor_assets() {
	wp_enqueue_script( 'block-filters', get_stylesheet_directory_uri() . '/js/block-filters.js', array( 'wp-hooks' ), '1.0.0', true );
}
//add_action( 'enqueue_block_editor_assets', 'mytheme_enqueue_block_editor_assets' );

// add data id to all containers
add_action( 'admin_head', 'add_data_id' );
function add_data_id(){
	
	$screen = get_current_screen();

	if ( ( $screen->base === 'post' ) ) {

		global $post;
		$post_id = $post->ID;
		
		if ( $post_id !== 651 ) { ?>

		<script>		
			(function($){
			if (typeof acf != 'undefined') {
			  acf.add_action('ready append', function($el) {
				// array to hold list of existing ID values
				var layout_ids = [];
				// selector targets id field butnot hidden clones of layouts
				var fields = $('[data-key="field_6483628aaa955"] .acf-input input').not('.clones [data-key="field_6483628aaa955"] .acf-input input');
				if (fields.length) {
				  for (i=0; i<fields.length; i++) {
					var field = $(fields[i]);
					var value = field.val();
					if (value == '' || layout_ids.indexOf(value) != -1) {
					  value = 'element-'+acf.uniqid();
					  field.val(value);
					  field.trigger('change');
					}
					layout_ids.push(value);
				  }
				}
				
			  });
			}
			})(jQuery);
		</script>

		<?php }
	}
}