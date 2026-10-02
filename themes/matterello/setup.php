<?php
/**
 * One-off site setup: `studio wp eval-file wp-content/themes/matterello/setup.php`.
 * Builds the Home page from the theme patterns (as real, editable blocks) plus the footer/nav pages.
 * Safe to re-run: it updates pages by slug instead of duplicating them.
 */

$registry = WP_Block_Patterns_Registry::get_instance();
$home     = implode( "\n\n", array_map( fn( $s ) => $registry->get_registered( "matterello/$s" )['content'], array( 'hero', 'locations', 'daily-menu', 'about' ) ) );

$pages = array(
	'home'           => array( 'Home', $home ),
	'vouchers'       => array( 'Vouchers', '<!-- wp:paragraph --><p>Gift a plate of pasta. Vouchers can be used at all three restaurants and are valid for 12 months.</p><!-- /wp:paragraph -->' ),
	'careers'        => array( 'Careers', '<!-- wp:paragraph --><p>We are always looking for chefs, pasta makers and front-of-house staff. Send your CV to jobs@example.com.</p><!-- /wp:paragraph -->' ),
	'privacy-policy' => array( 'Privacy Policy', '<!-- wp:paragraph --><p>Placeholder privacy policy.</p><!-- /wp:paragraph -->' ),
	'cookie-policy'  => array( 'Cookie Policy', '<!-- wp:paragraph --><p>Placeholder cookie policy.</p><!-- /wp:paragraph -->' ),
);

foreach ( $pages as $slug => list( $title, $content ) ) {
	$existing = get_page_by_path( $slug );
	$id       = wp_insert_post(
		array(
			'ID'           => $existing ? $existing->ID : 0,
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => $title,
			'post_content' => $content,
		)
	);
	if ( 'home' === $slug ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $id );
	}
	if ( 'privacy-policy' === $slug ) {
		update_option( 'wp_page_for_privacy_policy', $id );
	}
	WP_CLI::log( "$slug: $id" );
}

// Studio's default "Sample Page" and the draft privacy page aren't needed.
foreach ( get_posts( array( 'post_type' => 'page', 'name' => 'sample-page', 'post_status' => 'any' ) ) as $p ) {
	wp_delete_post( $p->ID, true );
}
