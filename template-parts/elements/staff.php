<?php

if( get_row_layout() == 'staff' ):
                                    
    // content
    $staff_members = get_sub_field('staff_members');
    $fields_display = get_sub_field('fields_display');

    // section
    $column_width = null;
    $column_width = get_sub_field('column_width');
    $layout = get_sub_field('layout');
    

    $col_inner_classes = [];
    $column_background = get_sub_field('column_background_theme_colors');
    if ( $column_background ) {
        $col_inner_classes[] = 'bg-' . $column_background;
    }
    $col_inner_classes[] = get_sub_field('column_padding');
    $col_inner_classes = implode(' ', $col_inner_classes);

    if ( $layout == 'vertical' ) {
        $column_width = 'col-md-12';
    } elseif ( $column_width == 'auto' ) {
        $column_width = 'col-md';
    }

    $row_classes = [];
    $row_classes[] = 'row';
    $row_classes[] = 'staff-members';
    $row_classes = implode(' ', $row_classes);

    $column_classes = [];
    $column_classes[] = 'staff-member';
    $column_classes[] = $column_width;
    $column_classes = implode(' ', $column_classes);
    
    // image
    $image_settings = get_sub_field('image_settings');
    $image_shape = get_sub_field('image_shape');
    $image_size = $image_settings['image_size'];

    // name
    $name_tag = get_sub_field('name_tag');
    $name_styles = get_sub_field('name_styles');
    $color = 'text-' . $name_styles['text_styles']['theme_colors'];
    $font_size = $name_styles['text_styles']['font_size'];
    $font_weight = 'weight-' . $name_styles['text_styles']['font_weight'];
    $additional_classes = $name_styles['text_styles']['additional_classes'];

    $name_classes = [];
    $name_classes[] = $color;
    $name_classes[] = $font_size;
    $name_classes[] = $font_weight;
    $name_classes[] = $additional_classes;
    $name_classes = implode(' ', $name_classes);

    $name_styles_list = [];
    $name_styles_list = implode(' ', $name_styles_list);

    // title
    $title_tag = get_sub_field('title_tag');
    $title_styles = get_sub_field('title_styles');

    $fields = [];
    
    foreach ( $fields_display as $field ) {
        $fields[] = $field;
    }

    if ( $staff_members ) { ?>

    <div class="<?=$row_classes?>">

        <?php foreach ( $staff_members as $staff_member ) {

            setup_postdata($staff_member);

                $id = $staff_member;

                $name = null;
                $title = null;
                $short_bio = null;
                $long_bio = null;
                $image = null;

                if ( in_array('name', $fields) ) {
                    $name = get_field('name', $id);
                }
                
                if ( in_array('title', $fields) ) {
                    $title = get_field('title', $id);
                }

                if ( in_array('short_bio', $fields) ) {
                    $short_bio = get_field('short_bio', $id);
                }

                if ( in_array('long_bio', $fields) ) {
                    $long_bio = get_field('long_bio', $id);
                }

                if ( in_array('bio_image', $fields) ) {
                    $bio_image = get_field('bio_image', $id);
                }

                ?>

                
                    <div class="<?=$column_classes?>">
                        <div class="<?=$col_inner_classes?>">

                        <?php if ( $bio_image ) { ?>
                            <img src="<?php echo esc_url($bio_image['sizes'][ $image_size ]); ?>" alt="<?php echo esc_attr($bio_image['alt']); ?>" />
                        <?php } ?>

                        <?php if ( $name ) { ?>
                            <div class="staff-name"><<?=$name_tag?> class="<?=$name_classes?>"><?=$name?></<?=$name_tag?>></div>
                        <?php } ?>

                        <?php if ( $short_bio ) { ?>
                            <div class="staff-short-bio"><?=$short_bio?></div>
                        <?php } ?>

                        <?php if ( $long_bio ) { ?>
                            <div class="staff-long-bio"><?=$long_bio?></div>
                        <?php } ?>

                        <?php if ( $title ) { ?>
                            <div class="staff-title"><<?=$title_tag?>><?=$title;?></<?=$title_tag?>></div>
                        <?php } ?>

                        </div>
                    </div>

                <?php

            wp_reset_postdata();
        } ?>

        </div>

    <?php }

endif;