<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

add_theme_support( 'post-thumbnails' );
 
//* Add my theme scripts
function my_theme_scripts() {
	if( !is_admin() ) {
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', false, 'latest', false);
		wp_register_script('my-jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.js');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'my-jquery-ui' );
	}
}

add_action('init', 'my_theme_scripts');

// Register extra custom menus 
function register_my_menus() {
	register_nav_menus(
		array(
			'the-race-menu' => __( 'The Race menu' ))
	);
}

add_action( 'init', 'register_my_menus' );

//* Remove the sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// Add menu, search and lang scripts
add_action('wp_head', 'ScriptTopNavigation');

function ScriptTopNavigation(){ ?>
	<script language="javascript">
        jQuery(document).ready( function(){							 
            jQuery("#menu-main-menu li a").before("<span class='menu-l'></span>");
			jQuery("#menu-main-menu li a").after("<span class='menu-r'></span>");
        });
				
    </script> <?php
}

// Add custom header and include inside the main menu
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_after_header', 'genesis_do_nav');


function custom_header() {
	global $post;
	$tourDates = get_field('dates', icl_object_id(2, 'page', false));
  ?>
  	<div class="header-full-width">
       <div class="left">
       		<a href="<?=get_bloginfo('url'); ?>" alt="<?php print get_bloginfo('name') .' - '. get_bloginfo('description'); ?>">
               <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/logo.png" title="<?php print get_bloginfo('name') ?>" />
            </a>
       </div>
       <div class="right">
       		<div class="menu"><?php genesis_do_nav(); ?></div>
            <div class="language">
            	<div class="left">
                	<span class="tourdates"><?php echo $tourDates; ?></span>
                	<img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/header-txt.png" />
                </div>
            	<div class="right">
                	<div class="lang"></div>
                    <div class="social"><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/social.png" border="0" usemap="#Map" />
                      <map name="Map" id="Map">
                        <area shape="rect" coords="1,1,23,27" href="https://goo.gl/jdKycy" target="_blank" />
                      </map>
                </div>
                
            </div>
       </div>
   </div>
     <?php 
}
 
// Add google analytics code
add_action('genesis_before_header', 'google_analytics');

function google_analytics() {
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54180538-1', 'auto');
  ga('send', 'pageview');

</script>
<?php 
}

add_action('genesis_header', 'custom_header');

// Add excerpt support for pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
	  add_post_type_support( 'page', 'excerpt' );
}

// Get list of subpages
function wpb_list_child_pages() { 
	global $post; 

	if ( is_page() && $post->post_parent )
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	
	if ( $childpages ) {
		$string = '<ul>' . $childpages . '</ul>';
	}
	
	return $string;
}

// add my custom variables to query_vars
function add_query_vars_filter( $vars ){
  $vars[] = "stage";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

// get latest news and photogallery
function news_gallery(){
	//$cat_id = 6; //category id for news: LOCAL
	$cat_id = 4; //category id for news: PRODUCTION
	$latest_cat_post = new WP_Query( array('posts_per_page' => 4, 'category__in' => array($cat_id)));
	
	?>
    <div class="bottomFrame">
    	<div class="news">
        	<h2><span><?php _e('NEWS','tourofcrete');?>:</span>
        	  <?php _e('UPDATE','tourofcrete');?>
        	</h2>
            <a href="<?php echo get_category_link(4); ?>" class="more">More News ></a>
            <?php
            if( $latest_cat_post->have_posts() ) : while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post(); ?>
              <div class="new">
                    <a href="<?php the_permalink() ?>"  title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a>
                    <p><?php echo get_the_excerpt(); ?>... <a href="<?php the_permalink() ?>">(read more)</a></p>
                </div>
            
            <?php endwhile; endif; ?>
        </div>
    	<div class="gallery">      	
            <h2><?php _e('PHOTO GALLERY','tourofcrete');?></h2>
            <a href="<?php get_site_url(); ?>/gallery/" class="more"><?php _e('More Photos','tourofcrete');?> ></a>
            <div style="padding:18px 0 0 57px; clear:both;">
		<?php
		global $wpdb;
		$pictures = $wpdb->get_results("SELECT * FROM wp_ngg_pictures WHERE galleryid = '5' ORDER BY imagedate DESC LIMIT 9");
		$i=1;
		foreach( $pictures as $p ) {
				if ($i <= 3) {
					echo ('<div class="masked-image">');
					echo do_shortcode("[singlepic id=".$p->pid.",199,9]");
					$template_dir=get_bloginfo('url');
					echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="'.$template_dir.'/wp-content/gallery/promo-video-shoot/'.$p->filename.'"><div class="hover-image"></div></a>');
					echo ('</div>');
					
					}
					
				else if ($i==4) {
				echo ('</div>');
				echo ('<div style="padding:6px 0 0 73px; clear:both;">');
					echo ('<div class="masked-image">');
					echo do_shortcode("[singlepic id=".$p->pid.",199,9]");
					$template_dir=get_bloginfo('url');
					echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="'.$template_dir.'/wp-content/gallery/promo-video-shoot/'.$p->filename.'"><div class="hover-image"></div></a>');
					echo ('</div>');
					
					
					}
					else if ($i<=6)
					{
					echo ('<div class="masked-image">');
					echo do_shortcode("[singlepic id=".$p->pid.",199,9]");
					$template_dir=get_bloginfo('url');
					echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="'.$template_dir.'/wp-content/gallery/promo-video-shoot/'.$p->filename.'"><div class="hover-image"></div></a>');
					echo ('</div>');
					}
					else if($i==7)
					{
				echo ('</div>');
				echo ('<div style="padding:6px 0 0 89px; clear:both;">');
					echo ('<div class="masked-image">');
					echo do_shortcode("[singlepic id=".$p->pid.",199,9]");
					$template_dir=get_bloginfo('url');					
					echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="'.$template_dir.'/wp-content/gallery/promo-video-shoot/'.$p->filename.'"><div class="hover-image"></div></a>');
					echo ('</div>');

					}
					else if($i>7)
					{
					echo ('<div class="masked-image">');
					echo do_shortcode("[singlepic id=".$p->pid.",199,9]");
					$template_dir=get_bloginfo('url');					
					echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="'.$template_dir.'/wp-content/gallery/promo-video-shoot/'.$p->filename.'"><div class="hover-image"></div></a>');
					echo ('</div>');					
					}
					else if($i>=10) 
					{
					break;
					}
			$i++;
			}
?>
         </div>
    </div> 
       
    <?php
}
