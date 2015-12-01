<?php
/*
template name: Category News
*/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'be_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );

function be_custom_loop() {
	global $post;
	 
	// arguments, adjust as needed
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 4,
		'post_status' => 'publish',
		'paged' => get_query_var( 'paged' )
	);
	 
	 $category = get_the_category();
	 
	/*
	Overwrite $wp_query with our new query.
	The only reason we're doing this is so the pagination functions work,
	since they use $wp_query. If pagination wasn't an issue,
	use: https://gist.github.com/3218106
	*/
	global $wp_query;
	$wp_query = new WP_Query( $args );
	 
	if ( have_posts() ) :
	
		echo '<div class="FullFrame news">';
			echo '<div class="left">';
				echo '<h1 class="entry-title">' . $category[0]->cat_name . '</h1>';
				echo '<img src="'.get_bloginfo('stylesheet_directory').'/images/news.jpg" />';
			echo '</div>';
			echo '<div class="right">';
				while ( have_posts() ) : the_post();
				 	echo '<article class="page type-page status-publish entry">';
						echo '<header class="entry-header">';
							?>
                            <h2 class="entry-title"><a href="<?php the_permalink() ?>"  title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <?php
						echo '</header>';
						echo '<div class="entry-content">';
							if ( has_post_thumbnail() ) {
							    the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
							}
							echo the_excerpt();
						echo '</div>';
						?>
						<div class="entry-date"><?php the_time('l, j.n.Y')?></div>
                        <?php
				 	echo '</article>';
				endwhile;
			echo '</div>';
		echo '</div>';
		do_action( 'genesis_after_endwhile' );
		
	endif;
	 
	wp_reset_query();
}
 
genesis(); ?>