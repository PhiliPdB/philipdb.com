window.onload = function() {
	addEvent(window, 'scroll', (event) => {
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