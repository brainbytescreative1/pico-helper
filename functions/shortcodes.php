<?php

function top_bar_shortcode() {
    echo 'top bar';
}
//add_shortcode( 'top_bar', 'top_bar_shortcode' );

function table_of_contents_shortcode() {
    
    // start content
	ob_start();
    
    if ( is_active_sidebar( 'right-sidebar' ) ) {

        echo '<div class="container-fluid px-0">';
            echo '<div class="row">';
                echo '<div class="col-12">';

                    $sidebar_content = get_field('sidebar_content');
                    if ( $sidebar_content == "Table of Contents" ) {
                        $toc = get_field('table_of_contents');
                        if ( $toc ) {
                            ?>
                            <div class="element toc" id="toc">
                                <?=$toc?>
                            </div>

                            <?php
                            $sticky_sidebar = get_field('sticky_sidebar');
                            if ( $sticky_sidebar === 'enable' ) { 
                                $sticky_position = get_field('sticky_position'); ?>

                                <script>
                                // When the user scrolls the page, execute myFunction
                                window.addEventListener('scroll', stickyTOC);

                                // Get the navbar
                                var toc = document.getElementById("right-sidebar");

                                // Get the offset position of the navbar
                                var sticky = toc.offsetTop;
                                var sticky = ( sticky + <?=$sticky_position?> );

                                // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
                                function stickyTOC() {
                                    if (window.pageYOffset >= sticky) {
                                        toc.classList.add("sticky-toc")
                                    } else {
                                        toc.classList.remove("sticky-toc");
                                    }
                                }
                                </script>

                                <script>
                                    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                                        anchor.addEventListener('click', function (e) {
                                            e.preventDefault();

                                            document.querySelector(this.getAttribute('href')).scrollIntoView({
                                                behavior: 'smooth'
                                            });
                                        });
                                    });
                                </script>

                            <?php }
                        }
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }

    ?>
    
    <?php

    // return content
	$content = ob_get_clean();
    return $content;

}
add_shortcode( 'table_of_contents', 'table_of_contents_shortcode' );