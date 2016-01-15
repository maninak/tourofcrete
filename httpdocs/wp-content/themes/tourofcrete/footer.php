<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

genesis_structural_wrap( 'site-inner', 'close' );
echo '</div>'; //* end .site-inner or #inner

do_action( 'genesis_before_footer' );

//do_action( 'genesis_footer' );


do_action( 'genesis_after_footer' );

echo '</div>'; //* end .site-container or #wrap
?>
	<div class="sponsors">
    	<div class="title">
        	<h2><?php _e('SPONSORED BY','tourofcrete');?></h2>
        </div>
    	<div class="content" align="center">
            <a href="http://www.cretansportscycling.gr/" target="_blank" alt="Adventure Guided Tours">
               <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/a-g-t.jpg" title="Adventure Guided Tours" border="0" />
            </a>
            <a href="http://fotomaris.gr/" target="_blank" alt="Foto Maris">
               <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/fotomaris.jpg" title="Foto Maris" border="0" />
            </a>
            <a href="#" alt="Cyclomania">
               <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/cyclomania.jpg" title="Cyclomania" border="0" />
            </a>
            <a href="http://www.minoan.gr/en/crete" alt="Minoan Lines">
               <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/minoan.jpg" title="Minoan Lines" border="0" />
            </a>
            <a href="http://www.mbike.gr/" alt="MBike">
               <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/mbike.jpg" title="MBike" border="0" />
            </a>
        </div>
    </div>
<?php
do_action( 'genesis_after' );
wp_footer(); //* we need this for plugins
?>
</body>
</html>
