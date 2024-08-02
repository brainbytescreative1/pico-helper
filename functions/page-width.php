<?php

function get_page_width_bbc( $field, $container, $post_id = false, $sub = false )  {

    if ( $field ) {

        $content_width = null;
        $container_class = null;

        if ( $post_id ) {
            $post_id = $post_id;
        } else {
            $post_id = false;
        }

        if ( $sub === true ) {
            $content_width = get_sub_field($field, $post_id);
        } else {
            $content_width = get_field($field, $post_id);
        }

        if ( $content_width ) {
            $container_class = $content_width;
            return $container_class;
        } else {
            return $container;
        }

    }

}