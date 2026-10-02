<?php
/**
 * Title: Hero
 * Slug: matterello/hero
 * Categories: banner
 * Description: Full-screen looping video (Pexels 31631562, restaurant interior at night) with a scroll-down arrow. The header floats over it on the home page.
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( 'assets/video/hero.mp4' ) ); ?>","backgroundType":"video","dimRatio":30,"overlayColor":"black","isUserOverlayColor":true,"minHeight":90,"minHeightUnit":"vh","contentPosition":"bottom center","isDark":true,"align":"full","style":{"spacing":{"padding":{"bottom":"2.5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull has-custom-content-position is-position-bottom-center" style="padding-bottom:2.5rem;min-height:90vh"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-30 has-background-dim"></span><video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline src="<?php echo esc_url( get_theme_file_uri( 'assets/video/hero.mp4' ) ); ?>" data-object-fit="cover"></video><div class="wp-block-cover__inner-container"><!-- wp:html -->
<p style="text-align:center"><a class="hero-chevron" href="#locations" aria-label="Scroll to our restaurants"><svg viewBox="0 0 34 20" fill="none" stroke="currentColor" stroke-width="3"><path d="M2 2l15 15L32 2"/></svg></a></p>
<!-- /wp:html --></div></div>
<!-- /wp:cover -->
