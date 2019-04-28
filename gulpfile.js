var gulp            = require("gulp");
var less            = require("gulp-less");
var babel           = require('gulp-babel');
var concat          = require('gulp-concat');
var uglify          = require('gulp-uglify');
var rename          = require("gulp-rename");
var cleanCSS        = require("gulp-clean-css");
var del             = require("del");

var paths           = {
    styles: {
        src: "./src/scss/**/*.scss",
        dest: "./assets/css/"
    },
    scripts: {
        src: "./src/js/**/*.js",
        dest: "./assets/js/"
    }
};
var styleSRC        = "./src/scss/styles.scss";
var styleDIST       = "./assets/";
var styleWatch      = "./src/scss/**/*.scss";

var jsSRC           = "./src/js/scripts.js";
var jsDIST          = styleDIST;
var jsWatch         = "./src/js/**/*.js";

function styles() {
    return gulp.src(paths.styles.src)
        .pipe(less())
        .pipe(cleanCSS())
        // pass in options to the stream
        .pipe(rename({
            basename: "styles",
            suffix: ".min"
        }))
        .pipe(gulp.dest(paths.styles.dest, { sourcemaps: true }));
}

function scripts() {
    return gulp.src(paths.scripts.src, { sourcemaps: true })
        .pipe(babel())
        .pipe(uglify())
        .pipe(concat("scripts.min.js"))
        .pipe(gulp.dest(paths.scripts.dest));
}

function watch() {
    gulp.watch(paths.scripts.src, scripts)
        .watch(paths.styles.src, styles);
}

/* Not all tasks need to use streams, a gulpfile is just another node program
 * and you can use all packages available on npm, but it must return either a
 * Promise, a Stream or take a callback and call it
 */
function clean() {
    // You can use multiple globbing patterns as you would with `gulp.src`,
    // for example if you are using del 2.0 or above, return its promise
    return del([ 'assets' ]);
}

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
var build       = gulp.series(clean, gulp.parallel(styles, scripts));

/*
 * You can use CommonJS `exports` module notation to declare tasks
 */
exports.clean = clean;
exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;
exports.build = build;

/*
 * Define default task that can be called by just running `gulp` from cli
 */
exports.default = build;