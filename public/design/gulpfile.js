const gulp = require('gulp');
const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const pug = require('gulp-pug');
const watch = require('gulp-watch');
const autoprefixer = require('gulp-autoprefixer');
const connect = require('gulp-connect');

// Watch Task

gulp.task('watch', function() {
    gulp.watch('src/**/*.scss', gulp.series('sass'));
    gulp.watch('src/**/*.pug', gulp.series('pug'));
});

// Sass compilation Task

gulp.task('sass', function () {
    return gulp.src('src/sass/main.scss', {
        sourcemap: true,
        style: 'compressed'
    })
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('assets/css'))
    .pipe(connect.reload());
});


// Pug compilation Task

gulp.task('pug', () => {
    return gulp.src('src/pug/*.pug')
    .pipe(pug({
        pretty: true
    }))
    .pipe(gulp.dest('./'))
    .pipe(connect.reload());
});


// Server Tsk

gulp.task('connect', function() {
    connect.server({
        port: 1234,
        root: './',
        livereload: true
    });
});

// Default Task

gulp.task('default', gulp.parallel('connect', 'watch'));
