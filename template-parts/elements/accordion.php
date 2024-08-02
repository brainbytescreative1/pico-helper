<?php

if( get_row_layout() == 'accordion' ):

    // get fields
    $accordion = get_sub_field('accordion');
    $accordion_spacing = get_sub_field('accordion_spacing');

    if ( $accordion ) {

        // initialize arrays
        $accordion_classes = [];
        $accordion_styles = [];
        $heading_classes = [];

        // add initial classes
        $accordion_classes[] = 'accordion';
        $accordion_classes[] = 'element';

        $accordion_style = get_sub_field('accordion_style');
        $flush_item = null;
        if ( $accordion_style == 'flush' ) {
            $accordion_classes[] = 'accordion-flush';
            $flush_item = '-flush-';
        }

        // processed inside loop
        $always_open = get_sub_field('always_open');
        $show_first = get_sub_field('show_first');

        // accordion options
        $title_color_collapsed = get_sub_field('title_color_collapsed');
        if ( $title_color_collapsed['theme_colors'] !== 'default') {
            $title_color_collapsed = 'text-collapsed-' . $title_color_collapsed['theme_colors'];
            $accordion_classes[] = $title_color_collapsed;
        }        

        $title_color_open = get_sub_field('title_color_open');
        if ( $title_color_open['theme_colors'] !== 'default') {
            $title_color_open = 'text-open-' . $title_color_open['theme_colors'];
            $accordion_classes[] = $title_color_open;
        }

        $title_background_color_collapsed = get_sub_field('title_background_color_collapsed');
        if ( $title_background_color_collapsed['theme_colors'] !== 'default') {
            $title_background_color_collapsed = 'bg-collapsed-' . $title_background_color_collapsed['theme_colors'];
            $accordion_classes[] = $title_background_color_collapsed;
        }

        $title_background_color_open = get_sub_field('title_background_color_open');
        if ( $title_background_color_open['theme_colors'] !== 'default') {
            $title_background_color_open = 'bg-open-' . $title_background_color_open['theme_colors'];
            $accordion_classes[] = $title_background_color_open;
        }

        // styles
        $heading_settings = get_sub_field('heading_settings');
        $tag = $heading_settings['tag'];    

        if ( $heading_settings['font_size'] && ( $heading_settings['font_size'] !== 'default' ) ) {
            $heading_classes[] = $heading_settings['font_size'];
            $heading_classes[] = 'accordion-font-size';
        }
        if ( $heading_settings['font_weight'] && ( $heading_settings['font_weight'] !== 'default' ) ) {
            $heading_classes[] = 'weight-' . $heading_settings['font_weight'];
        }
        if ( $heading_settings['font_family'] && ( $heading_settings['font_family'] !== 'default' ) ) {
            $heading_classes[] = 'font-' . $heading_settings['font_family'];
        }

        // advanced
        $accordion_id = get_sub_field('accordion_id');
        if ( !$accordion_id ) {
            $accordion_id = 'accordion-' . rand(0,9999);
        }
        $accordion_classes[] = get_sub_field('additional_classes');
        if ( $additional_classes ) {
            $accordion_classes[] = trim($additional_classes);
        }

        if ( function_exists('get_spacing_bbc') ) {
            $accordion_classes[] = get_spacing_bbc(get_sub_field('accordion_spacing'));
        }

        // item classes
        $accordion_item_add_classes = get_sub_field('accordion_item_classes');
        $accordion_heading_add_classes = get_sub_field('accordion_heading_classes');
        $accordion_button_add_classes = get_sub_field('accordion_header_button_classes');
        $accordion_body_add_classes = get_sub_field('accordion_body_classes');

        // process accordion classes and styles
        $accordion_classes = trim(implode(' ', $accordion_classes));
        $accordion_styles = trim(implode(' ', $accordion_styles));
        $heading_classes = trim(implode(' ', $heading_classes));
        
        ?>

        <div class="<?=esc_attr($accordion_classes)?>" id="<?=esc_attr($accordion_id)?>" style="<?=esc_attr($accordion_styles)?>">
            <?php
            $accordion_item_count = 1;
            foreach ( $accordion as $accordion_item ) { // accordion item loop start

                $show = null;
                $collapsed = null;
                $aria_expanded = 'false';

                if( $show_first && in_array('Yes', $show_first) ) {
                    if ( $accordion_item_count === 1 ) {
                        $show = ' show';
                        $aria_expanded = 'true';
                        
                    } else {
                        $collapsed = ' collapsed';
                    }
                } else {
                    $collapsed = ' collapsed';
                }

                $accordion_item_count_spelled = null;

                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                $accordion_item_count_spelled = $f->format($accordion_item_count);
                $accordion_item_count_spelled = str_replace(' ', '-', $accordion_item_count_spelled);
                $accordion_item_count_spelled = $flush_item . $accordion_item_count_spelled;

                // initialize accordion item arrays
                $accordion_item_classes = [];
                $accordion_item_styles = [];
                $header_inner_classes = [];
                $header_button_classes = [];

                // bring classes from outer
                $header_inner_classes[] = $heading_classes;

                /*
                $accordion_item_classes = get_sub_field('accordion_item_classes');
                $accordion_heading_classes = get_sub_field('accordion_heading_classes');
                $accordion_body_classes = get_sub_field('accordion_body_classes');
                */

                // determine if always open
                $data_bs_parent = null;
                if ( $always_open == 'disabled' ) {
                    $data_bs_parent = 'data-bs-parent="#'.$accordion_id.'"';
                }                

                // add initial classes
                $accordion_item_classes[] = 'accordion-item';
                if ( $accordion_item_add_classes ) {
                    $accordion_item_classes[] = trim($accordion_item_add_classes);
                }

                // heading
                $heading = $accordion_item['heading'];
                $heading_text = $heading['text'];
                $heading_tag = $tag;

                // heading style
                $header_inner_classes[] = 'accordion-header';
                if ( $accordion_heading_add_classes ) {
                    $header_inner_classes[] = trim($accordion_heading_add_classes);
                }

                // button
                $header_button_classes[] = 'accordion-button';
                if ( $accordion_button_add_classes ) {
                    $header_button_classes[] = trim($accordion_button_add_classes);
                }
                
                // text content
                $text_classes = [];
                $text = $accordion_item['text'];
                $text_content = $text['text'];

                // text content style
                $text_classes[] = 'accordion-body';
                if ( $accordion_body_add_classes ) {
                    $text_classes[] = trim($accordion_body_add_classes);
                }
                $text_classes = trim(implode(' ', $text_classes));

                // image
                $image = $accordion_item['image']['image'];
                $image_size = $accordion_item['image']['image_size'];
                
                if ( $image ) {

                    $image_classes = [];

                    // Image variables.
                    $thumb = wp_get_attachment_image_url($image, $image_size);
                    $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);

                    $image_classes = trim(implode(' ', $image_classes));
                
                }

                // process accordion item classes and styles
                $accordion_item_classes = trim(implode(' ', $accordion_item_classes));
                $accordion_item_styles = trim(implode(' ', $accordion_item_styles));
                $header_inner_classes = trim(implode(' ', $header_inner_classes));
                $header_button_classes = trim(implode(' ', $header_button_classes));

                ?>

                <div class="<?=esc_attr($accordion_item_classes)?>">
                    <<?=esc_attr($heading_tag)?> class="<?=esc_attr($header_inner_classes)?>" id="<?=esc_attr($flush_item)?>heading<?=esc_attr($accordion_item_count_spelled)?>">
                        <button class="<?=esc_attr($header_button_classes)?><?=esc_attr($collapsed)?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=esc_attr($accordion_item_count_spelled)?>" aria-expanded="<?=esc_attr($aria_expanded)?>" aria-controls="collapse<?=esc_attr($accordion_item_count_spelled)?>">
                            <?=esc_attr($heading_text)?>
                        </button>
                    </<?=esc_attr($tag)?>>
                    <div id="collapse<?=esc_attr($accordion_item_count_spelled)?>" class="accordion-collapse collapse<?=esc_attr($show)?>" aria-labelledby="heading<?=esc_attr($accordion_item_count_spelled)?>" <?php echo $data_bs_parent; ?>>
                        <?php
                        if ( $image ) { ?>
                            <div class="accordion-item-content-left">
                                <div class="img <?=$image_classes?>">
                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                </div>
                            </div>
                            <div class="accordion-item-content-right">
                        <?php }
                        ?>
                        <?php
                        if ( $text_content ) { ?>
                            <div class="<?=esc_attr($text_classes)?>">
                                <?php echo $text_content; ?>
                            </div>
                        <?php }
                        ?>
                        <?php
                        if ( $image ) { ?>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>

                
                
                <?php

            $accordion_item_count++;
            } // accordion item loop end
            ?>
            
        </div>

    <?php }

endif;