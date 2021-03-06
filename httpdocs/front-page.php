<?php
/*
template name: Front-page
*/
add_action('wp_head', 'ScriptSlider');
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
add_action( 'genesis_after_content_sidebar_wrap', 'news_gallery' );
 
function ScriptSlider(){ ?>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/unslider.min.js"></script>
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
                	<a href="/the-tour-of-crete/"><?php _e('Read More','tourofcrete');?>.</a>
                    <div class="right"></div>
                </div>
            </div>
            <div class='slider'>
                <div id="fader">
                    <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-1.png" /></li>
                    <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-2.png" /></li>
                    <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-3.png" /></li>
                    <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-4.png" /></li>
                    <li><img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/slide-show-5.png" /></li>
                </div>
            </div>
            <div class="clear"></div>
            <div class="banners">
                <a href="<?php get_site_url(); ?>/registration/individuals/"><div class="individuals banner"><?php _e('INDIVIDUALS','tourofcrete');?><span> > <?php _e('Register','tourofcrete');?> < </span></div></a>
                <a href="<?php get_site_url(); ?>/registration/teams/"><div class="teams banner"><?php _e('TEAMS','tourofcrete');?><span> > <?php _e('Register','tourofcrete');?> < </span></div></a>
                <a href="<?php get_site_url(); ?>/registration/non-cyclists/"><div class="non-cyclists banner"><?php _e('NON CYCLISTS','tourofcrete');?><span> > <?php _e('Register','tourofcrete');?> < </span></div></a>
            </div>
        </div>
     </div>
  <?php	
}

genesis(); ?>