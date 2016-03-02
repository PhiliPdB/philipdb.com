let drawer = document.getElementById('navigation_drawer');
let drawerOpen = false;
let timeoutID;

window.onload = function() {
	addEvent(document.body, 'click', handleDrawerClick);
	addEvent(window, 'scroll', updateHeaderBackground);
	updateHeaderBackground();
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
	drawer.className = 'open animate_open';
	timeoutID = window.setTimeout(() => {
		drawer.className = drawer.className.replace(' animate_open', '');
		drawerOpen = true;
	}, 300);
}

function closeDrawer() {
	drawerOpen = false;
	drawer.className = 'animate_close';
	timeoutID = window.setTimeout(() => {
		drawer.className = '';
	}, 300);
}

function handleDrawerClick(event) {
	if (event.target != drawer && drawerOpen) {
		closeDrawer();
	}
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