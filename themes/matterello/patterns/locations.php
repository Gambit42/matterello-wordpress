<?php
/**
 * Title: Locations
 * Slug: matterello/locations
 * Categories: featured
 * Description: Three tall photo cards, one per restaurant.
 */

$cards = array(
	array( 'riverside', 'Riverside Market', 'A long marble counter in a busy dining room' ),
	array( 'canal', 'Canal Street', 'Dark wood tables and banquettes' ),
	array( 'oldtown', 'Old Town', 'A plated dish on a candlelit table' ),
);
?>
<!-- wp:group {"anchor":"locations","align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"6.25rem"}}},"layout":{"type":"constrained"}} -->
<div id="locations" class="wp-block-group alignfull" style="padding-top:5rem;padding-bottom:6.25rem"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"2.25rem","top":"2.25rem"}}}} -->
<div class="wp-block-columns alignwide"><?php foreach ( $cards as list( $img, $name, $alt ) ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/$img.jpg" ) ); ?>","alt":"<?php echo esc_attr( $alt ); ?>","dimRatio":0,"isUserOverlayColor":true,"minHeight":720,"contentPosition":"bottom center","isDark":true,"className":"location-card","style":{"spacing":{"padding":{"bottom":"1.75rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-center location-card" style="padding-bottom:1.75rem;min-height:720px"><img class="wp-block-cover__image-background" alt="<?php echo esc_attr( $alt ); ?>" src="<?php echo esc_url( get_theme_file_uri( "assets/images/$img.jpg" ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:shortcode -->
[matterello_logo type="card"]
<!-- /wp:shortcode -->

<!-- wp:heading {"textAlign":"center","fontSize":"large"} -->
<h2 class="wp-block-heading has-text-align-center has-large-font-size"><a href="#menu"><?php echo esc_html( $name ); ?></a></h2>
<!-- /wp:heading --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --><?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
