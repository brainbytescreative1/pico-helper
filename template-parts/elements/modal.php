<?php

if( get_row_layout() == 'modal' ):

    echo '<style>';
        include_once( __DIR__ . '/styles/modal.css');
    echo '</style>';
    
    // ids
    $modal_id = 'modal-' . rand(1,9999);
    $video_id = 'video-' . rand(1,9999);
    $trigger_id = 'trigger' . strval(rand(1,9999));

    // heading
    $heading = get_sub_field('heading');
    $heading_element = null;
    if ( $heading ) {

        $heading_text = $heading['text'];

        if ( $heading_text ) {

            $heading_tag = $heading['tag'];
            $heading_color = $heading['theme_colors'];
            $heading_size = $heading['font_size'];

            $heading_element = '<'. $heading_tag . ' class="modal-title" id="exampleModalLabel">'. $heading_text . '</'. $heading_tag . '>';

        }
        
    }

    // trigger
    $trigger = get_sub_field('trigger');
    if ( $trigger ) {

        $modal_classes = [];
        $modal_classes[] = 'modal-trigger';
        
        $additional_classes = get_sub_field('additional_classes');
        if ( $additional_classes ) {
            $modal_classes[] = trim($additional_classes);
        }

        $modal_classes = esc_attr( trim( implode(' ', $modal_classes ) ) );

        echo '<div class="'. $modal_classes .'">'; // trigger start

            if ( $trigger == 'icon' ) { // icon start

                $icon = get_sub_field('icon');

                if ( $icon ) {
        
                    $icon_classes = [];
                    $icon_classes[] = 'modal-trigger-icon';
            
                    // style
                    $icon_size = get_sub_field('icon_size');
                    if ( $icon_size ) {
                        $icon_classes[] = $icon_size;
                    }
            
                    $icon_color = get_sub_field('icon_color');
                    if ( $icon_color['theme_colors'] ) {
                        $icon_classes[] = 'text-' . $icon_color['theme_colors'];
                    }
            
                    $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                    
                    echo '<a type="button" data-bs-toggle="modal" id="'. $trigger_id .'" data-bs-target="#'. esc_attr( trim( $modal_id ) ) .'" class="'. $icon_classes .'">'. $icon .'</a>'; // trigger icon

                }
            
            } // icon end

            if ( $trigger == 'image' ) { // image start

                $image = get_sub_field('trigger_image');

                if ( $image ) {
        
                    $image_classes = [];
                    $image_classes[] = 'modal-trigger-image';
            
                    // Image variables.
                    $url = $image['url'];
                    $alt = $image['alt'];
            
                    $image = '<img src="'. $url .'" alt="'. $alt .'" />';
            
                    $image_classes = esc_attr( trim( implode(' ', $image_classes ) ) );
            
                    echo '<a type="button" data-bs-toggle="modal" id="'. $trigger_id .'" data-bs-target="#'. esc_attr( trim( $modal_id ) ) .'" class="'. $image_classes .'">'. $image .'</a>'; // trigger image

                }
               
            } // image end

            if ( $trigger && ( $trigger == 'video-icon' ) ) { // video + icon start

                $icon = null;
                $icon = get_sub_field('icon');

                $button = null;

                if ( $icon ) {
        
                    $icon_classes = [];
                    $icon_classes[] = 'modal-trigger-icon';
            
                    // style
                    $icon_size = get_sub_field('icon_size');
                    if ( $icon_size ) {
                        $icon_classes[] = $icon_size;
                    }
            
                    $icon_color = get_sub_field('icon_color');
                    if ( $icon_color['theme_colors'] ) {
                        $icon_classes[] = 'text-' . $icon_color['theme_colors'];
                    }
            
                    $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
            
                    $icon = '<div class="'. $icon_classes .'">'. $icon .'</div>';
                    
                    $button = '<a type="button" data-bs-toggle="modal" id="'. $trigger_id .'" data-bs-target="#'. esc_attr( trim( $modal_id ) ) .'" class="">'. $icon .'</a>'; // trigger icon

                }
        
                // video
                $placeholder_video = null;
                $placeholder_image = null;
                $placeholder_video = get_sub_field('placeholder_video');
                $placeholder_image = get_sub_field('placeholder_image');
        
                $video_placeholder_classes = [];
                $video_placeholder_classes[] = 'video-placeholder-inner';
                $video_fit = get_sub_field('video_fit');
                if ( $video_fit && ( $video_fit === 'enable' ) ) {
                    $video_placeholder_classes[] = 'video-placeholder-fit';
                }
                $video_placeholder_classes = esc_attr( trim( implode(' ', $video_placeholder_classes ) ) );

                $video_styles = [];
                $video_max_height = get_sub_field('video_max_height');
                if ( $video_max_height ) {
                    $video_styles[] = 'max-height: ' . $video_max_height . 'px;';
                }
                $video_styles = esc_attr( trim( implode(' ', $video_styles ) ) );

                // overlay
                $overlay = get_sub_field('overlay');
                if ( $overlay && ( $overlay = 'enabled' ) ) {
                    $overlay_color = get_sub_field('overlay_color');

                    $theme_color = $overlay_color['theme_colors'];
                    $transparency = $overlay_color['transparency'];
                    $custom_color = $overlay_color['custom_color'];

                    if ( $transparency ) {
                        $transparency = $transparency / 100;
                    }

                    $overlay_element = null;
                    $overlay_color_value = null;

                    if ( $custom_color ) {
                        $overlay_element = '<div class="video-overlay" style="background: '. $custom_color .'; opacity: '. $transparency .'"></div>';
                    } elseif ( $theme_color ) {
                        $overlay_element = '<div class="video-overlay" style="background: var(--'. $theme_color .'); opacity: '. $transparency .'"></div>';
                    }
                    
                }

                if ( $placeholder_video ) { ?>
                
                    <div class="video-placeholder">
                        <?=$overlay_element?>
                        <div class="video-icon" id="video-icon">
                            <?=$button?>
                        </div>
                        <div class="<?=$video_placeholder_classes?>">
                            <video class="video" autoplay="" loop="" muted="" poster="<?=$placeholder_image?>" style="<?=$video_styles?>">
                                <source src="<?=$placeholder_video?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
        
                <?php }
            } // video + icon end

        echo '</div>'; // trigger end

    }

    // settings
    //$close_button = get_sub_field('close_button');
    
    // content
    $body_content = get_sub_field('body_content');
    if ( $body_content == 'youtube' ) {

        $youtube_video_original = get_sub_field('youtube_video');

        if ( $youtube_video_original ) {

            $youtube_video_id = null;
            $youtube_video = $youtube_video_original;
            $youtube_video = str_replace('https://', '', $youtube_video_original);
            $youtube_video = str_replace('http://', '', $youtube_video);
            $youtube_video = str_replace('youtube.com', '', $youtube_video);
            $youtube_video = str_replace('youtu.be', '', $youtube_video);
            $youtube_video = str_replace('embed', '', $youtube_video);

            $youtube_video_id = trim(str_replace('/', '', $youtube_video));

            $youtube_video_src = 'https://www.youtube.com/embed/'. $youtube_video_id .'?autoplay=1';

        }
        
    }
    
    ?>

    <div class="modal fade<?php if ( $heading_element ) { echo ' has-header'; } ?>" id="<?=esc_attr( trim( $modal_id ) )?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">

                    <?php 
                    $close_button_color = 'close-dark';
                    $close_button_color_field = get_sub_field('close_button_color');
                    if ( $close_button_color_field && ( $close_button_color_field === 'light' ) ) {
                        $close_button_color = 'close-light';
                    }
                    ?>
                    
                    <button type="button" class="btn-close <?=$close_button_color?>" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="" type="text/html" id="<?=esc_attr( trim( $video_id ) )?>"></iframe>
                        
                        <script>
                            const trigger<?=$trigger_id?> = document.getElementById("<?=$trigger_id?>");
                            const rows<?=$trigger_id?> = document.getElementsByClassName("row");

                            trigger<?=$trigger_id?>.onclick = function(){modalTrigger<?=$trigger_id?>()};

                            function modalTrigger<?=$trigger_id?>() {
                                
                                
                            }
                        </script>
                        <script>
                            var myModalEl = document.getElementById('<?=$modal_id?>')
                            myModalEl.addEventListener('show.bs.modal', function (event) {
                                for(var index=0;index < rows<?=$trigger_id?>.length;index++){
                                    rows<?=$trigger_id?>[1].style.setProperty('z-index', '1053', 'important');
                                    document.getElementById("<?=$video_id?>").src="<?=$youtube_video_src?>";
                                }
                            });
                            myModalEl.addEventListener('hidden.bs.modal', function (event) {
                                for(var index=0;index < rows<?=$trigger_id?>.length;index++){
                                    rows<?=$trigger_id?>[1].style.setProperty('z-index', '1', 'important');
                                    document.getElementById("<?=$video_id?>").src=null;
                                }
                            });
                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    
    
endif;