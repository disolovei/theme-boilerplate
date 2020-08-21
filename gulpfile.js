"use strict";
const gulp = require("gulp");
const sass = require("gulp-sass");

const sourcemaps = require("gulp-sourcemaps");
const browserSync = require("browser-sync").create();

sass.compiler = require("node-sass");

const CSSDestFolder = "./assets/css";
const SASSFilesPath = ["./sass/**/*.scss", "./sass/**/*.sass"];

const sassBuild = () => {
    return gulp
        .src(SASSFilesPath)
        .pipe(sass.sync().on("error", sass.logError))
        .pipe(gulp.dest(CSSDestFolder));
};

const cssBuild = () => {
    return sassBuild()
        .pipe(gulp.src([CSSDestFolder + "/**/*.css", "!" + CSSDestFolder + "/**/*.min.css"]))
        .pipe(sourcemaps.init())
        .pipe(require('gulp-group-css-media-queries')())
        .pipe(require("gulp-clean-css")({ 
            compatibility: "ie8", 
            level: {
                1: {
                    specialComments: 0
                },
                2: {
                    removeDuplicateRules: true
                }
            }
        }))
        .pipe(require("gulp-autoprefixer")("last 2 version", "safari 5", "ie 8", "ie 9"))
        .pipe(require("gulp-rename")(path => {path.basename += ".min";}))
        .pipe(sourcemaps.write("./"))
        .pipe(gulp.dest(CSSDestFolder));
};

const liveReload = () => {
    browserSync.init({
        server: "./"
    });

    gulp.watch(SASSFilesPath, sassBuild).on("change", browserSync.reload);
    gulp.watch("./*.html").on("change", browserSync.reload);
};

gulp.task("reload", liveReload);
gulp.task("build", cssBuild);
gulp.task("dev", () => {
    gulp.watch(SASSFilesPath, sassBuild);
});
