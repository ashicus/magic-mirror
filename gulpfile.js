const elixir = require('laravel-elixir');

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    pipe = require('gulp-plumber'),
    minify_css = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps');

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
        .pipe(gulp.dest('./public/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./sass/**/*.scss', ['sass']);
});
