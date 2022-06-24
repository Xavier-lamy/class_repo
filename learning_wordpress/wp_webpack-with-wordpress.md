# Utiliser webpack pour les thèmes wordpress

Inspiré de l'article: [How to Use Webpack in WordPress](https://wptips.dev/webpack-in-wordpress/) par ***HENNER SETYONO***

Pour utiliser webpack sur wordpress il faut: 
- Installer Node.js sur la machine, si ce n'est pas déjà fait
- Créer l'architecture des dossiers pour les assets (les fichiers sont uniquement à titre d'exemple):
```
/css
    |__app.css
/js
    |__app.js
/src
    |__app.scss
    |__app.js
    |__script.js
```
- Créer le fichier ``package.json``:
```json
{
  "name": "theme-name",
  "private": true,
  "dependencies": { //Dépendances pour la prod (Babel pour la transcription entre les types de JS)
    "@babel/polyfill": "^7.11.5"
  },
  "devDependencies": { //Dépendances pour la dev
    "@babel/cli": "^7.11.6",
    "@babel/core": "^7.11.6",
    "@babel/preset-env": "^7.11.5",
    "autoprefixer": "^10.0.0",
    "babel-core": "^7.0.0-bridge.0",
    "browser-sync": "^2.26.12",
    "browser-sync-webpack-plugin": "^2.2.2",
    "css-loader": "^4.3.0",
    "file-loader": "^6.1.0",
    "mini-css-extract-plugin": "^0.11.2",
    "node-sass": "^4.14.1",
    "sass-loader": "^10.0.2",
    "url-loader": "^4.1.0",
    "webpack": "^4.44.1",
    "webpack-cli": "^3.3.12"
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
- Créer le fichier de config webpack: ``webpack.config.js``
```js
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
var path = require('path');

//Variables correspondant au projet
const jsPath= './js';
const cssPath = './css';
const outputPath = 'src';
const localDomain = 'http://sitename.local';
const entryPoints = {
    //Ajouter la ou les sorties ou webpack devra compiler nos fichiers (app ou bundle par exemple)
  'app': jsPath + '/app.js',
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
    - Ajouter un point de sortie en plus du ``'app'`` de js
    ```js
    //dans webpack.config.js
    const entryPoints = {
    'app': jsPath + '/app.js',
    'style': cssPath + '/style.sass',
    };
    ```
    - Si on ajoute ceci après avoir lancer ``npm install`` une erreur peut survenir indiquant qu'un fichier ou dossier n'existe pas, il faut alors exécuter: ``npm rebuild node-sass`` pour fixer l'erreur

- Pour le live reloading il suffit de décommenter le bloc dans ``webpack.config.js`` et d'exécuter ``npm run dev`` (penser à changer le nom du domaine dans ``proxy`` pour qu'il corresponde au notre)

- Pour les librairies JS, on peut aussi les installer avec npm et les importer dans le js, par exemple pour swiper, on exécute d'abord ``npm install --save swiper`` puis dans notre js principal dans src on l'importe plutôt comme ceci:
```js
import swiper from 'swiper';
```

