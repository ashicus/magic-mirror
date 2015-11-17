'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    pipe = require('gulp-plumber'),
    minify_css = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function () {
    gulp.src('./sass/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            errLogToConsole: true,
            outputStyle: 'compact',
            sourceComments: true
        }))
        // .pipe(minify_css())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./html/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./sass/**/*.scss', ['sass']);
});
