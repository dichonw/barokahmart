process.env.CHROME_BIN = require('puppeteer').executablePath();

module.exports = function(config) {
  config.set({
    browsers: [
      'ChromeHeadlessCustom'
    ],
    customLaunchers: {
      ChromeHeadlessCustom: {
        base: 'ChromiumHeadless',
        flags: [
            '--no-sandbox',
            '--headless',
            '--disable-gpu',
            '--disable-translate',
            '--disable-extensions'
        ]
      }
    },
    basePath: '../..',
    frameworks: [
      'qunit'
    ],
    plugins: [
      'karma-qunit',
      'karma-chrome-launcher'
    ],
    files: [
      'js/tests/vendor/jquery-3.3.1.slim.js',
      'js/jquery.spinner.js',
      'js/tests/unit/unit.js'
    ],
    autoWatch: false,
    singleRun: true,
    concurrency: Infinity
  })
}
