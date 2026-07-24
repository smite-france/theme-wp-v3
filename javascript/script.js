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
 * `aria-expanded` state in sync for accessibility. While closed, the
 * off-canvas menu is made inert so its links stay out of the tab order,
 * and focus is moved into the menu on open / returned on close.
 */
function initMobileNav() {
	const toggle = document.querySelector('[data-menu-toggle]');
	const menu = document.getElementById('primary-menu');
	if (!toggle || !menu) {
		return;
	}

	const mobileQuery = window.matchMedia('(max-width: 1023.98px)');

	const isOpen = () => document.body.classList.contains('nav-open');

	// The menu is focusable only when visible: open, or on desktop.
	const syncInert = () => {
		if (mobileQuery.matches && !isOpen()) {
			menu.setAttribute('inert', '');
		} else {
			menu.removeAttribute('inert');
		}
	};

	const open = () => {
		document.body.classList.add('nav-open');
		document.body.style.overflow = 'hidden';
		toggle.setAttribute('aria-expanded', 'true');
		syncInert();
		const closeButton = document.querySelector('.menu-close');
		if (closeButton) {
			closeButton.focus();
		}
	};

	const close = ({ restoreFocus = true } = {}) => {
		if (!isOpen()) {
			return;
		}
		document.body.classList.remove('nav-open');
		document.body.style.overflow = '';
		toggle.setAttribute('aria-expanded', 'false');
		syncInert();
		if (restoreFocus) {
			toggle.focus();
		}
	};

	toggle.addEventListener('click', () => (isOpen() ? close() : open()));

	// Close on backdrop or close button click.
	document.querySelectorAll('[data-menu-close]').forEach((el) => {
		el.addEventListener('click', () => close());
	});

	menu.querySelectorAll('a').forEach((link) => {
		link.addEventListener('click', () => close({ restoreFocus: false }));
	});

	// Close on Escape, but only while the menu is open.
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && isOpen()) {
			close();
		}
	});

	// Reset the state when crossing the mobile/desktop breakpoint.
	mobileQuery.addEventListener('change', () => {
		close({ restoreFocus: false });
		syncInert();
	});

	syncInert();
}

/**
 * Add a `is-scrolled` class to the header once the page is scrolled, so it can
 * gain a solid background and border.
 */
function initStickyHeader() {
	const header = document.getElementById('masthead');
	if (!header) {
		return;
	}

	const onScroll = () => {
		header.classList.toggle('is-scrolled', window.scrollY > 16);
	};

	onScroll();
	window.addEventListener('scroll', onScroll, { passive: true });
}

document.addEventListener('DOMContentLoaded', () => {
	initMobileNav();
	initStickyHeader();
});
