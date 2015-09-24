<?php
/*
template name: News Single Page
*/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );

function child_do_custom_loop() {
	global $post;
?>
    <div class="FullFrame news">
    	<div class="left">
			<h1 class="entry-title"><?php echo get_cat_name(4); ?></h1>
            <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/news.jpg" />
		</div>
		<div class="right">
       
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        	<article class="page type-page status-publish entry news">
                <header class="entry-header">
                	<h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                	<?php the_content(); ?>
                </div>
                <div class="entry-date"><?php the_time('l, j.n.Y')?></div>
            </article>
        <?php endwhile; endif;?>
        </div>
    </div>
<?php  
}


genesis(); ?>