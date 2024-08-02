<?php

if( get_row_layout() == 'gallery' ):

    $images = get_sub_field('gallery');
    if( $images ): ?>
        <div class="image-gallery element">
            <?php foreach( $images as $image ): ?>
                <div class="image-gallery-item">
                        <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <p><?php echo esc_html($image['caption']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif;

endif;