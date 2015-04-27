var gulp    = require('gulp');
var phpspec = require('gulp-phpspec');
var notify  = require('gulp-notify');
var _       = require('lodash');

gulp.task('test', function() {
  gulp.src('spec/**/*.php')
    .pipe(phpspec('', {
      clear: true,
      verbose: 'v',
      //formatter: 'pretty',
      notify: true
    }))
    .on('error', notify.onError(
      testNotification('fail', 'phpspec')
    ))
    .pipe(notify(
      testNotification('pass', 'phpspec')
    ));
});

gulp.task('watch', function() {
  gulp.watch(
    ['spec/**/*.php', 'src/**/*.php'],
    ['test']
  );
});

gulp.task('default', ['test', 'watch']);

function testNotification(status, pluginName, override) {
    var options = {
        title:   ( status == 'pass' ) ? 'Tests Passed' : 'Tests Failed',
        message: ( status == 'pass' ) ? '\n\nAll tests have passed!\n\n' : '\n\nOne or more tests failed...\n\n',
        icon:    __dirname + '/node_modules/gulp-' + pluginName +'/assets/test-' + status + '.png'
    };
    options = _.merge(options, override);
  return options;
}
