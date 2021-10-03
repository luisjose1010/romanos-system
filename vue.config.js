const path = require('path');
const fs = require('fs');

// eslint-disable-next-line import/no-extraneous-dependencies
const CopyWebpackPlugin = require('copy-webpack-plugin');

const appPath = './resources/src';
const staticFilesPath = `${appPath}/static`;

const outputDir = 'public_html';
const outputDirPath = `./${outputDir}/`;

// Todos los archivos, menos "index.php" y ".htaccess", que no se utilizan en la build
const regexFiles = /^(?!.*(index\.php|\.htaccess)$)/;

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
fs.readdirSync(outputDirPath, { withFileTypes: true })
  .filter((dirent) => dirent.isDirectory())
  .map((dirent) => dirent.name)
  .forEach((dirent) => deleteFolder(outputDirPath + dirent));

// Limpia los archivos innecesarios de la ruta de salida para la build
fs.readdirSync(outputDirPath)
  .filter((file) => regexFiles.test(file))
  .map((file) => fs.unlinkSync(outputDirPath + file));

/**
 * @type {import('@vue/cli-service').ProjectOptions}
 */
module.exports = {
  outputDir,
  indexPath: 'app.html',

  configureWebpack: {
    plugins: [
      // Configura la ruta de archivos estáticos
      new CopyWebpackPlugin([{
        from: staticFilesPath,
        to: path.join(__dirname, outputDir),
        toType: 'dir',
        ignore: ['index.html', '.DS_Store'],
      }]),
    ],
  },

  chainWebpack: (config) => {
    // Configura la ruta del archivo "index.html" en la carpeta de archivos estaticos
    config
      .plugin('html')
      .tap((args) => {
        // eslint-disable-next-line no-param-reassign
        args[0].template = path.resolve(`${staticFilesPath}/index.html`);
        return args;
      });

    // Configura los archivos de entrada y salida de la aplicación
    config
      .entry('app')
      .clear()
      .add(`${appPath}/main.js`)
      .end();
    config.resolve.alias
      .set('@', path.join(__dirname, appPath));
  },

  transpileDependencies: [
    'vuetify',
  ],
};
