<?php

if ( class_exists( 'GFCommon' ) ) {

    // add classes to submit button
    add_filter( 'gform_submit_button', 'add_custom_css_classes', 10, 2 );
    function add_custom_css_classes( $button, $form ) {

        $submit_classes = [];
        $submit_button_classes = get_field('submit_button_classes', 'forms');
        if ( $submit_button_classes ) {
            $submit_classes[] = $submit_button_classes;
        }
        $submit_classes = implode(' ', $submit_classes);

        $dom = new DOMDocument();
        $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
        $input = $dom->getElementsByTagName( 'input' )->item(0);
        $classes = $input->getAttribute( 'class' );
        $classes .= ' ' . $submit_classes;
        $input->setAttribute( 'class', $classes );
        return $dom->saveHtml( $input );

    }

    // acf populate forms
    add_filter('acf/load_field/name=form', function($field) {
        
        $forms = [];
        $forms_list = GFAPI::get_forms();
        foreach ($forms_list as $form) {
            $id = $form['id'];
            $title = $form['title'];
            $forms[] = [ $form['id'], $form['title'] ];
        }

        $choices = [];

        // if enabled and exist
        foreach ($forms as $form) {
            $choices += array( $form[0] => __(ucfirst($form[1]), 'bbc') );
        } 
        
        $field['choices'] = $choices;
        $field['default_value'] = null;
        return $field;

    });

    // add custom merge tags
    add_action( 'gform_admin_pre_render', 'add_merge_tags' );
    function add_merge_tags($form) { ?>    
        <script type = "text/javascript" >
            gform.addFilter('gform_merge_tags', 'add_merge_tags');

            function add_merge_tags(mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option) {
                mergeTags["custom"].tags.push(
                    {
                        tag: '{Site_Name}',
                        label: 'Site Name'
                    },
                    {
                        tag: '{Global_Email}',
                        label: 'Global Email'
                    },
                    {
                        tag: '{From_Email}',
                        label: 'From Email'
                    },
                    {
                        tag: '{Global_Phone}',
                        label: 'Global Phone'
                    }
                );
                return mergeTags;
            } </script> 
        <?php
        return $form;
    }

    // site name
    add_filter('gform_replace_merge_tags', 'replace_site_name', 10, 7);
    function replace_site_name($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {

        $merge_tag = '{Site_Name}';

        if ( strpos( $text, $merge_tag ) === false || empty( $form ) ) {
            return $text;
        }
        
        $siteName = do_shortcode('[bbc_site_name]');
        if ( $siteName ) {
            return str_replace( $merge_tag, $siteName, $text );
        } else {
            return str_replace( $merge_tag, 'us', $text );
        }

    }

    // global email
    add_filter('gform_replace_merge_tags', 'replace_global_email', 10, 7);
    function replace_global_email($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
        
        $merge_tag = '{Global_Email}';

        if ( strpos( $text, $merge_tag ) === false || empty( $form ) ) {
            return $text;
        }

        $global_email = get_field('global_email', 'integrations');
        if ( $global_email ) {
            return str_replace( $merge_tag, $global_email, $text );
        } else {
            return '';
        }

    }

    // from email
    add_filter('gform_replace_merge_tags', 'replace_from_email', 10, 7);
    function replace_from_email($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
        
        $merge_tag = '{From_Email}';

        if ( strpos( $text, $merge_tag ) === false || empty( $form ) ) {
            return $text;
        }
        
        $global_from_email = get_field('global_from_email', 'integrations');
        if ( $global_from_email ) {
            return str_replace( $merge_tag, $global_from_email, $text );
        } else {
            return str_replace( $merge_tag, 'forms@brainbytescreative.com', $text );
        }
        
    }

    // global phone
    add_filter('gform_replace_merge_tags', 'replace_global_phone', 10, 7);
    function replace_global_phone($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
        
        $merge_tag = '{Global_Phone}';

        if ( strpos( $text, $merge_tag ) === false || empty( $form ) ) {
            return $text;
        }
        $global_phone = get_field('global_phone', 'integrations');
        if ( $global_phone ) {
            return str_replace( $merge_tag, $global_phone, $text );
        } else {
            return '';
        }

    }

    // get privacy page for consent field
    function bbc_get_privacy_consent() {
        $privacy = get_privacy_policy_url();
        if ( $privacy ) {
            return 'I have read and accept the <a href="'. $privacy .'" target="_blank">Privacy Policy</a>.';
        } else {
            return 'I have read and accept the <a href="/privacy-hipaa/" target="_blank">Privacy Policy</a>.';
        }
    }
    add_shortcode( 'privacy_consent', 'bbc_get_privacy_consent' );

}