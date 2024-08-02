<?php

if( get_row_layout() == 'form' ):

    // get form id
    $form = get_sub_field('form');

    $form_id = 'form-' . $form;

    include_once( __DIR__ . '../../../functions/forms.php');

    // style options
    $color_scheme = 'light';
    if ( get_sub_field('color_scheme') !== 'default' ) {
        $color_scheme = get_sub_field('color_scheme');
    } elseif ( get_field('default_color_scheme', 'forms') ) {
        $color_scheme = get_field('default_color_scheme', 'forms');
    }

    // color scheme
    $color_scheme_select = get_field($color_scheme, 'forms');

    $input_text = '#000000';
    $input_background = '#ffffff';
    $input_border = 'transparent';
    $checkbox_text = '#000000';
    $checkbox_checkmark = '#ffffff';
    $checkbox_background = '#000000';
    if ( $color_scheme === 'dark' ) {
        $checkbox_text = '#ffffff';
        $checkbox_checkmark = 'var(--text)';
        $checkbox_background = '#ffffff';
    }
    $checkbox_text_link = '';
    $submit_button_text = '';
    $submit_background = '';
    $submit_background_hover = '';
    $confirmation_color = '#000000';
    if ( $color_scheme === 'dark' ) {
        $confirmation_color = '#ffffff';
    }
    $placeholder = 'var(--text)';
    $input_size = '1rem';
    $input_family = 'var(--font-primary)';
    $submit_size = '1rem';
    $submit_family = $input_family;
    $input_padding = '12px';
    $submit_padding = $input_padding;
    $error_text = '';
    $error_background = '';
    $input_spacing = '1rem';
    $border_width = '1px';
    $border_color = $input_text;
    $border_color_focus = $input_text;
    $input_radius = 'var(--button_border-radius)';
    $textarea_radius = 'var(--button_border-radius)';
    $submit_radius = 'var(--button_border-radius)';

    // input
    if ( if_array_value($color_scheme_select, 'input_text') ) {
        if ( $color_scheme_select['input_text']['custom_color'] ) {
            $input_text = $color_scheme_select['input_text']['custom_color'];
        } elseif ( $color_scheme_select['input_text']['theme_colors'] ) {
            $input_text = 'var(--' . $color_scheme_select['input_text']['theme_colors'] . ')';
        }
    }
    
    if ( if_array_value($color_scheme_select, 'input_background') ) {
        if ( $color_scheme_select['input_background']['custom_color'] ) {
            $input_background = $color_scheme_select['input_background']['custom_color'];
        } elseif ( $color_scheme_select['input_background']['theme_colors'] ) {
            $input_background = 'var(--' . $color_scheme_select['input_background']['theme_colors'] . ')';
        }
    }
    
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['input_border']['custom_color'] ) {
            $input_border = $color_scheme_select['input_border']['custom_color'];
        } elseif ( $color_scheme_select['input_border']['theme_colors'] ) {
            $input_border = 'var(--' . $color_scheme_select['input_border']['theme_colors'] . ')';
        }
    }

    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['input_border_focus']['custom_color'] ) {
            $border_color_focus = $color_scheme_select['input_border_focus']['custom_color'];
        } elseif ( $color_scheme_select['input_border_focus']['theme_colors'] ) {
            $border_color_focus = 'var(--' . $color_scheme_select['input_border_focus']['theme_colors'] . ')';
        }
    }
    
    // checkbox
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['checkbox_text']['custom_color'] ) {
            $checkbox_text = $color_scheme_select['checkbox_text']['custom_color'];
        } elseif ( $color_scheme_select['checkbox_text']['theme_colors'] ) {
            $checkbox_text = 'var(--' . $color_scheme_select['checkbox_text']['theme_colors'] . ')';
        }
    }

    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['checkbox_text_link']['custom_color'] ) {
            $checkbox_text_link = $color_scheme_select['checkbox_text_link']['custom_color'];
        } elseif ( $color_scheme_select['checkbox_text_link']['theme_colors'] ) {
            $checkbox_text_link = 'var(--' . $color_scheme_select['checkbox_text_link']['theme_colors'] . ')';
        }
    }

    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['checkbox_checkmark']['custom_color'] ) {
            $checkbox_checkmark = $color_scheme_select['checkbox_checkmark']['custom_color'];
        } elseif ( $color_scheme_select['checkbox_checkmark']['theme_colors'] ) {
            $checkbox_checkmark = 'var(--' . $color_scheme_select['checkbox_checkmark']['theme_colors'] . ')';
        }
    }

    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['checkbox_checked_background']['custom_color'] ) {
            $checkbox_background = $color_scheme_select['checkbox_checked_background']['custom_color'];
        } elseif ( $color_scheme_select['checkbox_checked_background']['theme_colors'] ) {
            $checkbox_background = 'var(--' . $color_scheme_select['checkbox_checked_background']['theme_colors'] . ')';
        }
    }

    // submit text
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['submit_button_text']['custom_color'] ) {
            $submit_button_text = $color_scheme_select['submit_button_text']['custom_color'];
        } elseif ( $color_scheme_select['submit_button_text']['theme_colors'] ) {
            $submit_button_text = 'var(--' . $color_scheme_select['submit_button_text']['theme_colors'] . ')';
        }
    }

    // submit background
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['submit_button_background']['custom_color'] ) {
            $submit_background = $color_scheme_select['submit_button_background']['custom_color'];
        } elseif ( $color_scheme_select['submit_button_background']['theme_colors'] ) {
            $submit_background = 'var(--' . $color_scheme_select['submit_button_background']['theme_colors'] . ')';
            $submit_background_hover = 'var(--' . $color_scheme_select['submit_button_background']['theme_colors'] . '_hover)';
        }
    }

    // error text
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['error_text']['custom_color'] ) {
            $error_text = $color_scheme_select['error_text']['custom_color'];
        } elseif ( $color_scheme_select['error_text']['theme_colors'] ) {
            $error_text = 'var(--' . $color_scheme_select['error_text']['theme_colors'] . ')';
        }
    }

    // error background
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['error_background']['custom_color'] ) {
            $error_background = $color_scheme_select['error_background']['custom_color'];
        } elseif ( $color_scheme_select['error_background']['theme_colors'] ) {
            $error_background = 'var(--' . $color_scheme_select['error_background']['theme_colors'] . ')';
        }
    }

    // placeholder background
    if ( if_array_value($color_scheme_select, 'input_border') ) {
        if ( $color_scheme_select['placeholder_text']['custom_color'] ) {
            $placeholder = $color_scheme_select['placeholder_text']['custom_color'];
        } elseif ( $color_scheme_select['placeholder_text']['theme_colors'] ) {
            $placeholder = 'var(--' . $color_scheme_select['placeholder_text']['theme_colors'] . ')';
        }
    }

    /* fonts */
    // default fonts
    if ( if_array_value($color_scheme_select, 'input_border') ) {
    $input_size_choice = get_field('input_font_size', 'forms');
        if ( $input_size_choice ) {
            if ( $input_size_choice['value'] ) {
                $input_size = $input_size_choice['value'] . $input_size_choice['unit'];
            }
        }
    }

    $input_family_choice = get_field('input_font_family', 'forms');
    if ( $input_family_choice && ( $input_family_choice !== 'default' ) ) {
        $input_family = 'var(--font-' . get_field('input_font_family', 'forms') . ')';
    }

    $submit_size_choice = get_field('submit_font_size', 'forms');
    if ( $submit_size_choice ) {
        if ( $submit_size_choice['value'] ) {
            $submit_size = $submit_size_choice['value'] . $submit_size_choice['unit'];
        }
    }
    
    $submit_family_choice = get_field('submit_family', 'forms');
    if ( $submit_family_choice && ( $submit_family_choice !== 'default' ) ) {
        $submit_family = 'var(--font-' . get_field('submit_button_font_family', 'forms') . ')';
    }

    // spacing
    $input_padding_choice = get_field('input_padding', 'forms');
    if ( $input_padding_choice ) {
        if ( $input_padding_choice['value'] ) {
            $input_padding = $input_padding_choice['value'] . $input_padding_choice['unit'];
        }
    }
    
    $submit_padding_choice = get_field('submit_padding', 'forms');
    if ( $submit_padding_choice ) {
        if ( $submit_padding_choice['value'] ) {
            $submit_padding = $submit_padding_choice['value'] . $submit_padding_choice['unit'];
        }
    }

    $input_spacing_choice = get_field('input_spacing', 'forms');
    if ( $input_spacing_choice ) {
        if ( $input_spacing_choice['value'] ) {
            $input_spacing = $input_spacing_choice['value'] . $input_spacing_choice['unit'];
        }
    }

    // borders
    $border_width_global = get_field('border_width', 'style');
    if ( get_field('border_width', 'forms') ) {
        $border_width = get_field('border_width', 'forms') . 'px';
    } elseif ( $border_width_global ) {
        $border_width = $border_width_global . 'px';
    }

    $border_color_choice = get_field('border_color', 'forms');
    if ( $border_color_choice ) {
        if ( $border_color_choice['custom_color'] ) {
            $border_color = $border_color_choice['custom_color'];
        } elseif ( $border_color_choice['theme_colors'] ) {
            $border_color = 'var(--' . $border_color_choice['theme_colors'] . ')';
        }
    }

    // radius
    $input_radius_choice = get_field('input_radius', 'forms');
    if ( $input_radius_choice ) {
        $input_radius = $input_radius_choice . 'rem';
    }

    // global button radius
    $button_border_radius = '0';
    $button_border_radius = get_field('button_border', 'style');
	if ( $button_border_radius === 'radius' ) {
		$textarea_radius = 'var(--button_border-radius)';
	} elseif ( $button_border_radius === 'round' ) {
		$textarea_radius = '1rem';
	}

    $textarea_radius_choice = get_field('textarea_radius', 'forms');
    if ( $textarea_radius_choice ) {
        $textarea_radius = $textarea_radius_choice . 'rem';
    }
    
    $submit_radius_choice = get_field('submit_radius', 'forms');
    if ( $submit_radius_choice ) {
        $submit_radius = $submit_radius_choice . 'rem';
    }

    // get global css
    $custom_css_global = get_field('custom_css', 'forms');

    ?>
    <style>
        /* inputs */
        .form.element#<?=$form_id?> input[type="text"],
        .form.element#<?=$form_id?> input[type="email"],
        .form.element#<?=$form_id?> input[type="url"],
        .form.element#<?=$form_id?> input[type="tel"],
        .form.element#<?=$form_id?> input[type="number"],
        .form.element#<?=$form_id?> textarea,
        .form.element#<?=$form_id?> select {
            color: <?=$input_text?> !important;
            background: <?=$input_background?> !important;
            font-size: <?=$input_size?> !important;
            line-height: <?=$input_size?> !important;
            font-family: <?=$input_family?> !important;
            padding: <?=$input_padding?> !important;
            border: <?=$border_width?> <?=$input_border?> solid !important;
            border-radius: <?=$input_radius?> !important;
            -webkit-background-clip: padding-box !important;
            -moz-background-clip:    padding !important;
            background-clip:         padding-box !important;
            border-style: solid !important;
        }
        .form.element#<?=$form_id?> input:focus,
        .form.element#<?=$form_id?> textarea:focus,
        .form.element#<?=$form_id?> select:focus,
        .form.element#<?=$form_id?> input:focus-visible,
        .form.element#<?=$form_id?> textarea:focus-visible,
        .form.element#<?=$form_id?> select:focus-visible,
        .form.element#<?=$form_id?> input:active,
        .form.element#<?=$form_id?> textarea:active,
        .form.element#<?=$form_id?> select:active {
            border-color: <?=$border_color_focus?> !important;
        }
        /* select */
        .form.element#<?=$form_id?> select {
            color: <?=$input_text?> !important;
            background: <?=$input_background?> !important;
            font-size: <?=$input_size?> !important;
            line-height: <?=$input_size?> !important;
            font-family: <?=$input_family?> !important;
            color: <?=$placeholder?> !important;
            border-radius: <?=$input_radius?> !important;
        }
        /* checkbox */
        .form.element#<?=$form_id?> .gfield_checkbox .gform-field-label {
            font-size: <?=$input_size?> !important;
            font-family: <?=$input_family?> !important;
            color: <?=$checkbox_text?> !important;
        }
        .form.element#<?=$form_id?> .gfield_checkbox .gform-field-label a {
            color: <?=$checkbox_text_link?> !important;
        }
        .form.element#<?=$form_id?> input[type="checkbox"] {
            font-size: <?=$input_size?> !important;
            line-height: <?=$input_size?> !important;
            width: <?=$input_size?> !important;
            height: <?=$input_size?> !important;
        }
        .form.element#<?=$form_id?> input[type="checkbox"]::before {
            color: <?=$checkbox_checkmark?> !important;
        }
        .form.element#<?=$form_id?> input[type=checkbox]:not(:checked) + label:after {
            border: 2px solid <?=$border_color?>;
        }
        .form.element#<?=$form_id?> input[type=checkbox]:checked + label:after {
            border: 2px solid <?=$checkbox_background?>;
            background-color: <?=$checkbox_background?>;
        }
        .form.element#<?=$form_id?> input[type=checkbox]:checked + label:before {
            border-right: 2px solid <?=$checkbox_checkmark?>;
            border-bottom: 2px solid <?=$checkbox_checkmark?>;
        }
        .form.element#<?=$form_id?>  input[type=checkbox]:not(:checked) + label:after {
            border: 2px solid <?=$checkbox_text?>;
        }
        .form.element#<?=$form_id?>  .ginput_container_checkbox .gform-field-label {
            color: <?=$checkbox_text?>;
        }
        .form.element#<?=$form_id?>  input[type=checkbox]:not(:checked) + label:after {
            border: 2px solid <?=$checkbox_text?>;
        }
        /* textarea */
        .form.element#<?=$form_id?> textarea {
            border-radius: <?=$textarea_radius?> !important;
        }
        /* submit */
        .form.element#<?=$form_id?> input[type="submit"] {
            display: block;
            width: 100%;
            color: <?=$submit_button_text?> !important;
            background: <?=$submit_background?> !important;
            border-color: <?=$submit_background?> !important;
            font-size: <?=$submit_size?> !important;
            font-family: <?=$submit_family?> !important;
            padding: <?=$submit_padding?> !important;
            border-radius: <?=$submit_radius?> !important;
            margin-top: <?=$input_spacing?> !important;
            border-width: 0;
        }
        .form.element#<?=$form_id?> input[type="submit"]:hover {
            background: <?=$submit_background_hover?> !important;
            border-color: <?=$submit_background_hover?> !important;
            padding: <?=$submit_padding?> !important;
        }
        /* error */
        .form.element#<?=$form_id?> .gform_validation_errors,
        .form.element#<?=$form_id?> .gfield_validation_message,
        .form.element#<?=$form_id?> .gform_submission_error,
        .form.element#<?=$form_id?> .validation_message {
            color: <?=$error_text?> !important;
            border-color: <?=$error_text?> !important;
            background: <?=$error_background?> !important;
            font-family: var(--font-primary) !important;
        }
        .form.element#<?=$form_id?> .gform_validation_errors h2,
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme .gfield_error .gfield_repeater_cell label, 
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme .gfield_error label, 
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme .gfield_error legend, 
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme .gfield_validation_message, 
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme .validation_message, 
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme [aria-invalid="true"] + label, 
        .form.element#<?=$form_id?> .gform_wrapper.gravity-theme label + [aria-invalid="true"] {
            color: <?=$error_text?> !important;
            font-family: var(--font-primary) !important;
        }
        .form.element#<?=$form_id?> .gform-icon--circle-error {
            color: <?=$error_text?> !important;
        }
        /* confirmation */
        .form.element#<?=$form_id?> .gform_confirmation_message {
            color: <?=$confirmation_color?> !important;
        }
        /* placeholder */
        .form.element#<?=$form_id?> ::-moz-placeholder {
            color: <?=$placeholder?> !important;
            opacity: 1 !important;
        }
        .form.element#<?=$form_id?> ::-webkit-placeholder {
            color: <?=$placeholder?> !important;
            opacity: 1 !important;
        }
        .form.element#<?=$form_id?> ::placeholder {
            color: <?=$placeholder?> !important;
            opacity: 1 !important;
        }
        /* gap */
        .form.element#<?=$form_id?> .gform_fields {
            grid-row-gap: <?=$input_spacing?> !important;
        }
        /* responsive */
        @media screen and (max-width: 640px) {
            .form.element#<?=$form_id?> .name_first {
                margin-bottom: <?=$input_spacing?> !important;
            }
            .form.element#<?=$form_id?> .name_last {
                margin-bottom: 0 !important;
            }
        }
        <?php 
        if ( $custom_css_global ) {
            // global css
            echo $custom_css_global;
        }
        ?>
        
    </style>
    <?php
    /** global settings end **/

    // initialize
    $form_classes = [];

    // default classes
    $form_classes[] = 'form';
    $form_classes[] = 'element';

    // form options
    if ( get_sub_field('color_scheme') !== 'default' ) {
        $form_classes[] = 'form-' . get_sub_field('color_scheme');
    } else {
        $form_classes[] = 'form-' . $color_scheme;
    }

    $required_text_summary = 'hide-required';
    if ( get_sub_field('required_text_summary') === 'show' ) {
        $required_text_summary = 'show-required';
    }
    $form_classes[] = $required_text_summary;

    $labels = 'hide-labels';
    if ( get_sub_field('labels') === 'show' ) {
        $labels = 'show-labels';
    }
    $form_classes[] = $labels;

    $form_title = 'false';
    if ( get_sub_field('form_title') === 'true' ) {
        $form_title = 'true';
    }

    $form_description = 'false';
    if ( get_sub_field('form_description') === 'true' ) {
        $form_description = 'true';
    }

    $ajax = 'true';
    if ( get_sub_field('ajax') === 'false' ) {
        $ajax = 'false';
    }

    // get global classes
    $additional_form_classes = get_field('form_classes', 'forms');
    if ( $additional_form_classes ) {
        $form_classes[] = $additional_form_classes;
    }

    // get global css
    $custom_css_global = get_field('custom_css', 'forms');

    // element advanced
    if ( get_sub_field('additional_classes') ) {
        $form_classes[] = get_sub_field('additional_classes');
    }

    if ( get_sub_field('custom_css') ) {
        echo '<style>';
            echo get_sub_field('custom_css');
        echo '</style>';
    }

    if ( function_exists('get_spacing_bbc') ) {
        $form_classes[] = get_spacing_bbc(get_sub_field('form_spacing'));
    }

    // complile
    $form_classes = implode(' ', $form_classes);

    if ( $form ) {
        echo '<div class="'. $form_classes .'" id="'. $form_id .'">';
            echo do_shortcode('[gravityform id="'. $form .'" title="'. $form_title .'" description="'. $form_description .'" ajax="'. $ajax .'"]');
        echo '</div>';
    }

endif;