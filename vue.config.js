const path = require('path');
const fs = require('fs');

const outputDir = 'public_html';

const pathOutputDir = `./${outputDir}/`;
const regexFiles = /^.*\.js$|^.*\.json$|^.*\.html$/;

function deleteFolder(directoryPath) {
  if (fs.existsSync(directoryPath)) {
    fs.readdirSync(directoryPath).forEach((file) => {
      const curPath = path.join(directoryPath, file);

      // Llama de nuevo a la función si es un directorio, sino elimina
      if (fs.lstatSync(curPath).isDirectory()) {
        deleteFolder(curPath);
      } else {
        fs.unlinkSync(curPath);
      }
    });
    fs.rmdirSync(directoryPath);
  }
}

// Limpia las carpetas innecesarias de la ruta de salida para la build
fs.readdirSync(pathOutputDir, { withFileTypes: true })
  .filter((dirent) => dirent.isDirectory())
  .map((dirent) => dirent.name)
  .forEach((dirent) => deleteFolder(pathOutputDir + dirent));

// Limpia los archivos innecesarios de la ruta de salida para la build
fs.readdirSync(pathOutputDir)
  .filter((file) => regexFiles.test(file))
  .map((file) => fs.unlinkSync(pathOutputDir + file));

/**
 * @type {import('@vue/cli-service').ProjectOptions}
 */
module.exports = {
  outputDir,
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
