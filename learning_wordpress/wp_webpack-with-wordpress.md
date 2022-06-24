# Utiliser webpack pour les thèmes wordpress

Inspiré de l'article: [How to Use Webpack in WordPress](https://wptips.dev/webpack-in-wordpress/) par ***HENNER SETYONO***

Pour utiliser webpack sur wordpress il faut: 
- Installer Node.js sur la machine, si ce n'est pas déjà fait
- Créer l'architecture des dossiers pour les assets (les fichiers sont uniquement à titre d'exemple):
```
/assets
    |___/scss
        |__main.scss
    |___/js
        |__script.js
/dist
```
- Créer le fichier ``package.json`` dans le thème:
```json
{
  "name": "theme-name",
  "private": true,
  "dependencies": {
    "@babel/polyfill": "^7.11.5"
  },
  "devDependencies": {
    "@babel/cli": "^7.11.6",
    "@babel/core": "^7.11.6",
    "@babel/preset-env": "^7.11.5",
    "autoprefixer": "^10.0.0",
    "babel-core": "^7.0.0-bridge.0",
    "browser-sync": "^2.26.12",
    "browser-sync-webpack-plugin": "^2.2.2",
    "css-loader": "^6.7.1",
    "file-loader": "^6.1.0",
    "mini-css-extract-plugin": "^2.6.1",
    "node-sass": "^7.0.1",
    "sass-loader": "^13.0.0",
    "url-loader": "^4.1.0",
    "webpack": "^5.73.0",
    "webpack-cli": "^4.10.0"
  },
  "scripts": {
    "build": "webpack --mode production",
    "dev": "webpack --mode development --watch"
  },
  "babel": {
    "presets": [
      "@babel/preset-env"
    ]
  }
}
```
- Créer le fichier de config webpack dans le thème: ``webpack.config.js``
```js
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
var path = require('path');

//Variables correspondant au projet
const jsPath= './assets/js';
const scssPath = './assets/scss';
const outputPath = 'dist';
const localDomain = 'http://localhost';
const entryPoints = {
    //Ajouter les points d'entrée depuis lesquels webpack devra compiler nos fichiers (app ou bundle par exemple)
  'app': jsPath + '/script.js',
  'style': scssPath + '/main.scss',
};

module.exports = {
  entry: entryPoints,
  output: {
    path: path.resolve(__dirname, outputPath),
    filename: '[name].js',
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),

    //On peut utiliser le hot reloading en décommentant le bloc suivant
    /*
    new BrowserSyncPlugin({
      proxy: localDomain,
      files: [ outputPath + '/*.css' ],
      injectCss: true,
    }, { reload: false, }),
    */
  ],
  module: {
    rules: [
      {
        test: /\.s?[c]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      },
      {
        test: /\.sass$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'sass-loader',
            options: {
              sassOptions: { indentedSyntax: true }
            }
          }
        ]
      },
      {
        test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
        use: 'url-loader?limit=1024'
      }
    ]
  },
};
```
- Exécuter ``npm install`` pour installer les dépendances du ``package.json``
- Ensuite en fonction de la situation on peut exécuter:
    - ``npm run dev``: si on est en développement, cela lancera la commande webpack en mode developpement (donc avec tous les plugins css, sass,...) avec l'option watch pour observer en permanence les changements de fichiers
    - ``npm run build``: si on souhaite passer en production, cela va minifier les fichiers de styles

- Grâce à webpack on peut importer nos fichiers JS sans avoir à utiliser les modules:
```js
import swiperfrom 'vendors/swiper.js';
```

- Pour la compilation du css, on peut:
    - Importer dans le ``.js`` notamment si notre js et notre css sont liés
    ```js
    import '../sass/app.scss';
    ```
    - Ajouter un point d'entrée en plus du ``'app'`` de js
    ```js
    //dans webpack.config.js
    const entryPoints = {
    'app': jsPath + '/app.js',
    'style': scssPath + '/app.scss',
    };
    ```
    - Si on ajoute ceci après avoir lancer ``npm install`` une erreur peut survenir indiquant qu'un fichier ou dossier n'existe pas, il faut alors exécuter: ``npm rebuild node-sass`` pour fixer l'erreur

- Pour le live reloading il suffit de décommenter le bloc dans ``webpack.config.js`` et d'exécuter ``npm run dev`` (penser à changer le nom du domaine dans ``proxy`` pour qu'il corresponde au notre)

- Pour les librairies JS, on peut aussi les installer avec npm et les importer dans le js, par exemple pour swiper, on exécute d'abord ``npm install --save swiper`` puis dans notre js principal dans src on l'importe plutôt comme ceci:
```js
import swiper from 'swiper';
```

- Si les dépendance du fichier package.json sont dépassés on peut utiliser ``npm outdated`` pour vérifier lesquelles ont une version plus récente

- Note: il faut penser à ajouter un fichier gitignore dans le thème pour exclure ``/node_modules/`` ainsi que le dossier ``dist`` puisque celui ci sera rempli par webpack à chaque compilation
