<?php
/**
 * FIXME: Edit Title Content
 *
 * FIXME: Edit Description Content
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 * FIXME: POINT USERS TO DOWNLOAD OUR STARTER CHILD THEME AND DOCUMENTATION
 *
 * @category Cyber Chimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

if ( !class_exists( 'CyberChimpsBreadcrumbs' ) ) {
	class CyberChimpsBreadcrumbs {
		
		protected static $instance;
		
		/* Static Singleton Factory Method */
		public static function instance() {
			if (!isset(self::$instance)) {
				$className = __CLASS__;
				self::$instance = new $className;
			}
			return self::$instance;
		}	
		
		/**
		 * Initializes plugin variables and sets up WordPress hooks/actions.
		 *
		 * @return void
		 */
		protected function __construct( ) {
			add_action( 'init', array( $this, 'init'), 10 );
		}
		
		/**
		 * Run on applied action init
		 */
		public function init() {
			if (self::check_yoast_breadcrumbs()) {
				// load yoast breadcrumbs
				add_action('breadcrumbs', 'yoast_breadcrumb');
			} else if (self::check_navxt_breadcrumbs()) {
				// load navxt breadcrumbs
				add_action('breadcrumbs', 'bcn_display');
			} else {
				// load default breadcrumbs
				add_action( 'breadcrumbs', array( $this, 'default_display' ) );
			}
		}
		
		// FIXME: Fix documentation
		public function default_display() {		
			// TODO: Work on code to add more features and clean up markup
			$delimiter = ' &raquo; ';
			$before = '<span class="current">'; // tag before the current crumb
			$after = '</span>'; // tag after the current crumb
			
			if ( !is_home() && !is_front_page() || is_paged() ) {
				global $post;
				
				echo '<div class="breadcrumbs">';
				echo '<div class="row-fluid">';
				echo '<a href="' . get_site_url() . '">' . __('Home', 'cyberchimps') . '</a> ' . $delimiter . ' ';
		
				if ( is_category() ) {
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$thisCat = $cat_obj->term_id;
					$thisCat = get_category($thisCat);
					$parentCat = get_category($thisCat->parent);
					if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
					echo $before .  __('Archive for category ', 'cyberchimps') . '"' . single_cat_title('', false) . '"' . $after;
		
				} elseif ( is_day() ) {
					echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
					echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
					echo $before . get_the_time('d') . $after;
		
				} elseif ( is_month() ) {
					echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
					echo $before . get_the_time('F') . $after;
		
				} elseif ( is_year() ) {
					echo $before . get_the_time('Y') . $after;
		
				} elseif ( is_single() && !is_attachment() ) {
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						echo '<a href="' . get_site_url() . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
						echo $before . get_the_title() . $after;
					} else {
						$cat = get_the_category(); $cat = $cat[0];
						echo is_wp_error( $cat_parents = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') ) ? '' : $cat_parents;
						echo $before . get_the_title() . $after;
					}
					
				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());
					echo $before . $post_type->labels->singular_name . $after;
		
				} elseif ( is_attachment() ) {
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID); $cat = $cat[0];
					echo is_wp_error( $cat_parents = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') ) ? '' : $cat_parents;
					echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
					echo $before . get_the_title() . $after;
		
				} elseif ( is_page() && !$post->post_parent ) {
					echo $before . get_the_title() . $after;
		
				} elseif ( is_page() && $post->post_parent ) {
					$parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
					echo $before . get_the_title() . $after;
		
				} elseif ( is_search() ) {
					echo $before . __('Search results for ', 'cyberchimps') . '"' . get_search_query() . '"' . $after;
		
				} elseif ( is_tag() ) {
					echo $before . __('Posts tagged ', 'cyberchimps') . '"' . single_tag_title('', false) . '"' . $after;
		
				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					echo $before . __('Articles posted by ', 'cyberchimps') . $userdata->display_name . $after;
		
				} elseif ( is_404() ) {
					echo $before . __('Error 404', 'cyberchimps') . $after;
				}
		
				if ( get_query_var('paged') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
					echo __('Page', 'cyberchimps') . ' ' . get_query_var('paged');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
				}
				echo '</div>';
				echo '</div>';
			}
		}
		
		// FIXME: Fix documentation
		private function check_yoast_breadcrumbs() {
			// check if yoast plugin is installed and activated
			if ( cyberchimps_detect_plugin( array('constants' => array( 'WPSEO_VERSION' ) ) ) ) {
				$options = get_wpseo_options(); // get yoast options
				
				// check if breadcrumbs are enabled and yoast_breadcrumb function exists
				if ( ( isset($options['breadcrumbs-enable']) && $options['breadcrumbs-enable'] ) && ( function_exists( 'yoast_breadcrumb' ) ) ) {
					return true;
				}
			}
		
			return false;
		}
		
		// FIXME: Fix documentation
		private function check_navxt_breadcrumbs() {
			// check if navxt breadcrumbs plugin is installed and activated
			if ( cyberchimps_detect_plugin( array('classes' => array( 'bcn_breadcrumb' ) ) ) ) {
				
				// check if bcn_display function exists
				if ( function_exists( 'bcn_display' ) ) {
					return true;
				}
			}
		
			return false;
		}
	}
}
CyberChimpsBreadcrumbs::instance();