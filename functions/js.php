<?php

// add footer functions
function theme_js() { ?>
    
    <script id="stickyNav" async type="text/javascript">
        function stickyNav() {
    
            const navbar = document.getElementById("navbar-sticky");
            const mainNav = document.querySelector('#wrapper-navbar');

            let mainNavHeightOffset = mainNav.offsetHeight + 200;

            window.addEventListener("scroll", () => {

                if (window.scrollY === 0) {
                    navbar.classList.remove("fixed-top");
                    navbar.classList.add("d-none");
                } else if (window.scrollY > mainNavHeightOffset) {
                    navbar.classList.add("fixed-top");
                    navbar.classList.add("animated");
                    navbar.classList.add("slideDown");
                    navbar.classList.add("d-block");
                    navbar.classList.remove("slideUp");
                    navbar.classList.remove("d-none");
                } else if (window.scrollY < mainNavHeightOffset) {
                    navbar.classList.add("slideUp");
                    navbar.classList.remove("d-block");
                    navbar.classList.remove("slideDown");
                } else if (window.scrollY === 0) {
                    navbar.classList.remove("fixed-top");
                }
            });

        }
        stickyNav();
    </script>

    <script id="backToTopButton" async type="text/javascript">
        function backToTopButton() {
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                showButton();
            };

            function showButton() {

                let mybutton = document.getElementById("btn-back-to-top");
                mybutton.classList.add("d-none");

                //Get the button
                if ( mybutton ) {
                    if ( document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ) {
                        // show on scroll
                        mybutton.classList.remove("d-none");
                        mybutton.classList.add("d-flex");
                    } else {
                        // hide at top
                        mybutton.classList.add("d-none");
                        mybutton.classList.remove("d-flex");
                    }
                }

                if ( mybutton ) {
                    mybutton.addEventListener("click", backToTop);
                }

            }
            // When the user clicks on the button, scroll to the top of the document
            function backToTop() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        }
        backToTopButton();
    </script>

    <?php
    $header_height = get_field('header_height', 'header');

    if ( !$header_height ) { ?>
        <script id="headerHeight" async type="text/javascript">
            function headerHeight() {
                const menuHeight = document.querySelector('#wrapper-navbar').offsetHeight;
                
                document.documentElement.style.setProperty('--header-height', menuHeight + 'px');
                document.documentElement.style.setProperty('--header-height-logged-in', ( menuHeight + 32 ) + 'px');
                document.documentElement.style.setProperty('--header-height-logged-in-mobile', ( menuHeight + 46 ) + 'px');
            }
            headerHeight();
        </script>
    <?php }

    $content_negative_margin = get_field('content_negative_margin', 'header');
	if ( ( $content_negative_margin === 'enabled' ) && !$header_height ) { ?>
        <script id="firstElementSpacing" async type="text/javascript">
            function firstElementSpacing() {

                // define variables
                let menuHeight = null;
                let menu = null;

                menu = document.querySelector('#wrapper-navbar');
                menuHeight = menu.offsetHeight;

                // apply style to content
                // content wrapper
                let content = document.querySelector('#theme-main');
                content.style.marginTop = "-" + menuHeight + 'px';

                // get first element style
                let firstElement = document.querySelector('#container-content-page .element-container:first-child');
                let firstElementStyle = getComputedStyle(firstElement);

                // set top padding of first element
                let paddingTop = parseInt(firstElementStyle.paddingTop);
                firstElement.style.setProperty("padding-top", ( menuHeight + paddingTop ) + 'px', "important");

            }
            //firstElementSpacing();
        </script>
	<?php } ?>


    
    

<?php }
add_action( 'wp_footer', 'theme_js' );