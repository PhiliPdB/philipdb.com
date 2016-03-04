let drawer = document.getElementById('navigation_drawer');
let drawerOpen = false;
let timeoutID;

window.onload = function() {
	addEvent(document.body, 'click', handleDrawerClick);
	addEvent(window, 'scroll', updateHeaderBackground);
	updateHeaderBackground();
	setupSwipeDrawer();
}

function updateHeaderBackground(event) {
	let header = document.getElementById('header_background');
	let banner = document.getElementById('home');
	let scrollTop = window.scrollY;
	let offset = {top: 0, left: 0};
	let node = banner;
	while (node) {
		offset.top += node.offsetTop;
		offset.left += node.offsetLeft;
		node = node.offsetParent;
	}
	const height = banner.offsetHeight;
	const range = 200;

	offset = offset.top + height / 2;
	let calc = (scrollTop - offset + range) / range;

	header.style.opacity = calc;
	if (calc > 1) {
		header.style.opacity = 1;
	} else if (calc < 0) {
		header.style.opacity = 0;
	}
}

function openDrawer() {
	drawer.classList.add('open');
	let id = window.setTimeout(() => {
		drawerOpen = true;
		window.clearTimeout(id);
	}, 300);
}

function closeDrawer() {
	drawer.className = '';
	let id = window.setTimeout(() => {
		drawerOpen = false;
		window.clearTimeout(id);
	}, 300);
}

function handleDrawerClick(event) {
	if (event.target != drawer && drawerOpen) {
		closeDrawer();
	}
}

const startPos = {
	x: 0,
	y: 0
};
const totalAnimationTime = 300;
let startAnimationTime = 0;
let drawerWidth, calcAnimationTime, animation;
function setupSwipeDrawer() {
	addEvent(document.body, 'touchstart', event => {
		const touch = event.targetTouches[0];
		if (drawerOpen || !drawerOpen && touch.pageX < 24) {
			startPos.x = touch.pageX;
			startPos.y = touch.pageY;
			drawerWidth = drawer.offsetWidth;
		} else {
			// TODO
		}
	});

	addEvent(document.body, 'touchmove', event => {
		const touch = event.targetTouches[0];
		if (drawerOpen && touch.pageX < startPos.x) {
			let position = Math.min(30 + touch.pageX - (startPos.x - drawerWidth), drawerWidth + 30);
			drawer.style.transition = 'none';
			drawer.style.webkitTransition = 'none';
			drawer.style.transform = `translate(${position}px, 0)`;
			drawer.style.webkitTransform = `translate(${position}px, 0)`;
		} else if (!drawerOpen && touch.pageX > startPos.x) {
			let position = Math.min(30 + touch.pageX - startPos.x, drawerWidth + 30)
			drawer.style.transition = 'none';
			drawer.style.webkitTransition = 'none';
			drawer.style.transform = `translate(${position}px, 0)`;
			drawer.style.webkitTransform = `translate(${position}px, 0)`;
		}
	});

	addEvent(document.body, 'touchend', event => {
		const touch = event.changedTouches[0];
		if (touch.pageX <= drawerWidth / 2) {
			// Close drawer
			drawerOpen = false;
			drawer.style.transition = '';
			drawer.style.webkitTransition = '';
			drawer.className = '';
			drawer.style.transform = '';
			drawer.style.webkitTransform = '';
		} else if (touch.pageX > drawerWidth / 2) {
			// Open drawer
			drawerOpen = true;
			drawer.style.transition = '';
			drawer.style.webkitTransition = '';
			drawer.className = 'open';
			drawer.style.transform = '';
			drawer.style.webkitTransform = '';
		}
	});
}

// This is a function from https://github.com/remy/html5demos
const addEvent = ((() => {
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
}))();