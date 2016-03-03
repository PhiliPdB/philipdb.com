// Polyfill requestAnimationFrame and cancelAnimationFrame
window.requestAnimationFrame = (function() {
	return window.requestAnimationFrame
		|| window.webkitRequestAnimationFrame
		|| window.mozRequestAnimationFrame
		|| window.msRequestAnimationFrame
		|| window.oRequestAnimationFrame
		|| function(callback) { timeoutID = setTimeout(callback, 1000/60); return timeoutID; };
})();
window.cancelAnimationFrame = (function() {
	return window.cancelAnimationFrame
		|| window.webkitCancelAnimationFrame
		|| window.webkitCancelRequestAnimationFrame
		|| window.mozRequestAnimationFrame
		|| function(timeoutID) { clearTimeout(timeoutID); };
})();

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
	drawer.style.left = '';
	console.log(drawer.style.offsetLeft);
	drawer.classList.add('open');
	drawerOpen = true;
}

function closeDrawer() {
	drawerOpen = false;
	drawer.className = '';
	drawer.style.left = '';
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
		if (drawerOpen) {
			startPos.x = event.targetTouches[0].pageX;
			startPos.y = event.targetTouches[0].pageY;
			drawerWidth = drawer.offsetWidth;
		} else {
			// TODO
		}
	});

	addEvent(document.body, 'touchmove', event => {
		const touch = event.targetTouches[0];
		if (drawerOpen && touch.pageX < startPos.x) {
			drawer.style.left = `${touch.pageX - startPos.x}px`;
		}
	});

	addEvent(document.body, 'touchend', event => {
		const touch = event.changedTouches[0];
		// if (-10 > startPos.x - touch.pageX && startPos.x - touch.pageX > 10
		// 	&& -10 > startPos.y - touch.pageY  && startPos.y - touch.pageY > 10) {
		// 	return false; // Do nothing when slightly moved
		// } else
		if (touch.pageX <= drawerWidth / 2) {
			// Close drawer
			calcAnimationTime = (touch.pageX - startPos.x) / drawerWidth * totalAnimationTime;
			animation = window.requestAnimationFrame(swipeCloseDrawer);
		} else if (touch.pageX > drawerWidth / 2) {
			// Open drawer
			calcAnimationTime = (touch.pageX - startPos.x) / drawerWidth * totalAnimationTime;
			animation = window.requestAnimationFrame(swipeOpenDrawer);
		}
	});
}

function swipeOpenDrawer(timestamp) {
	if (!startAnimationTime) startAnimationTime = timestamp;
	console.debug(timestamp - startAnimationTime);
	let progress = timestamp - startAnimationTime + (totalAnimationTime - calcAnimationTime);
	let currentPosition = Math.min(progress / totalAnimationTime * drawerWidth - drawerWidth, 0);
	drawer.style.left = `${currentPosition}px`;

	if (progress < totalAnimationTime) window.requestAnimationFrame(swipeOpenDrawer);
	else {
		window.cancelAnimationFrame(animation);
		drawerOpen = true;
		console.log(drawer.style.offsetLeft);
		drawer.className = 'open';
		drawer.style.left = '';
		resetAnimation();
	}
}

function swipeCloseDrawer(timestamp) {
	if (!startAnimationTime) startAnimationTime = timestamp;
	let progress = timestamp - startAnimationTime + (totalAnimationTime - calcAnimationTime);
	let currentPosition = Math.min(-progress / totalAnimationTime * drawerWidth, 0);
	drawer.style.left = `${currentPosition}px`;

	if (progress < totalAnimationTime) window.requestAnimationFrame(swipeCloseDrawer);
	else {
		window.cancelAnimationFrame(animation);
		drawerOpen = false;
		console.log(drawer.style.offsetLeft);
		drawer.className = '';
		drawer.style.left = '';
		resetAnimation();
	}
}

function resetAnimation() {
	animation = undefined;
	calcAnimationTime = undefined;
	startAnimationTime = undefined;
	drawerWidth = undefined;
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