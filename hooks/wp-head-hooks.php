<?php
/**
 * Title: wp-head hooks
 *
 * Description: Defines actions/hooks to be called in wp-head action.
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category Cyber Chimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

if( !function_exists( 'cyberchimps_css_styles' ) ) {
// adds styles to header created from functions at the bottom
	function cyberchimps_css_styles() {
		$body_styles      = cyberchimps_body_styles();
		$link_styles      = cyberchimps_link_styles();
		$container_styles = cyberchimps_layout_styles();
		$headings_styles  = cyberchimps_headings_styles();
		?>

		<style type="text/css" media="all">
			<?php if ( !empty( $body_styles ) ) : ?>
			body {
			<?php  // Changed to previous code for minor font changes
				foreach( $body_styles as $key => $body_style ): ?> <?php echo $key; ?> : <?php echo $body_style; ?>;
			<?php 	endforeach; ?>
			}

			<?php endif; ?>
			<?php if ( !empty( $link_styles ) ) : ?>
			<?php foreach( $link_styles as $key2 => $link_style ): ?>
			<?php echo $key2; ?>
			{
				color:
			<?php echo $link_style; ?>
			;
			}
			<?php endforeach; ?>
			<?php endif; ?>
			<?php if ( !empty( $container_styles ) ) : ?>
			.container {
			<?php foreach( $container_styles as $key3 => $container_style ): ?> <?php echo $key3; ?> : <?php echo $container_style; ?>px;
			<?php endforeach; ?>
			}

			<?php endif; ?>

			<?php if ( !empty( $headings_styles[0] ) ) { ?>
					h1 {
						<?php foreach( $headings_styles[0] as $key => $headings_style_1 ) {
						// Changed to previous code for minor font changes
						echo $key; ?> : <?php echo $headings_style_1; ?>;
						<?php } ?>
						}
            <?php }

                  if ( !empty( $headings_styles[1] ) ) { ?>
					h2 {
						<?php foreach( $headings_styles[1] as $key => $headings_style_2 ) {
							echo $key; ?> : <?php echo $headings_style_2; ?>;
						<?php } ?>
						}
            <?php }

                  if ( !empty( $headings_styles[2] ) ) { ?>
					h3 {
						<?php foreach( $headings_styles[2] as $key => $headings_style_3 ) {
							echo $key; ?> : <?php echo $headings_style_3; ?>;
						<?php } ?>
						}
			<?php }

			$width = intval( cyberchimps_get_option( 'max_width' ) ) . 'px';
			if( !cyberchimps_get_option( 'responsive_design', 'checked' ) ) {
			?>
				@media screen and (max-width: <?php echo $width; ?>) {
					.container-full-width {
						width: <?php echo $width; ?>;
					}
				}
			<?php
			}


			?>

		</style>
		<?php
		return;
	}
}

add_action( 'wp_head', 'cyberchimps_css_styles', 50 );

// Creat headings_styles array from options.
function cyberchimps_headings_styles() {

	// Set header font family.
	$headings_styles_1      = cyberchimps_get_option( 'font_family_h1' );
	$google_font_h1 = cyberchimps_get_option( 'google_font_h1' );

    $headings_styles_2      = cyberchimps_get_option( 'font_family_h2' );
	$google_font_h2 = cyberchimps_get_option( 'google_font_h2' );

    $headings_styles_3      = cyberchimps_get_option( 'font_family_h3' );
	$google_font_h3 = cyberchimps_get_option( 'google_font_h3' );


	// older versions will have saved the font family as a string so we need to check for that first
	if( is_array( $headings_styles_1 ) ) {
		$headings_styles_1['font-family'] = $headings_styles_1['face'];
foreach( $headings_styles_1 as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$headings_styles_1[$option] = $value;
			}
		}
	}
	else {
		$headings_styles_1                = array();
		$headings_styles_1['font-family'] = $headings_styles_1;
		foreach( $headings_styles_1 as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$headings_styles_1[$option] = $value;
			}
		}
	}

    if( is_array( $headings_styles_2 ) ) {
		$headings_styles_2['font-family'] = $headings_styles_2['face'];
                foreach( $headings_styles_2 as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$headings_styles_2[$option] = $value;
			}
		}

	}
	else {
		$headings_styles_2                = array();
		$headings_styles_2['font-family'] = $headings_styles_2;
                foreach( $headings_styles_2 as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$headings_styles_2[$option] = $value;
			}
		}

	}

    if( is_array( $headings_styles_3 ) ) {
		$headings_styles_3['font-family'] = $headings_styles_3['face'];
		 foreach( $headings_styles_3 as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$headings_styles_3[$option] = $value;
			}
		}
	}
	else {
		$headings_styles_3                = array();
		$headings_styles_3['font-family'] = $headings_styles_3;
                foreach( $headings_styles_3 as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$headings_styles_3[$option] = $value;
			}
		}

	}

	// Check if Google fonts have been selected - h1
	if( $headings_styles_1['font-family'] == "Google Fonts" && $google_font_h1 != "" ) {
		$headings_styles_1['font-family'] = '"'.$google_font_h1.'"';

		// Check if SSL is present, if so then use https othereise use http
		$protocol = is_ssl() ? 'https' : 'http';

		wp_register_style( 'google-font-h1', $protocol . '://fonts.googleapis.com/css?family=' . $google_font_h1 );
		wp_enqueue_style( 'google-font-h1' );
	}

	// Check if Google fonts have been selected - h2
    if( $headings_styles_2['font-family'] == "Google Fonts" && $google_font_h2 != "" ) {
		$headings_styles_2['font-family'] = '"'.$google_font_h2.'"';

		// Check if SSL is present, if so then use https othereise use http
		$protocol = is_ssl() ? 'https' : 'http';
		wp_register_style( 'google-font-h2', $protocol . '://fonts.googleapis.com/css?family=' . $google_font_h2 );
		wp_enqueue_style( 'google-font-h2' );
	}

	// Check if Google fonts have been selected - h3
    if( $headings_styles_3['font-family'] == "Google Fonts" && $google_font_h3 != "" ) {
		$headings_styles_3['font-family'] = '"'.$google_font_h3.'"';

		// Check if SSL is present, if so then use https othereise use http
		$protocol = is_ssl() ? 'https' : 'http';

		wp_register_style( 'google-font-h3', $protocol . '://fonts.googleapis.com/css?family=' . $google_font_h3 );
		wp_enqueue_style( 'google-font-h3' );
	}

	//TODO recreate original settings so they are actually named by the css style they refer to
	// eg face becomes font-family, size is font-size etc

	unset( $headings_styles_1['size'] );
	unset( $headings_styles_1['face'] );
	unset( $headings_styles_1['color'] );
	unset( $headings_styles_1['style'] );

	unset( $headings_styles_2['size'] );
	unset( $headings_styles_2['face'] );
	unset( $headings_styles_2['color'] );
	unset( $headings_styles_2['style'] );

	unset( $headings_styles_3['size'] );
	unset( $headings_styles_3['face'] );
	unset( $headings_styles_3['color'] );
	unset( $headings_styles_3['style'] );

    $headings_styles = array($headings_styles_1, $headings_styles_2, $headings_styles_3);

	return $headings_styles;
}

// creates body_styles array from options
function cyberchimps_body_styles() {
	$body_styles = array();

	if( cyberchimps_get_option( 'typography_options' ) ) {
		$typography_options = cyberchimps_get_option( 'typography_options' );
		// changes terminology for typography to css elements
		foreach( $typography_options as $option => $value ) {
			if( $option == 'size' ) {
				$option = 'font-size';
			}
			if( $option == 'face' ) {
				$option = 'font-family';
			}
			if( $option == 'style' ) {
				$option = 'font-weight';
			}
			if( $value != '' ) {
				$body_styles[$option] = $value;
			}
		}
	}

	// Set font-family if google font is on
	$google_font = cyberchimps_get_option( 'google_font_field' );

	if( $body_styles['font-family'] == "Google Fonts" && $google_font != "" ) {
		$body_styles['font-family'] = $google_font;

		// Check if SSL is present, if so then use https othereise use http
		$protocol = is_ssl() ? 'https' : 'http';

		wp_register_style( 'google-font', $protocol . '://fonts.googleapis.com/css?family=' . $google_font );
		wp_enqueue_style( 'google-font' );
	}
	if( cyberchimps_get_option( 'text_colorpicker' ) ) {
		$body_styles['color'] = cyberchimps_get_option( 'text_colorpicker' );
	}
	return $body_styles;
}

// creates link color array for just a tag
function cyberchimps_link_styles() {
	$link_styles = array();
	if( cyberchimps_get_option( 'link_colorpicker' ) ) {
		$link_styles['a'] = cyberchimps_get_option( 'link_colorpicker' );
	}
	if( cyberchimps_get_option( 'link_hover_colorpicker' ) ) {
		$link_styles['a:hover'] = cyberchimps_get_option( 'link_hover_colorpicker' );
	}

	return $link_styles;
}

// creates width for main container of website
function cyberchimps_layout_styles() {
	$container_styles = array();
	if( cyberchimps_get_option( 'max_width' ) ) {
		$width = intval( cyberchimps_get_option( 'max_width' ) );
		$key   = ( cyberchimps_get_option( 'responsive_design', 'checked' ) ) ? 'max-width' : 'width';
		if( $width < 400 || empty( $width ) ) {
			$container_styles[$key] = 1020;
		}
		else {
			$container_styles[$key] = $width;
		}
	}

	return $container_styles;
}

// add favicon
function cyberchimps_favicon() {
	if( cyberchimps_get_option( 'custom_favicon' ) ) :
		$favicon = cyberchimps_get_option( 'favicon_uploader' );
		if( $favicon != '' ):?>
			<link rel="shortcut icon" href="<?php echo stripslashes( $favicon ); ?>" type="image/x-icon"/>
		<?php endif;
	endif;
}

add_action( 'wp_head', 'cyberchimps_favicon', 2 );
add_action( 'admin_head', 'cyberchimps_favicon', 2 );

// add apple touch icon
function cyberchimps_apple() {
	if( cyberchimps_get_option( 'custom_apple' ) ) :
		$apple = cyberchimps_get_option( 'apple_touch_uploader' );
		if( $apple != '' ): ?>
			<link rel="apple-touch-icon" href="<?php echo stripslashes( $apple ); ?>"/>
		<?php endif;
	endif;
}

add_action( 'wp_head', 'cyberchimps_apple', 2 );

// add styles for skin selection
function cyberchimps_skin_styles() {
	$skin = cyberchimps_get_option( 'cyberchimps_skin_color' );
	if( $skin != 'default' && $skin != '' ) {
		wp_enqueue_style( 'skin-style', get_template_directory_uri() . '/inc/css/skins/' . $skin . '.css', array( 'style' ), '1.0' );
	}
}

add_action( 'wp_enqueue_scripts', 'cyberchimps_skin_styles', 35 );

// Add custom header scripts.
function cyberchimps_header_scripts() {
	$header_scripts = cyberchimps_get_option( 'header_scripts' );
	echo $header_scripts;
}

add_action( 'wp_head', 'cyberchimps_header_scripts' );
?>
