<?php
/*
template name: The Race
*/
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

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
		  'orderby'				=> 'meta_value_num',
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
			<!-- For mapbox map container -K -->
			<script src='https://api.mapbox.com/mapbox.js/v2.2.4/mapbox.js'></script>
			<link href='https://api.mapbox.com/mapbox.js/v2.2.4/mapbox.css' rel='stylesheet' />
			<!-- For fullscreen mode button -K -->
			<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.2/Leaflet.fullscreen.min.js'></script>
			<link href='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css' rel='stylesheet' />
			<!-- For labels -K -->
			<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.js'></script>
			<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.css' rel='stylesheet' />
			<script>
				L.mapbox.accessToken = 'pk.eyJ1IjoibWFuaW5hcyIsImEiOiJjaWpzYmRvZW4wMGFodmxtN3M3bHV6cXhrIn0.Xf1uqAaJ4QSFgmM_UinFkg';
				var map = L.mapbox.map('map', 'mapbox.streets', {attributionControl: false}).setView([35.2275941, 24.7696794], 8);
				var featureLayer = L.mapbox.featureLayer()
						.loadURL('http://tourofcrete.com/wp-content/themes/tourofcrete/geojson/ToC17_allstages_thres=0,0005_N=6_dark.geojson')
						.addTo(map);  
				L.control.fullscreen().addTo(map);
				
				map.once('move', function() {
					featureLayer.eachLayer(function(marker) {
						if (marker.toGeoJSON().properties.name === 'S1  Heraklion - Sfakia 140Km 3133m') {
							marker.bindLabel('S1  Heraklion - Sfakia 140Km 3133m').addTo(map);
						}
						else if (marker.toGeoJSON().properties.name === 'S2 Sfakia - Platanias 105Km 2769m') {
							marker.bindLabel('S2 Sfakia - Platanias 105Km 2769m').addTo(map);
						}
						else if (marker.toGeoJSON().properties.name === 'S3 Topolianos Gyros 123Km 2525m') {
							marker.bindLabel('S3 Topolianos Gyros 123Km 2525m').addTo(map);
						}
						else if (marker.toGeoJSON().properties.name === 'S4 Therisso Gorge 52Km 1073m') {
							marker.bindLabel('S4 Therisso Gorge 52Km 1073m').addTo(map);
						}
						else if (marker.toGeoJSON().properties.name === 'S5 Platanias - Rethymnon 98Km 1682m') {
							marker.bindLabel('S5 Platanias - Rethymnon 98Km 1682m').addTo(map);
						}
						else if (marker.toGeoJSON().properties.name === 'S6 Rethymnon - Skinakas - Heraklion 139Km 3670m') {
							marker.bindLabel('S6 Rethymnon - Skinakas - Heraklion 139Km 3670m').addTo(map);
						}
						else {
							marker.bindLabel('Stage start').addTo(map);
						}
					 });
				});
			</script>
			<!-- <div><br></div>
			<img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/stages.jpg" /> --> 
			<?php 
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
				
				echo "<article>";
					echo "<div class='entry-content'>";
						echo "<p>". get_post_field('post_content', 92) . "</p>";
					echo "</div>";
				echo "</article>";
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
