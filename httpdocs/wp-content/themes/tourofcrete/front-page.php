<?php
/*
template name: Front-page
*/
add_action('wp_head', 'ScriptSlider');
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );
 
function ScriptSlider(){ ?>
	<script async src="<?php bloginfo('stylesheet_directory'); ?>/js/unslider.min.js"></script>
	<?php
}

function child_do_custom_loop() {
	?>
    <div class="homeFullFrame">
        <div class="frameContent">
            <div class='content'>
                <?php genesis_do_loop(); ?>
                <div class='more'>
                	<div class="left"></div>
                    <?php   if      (ICL_LANGUAGE_CODE == 'en') { $read_more_target = "/discover-crete/";   }
                            elseif  (ICL_LANGUAGE_CODE == 'el') { $read_more_target = "/el/discover-crete/";}
                            else                                { $read_more_target = "/discover-crete/";   }
                    ?>
                	<a href="<?php echo $read_more_target; ?>"><?php _e('Read More','tourofcrete');?></a>
                    <div class="right"></div>
                </div>
            </div>
            
            <a href="https://goo.gl/4ajmXQ" target="_blank">
		        <div class='slider'>
		            <div id="fader">
		            	<ul>
				            <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-1.png" /></li>
				            <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-2.png" /></li>
				            <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-3.png" /></li>
				            <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-4.png" /></li>
				            <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-5.png" /></li>
		            	</ul>
		            </div>
		        </div>
		    </a>
            <div class="clear"></div>
            <div class="banners">
            	<?php   if      (ICL_LANGUAGE_CODE == 'en') { $registration_target = "/registration/";   }
                        elseif  (ICL_LANGUAGE_CODE == 'el') { $registration_target = "/el/registration/";}
                        else                                { $registration_target = "/registration/";   }
                ?>
                <a href="<?php echo $registration_target; ?>">
					<div id="box-shadow-indiv"></div>
                	<div class="individuals banner">
                		<?php _e('INDIVIDUALS','tourofcrete');?>
                		<span> > <?php _e('Register','tourofcrete');?> < </span>
                	</div>
                </a>
                <a href="<?php echo $registration_target; ?>">
					<div id="box-shadow-teams"></div>
                	<div class="teams banner">
                		<?php _e('GROUPS','tourofcrete');?>
                		<span> > <?php _e('Register','tourofcrete');?> < </span>
                	</div>
                </a>
                <a href="<?php echo $registration_target; ?>">
					<div id="box-shadow-noncy"></div>
                	<div class="non-cyclists banner">
                		<?php _e('NON-CYCLISTS','tourofcrete');?>
                		<span> > <?php _e('Register','tourofcrete');?> < </span>
                	</div>
                </a>
            </div>
        </div>
     </div>
  <?php	
}

genesis(); ?>
