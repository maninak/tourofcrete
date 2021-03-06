<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

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
		wp_register_script('toc-scripts', 'http://tourofcrete.com/wp-content/themes/tourofcrete/toc-scripts.js');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'my-jquery-ui' );
		wp_enqueue_script('toc-scripts');
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

function ScriptTopNavigation(){ /*?>
	<script language="javascript">
        jQuery(document).ready( function(){							 
            jQuery("#menu-main-menu li a").before("<span class='menu-l'></span>");
			jQuery("#menu-main-menu li a").after("<span class='menu-r'></span>");
        });
				
    </script> <?php */ // Commented-out when redesigning the navbar -K
}

// Add custom header and include inside the main menu
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_after_header', 'genesis_do_nav');


function custom_header() {
	global $post;
	$tourDates = get_field('dates', icl_object_id(2, 'page', false));
  ?>
  	<div class="header-full-width">
  	<?php if (ICL_LANGUAGE_CODE == 'el'){ ?>
		<link rel='stylesheet'   href='<?=get_bloginfo('stylesheet_directory');?>/style_el.css' type='text/css' media='all' />
	<?php } ?>
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
                	<div class="lang"><?php do_action('icl_language_selector'); ?></div>
                    <div class="social"><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/social.png" border="0" usemap="#Map" />
                      <map name="Map" id="Map">
                        <area shape="rect" coords="1,1,23,27" href="https://goo.gl/jdKycy" target="_blank" />
                      </map>
                </div>
            </div>
       </div>
</div>
<?php
	// Adds google analytics tracking at kmaninak@gmail.com -K
	add_action('wp_footer', 'add_googleanalytics');
	function add_googleanalytics() { 
?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-70469459-2', 'auto');
			ga('send', 'pageview');
		</script>
<?php 
	} 
?>
<?php
	// Adds facebook analytics tracking -K
	add_action('wp_footer', 'add_facebookanalytics');
	function add_facebookanalytics() { 
?>
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','//connect.facebook.net/en_US/fbevents.js');

		fbq('init', '461713000682562');
		fbq('track', "PageView");
	</script>
	<noscript>
		<img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=461713000682562&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
<?php 
	} 
?>
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

// Adds class ".parallelogram" to navbar menu items (for redesign) -K
function add_custom_nav_menu_item_class ($classes, $item) {
	if ($item->id == 'menu-item-6' ) {
    	$classes[] = 'parallelogram';
	}
    return $classes;
}
add_filter( 'nav_menu_css_class', 'add_custom_nav_menu_item_class', 10, 2);

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
				$pictures = $wpdb->get_results("SELECT * FROM wp_ngg_pictures WHERE pid='211' OR pid='221' OR pid='242'"
																			   ."OR pid='334' OR pid='288' OR pid='268'"
																			   ."OR pid='340' OR pid='243' OR pid='379'"
				);
				$i=1;
				foreach( $pictures as $p ) {
					if ($i == 1) {
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}

					else if ($i == 2) {
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}

					else if ($i == 3) {
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}
						
					else if ($i == 4) {
						echo ('</div>');
						echo ('<div style="padding:6px 0 0 73px; clear:both;">');
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}

					else if ($i == 5) {
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}

					else if ($i == 6) {
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}

					else if ($i == 7) {
						echo ('</div>');
						echo ('<div style="padding:6px 0 0 89px; clear:both;">');
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}
					
					else if ($i == 8) {
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');					
					}

					else if ($i == 9) {
						echo ('</div>');
						echo ('<div class="masked-image">');
						echo do_shortcode("[singlepic id=".$p->pid.",999,9]");
						echo ('<a class="ngg-fancybox" target="_self" data-title="'.$p->alttext.'" data-image-id="'.$p->pid.'" href="http://tourofcrete.com/wp-content/gallery/tour-of-crete-2016/'.$p->filename.'"><div class="hover-image"></div></a>');
						echo ('</div>');
					}
						
					else {
						break;
					}

					$i++;
				}
				?>
         </div>
    </div> 
       
    <?php
}
?>