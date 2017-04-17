'use strict';

var gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    cssmin = require('gulp-cssmin'),
    less = require('gulp-less');


gulp.task('css', function(){
    return gulp.src('assets/templates/*.less')
        .pipe(less())
        .pipe(autoprefixer())
        .pipe(cssmin())
        .pipe(gulp.dest('web/css'))
});

gulp.task('default', [ 'css' ]);