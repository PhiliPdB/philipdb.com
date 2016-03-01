'use strict';

var gulp = require('gulp'),
	gutil = require('gulp-util'),
	babel = require('gulp-babel'),
	phpConnect = require('gulp-connect-php'),
	browserSync = require('browser-sync'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	eslint = require('gulp-eslint'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	cssnano = require('gulp-cssnano'),
	imagemin = require('gulp-imagemin'),
	ftp = require('vinyl-ftp'),
	cache = require('gulp-cache'),
	del = require('del'),
	rename = require('gulp-rename');

var paths = {
	styles: {
		src: 'scss/**/*.scss',
		dest: 'build/css/'
	},
	scripts: {
		src: 'js/**/*.js',
		dest: 'build/js/'
	},
	images: {
		src: '{images,favicons}/**/*.{jpg,jpeg,png}',
		dest: 'build/'
	},
	html: {
		src: ['**/*.{php,html}', '!{node_modules,build}/**/*.{php,html}'],
		dest: 'build/'
	}
};

var liveReloadFiles = 'build/**';

gulp.task('default', ['serve', 'watch']);

gulp.task('serve', ['connect', 'browser-sync']);

gulp.task('watch', function() {
	gulp.watch(paths.styles.src, ['build:scss']);
	gulp.watch(paths.scripts.src, ['eslint', 'build:js']);
	gulp.watch(paths.images.src, ['minify-images']);
	gulp.watch(paths.html.src, ['build:html']);
});

// Start the server
gulp.task('connect', function() {
	// PHP server (will be proxied)
	phpConnect.server({
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
	gulp.src('fonts/**.*').pipe(gulp.dest('build/fonts'));
	gulp.src('favicons/**.{json,xml,ico,svg}').pipe(gulp.dest('build/favicons'));

	if (gutil.env.type === 'deploy') deploy();
});

// HTML/php stuff
gulp.task('build:html', function() {
	gulp.src(paths.html.src)
		.pipe(rename(function (path) {
			if (path.dirname === '.' && path.extname === '.php' && path.basename !== 'index') {
				path.dirname = path.basename;
				path.basename = 'index';
			}
		}))
		.pipe(gulp.dest(paths.html.dest));
});

// scss stuff
gulp.task('build:scss', function() {
	gulp.src(paths.styles.src)
		.pipe(sass().on('error', sass.logError))
		.pipe(autoprefixer())
		// Only uglify if gulp is ran with '--type production' or '--type deploy'
		.pipe(gutil.env.type === 'production' || gutil.env.type === 'deploy' ? cssnano() : gutil.noop())
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// JS stuff
gulp.task('eslint', function() {
	gulp.src(paths.scripts.src)
		.pipe(eslint('.eslintrc'))
		.pipe(eslint.format());
});

gulp.task('build:js', function() {
	gulp.src(paths.scripts.src)
		.pipe(babel())
		.pipe(concat('script.js'))
		// Only uglify if gulp is ran with '--type production' or '--type deploy'
		.pipe(gutil.env.type === 'production' || gutil.env.type === 'deploy' ? uglify() : gutil.noop())
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(browserSync.reload({
			stream: true
		}))
});

// Images
gulp.task('minify-images', function () {
	gulp.src(paths.images.src)
		.pipe(cache(imagemin({
			progressive: true
		})))
		.pipe(gulp.dest(paths.images.dest));
});

gulp.task('deploy', deploy);

function deploy() {
	var config = require('./config.json');
	var connection = ftp.create({
		host: config.host,
		user: config.user,
		password: config.password,
		log: gutil.log
	});

	var globs = 'build/**'

	// using base = './build' will transfer everything to folder correctly 
	// turn off buffering in gulp.src for best performance 
	return gulp.src(globs, { base: './build', buffer: false })
		.pipe(connection.newer(config.remote_path)) // only upload newer files 
		.pipe(connection.dest(config.remote_path));
}

// MISC
gulp.task('rebuild', ['clear', 'build']);
gulp.task('clear', ['clear:cache', 'clear:build']);

gulp.task('clear:cache', function (done) {
	return cache.clearAll(done);
});

gulp.task('clear:build', function(done) {
	return del('build');
});
