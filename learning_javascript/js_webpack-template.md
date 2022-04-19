## Résumé et template de base:
+ Créer ``dist`` et ``src`` si besoin 

+ ``npm init -y`` pour créer un fichier ``package.json``, 
    - Retirer: ``"main": "index.js"`` 

+ Installer webpack ``npm install -D webpack webpack-cli``
    - Si git: ``node_modules`` dans ``.gitignore``

+ ``npm install -D webpack-merge``

+  Créer:
    - ``webpack.common.js``
    ```js
    const path = require('path');
    const HtmlWebpackPlugin = require('html-webpack-plugin');

    module.exports = {
        entry: {
            app: path.resolve(__dirname, 'src/app.js'),
        },
        output: {
            path: path.resolve(__dirname, 'dist'),
            /*
            * Use [name] in filename to get the entryfile name
            * Use [contenthash] between filename and extension to get a unique filename
            * Or name it with a custom name, ex: app.bundle.js:
            */
            filename: '[name].[contenthash].js',
            //Same for the assets name (like images)
            assetModuleFilename: 'assets/[hash][ext]',
            //Clear the dist everytime we compile so old files doesn't stay:
            clean: true,
        },
        //loaders
        module: {
            rules: [
                //Create a regex for images, type asset/resource copy it into the distribution file and load it to make it available for js files:
                {
                    test: /\.(ico|webp|gif|png|jp(e)?g|svg)$/, 
                    type:'asset/resource',
                    generator: {
                        filename: 'assets/images/[name][ext]'
                    },
                },

                //Loader for fonts and SVG:
                {
                    test: /\.(woff(2)?|eot|[ot]tf)$/,
                    type: 'asset/inline',
                },

                //js for babel, use exclude to avoid babel searching into node_modules: 
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
        plugins: [
            new HtmlWebpackPlugin({
                title: 'Calculator',
                filename: 'index.html',
                template: path.resolve(__dirname, 'src/template.html')
            }),
        ],
    };
    ```
    - ``webpack.dev.js``
    ```js
    const path = require('path');
    const { merge } = require('webpack-merge');
    const common = require('./webpack.common.js');

    module.exports = merge(common, {
        //Sur la dev on va pouvoir mettre les options du serveur
        mode: 'development',
        devtool: 'inline-source-map', //source map for dev
        module: {
            rules: [
                //Sass, PostCSS and Css
                {
                    test: /\.(sa|sc|c)ss$/,
                    use: [
                        "style-loader",
                        "css-loader",
                        "postcss-loader",
                        "sass-loader",
                    ],
                },  
            ]
        },
        devServer: {
            static: path.resolve(__dirname, 'dist'),
            port: 8080, //Default
            open: true,
            hot: true,
        },
    }); 
    ```
    - ``webpack.prod.js``
    ```js
    const { merge } = require('webpack-merge');
    const common = require('./webpack.common.js');
    const MiniCssExtractPlugin = require("mini-css-extract-plugin");
    const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

    module.exports = merge(common, {
        mode: 'production',
        devtool: 'source-map', //Lighter source map for production
        module: {
            rules: [
                //Sass, PostCSS and Css
                {
                    test: /\.(sa|sc|c)ss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        "css-loader",
                        "postcss-loader",
                        "sass-loader",
                    ],
                }, 
            ]
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: "[name].css",
                chunkFilename: "[id].css",
            }),        
        ], 
        optimization: {
            minimizer: [
                new CssMinimizerPlugin(),
            ],
        }  
    });
    ```
+ Installer les différents plugins et loaders:
    - ``npm install -D html-webpack-plugin sass-loader postcss-loader css-loader style-loader postcss-preset-env node-sass mini-css-extract-plugin css-minimizer-webpack-plugin``
    - `npm install -D babel-loader @babel/core @babel/preset-env`
+ Créer un fichier ``.babelrc`` ou ``.babelrc.json`` à la racine:
```json
//Inside .babelrc.json or .babelrc
{
  "presets": ["@babel/preset-env"],
  //Optionnal plugin, remove if not used
  "plugins": ["@babel/plugin-proposal-class-properties"]
}
```
+ Créer un fichier de config pour postCSS:
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
+ Créer si besoin un fichier `template.html` dans `src`, utiliser la syntaxe ``<%= htmlWebpackPlugin.options.title %>`` pour intégrer les options du plugin htmlwebpack dans le template

+ Dans ``package.json`` ajouter ceci dans scripts:
```json
    //...
    "scripts": {
        "test": "echo \"Error: no test specified\" && exit 1",
        "start": "webpack serve --config webpack.dev.js",
        "watch": "webpack --watch --config webpack.dev.js",
        "build": "webpack --config webpack.prod.js"
    },
    //....
```
+ On peut installer npm-run-all: ``npm install npm-run-all`` pour lancer plusieurs scripts d'un coup
```json
//Si on veut pouvoir lancer serve et watch en meme temps, on peut préfixer des scripts avec start:, quand on exécute npm run start, ils se lancent tous en meme temps
    //...
    "scripts": {
        "test": "echo \"Error: no test specified\" && exit 1",
        "start": "run-p start:**",
        "start:serve": "webpack serve --config webpack.dev.js",
        "start:watch": "webpack --watch --config webpack.dev.js",
        "build": "webpack --config webpack.prod.js"
    },
    //....
```
```json
//Avec tailwind, si on ne l'a pas intégré à postCss
    //...
    "scripts": {
        "test": "echo \"Error: no test specified\" && exit 1",
        "start": "run-p start:**",
        "start:serve": "webpack serve --config webpack.dev.js",
        "start:watch": "webpack --watch --config webpack.dev.js",
        "start:tailwindcss": "npx tailwindcss -i ./src/assets/main.scss -o ./dist/app.css --watch",
        "build": "webpack --config webpack.prod.js"
    },
    //....
```

