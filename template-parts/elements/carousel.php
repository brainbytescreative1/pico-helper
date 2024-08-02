<?php

if( get_row_layout() == 'carousel' ):

    // content
    $slides = get_sub_field('slides');

    if ( $slides ) {

        echo '<style>';
            include_once( __DIR__ . '/styles/carousel.css');
        echo '</style>';

        $wrapper_classes = [];
        $slide_classes = [];
        $slide_styles = [];
        $slide_overlay = null;
        $slide_video = null;

        $text_classes = [];
        $text_styles = [];

        $label_classes = [];
        $label_styles = [];

        $sub_label_classes = [];
        $sub_label_styles = [];

        $image_classes = [];
        $image_styles = [];

        // initial classes

        // wrapper classes
        $wrapper_classes[] = 'carousel carousel-element testimonial-carousel';
        if ( function_exists('get_spacing_bbc') ) {
            $wrapper_classes[] = get_spacing_bbc(get_sub_field('carousel_spacing'));
        }
        $wrapper_classes[] = get_sub_field('wrapper_additional_classes');

        // slide classes
        $slide_classes[] = 'carousel-item';
        $slide_classes[] = 'rounded-pill pt-3 pb-1 px-3 mx-2';
        $slide_classes[] = get_sub_field('slide_additional_classes');

        // options
        $prev_next_indicators = get_sub_field('prev_next_indicators');
        $dots = 'false';
        $arrows = 'false';
        if ( $prev_next_indicators !== 'none' ) {
            if ( $prev_next_indicators === 'both'  ) {
                $dots = 'true';
                $arrows = 'true';
            } else {
                $dots = 'true';
                $arrows = 'false';
            }
        }

        $autoplay = get_sub_field('autoplay');
        $autoplay = 'false';
        if ( get_sub_field('autoplay') == 'enabled' ) {
            $autoplay = 'true';
        }

        // calculate indicators width
        $slide_count = count($slides);
        $dots_padding = get_sub_field('dot_padding');
        $dots_width = ( $slide_count * ( $dots_padding * 2 ) ) + 70 + ( $dots_padding * 8 ) . 'px';

        // content
        $text_style = get_sub_field('text_style');
        $label_tag = get_sub_field('label_tag');
        $label_style = get_sub_field('label_style');
        $sub_label_tag = get_sub_field('sub_label_tag');
        $sub_label_style = get_sub_field('sub_label_style');
        $slide_background = get_sub_field('slide_background');
        $additional_classes = get_field('additional_classes');
        $custom_id = get_sub_field('custom_id');
        if ( $custom_id ) {
            $custom_id = esc_attr($custom_id);
        } else {
            $custom_id = 'carousel-' . rand(1,9999);
        }

        // content
        $text_style = null;
        if ( function_exists('get_text_styles_bbc') ) {
            $text_style = get_text_styles_bbc('text_style', $text_classes, $text_styles, true);
            if ( $text_style['classes'] ) {
                $text_classes[] = $text_style['classes'];
            }
        }

        $label_style = null;
        if ( function_exists('get_text_styles_bbc') ) {
            $label_style = get_text_styles_bbc('label_style', $label_classes, $label_styles, true);
            if ( $label_style['classes'] ) {
                $label_classes[] = $label_style['classes'];
            }
        }

        $sub_label_style = null;
        if ( function_exists('get_text_styles_bbc') ) {
            $sub_label_style = get_text_styles_bbc('sub_label_style', $sub_label_classes, $sub_label_styles, true);
            if ( $sub_label_style['classes'] ) {
                $sub_label_classes[] = $sub_label_style['classes'];
            }
        }

        // get background
        $slide_background = null;
        if ( function_exists('get_background_bbc') ) {
            $slide_background = get_background_bbc('slide_background', $slide_classes, $slide_styles, true);
            if ( $slide_background ) {
                if ( $slide_background['classes'] ) {
                    $slide_classes[] = $slide_background['classes'];
                }
                if ( $slide_background['styles'] ) {
                    $slide_styles[] = $slide_background['styles'];
                }
                if ( $slide_background['overlay'] ) {
                    $slide_overlay = $slide_background['overlay'];
                }
                if ( $slide_background['video'] ) {
                    $slide_video = $slide_background['video'];
                }
            }
        }

        // process elements
        $wrapper_classes = implode(' ', $wrapper_classes);

        $slide_classes = implode(' ', $slide_classes);
        $slide_styles = implode(' ', $slide_styles);

        $text_classes = implode(' ', $text_classes);
        $text_styles = implode(' ', $text_styles);

        $label_classes = implode(' ', $label_classes);
        $label_styles = implode(' ', $label_styles);

        $sub_label_classes = implode(' ', $sub_label_classes);
        $sub_label_styles = implode(' ', $sub_label_styles);

        $image_classes = implode(' ', $image_classes);
        $image_styles = implode(' ', $image_styles);
        
    ?>

    <div class="<?=esc_attr($wrapper_classes)?>" id="<?=$custom_id?>">

        <?php
        if( have_rows('slides') ):
            $slide_number = 0;
            while( have_rows('slides') ): the_row(); 
            ?>
            <div class="<?=esc_attr($slide_classes)?>">
            <?php
                $text = get_sub_field('text');
                if ( $text ) {
                    echo '<div class="carousel-text '. esc_attr( $text_classes ) .'">';
                        echo $text;
                    echo '</div>';
                }
                $label = get_sub_field('label');
                if ( $label ) {
                    echo '<div class="carousel-label '. esc_attr( $label_classes ) .'">';
                        echo '<' . $label_tag . '>' . $label . '</' . $label_tag . '>';
                    echo '</div>';
                }
                $sub_label = get_sub_field('sub_label');
                if ( $sub_label ) {
                    echo '<div class="carousel-sub-label '. esc_attr( $sub_label_classes ) .'">';
                    echo '<' . $sub_label_tag . '>' . $sub_label . '</' . $sub_label_tag . '>';
                    echo '</div>';
                }
            ?>
            </div>
            <?php
            $slide_number++;
            endwhile; 
        endif;
        ?>
    </div>
    <div class="slide-indicators">
        <div class="slide-indicators-dots"></div>
    </div>

    <style>
        .slide-indicators {
            max-width: <?=$dots_width?>;
        }
        .slick-dots li {
            padding: <?=$dots_padding?>px;
        }
    </style>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript">
        $('#<?=$custom_id?>').slick({
            accessibility: true,
            arrows: <?=$arrows?>,
            dots: <?=$dots?>,
            autoplay: <?=$autoplay?>,
            autoplaySpeed: 6000,
            adaptiveHeight: true,
            centerMode: true,
            centerPadding: '15%',
            prevArrow: '<span type="button" class="slick-prev"><i class="fa-light fa-angle-left"></i></span>',
            nextArrow: '<span type="button" class="slick-next"><i class="fa-light fa-angle-right"></i></span>',
            appendArrows: '.slide-indicators',
            appendDots: '.slide-indicators-dots',
            slidesToShow: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                    centerPadding: '0px',
                }
            }]
        });
    </script>

    <?php }
endif;