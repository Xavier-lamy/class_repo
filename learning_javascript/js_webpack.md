# Webpack

+ C'est un bundler pour rassembler tous nos fichiers (js, css, images,...)

## Mise en place de webpack sur un projet

+ Créer un dossier ``dist`` qui servira de sortie pour les fichiers
+ Créer un dossier ``src`` dans lequel on travaillera et qui servira d'entrée pour les fichiers

+ On lance ``npm init -y`` (``-y`` pour ``yes``, lance sans poser de questions ``Y/N``), cela crée un fichier ``package.json``, on peut y enlever la ligne ``"main": "index.js"`` car ce sera à webpack de définir ça

+ On installe webpack (``-D`` ou ``-dev`` pour la branche de dev):
``npm install -D webpack webpack-cli``

+ Si on a versionné avec git, on oublie pas de mettre ``node_modules`` dans ``.gitignore``

+ Créer un fichier ``webpack.config.js``
+ On peut également utiliser ``npm webpack-cli init`` pour générer une configuration de base
```js
//Inside webpack.config.js
//Start with adding basics
const path = require('path');

module.exports = {
    mode: 'development', // other values: production, none
    //Where does files come:
    entry: {
        main: path.resolve(__dirname, 'src/app.js'),
    },
    //Where they go:
    output: {
        path: path.resolve(__dirname, 'dist'),
        /*
        * Use [name] in filename to get the entryfile name
        * Use [contenthash] between filename and extension to get a unique filename, like: name.f564872fgseddq31df.js
        * Or name it with a custom name, ex: app.bundle.js:
        */
        filename: '[name].[contenthash].js',
        //Same for the assets name (like images)
        assetModuleFilename: '[name].[ext]',
        //Clear the dist everytime we compile so old files doesn't stay:
        clean: true,
    },
    //loaders

    //plugins
}
```

