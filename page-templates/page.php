<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php if ( get_field('show_page_title') === 'show' ) { ?>
    <div class="py-5 py-xl-6 bg-light-subtle text-dark-emphasis">
        <div class="container text-center">
            <h1 class="display-4"><?php the_title(); ?></h1>    
        </div>
    </div>
<?php } ?>

<div id="container-content-page" class="">
    <div class="container p-0">
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
</div>


<?php get_footer();