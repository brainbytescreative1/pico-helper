<?php

if( get_row_layout() == 'post_carousel' ):

    $posts_per_page = get_sub_field('posts_per_page');
    if ( !$posts_per_page ) {
        $posts_per_page = 3;
    }
    $max_num_pages = get_sub_field('max_pages');
    if ( !$max_num_pages ) {
        $max_num_pages = 1;
    }


    ?>

    <div id="carouselExampleIndicators" class="carousel slide post-carousel element" data-bs-ride="carousel">
    <!--
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row">
                <?php
                $args = array(
                    'posts_per_page' => $posts_per_page,
                    'post_type' => 'post',
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                $the_query = new WP_Query($args);
            
                if ($the_query->have_posts()) {

                    $post_count = 0;

                    while ($the_query->have_posts()) {

                        $the_query->the_post();
            
                        $link = get_the_permalink();
                        $title = get_the_title();
                        $image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        $excerpt = get_the_excerpt();

                        if ( $post_count < ( $posts_per_page / $max_num_pages ) ) { ?>
                            <div class="col-12 col-md-6 col-xl-4 mb-4">
                                <div class="card mr-3">
                                    <a href="<?php echo $link; ?>" title="<?=$title?>">
                                        <img src="<?=$image?>" class="card-img-top" alt="<?=$title?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?=$title?></h5>
                                            <span class="card-text"><?=$excerpt?></span>
                                            
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php }

                        $post_count++;
                       
                    }
            
                }
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
    <!--
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    -->
    </div>
    <?php
    
endif;