const elixir = require('laravel-elixir');

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    pipe = require('gulp-plumber'),
    minify_css = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps'),
    browserSync = require('browser-sync').create();

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
});

gulp.task('serve', ['sass'], function() {
    browserSync.init({
        proxy: "magic-mirror.dev"
    });

    gulp.watch("sass/*.scss", ['sass']);
    gulp.watch("resources/views/**/*.blade.php").on('change', browserSync.reload);
});

// SASS

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
        .pipe(gulp.dest('./public/css'))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);
