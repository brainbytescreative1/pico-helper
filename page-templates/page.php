<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="container-content-page" class="">

    <?php if ( get_field('show_page_title') === 'show' ) { ?>
        <div class="py-5 py-xl-6 bg-light-subtle text-dark-emphasis">
            <div class="container text-center">
                <h1 class="display-4"><?php the_title(); ?></h1>    
            </div>
        </div>
    <?php } ?>

    <?php 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif;
    ?>

</div>

<?php get_footer();