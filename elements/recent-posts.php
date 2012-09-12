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

add_action( 'recent_posts', 'recent_posts_content' );

function recent_posts_content() {
	global $options, $wp_query, $custom_excerpt, $post;
	$custom_excerpt = 'recent';
	
	if (is_page()){
		$title = get_post_meta($post->ID, 'cyberchimps_recent_posts_title' , true);;
		$toggle = get_post_meta($post->ID, 'cyberchimps_recent_posts_title_toggle' , true);;
		$recent_posts_image = get_post_meta($post->ID, 'cyberchimps_recent_posts_images_toggle' , true);;
		$category = get_post_meta($post->ID, 'cyberchimps_recent_posts_category' , true);

	} else {
	
		/* To be modified after theme option is implemented 
		
		$title = $options->get('_blog_recent_posts_title');
		$toggle = $options->get('_blog_recent_posts_title_toggle');
		$recent_posts_image = $options->get('_blog_recent_posts_images_toggle');
		$category = $options->get('_blog_recent_posts_category'); 
		
		*/
	}
	
	if ($category != 'all') {
		$blogcategory = $category;
	}
	else {
		$blogcategory = "";
	}
	
	$args = array( 'numberposts' => 4, 'post__not_in' => get_option( 'sticky_posts' ), 'category_name' => $blogcategory );
	$recent_posts = get_posts( $args );
	
?>
	<div class="row-fluid">
		<div id="recent_posts">
			<?php if ($toggle == '1' OR $toggle == 'on'): ?>
				<h2 class="entry-title"><?php echo $title; ?></h2>
			<?php endif; ?>
			<div id="recent_posts_wrap">
			
			<?php if ( $recent_posts ) :
				foreach($recent_posts as $post) : setup_postdata($post); ?>
					<div id="recent-posts-container" class="span3">
					
						<h5 class="recent_posts_post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
						<h6 class="recent_posts_byline">
							<?php the_time( 'd/m/y');?> - <?php the_category(', ') ?> - 
							<?php comments_popup_link( 'No Comments', '1 Comment', '% Comments' ); ?>
						</h6>
						<?php
							if ( has_post_thumbnail() && $recent_posts_image == '1' OR has_post_thumbnail() && $recent_posts_image == 'on' ) {
								echo '<div class="recent-posts-image">';
								echo '<a href="' . get_permalink($post->ID) . '" >';
								the_post_thumbnail();
								echo '</a>';
								echo '</div>';
							}
						?>
						
						<?php the_excerpt(); ?>	
					</div>
				<?php endforeach; wp_reset_postdata(); ?>
				
				<div class="clear-both"></div>
				
			<?php else : ?>
				
				<h2>Not Found</h2>
				
			<?php endif; ?>
			
			</div>
		</div>
	</div>
<?php } ?>