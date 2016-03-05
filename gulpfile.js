'use strict';

var gulp = require('gulp'),
	$ = require('gulp-load-plugins')({
		rename: {
			'gulp-connect-php': 'phpConnect'
		}
	}),
	browserSync = require('browser-sync'),
	pngquant = require('imagemin-pngquant'),
	ftp = require('vinyl-ftp'),
	del = require('del');

var cachebust = new $.cachebust();
var paths = {
	styles: {
		src: 'src/scss/**/*.scss',
		dest: 'build/css/'
	},
	scripts: {
		src: 'src/js/**/*.js',
		dest: 'build/js/'
	},
	images: {
		src: 'src/{images,favicons}/**/*.{jpg,jpeg,png}',
		dest: 'build/'
	},
	html: {
		src: ['src/**/*.{php,html}', '!{node_modules,build}/**/*.{php,html}'],
		watch: ['src/*.php', 'src/components/**/*.html'],
		dest: 'build/'
	}
};
var liveReloadFiles = [
	'build/css/**/*.css',
	'build/js/**/*.js',
	'build/images/**/*.{png,jpg,jpeg}',
	'build/components/**/*.html',
	'build/**/index.php'
];

gulp.task('default', ['serve', 'watch']);

gulp.task('serve', ['connect', 'browser-sync']);

gulp.task('watch', function() {
	gulp.watch(paths.styles.src, ['build:scss']);
	gulp.watch(paths.scripts.src, ['eslint', 'build:js']);
	gulp.watch(paths.images.src, ['minify-images']);
	gulp.watch(paths.html.watch, ['build:html']);
});

// Start the server
gulp.task('connect', function() {
	// PHP server (will be proxied)
	$.phpConnect.server({
		base: './build/',
		hostname: '0.0.0.0',
		port: 6000
	});
});

gulp.task('browser-sync', function() {
	browserSync({
		files: liveReloadFiles,
		proxy: 'localhost:6000',
    	port: 8080,
    	open: false,
    	ui: {
    		port: 3001,
    		weinre: {
    			port: 8000
    		}
    	}
	}, function (err, bs) {
		if (err)
			console.log(err);
		else
			console.log('BrowserSync is ready.');
	});
});

// Build all
gulp.task('build', ['build:html', 'build:scss', 'build:js', 'minify-images'], function() {
	// Copy other required files to build
	gulp.src('src/fonts/**.*').pipe(gulp.dest('build/fonts'));
	gulp.src('src/favicons/**.{json,xml,ico,svg}').pipe(gulp.dest('build/favicons'));

	if ($.util.env.type === 'deploy') deploy();
});

// HTML/php stuff
gulp.task('build:html', function() {
	gulp.src(paths.html.src)
		.pipe($.rename(function (path) {
			if (path.dirname === '.' && path.extname === '.php' && path.basename !== 'index') {
				path.dirname = path.basename;
				path.basename = 'index';
			}
		}))
		.pipe($.util.env.type === 'deploy' ? cachebust.references() : $.util.noop())
		.pipe(gulp.dest(paths.html.dest))
});

// scss stuff
gulp.task('build:scss', function() {
	gulp.src(paths.styles.src)
		.pipe($.sass().on('error', $.sass.logError))
		.pipe($.autoprefixer())
		// Only uglify if gulp is ran with '--type production' or '--type deploy'
		.pipe($.util.env.type === 'production' || $.util.env.type === 'deploy' ? $.cssnano() : $.util.noop())
		.pipe($.util.env.type === 'deploy' ? cachebust.resources() : $.util.noop())
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// JS stuff
gulp.task('eslint', function() {
	gulp.src(paths.scripts.src)
		.pipe($.eslint('.eslintrc'))
		.pipe($.eslint.format());
});

gulp.task('build:js', function() {
	gulp.src(paths.scripts.src)
		.pipe($.babel())
		.pipe($.concat('script.js'))
		// Only uglify if gulp is ran with '--type production' or '--type deploy'
		.pipe($.util.env.type === 'production' || $.util.env.type === 'deploy' ? $.uglify() : $.util.noop())
		.pipe($.util.env.type === 'deploy' ? cachebust.resources() : $.util.noop())
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// Images
gulp.task('minify-images', function () {
	gulp.src(paths.images.src)
		.pipe($.imagemin({
			progressive: true,
			use: [pngquant()]
		}))
		.pipe(gulp.dest(paths.images.dest));
});

// Deploying
gulp.task('deploy', deploy);
function deploy() {
	var config = require('./config.json');
	var connection = ftp.create({
		host: config.host,
		user: config.user,
		password: config.password,
		log: $.util.log
	});

	var globs = 'build/**'

	// using base = './build' will transfer everything to folder correctly 
	// turn off buffering in gulp.src for best performance 
	return gulp.src(globs, { base: './build', buffer: false })
		.pipe(connection.newer(config.remote_path)) // only upload newer files 
		.pipe(connection.dest(config.remote_path));
}

// MISC
gulp.task('rebuild', ['clear:build', 'build']);

gulp.task('clear:build', function(done) {
	return del('build');
});
