<?php
/*
template name: Front-page-details
*/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );

function child_do_custom_loop() {
?>
    <div class="FullFrame">
        <?php genesis_do_loop(); ?>
        <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/the-tour-of-crete.jpg" />
    </div>
<?php  
}


genesis(); ?>