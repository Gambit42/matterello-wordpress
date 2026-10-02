// Scroll reveal (same approach as Evercrest): the children of each group rise + fade in once, staggered.
// Selector mirrors the Motion block in style.css — keep them in sync.
( () => {
	const io = new IntersectionObserver(
		( entries ) => {
			for ( const entry of entries ) {
				if ( ! entry.isIntersecting ) continue;
				entry.target.classList.add( 'is-in' );
				io.unobserve( entry.target );
			}
		},
		{ rootMargin: '0px 0px -12% 0px' }
	);
	document.querySelectorAll( 'main > .wp-block-group, main .wp-block-columns' ).forEach( ( el ) => {
		[ ...el.children ].forEach( ( child, i ) => child.style.setProperty( '--mt-i', i ) );
		io.observe( el );
	} );
} )();

// Home header: transparent over the hero, solid once the page scrolls.
( ( h ) => h && addEventListener( 'scroll', () => h.classList.toggle( 'is-scrolled', scrollY > 40 ), { passive: true } ) )( document.querySelector( '.home .site-header' ) );

// Back-to-top button: appears once the page has scrolled a screen down.
( ( b ) => b && addEventListener( 'scroll', () => b.classList.toggle( 'is-shown', scrollY > innerHeight ), { passive: true } ) )( document.querySelector( '.to-top' ) );

// Hero video: stays paused on its first frame for reduced-motion visitors.
if ( matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) document.querySelectorAll( '.wp-block-cover__video-background' ).forEach( ( v ) => v.pause() );
