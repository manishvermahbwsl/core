<?php
/**
 * FIXME: Edit Title Content
 *
 * FIXME: Edit Description Content
 *
 * Please do not edit this file. This file is part of the Response core framework and all modifications
 * should be made in a child theme.
 * FIXME: POINT USERS TO DOWNLOAD OUR STARTER CHILD THEME AND DOCUMENTATION
 *
 * @category Response
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// FIXME: Fix documentation
function response_load_pagination() {
	// TODO: Only check once maybe on plugin activation and maybe throw alerts that there is a plugin conflict or maybe allow a dropdown when breadcrumb is assigned that allows you to choose which plugin to use. Plugin options would be added as they become available
	if (response_yoast_breadcrumbs()) {
		// load yoast breadcrumbs
		add_action('response_before_content', 'yoast_breadcrumb');
	} else if (response_navxt_breadcrumbs()) {
		// load navxt breadcrumbs
		add_action('response_before_content', 'bcn_display');
	} else {
		// load default pagination
		add_action('response_after_content', 'response_default_pagination');
	}
}
add_action('init', 'response_load_pagination');

// FIXME: Fix documentation
function response_default_pagination() {
	global $wp_query;  
      
    $total_pages = $wp_query->max_num_pages;  
      
    if ($total_pages > 1){  
      
      $current_page = max(1, get_query_var('paged'));  
        
      echo '<div class="pagination">';  
      echo '<ul>';
      echo paginate_links(array(  
          'base' => get_pagenum_link(1) . '%_%',  
          'format' => '/page/%#%',  
          'current' => $current_page,  
          'total' => $total_pages,  
          'prev_text' => 'Prev',  
          'next_text' => 'Next'  
        ));  
      echo '</ul>';  
      echo '</div>';  
        
    }

	// TODO: Work on code to add more features and clean up markup
	?>
	

<?php
}

/*
// FIXME: Fix documentation
function response_yoast_breadcrumbs() {
	// check if yoast plugin is installed and activated
	if ( response_detect_plugin( array('constants' => array( 'WPSEO_VERSION' ) ) ) ) {
		$options = get_wpseo_options(); // get yoast options
		
		// check if breadcrumbs are enabled and yoast_breadcrumb function exists
		if ( ( isset($options['breadcrumbs-enable']) && $options['breadcrumbs-enable'] ) && ( function_exists( 'yoast_breadcrumb' ) ) ) {
			return true;
		}
	}

	return false;
}

// FIXME: Fix documentation
function response_navxt_breadcrumbs() {
	// check if navxt breadcrumbs plugin is installed and activated
	if ( response_detect_plugin( array('classes' => array( 'bcn_breadcrumb' ) ) ) ) {
		
		// check if bcn_display function exists
		if ( function_exists( 'bcn_display' ) ) {
			return true;
		}
	}

	return false;
}
*/