"use strict";
const gulp = require("gulp");
const sass = require("gulp-sass");

const sourcemaps = require("gulp-sourcemaps");

sass.compiler = require("node-sass");

const CSSDestFolder = "./assets/css";
const SASSFilesPath = ["./sass/**/*.scss", "./sass/**/*.sass"];
const JSFilesPath   = "./assets/js";

const sassBuild = () => {
    return gulp
        .src(SASSFilesPath)
        .pipe(sass.sync().on("error", sass.logError))
        .pipe(gulp.dest(CSSDestFolder));
};

const cssBuild = () => {
    return sassBuild()
        .pipe(gulp.src([CSSDestFolder + "/**/*.css", "!" + CSSDestFolder + "/**/*.min.css", "!" + CSSDestFolder + "/modules/**/*.min.css"]))
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

const jsBuild = () => {
    const jsFilesPatterns = [
        JSFilesPath + "/**/*.js",
        "!" + JSFilesPath + "/**/*.min.js",
        "!" + JSFilesPath + "/modules/**/*.js",
        "!" + JSFilesPath + "/*.test.js",
        "!" + JSFilesPath + "/tests/**/*.test.js"
    ];

    return require("gulp-merge")(
            gulp.src(jsFilesPatterns),
            gulp.src(require("path").join(__dirname, 'node_modules', '@babel', 'polyfill', 'browser.js'))
        )
        .pipe(sourcemaps.init())
        .pipe(require("gulp-babel")({
            presets: [
                [
                    "@babel/preset-env",
                    { targets: "> 0.10%, not dead" },
                ]
            ],
            plugins: ['@babel/transform-runtime']
        }))
        .pipe(require("gulp-uglify")())
        .pipe(require("gulp-rename")(path => {path.basename += ".min";}))
        .pipe(sourcemaps.write("./"))
        .pipe(gulp.dest(JSFilesPath));
};

gulp.task("watch", () => {
    gulp.watch(SASSFilesPath, sassBuild);
});
gulp.task("buildJS", jsBuild);
gulp.task("buildCSS", cssBuild);
gulp.task("build", gulp.parallel([cssBuild, jsBuild]));
