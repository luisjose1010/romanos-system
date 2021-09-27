const path = require('path');

/**
 * @type {import('@vue/cli-service').ProjectOptions}
 */
module.exports = {
  outputDir: 'public_html',
  indexPath: 'app.html',

  chainWebpack: (config) => {
    config
      .entry('app')
      .clear()
      .add('./resources/src/main.js')
      .end();
    config.resolve.alias
      .set('@', path.join(__dirname, './resources/src/'));
  },
};
