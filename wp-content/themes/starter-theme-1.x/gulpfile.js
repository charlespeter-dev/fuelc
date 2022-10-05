// Initialize modules
var gulp = require('gulp');
var cssnano = require('gulp-cssnano');
var sass = require('gulp-sass')(require('sass'));
var uglify = require('gulp-uglify');

// Sass task: compiles the style.scss file into style.css
gulp.task('sass', function () {
	return (
		gulp
			.src('assets/src/*.scss')
			.pipe(sass()) // compile SCSS to CSS
			// .pipe(cssnano()) // minify CSS
			.pipe(gulp.dest('assets/css'))
	); // put final CSS in dist folder
});

// JS task: concatenates and uglifies JS files to script.js
gulp.task('js', function () {
	return (
		gulp
			.src(['assets/src/*.js'])
			// .pipe(uglify())
			.pipe(gulp.dest('assets/js'))
	);
});

gulp.task('sass-prod', function () {
	return gulp
		.src('assets/src/*.scss')
		.pipe(sass()) // compile SCSS to CSS
		.pipe(cssnano()) // minify CSS
		.pipe(gulp.dest('assets/css')); // put final CSS in dist folder
});

// JS task: concatenates and uglifies JS files to script.js
gulp.task('js-prod', function () {
	return gulp
		.src(['assets/src/*.js'])
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'));
});

// Watch task: watch SCSS and JS files for changes
gulp.task('watch', function () {
	gulp.watch('assets/src/*.scss', gulp.series('sass'));
	gulp.watch('assets/src/*.js', gulp.series('js'));
});

// Default task
gulp.task('sass');
gulp.task('default', gulp.series('sass', 'js', 'watch'));
gulp.task('prod', gulp.series('sass-prod', 'js-prod'));