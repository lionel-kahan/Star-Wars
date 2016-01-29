var gulp   = require('gulp'),
    sass   = require('gulp-sass'),
    minify = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

var path = {
    'resources': {
        'sass': './resources/assets/sass',
        'js': './resources/assets/js'
    },
    'public': {
        'css': './public/assets/css',
        'js': './public/assets/js'
    },
    'sass': './resources/assets/sass/**/*.scss',
    'js': './resources/assets/**/*js'
};

gulp.task('task_app_sass', function() {
   return gulp.src(path.resources.sass + '/app.scss')
    .pipe(sass({onError: console.error.bind(console, 'SASS ERROR')}))
    .pipe(minify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(path.public.css))
});

gulp.task('task_knacss_sass', function() {
   return gulp.src(path.resources.sass + '/knacss/sass/knacss.scss')
    .pipe(sass({onError: console.error.bind(console, 'SASS ERROR')}))
    .pipe(minify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(path.public.css))
});

gulp.task('task_js', function() {
   return gulp.src(path.resources.js + '/*.js')
    .pipe(uglify({onError: console.error.bind(console, 'JS ERROR')}))
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(path.public.js))
});

gulp.task('watch', function() {
   gulp.watch(path.sass, ['task_app_sass', 'task_knacss_sass']);
   gulp.watch(path.js, ['task_js']);
});

gulp.task('default', ['watch']);

//gulp.task('default', ['watch', 'phpunit]);
//pour lancer une task spécifique (par exemple watch):
//gulp watch
//pour lancer les tasks par défaut
//gulp

