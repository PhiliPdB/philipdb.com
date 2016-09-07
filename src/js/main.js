const drawer = document.getElementById("navigation_drawer");
let drawerOpen = false;

window.onload = function() {
	// Set up everything...
	addEvent(document.body, "click", handleDrawerClick);
	
	addEvent(window, "scroll", updateHeaderBackground);
	updateHeaderBackground();
	
	setupSwipeDrawer();
}

function updateHeaderBackground(event) {
	const header = document.getElementById("header_background");
	const banner = document.getElementById("home");
	const scrollTop = window.scrollY;
	let offset = 0;

	// Calculate offset height of an element
	let node = banner;
	while (node) {
		offset += node.offsetTop;
		node = node.offsetParent;
	}
	
	const height = banner.offsetHeight;

	offset += height;
	const calc = (scrollTop - offset + height) / height;

	// Set header style
	header.style.opacity = calc;
	if (calc > 1) {
		header.style.opacity = 1;
	} else if (calc < 0) {
		header.style.opacity = 0;
	}
}

function openDrawer() {
	drawer.className = "open";
	let id = window.setTimeout(() => {
		drawerOpen = true;
		window.clearTimeout(id);
	}, 300);
}

function closeDrawer() {
	drawer.className = "";
	let id = window.setTimeout(() => {
		drawerOpen = false;
		window.clearTimeout(id);
	}, 300);
}

function handleDrawerClick(event) {
	if (!(event.target == drawer || drawer.contains(event.target)) && drawerOpen) {
		// Close drawer when open and tapping outside of it
		event.preventDefault();
		closeDrawer();
	}
}

// Some variables needed for the drawer to follow your finger
const startPosition = {
	x: 0,
	y: 0
};
let startedSwipe = false;
let drawerWidth;

function setupSwipeDrawer() {
	// Touch start
	addEvent(document.body, "touchstart", event => {
		const touch = event.targetTouches[0];
		// Only initialize when drawer is open or when tapping in specific area when screen is small enough
		if (drawerOpen || (!drawerOpen && touch.pageX < 24 && window.innerWidth <= 540)) {
			// Initialize
			startPosition.x = touch.pageX;
			startPosition.y = touch.pageY;
			drawerWidth = drawer.offsetWidth;
			startedSwipe = true;
		}
	});

	// Moving you finger while touching the screen clearly does now something
	addEvent(document.body, "touchmove", event => {
		const touch = event.targetTouches[0]; // Pick the first finger
		if (startedSwipe && drawerOpen && touch.pageX < startPosition.x) {
			// Calculate the position of the drawer to follow your finger
			let position = Math.min(30 + touch.pageX - (startPosition.x - drawerWidth), drawerWidth + 30);
			
			// Set all transform styles
			drawer.style.transition = "none";
			drawer.style.webkitTransition = "none";
			drawer.style.transform = `translate(${position}px, 0)`;
			drawer.style.webkitTransform = `translate(${position}px, 0)`;
		} else if (startedSwipe && !drawerOpen && touch.pageX > startPosition.x) {
			// Calculate the position of the drawer to follow your finger
			let position = Math.min(30 + touch.pageX - startPosition.x, drawerWidth + 30)
			
			// Set all transform styles
			drawer.style.transition = "none";
			drawer.style.webkitTransition = "none";
			drawer.style.transform = `translate(${position}px, 0)`;
			drawer.style.webkitTransform = `translate(${position}px, 0)`;
		}
	});

	addEvent(document.body, "touchend", event => {
		const touch = event.changedTouches[0];
		if (startedSwipe && touch.pageX <= drawerWidth / 2) {
			// Finish closing the drawer
			drawerOpen = false;
			startedSwipe = false;
			
			// Remove transitions and reset class name
			drawer.style.transition = "";
			drawer.style.webkitTransition = "";
			drawer.style.transform = "";
			drawer.style.webkitTransform = "";
			
			drawer.className = "";
		} else if (startedSwipe && touch.pageX > drawerWidth / 2) {
			// Finish opening the drawer
			drawerOpen = true;
			startedSwipe = false;

			// Remove transitions and set class name to open
			drawer.style.transition = "";
			drawer.style.webkitTransition = "";
			drawer.style.transform = "";
			drawer.style.webkitTransform = "";
			
			drawer.className = "open";
		}
	});
}

// This is a function from https://github.com/remy/html5demos
const addEvent = (() => {
	if (document.addEventListener) {
		return (el, type, fn) => {
			if (el && el.nodeName || el === window) {
				el.addEventListener(type, fn, false);
			} else if (el && el.length) {
				for (let i = 0; i < el.length; i++) {
					addEvent(el[i], type, fn);
				}
			}
		};
	} else {
		return (el, type, fn) => {
			if (el && el.nodeName || el === window) {
				el.attachEvent(`on${type}`, () => { return fn.call(el, window.event); });
			} else if (el && el.length) {
				for (let i = 0; i < el.length; i++) {
					addEvent(el[i], type, fn);
				}
			}
		};
	}
})();