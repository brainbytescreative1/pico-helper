<?php ?>

<div class="container">

    <!-- Your site branding in the menu -->
    <?php get_template_part( 'global-templates/navbar-branding' ); ?>

    <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#navbarNavOffcanvasSticky"
        aria-controls="navbarNavOffcanvasSticky"
        aria-expanded="false"
        aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end bg-primary" tabindex="-1" id="navbarNavOffcanvasSticky">

        <div class="offcanvas-header justify-content-end">
            <button
                class="btn-close btn-close-white text-reset"
                type="button"
                data-bs-dismiss="offcanvas"
                aria-label="<?php esc_attr_e( 'Close menu', 'understrap' ); ?>"
            ></button>
        </div><!-- .offcancas-header -->

        <!-- The WordPress Menu goes here -->
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'container_class' => 'offcanvas-body',
                'container_id'    => '',
                'menu_class'      => 'navbar-nav justify-content-end flex-grow-1 pe-3',
                'fallback_cb'     => '',
                'menu_id'         => 'main-menu',
                'depth'           => 2,
                'walker'          => new bootstrap_5_wp_nav_menu_walker(),
            )
        );
        ?>
    </div><!-- .offcanvas -->

</div><!-- .container(-fluid) -->