## Les loaders 
+ servent à ajouter des modules pour les éléments que webpack ne peut pas comprendre par défaut (ce qui n'est pas du javascript, exemple:  svg, css, ...), c'est utile quand on importe un fichier css ou une image dans un fichier que webpack doit compiler:
```js
//Inside webpack.config.js
module: {
    //loaders
    rules: [
        //Create a regex and install both modules with `npm install -D style-loader css-loader`:
        {
            test: /\.css$/,
            use: ['style-loader', 'css-loader']
        },

        //Create a regex for images, type asset/resource copy it into the distribution file and load it to make it available for js files:
        {
            test: /\.(ico|webp|gif|png|jpe?g)$/, 
            type:'asset/resource',
            //We can add a rule for this kind of asset if we want to overwrite the `assetModuleFilename` rule
            generator: {
                filename: 'images/[name][ext]'
            },
        },

        //Loader for fonts and SVG:
        {
            test: /\.(woff(2)?|eot|[ot]tf|svg)$/,
            type: 'asset/inline',
        },


        /*js for babel, use exclude to avoid babel searching 
        *into node_modules, for babel `use:` need to have an object,
        *install babel with: `npm install -D babel-loader @babel/core @babel/preset-env`
        */
        { 
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
              loader: 'babel-loader',
              options: {
                  presets: ['@babel/preset-env']
              }
          }
        }
    ]
},
```
+ Si on souhaite configurer un projet TypeScript il faut utiliser ``typescript-loader`` au lieu de babel
+ Pour Babel il faut ensuite créer un fichier ``.babelrc`` ou ``.babelrc.json`` à la racine:
```json
//Inside .babelrc.json or .babelrc
{
  //Add presets and plugins (if they have been installed)
  "presets": ["@babel/preset-env"],
  "plugins": ["@babel/plugin-proposal-class-properties"]
}
```

### Loaders pour Sass/css
+ Si on souhaite utiliser PostCSS (qui permet d'utiliser les dernières fonctionnalités css), ou Sass, on peut utiliser les loaders suivants:
    - sass-loader: compile le sass/scss en css
    - node-sass
    - postcss-loader (et postcss-preset-env pour y ajouter des paramètres de base)
    - css-loader
    - style-loader (pour appliquer les styles aux éléments du DOM)

+ On les installe avec ``npm install -D sass-loader postcss-loader css-loader style-loader postcss-preset-env node-sass``
+ Ensuite il faut un fichier de config pour PostCSS:
```js
//Inside postcss.config.js
module.exports = {
    plugins: {
        'postcss-preset-env': {
            browsers: 'last 2 versions',
        },
    },
}
```
+ Ensuite il faut ajouter les loaders (webpack les utilise de droite à gauche):
```js
//Inside webpack.config.js
module: {
    //loaders
    rules: [
        //Other rules for css, images,.....
        
        //Sass, PostCSS and Css
        {
            test: /\.(s[ca]ss|css)$/,
            use: ['style-loader', 'css-loader', 'postcss-loader', 'sass-loader'],
        }        
    ]
}
```

### Mettre le css dans un fichier à part
+ Si on souhaite mettre le css dans un fichier à part:
    - On installe ``mini-css-extract-plugin`` avec: ``npm install -D mini-css-extract-plugin``
    - Dans ``webpack.config.js``:
    ```js
    //At beginning of file:
    const MiniCssExtractPlugin = require("mini-css-extract-plugin");

    //Instead of the previous css/sass loaders, replace by:
    module: {
        rules: [
            //Other rules for css, images,.....
            
            //Sass, PostCSS and Css
            {
                test: /\.css$/,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            }        
        ]
    }
    plugins: [
        new MiniCssExtractPlugin()
    ]
    ```
    - Le css est automatiquement linké dans notre html généré par le template

+ En général on utilise style.loader en dev et minicssextractplugin en prod, pour cela on peut écrire ceci:
```js
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const devMode = process.env.NODE_ENV !== "production";

module.exports = {
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          devMode ? "style-loader" : MiniCssExtractPlugin.loader,
          "css-loader",
          "postcss-loader",
          "sass-loader",
        ],
      },
    ],
  },
  plugins: [].concat(devMode ? [] : [new MiniCssExtractPlugin()]),
};
```

## Les plugins 
+ permettent de prendre en charge des fonctionnalités que les loaders ne peuvent pas prendre en charge 
    - par exemple on peut utiliser un plugin pour générer un fichier html à partir d'un template:
    ```js
    //Inside webpack.config.js
    //At beginning of file
    const HtmlWebpackPlugin = require('html-webpack-plugin');//Install it using `npm install -D html-webpack-plugin`

    //plugins
    plugins: [
        new HtmlWebpackPlugin({
            title: 'html page title',
            filename: 'index.html',
            template: path.resolve(__dirname, 'src/template.html')
        })
    ],
    ```
    - Si le html ne sera pas entièrement généré par javascript, on peut préparer un template, webpack s'en servira pour créer le fichier, il suffit de créer ce template dans ``src`` et de le linker dans la propriété ``template`` de l'objet créé dans ``plugins``
    - Dans ce template on peut utiliser  : ``<%= htmlWebpackPlugin.options.title %>`` pour afficher une des options de l'objet (ici le titre)


+ Dans ``package.json`` on peut ajouter des commandes dans ``scripts`` afin d'exécuter webpack:
```js
//Inside package.json
{
  "name": "calculator_js",
  "version": "1.0.0",
  "description": "",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "build": "webpack",
    "start": "webpack serve", //or `server`, launch a development server
    "watch": "webpack --watch" //On peut utiliser `npm run watch` à la place de build pour que weback recompile à chaque changement
  },
}
```
+ On peut lancer la commande: ``npm run build`` pour lancer le script de notre ``webpack.config.js``
+ On peut lancer ``npm run watch`` à la place de build pour la recompilation auto à chaque changement
+ On peut lancer ``npm run start`` pour que webpack lance le serveur de dev en plus du script comme indiqué dans ``scripts: -> start:``, il ne faut pas oublier de faire ``npm install -D webpack-dev-server`` avant
+ La commande ``start`` ainsi créée nécessite des options supplémentaires dans ``webpack.config.js``:
    - ``devtool: 'inline-source-map',`` ajoute une option de ``source mapping`` à notre serveur de dev, afin que le navigateur puisse retrouver d'où provient le fichier où se trouve l'erreur
    - ``devServer`` qui indique les paramètres de notre serveur de dev
    ```js
    //Inside webpack.config.js
    ...
    output: {
        ...
    },
    //dev serv
    devtool: 'inline-source-map',
    devServer: {
        static: path.resolve(__dirname, 'dist'),
        port: 5001, //default: 8080
        open: true, //Launch the default browser when it start webserver
        hot: true, //Hot module reloading (reload files on modifications)
    },

    //loaders
    ```

## Séparation des fichiers:
+ Il est recommandé d'avoir deux fichiers de configuration séparés: un pour la prod et un pour la dev (ou à minima deux config dans le même fichier):
    - Pour la prod il faut: la minification, l'optimisation, et la suppression des ``source-maps``
    - Pour l'environnement de dev il faut un serveur de dev, le hotloading sur le serveur pour ne pas avoir à rebuild forcément à chaque changement mineur et les ``source-map`` notamment pour nous indiquer dans quel fichier se trouve l'erreur dans l'inspecteur de code

+ Pour cela on peut utiliser ``webpack-merge``:
    - ``npm install -D webpack-merge``
    - Au lieu d'un ``webpack.config.js``, on sépare en 3:
        - ``webpack.common.js``
        ```js
        const path = require('path');
        const HtmlWebpackPlugin = require('html-webpack-plugin');

        module.exports = {
            entry: {
                app: './src/index.js',
            },
            plugins: [
                new HtmlWebpackPlugin({
                title: 'Production',
                }),
            ],
            output: {
                filename: '[name].bundle.js',
                path: path.resolve(__dirname, 'dist'),
                clean: true,
            },
        };
        ```
        - ``webpack.dev.js``
        ```js
        const { merge } = require('webpack-merge');
        const common = require('./webpack.common.js');

        module.exports = merge(common, {
            //Sur la dev on va pouvoir mettre les options du serveur
            mode: 'development',
            devtool: 'inline-source-map', //source map for dev
            devServer: {
                static: './dist',
                open: true,
                hot: true,
            },
        });
        ```
        - ``webpack.prod.js``
        ```js
        const { merge } = require('webpack-merge');
        const common = require('./webpack.common.js');

        module.exports = merge(common, {
            mode: 'production',
            devtool: 'source-map', //Lighter source map for production
        });
        ```
        -  Dans package.json on peut modifier nos commandes dans scripts, afin qu'on ait une commmande pour la prod (``build``), et une commande pour le dev (``start`` ou ``watch``)
        ```js
        {
            "name": "development",
            //...
            "scripts": {
                "start": "webpack serve --config webpack.dev.js",
                "watch": "webpack --watch --config webpack.dev.js",
                "build": "webpack --config webpack.prod.js"
            },
            //....
        }

## Minifier en prod
+ Sur la prod on doit pouvoir minifier notre js et notre css:

### Minifier JS
- Depuis webpack 4 et au delà, le js est automatiquement minifié en prod, donc terser n'est util que si on tient à minifier en dev (ce qu'on évite généralement)
- ``npm install -D terser-webpack-plugin``
```js
//Inside webpack.config.js
const TerserPlugin = require("terser-webpack-plugin");

module.exports = {
  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin()],
  },
};
```

### Minifier le CSS
- ``npm install -D css-minimizer-webpack-plugin``
```js
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

module.exports = {
  plugins: [
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css",
    }),
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, "css-loader"],
      },
    ],
  },
  optimization: {
    minimizer: [
      new CssMinimizerPlugin(),
    ],
  },
};
```

## Installer TailWind sur un projet avec webpack
+ Il faut l'ajouter en tant que dépendance pour postCSS:
```
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init
```
+ Dans le fichier de config de postCSS:
```js
//postcss.config.js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  }
}
```
+ Dans le fichier de config de tailwind:
```js
//tailwind.config.js
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {},
  },
  plugins: [],
}
```
+ Ajouter les directives tailwind (``@tailwind``), dans le fichier de style principal
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```
+ Lancer la commande de build: ``npm run build``/``npm run watch`` (ou autre en fonction de ce qu'on a déterminé comme commande pour webpack)
+ Vérifier que le css est bien inclu dans le header du html