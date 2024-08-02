<?php

function if_array_value($field = false, $key = false, $prefix = false, $suffix = false) {
    if ( $field && $key ) {
        if ( isset ( $field[$key] ) ) {
            if ( $field[$key] ) {
                return $field[$key];
            }
        }
    }
}