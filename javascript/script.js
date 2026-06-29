/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

/**
 * Mobile navigation toggle.
 *
 * Shows/hides the primary menu on small screens and keeps the
 * `aria-expanded` state in sync for accessibility.
 */
function initMobileNav() {
	const toggle = document.querySelector( '[data-menu-toggle]' );
	if ( ! toggle ) {
		return;
	}

	const open = () => {
		document.body.classList.add( 'nav-open' );
		document.body.style.overflow = 'hidden';
		toggle.setAttribute( 'aria-expanded', 'true' );
	};

	const close = () => {
		document.body.classList.remove( 'nav-open' );
		document.body.style.overflow = '';
		toggle.setAttribute( 'aria-expanded', 'false' );
	};

	toggle.addEventListener( 'click', () => {
		if ( document.body.classList.contains( 'nav-open' ) ) {
			close();
		} else {
			open();
		}
	} );

	// Close on backdrop, close button, or any menu link click.
	document.querySelectorAll( '[data-menu-close]' ).forEach( ( el ) => {
		el.addEventListener( 'click', close );
	} );

	document.querySelectorAll( '#primary-menu a' ).forEach( ( link ) => {
		link.addEventListener( 'click', close );
	} );

	// Close on Escape.
	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' ) {
			close();
		}
	} );
}

/**
 * Add a `is-scrolled` class to the header once the page is scrolled, so it can
 * gain a solid background and border.
 */
function initStickyHeader() {
	const header = document.getElementById( 'masthead' );
	if ( ! header ) {
		return;
	}

	const onScroll = () => {
		header.classList.toggle( 'is-scrolled', window.scrollY > 16 );
	};

	onScroll();
	window.addEventListener( 'scroll', onScroll, { passive: true } );
}

document.addEventListener( 'DOMContentLoaded', () => {
	initMobileNav();
	initStickyHeader();
} );
