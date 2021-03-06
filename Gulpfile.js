'use strict';

var gulp = require('gulp');
var gulpUtil = require('gulp-util');
var gulpIf = require('gulp-if');
var sass = require('gulp-sass');
var cssMinify = require('gulp-minify-css');
var sourcemaps = require('gulp-sourcemaps');

const PATHS = {
	CSS: './'
};

gulp.task('css', function() {
	gulp.src('assets/sass/**/*.scss')
		.pipe(gulpIf(gulpUtil.env.sourcemaps, sourcemaps.init()))
		.pipe(sass().on('error', sass.logError))
		.pipe(gulpIf(gulpUtil.env.sourcemaps, sourcemaps.write('./')))
		.pipe(gulp.dest(PATHS.CSS));
});

gulp.task('build', ['css']);

gulp.task('watch', function() {
	gulp.watch('sass/**/*.scss', ['css']);
})

gulp.task('default', ['watch']);