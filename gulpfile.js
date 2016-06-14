var gulp = require('gulp');
var sass = require('gulp-sass');
 
gulp.task('sass', function () {
  return gulp.src('admin/sass/_import.scss')    
  	.pipe(sass({outputStyle: 'compressed'}))  	
    .pipe(gulp.dest('admin/css'));
});
 
gulp.task('sass:watch', function () {
  gulp.watch('admin/sass/**/*.scss', ['sass']);
}); 

gulp.task('default', ['sass', 'sass:watch']);