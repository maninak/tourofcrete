<?php
/*
template name: The Race
*/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );

function child_do_custom_loop() {
	global $wp_query;
	global $post;
	$pageType = get_post_meta( get_the_ID(), 'page_type', true );
?>
    <div class="FullFrame">
           
            <?php 
            if ($pageType == 'stages'){
                getStageInfo('stages',29);
            }
            elseif ($pageType == 'stagedetails'){
                getStageInfo('stagedetails',29);
            }
            elseif ($pageType == 'venues'){
                getStageInfo('venues',33);
            }
            elseif ($pageType == 'venuedetails'){
                getStageInfo('venuedetails',33);
            }
            else {
				echo '<div class="race-left">';
					wp_nav_menu(array('theme_location' => 'the-race-menu', 'container_class' => 'race-menu'));
				echo "</div>";
				echo '<div class="race-right">';
                	genesis_do_loop(); 
				echo '</div>';
                ?><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/the-race.jpg" /> <?php 
            }
            ?>
            
       

    </div>
<?php  
}



function getStageInfo($type, $parentID){
	global $post;
	//get children of page and display with custom fields
	
	if (($type == 'stages') || ($type == 'stagedetails')) {
		$args=array(
		  'post_parent' => $parentID,
	//	  'order' => 'ASC',
		  'post_type' => 'page',
		  'meta_key'			=> 'orderstage',
		  'orderby'			=> 'meta_value_num',
		  'order'				=> 'ASC'	  
		);
	}
	elseif (($type == 'venues') || ($type == 'venuedetails')) {
		$args=array(
		  'post_parent' => $parentID,
		  'post_type' => 'page',
		  'order' => 'ASC'
		);	
	}
	$my_query = null;
	$my_query = new WP_Query($args);
	
	if( $my_query->have_posts() ) {
		if ($type == 'stages') {
			echo '<div class="race-left">';
				wp_nav_menu(array('theme_location' => 'the-race-menu', 'container_class' => 'race-menu'));
			echo "</div>";
			
			echo '<div class="race-right">';
				echo "<ul class='all-stages-menu'>";
				
				while ($my_query->have_posts()) : $my_query->the_post(); 
					$stageDay = get_post_meta($post->ID, 'day', true);
					$stageRoute = get_post_meta($post->ID, 'route', true);
					$stageKilometers = get_post_meta($post->ID, 'kilometers', true);
					$stageAscent = get_post_meta($post->ID, 'ascent', true);
					?>
					<li class="menuitem">
                    	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    		<div class="thetitle">	<?php the_title(); ?>			</div>
		                    <div class="day">		<?php echo $stageDay; ?>		</div>
		                    <div class="route">		<?php echo $stageRoute; ?>		</div>
		                    <div class="kilometers"><?php echo $stageKilometers; ?>	</div>
		                    <div class="ascent">	<?php echo $stageAscent; ?>		</div>
                        </a>
                    </li>
					<?php 
				endwhile; 
				echo "</ul>";
			echo "</div>";
			?>
			<div id='map'></div>
			<script src='https://api.mapbox.com/mapbox.js/v2.2.4/mapbox.js'></script>
			<link href='https://api.mapbox.com/mapbox.js/v2.2.4/mapbox.css' rel='stylesheet' />
			<!-- For fullscreen mode button -K -->
			<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.2/Leaflet.fullscreen.min.js'></script>
			<link href='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.2/leaflet.fullscreen.css' rel='stylesheet' />
			<script>
				L.mapbox.accessToken = 'pk.eyJ1IjoibWFuaW5hcyIsImEiOiJjaWpzYmRvZW4wMGFodmxtN3M3bHV6cXhrIn0.Xf1uqAaJ4QSFgmM_UinFkg';
				var map = L.mapbox.map('map', 'mapbox.streets')
						.setView([35.2275941, 24.7696794], 8);
				var featureLayer = L.mapbox.featureLayer()
						.loadURL('https://gist.githubusercontent.com/anonymous/dbcb9fbc1adf5958471e/raw/f326fc0fa63acade63146c74bfdbb8021afa5bdc/map.geojson')
						.addTo(map);  
			 	L.control.fullscreen().addTo(map);
			</script>
			<br>
			<img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/stages.jpg" /> <?php 
		}
		elseif ($type == 'stagedetails') {
			$stageDescription = get_post_meta($post->ID, 'stage_description', true);
			$graphicImage = get_field('graphic_image');
			$graphicImageBig = get_field('graphic_image_big');
			$stageTable = get_field('stage_details_table');
			$mapGPX = get_field('gpx_map');
			$children = wp_list_pages('title_li=&child_of=29&echo=0');
			
			echo '<div class="race-left">';
				wp_nav_menu(array('theme_location' => 'the-race-menu', 'container_class' => 'race-menu'));
				remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
				//genesis_do_loop();
			echo "</div>";

			echo '<div class="race-right">';
				echo "<ul class='stages-menu subpages'>";
					echo $children;
				echo "</ul>";				
			?>
				<h1><span><?php echo $stageDescription; ?></span></h1>
            	<?php genesis_do_loop(); ?>
                
				<?php if( !empty($graphicImage) ): ?>
                    <?php if( !empty($graphicImageBig) ): ?>
                        <a class="ngg-fancybox {titleShow:true}" target="_self" href="<?php echo $graphicImageBig['url']; ?>" title="<?php echo $stageDescription; ?>">
                    <?php endif; ?> 
                        <img src="<?php echo $graphicImage['url']; ?>" alt="<?php the_title(); ?>" />
                    <?php if( !empty($graphicImageBig) ): ?>
                        </a>
                    <?php endif; ?> 
                <?php endif;
				
				if( !empty($mapGPX) ): 
					echo do_shortcode("[sgpx gpx='". $mapGPX ."']");
				endif;
				
				if( !empty($stageTable) ): 
					echo do_shortcode("[table id='".$stageTable."']");
				endif;
				
				
				
			echo '</div>';
			
			
			
		}
		elseif ($type == 'venues') {
			
			$venueImage = get_field('venue_image',92);
			
			echo '<div class="race-left">';
				wp_nav_menu(array('theme_location' => 'the-race-menu', 'container_class' => 'race-menu'));
			echo "</div>";

			echo '<div class="race-right">';
				echo "<ul class='venues-menu subpages'>";
					wp_list_pages('child_of='.$parentID.'&sort_column=post_date&title_li=');
				echo "</ul>";
			
				echo "<div class='entry-content'>";
					echo "<p>". get_post_field('post_content', 92) . "</p>";
					echo "<div class=\"sharedaddy sd-sharing-enabled\"><div class=\"robots-nocontent sd-block sd-social sd-social-icon sd-sharing\"><h3 class=\"sd-title\">Let the world know:</h3><div class=\"sd-content\"><ul><li class=\"share-facebook\"><a rel=\"nofollow\" data-shared=\"sharing-facebook-33\" class=\"share-facebook sd-button share-icon no-text\" href=\"http://tourofcrete.com/the-race/venues/heraklion/?share=facebook&amp;nb=1\" target=\"_blank\" title=\"Share on Facebook\"><span></span><span class=\"sharing-screen-reader-text\">Share on Facebook (Opens in new window)</span></a></li><li class=\"share-twitter\"><a rel=\"nofollow\" data-shared=\"sharing-twitter-33\" class=\"share-twitter sd-button share-icon no-text\" href=\"http://tourofcrete.com/the-race/venues/heraklion/?share=twitter&amp;nb=1\" target=\"_blank\" title=\"Click to share on Twitter\"><span></span><span class=\"sharing-screen-reader-text\">Click to share on Twitter (Opens in new window)</span></a></li><li><a href=\"#\" class=\"sharing-anchor sd-button share-more\"><span>More</span></a></li><li class=\"share-end\"></li></ul><div class=\"sharing-hidden\"><div class=\"inner\" style=\"display: none;\"><ul><li class=\"share-email share-service-visible\"><a rel=\"nofollow\" data-shared=\"\" class=\"share-email sd-button share-icon no-text\" href=\"http://tourofcrete.com/the-race/venues/heraklion/?share=email&amp;nb=1\" target=\"_blank\" title=\"Click to email this to a friend\"><span></span><span class=\"sharing-screen-reader-text\">Click to email this to a friend (Opens in new window)</span></a></li><li class=\"share-print\"><a rel=\"nofollow\" data-shared=\"\" class=\"share-print sd-button share-icon no-text\" href=\"http://tourofcrete.com/the-race/venues/heraklion/#print\" target=\"_blank\" title=\"Click to print\"><span></span><span class=\"sharing-screen-reader-text\">Click to print (Opens in new window)</span></a></li><li class=\"share-end\"></li><li class=\"share-end\"></li></ul></div></div></div></div></div>";
				echo "</div>";
			echo "</div>";	
			if( !empty($venueImage) ): ?>
				 <img src="<?php echo $venueImage['url']; ?>" alt="<?php the_title(); ?>" />
			<?php endif;

		}
		elseif ($type == 'venuedetails') {
			
			echo '<div class="race-left">';
				wp_nav_menu(array('theme_location' => 'the-race-menu', 'container_class' => 'race-menu'));
			echo "</div>";
			
			echo '<div class="race-right">';
				echo "<ul class='venues-menu subpages'>";
					wp_list_pages('child_of='.$parentID.'&sort_column=post_date&title_li=');
				echo "</ul>";
				
				$venueImage = get_field('venue_image');
				remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
				genesis_do_loop(); 
				
			echo "</div>";
			if( !empty($venueImage) ): ?>
				 <img src="<?php echo $venueImage['url']; ?>" alt="<?php the_title(); ?>" />
			<?php endif;

		}
		else {
			echo "default";
		}
	}
	wp_reset_query();  // Restore global post data stomped by the_post().
}

genesis(); ?>
