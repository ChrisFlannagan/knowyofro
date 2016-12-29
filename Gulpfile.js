var gulp = require('gulp');
var concat = require('gulp-concat');
var minify = require('gulp-minify-css');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

// Bootstrap scss source
var bootstrapSass = {
    in: 'node_modules/bootstrap-sass/'
};
var fontawesomeSass = {
    in: 'node_modules/font-awesome/'
};

// source and distribution folder
var source = 'includes/',
    dest = 'includes/';
var fonts = {
    in: [source + 'fonts/*.*',
        bootstrapSass.in + 'assets/fonts/**/*',
        fontawesomeSass.in + 'fonts/*'
    ],
    out: dest + 'fonts/'
};

var scss = {
    in: ['includes/scss/*'],
    sassOpts: {
        includePaths: [bootstrapSass.in + 'assets/stylesheets']
    }
};
var js = {
    in: ['includes/js/*.js']
};

gulp.task('styles', ['fonts'], function() {
    gulp.src('includes/scss/main.scss')
        .pipe(sass(scss.sassOpts).on('error', sass.logError))
        .pipe(concat('style.css'))
        .pipe(minify())
        .pipe(gulp.dest('includes'));
});
// copy bootstrap required fonts to dest
gulp.task('fonts', function () {
    return gulp
        .src(fonts.in)
        .pipe(gulp.dest(fonts.out));
});

gulp.task('javascripts', function() {
    gulp.src(js.in)
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(gulp.dest('includes'));
});


gulp.task('watch', function() {
    gulp.watch(scss.in,
        ['styles']);
    gulp.watch(js.in,
        ['javascripts']);
});

gulp.task('default', ['styles', 'javascripts', 'watch']);