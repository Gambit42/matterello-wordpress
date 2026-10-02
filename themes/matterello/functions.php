<?php
/** Matterello theme. Menu and page copy live in the block editor; this file adds the logo and the menu date. */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', fn() => add_editor_style( 'style.css' ) );

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'matterello', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
		wp_enqueue_script( 'matterello', get_theme_file_uri( 'assets/js/matterello.js' ), array(), filemtime( get_theme_file_path( 'assets/js/matterello.js' ) ), array( 'strategy' => 'defer' ) );
		// Runs in <head> so reveal targets are hidden before first paint (no flash, no jump).
		wp_add_inline_script( 'matterello', 'document.documentElement.classList.add("mt-js");', 'before' );
	}
);

/**
 * [matterello_logo type="header|card|mark" link="1"] — the arched wordmark, or the round rings mark.
 * Inline SVG so it uses the theme's Oswald webfont and the current text colour.
 */
add_shortcode(
	'matterello_logo',
	function ( $atts ) {
		$atts = shortcode_atts( array( 'type' => 'header', 'link' => '' ), $atts );
		$type = in_array( $atts['type'], array( 'card', 'mark' ), true ) ? $atts['type'] : 'header';
		if ( 'mark' === $type ) {
			$svg = '<svg class="mt-logo mt-logo--mark" viewBox="0 0 168 168" role="img" aria-label="Matterello"><circle cx="84" cy="84" r="84"/><circle cx="84" cy="84" r="51" fill="none" stroke="#000" stroke-width="10"/><circle cx="84" cy="84" r="23" fill="none" stroke="#000" stroke-width="10"/></svg>';
		} else {
			$id  = wp_unique_id( 'mt-arc-' );
			$svg = '<svg class="mt-logo mt-logo--' . $type . '" viewBox="0 0 300 92" role="img" aria-label="Matterello">'
				. '<path id="' . $id . '" d="M8 86 Q150 4 292 86" fill="none"/>'
				. '<text font-size="50" letter-spacing="1"><textPath href="#' . $id . '" startOffset="50%" text-anchor="middle">MATTERELLO</textPath></text></svg>';
		}
		return $atts['link'] ? '<a class="mt-logo-link" href="' . esc_url( home_url( '/' ) ) . '">' . $svg . '</a>' : $svg;
	}
);

// [menu_date] — today's date for the daily menu heading, e.g. "Friday 2nd October" (site timezone).
add_shortcode( 'menu_date', fn() => esc_html( wp_date( 'l jS F' ) ) );

// Favicon: the theme mark, unless a Site Icon has been set in the editor.
add_action( 'wp_head', fn() => has_site_icon() || printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "
", esc_url( get_theme_file_uri( 'assets/images/mark.svg' ) ) ) );
