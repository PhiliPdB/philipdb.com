import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';
import pngquant from 'imagemin-pngquant';
import del from 'del';

// For handling js imports
import browserify from 'browserify';
import source from 'vinyl-source-stream';
import glob from 'glob';
import eventStream from 'event-stream';

const $ = gulpLoadPlugins({
	rename: {
		'gulp-connect-php': 'phpConnect'
	}
});

const paths = {
	styles: {
		src: 'src/scss/**/*.scss',
		dest: 'build/css/'
	},
	scripts: {
		src: 'src/js/**/*.js',
		dest: 'build/js/'
	},
	images: {
		src: 'src/{images,favicons}/**/*.{jpg,jpeg,png,svg}',
		dest: 'build/'
	},
	html: {
		src: 'src/**/*.{php,html}',
		watch: ['src/*.php', 'src/components/**/*.html', 'src/php/**/*.php'],
		dest: 'build/'
	}
};
const liveReloadFiles = [
	'build/css/**/*.css',
	'build/js/**/*.js',
	'build/images/**/*.{png,jpg,jpeg}',
	'build/components/**/*.html',
	'build/**/index.php'
];

gulp.task('default', ['serve', 'watch']);

gulp.task('serve', ['connect', 'browser-sync']);

gulp.task('watch', () => {
	gulp.watch(paths.styles.src, ['build:scss']);
	gulp.watch(paths.scripts.src, ['eslint', 'build:js']);
	gulp.watch(paths.images.src, ['minify-images']);
	gulp.watch(paths.html.watch, ['build:html']);
});

// Start the server
gulp.task('connect', () => {
	// PHP server (will be proxied)
	$.phpConnect.server({
		base: './build/',
		hostname: '0.0.0.0',
		port: 6000
	});

	// Another server for phpMyAdmin, since connect-php doesn't support multiple bases
	$.phpConnect.server({
		base: './phpmyadmin',
		open: false,
		hostname: '0.0.0.0',
		port: 1337
	});
});

gulp.task('browser-sync', () => {
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
	}, (err, bs) => {
		if (err)
			console.log(err);
		else
			console.log('BrowserSync is ready.');
	});
});

// Build all
gulp.task('build', ['build:html', 'build:scss', 'build:js', 'minify-images'], () => {
	// Copy other required files to build if changed
	gulp.src('src/fonts/**.*')
		.pipe($.changed('build/fonts'))
		.pipe(gulp.dest('build/fonts'));
	gulp.src('src/favicons/**.{json,xml,ico}')
		.pipe($.changed('build/favicons'))
		.pipe(gulp.dest('build/favicons'));
	gulp.src('src/robots.txt')
		.pipe($.changed('build/'))
		.pipe(gulp.dest('build/'));

	if ($.util.env.type === 'deploy') deploy();
});

// HTML/php stuff
gulp.task('build:html', () => {
	gulp.src(paths.html.src)
		.pipe($.changed(paths.html.dest))
		.pipe($.rename((path) => {
			if (path.dirname === '.' && path.extname === '.php' && path.basename !== 'index') {
				path.dirname = path.basename;
				path.basename = 'index';
			}
		}))
		.pipe(gulp.dest(paths.html.dest))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// scss stuff
gulp.task('build:scss', () => {
	gulp.src(paths.styles.src)
		.pipe($.sass().on('error', $.sass.logError))
		.pipe($.autoprefixer())
		// Only uglify if gulp is ran with '--type production' or '--type deploy'
		.pipe($.util.env.type === 'production' || $.util.env.type === 'deploy' ? $.cssnano() : $.util.noop())
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// JS stuff
gulp.task('eslint', () => {
	gulp.src(paths.scripts.src)
		.pipe($.eslint('.eslintrc'))
		.pipe($.eslint.format());
});

gulp.task('build:js', (done) => {
	let debug = !($.util.env.type === 'production' || $.util.env.type === 'deploy');

	glob(paths.scripts.src, (error, files) => {
        if (error) done(error);

        let tasks = files.map((entry) => {
            if (!debug) {
                return browserify({
                    entries: [entry],
                    standalone: "app",
                    debug: false
                })
                    //.transform("babelify")
                    //.transform("uglifyify")
                    .bundle()
                    .pipe(source(entry.replace("src/js/", "")))
                    .pipe(gulp.dest(paths.scripts.dest))
            } else {
                return browserify({
                    entries: [entry],
                    standalone: "app",
                    debug: true
                })
                    .bundle()
                    .pipe(source(entry.replace("src/js/", "")))
                    .pipe(gulp.dest(paths.scripts.dest))
                    .pipe(browserSync.reload({
                        stream: true
                    }));
            }
        });
        eventStream.merge(tasks).on('end', done);
	});
});

// Images
gulp.task('minify-images', () => {
	gulp.src(paths.images.src)
		.pipe($.changed(paths.images.dest))
        .pipe($.imagemin(
            [
                $.imagemin.gifsicle({interlaced: true}),
                $.imagemin.jpegtran({progressive: true}),
                pngquant(),
                $.imagemin.svgo({plugins: [{removeViewBox: true}]})
            ],
            {
                verbose: true
            }
        ))
		.pipe(gulp.dest(paths.images.dest));
});

// Deploying
gulp.task('deploy', deploy);
function deploy() {
	let config;
	try {
		config = require('./config.json');
	} catch (error) {
		config = {
			host: $.util.env.host,
			user: $.util.env.user,
			password: $.util.env.password,
			remote_path: $.util.env.path
		}
	}

	const globs = [
		'build/**',
		'!build/php/config.php'
	];
	const remotePath = $.util.env.beta ? config.beta_path : config.remote_path;

	return gulp.src(globs, { base: './build', buffer: false })
		.pipe($.sftp({
			host: config.host,
			user: config.user,
			pass: config.password,
			remotePath: remotePath
		}));
}

// MISC
gulp.task('rebuild', ['clear:build', 'build']);

gulp.task('clear:build', done => {
	return del('build');
});
