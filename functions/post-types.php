<?php

// change blog URL prefix
function add_rewrite_rules( $wp_rewrite )
{
    $new_rules = array(
        'blog/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules'); 

function change_blog_links($post_link, $id=0){

    $post = get_post($id);

    if( is_object($post) && $post->post_type == 'post'){
        return home_url('/blog/'. $post->post_name.'/');
    }

    return $post_link;
}
add_filter('post_link', 'change_blog_links', 1, 3);

// change blog excerpt length
function my_excerpt_length($length){ 
    return 30; 
} 
add_filter('excerpt_length', 'my_excerpt_length');

function all_excerpts_get_more_link( $post_excerpt ) {

    return $post_excerpt . '<a class="btn btn-secondary understrap-read-more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'understrap' ) . '</a>';
}
//add_filter( 'wp_trim_excerpt', 'all_excerpts_get_more_link' );