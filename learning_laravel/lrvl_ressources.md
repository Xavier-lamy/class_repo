# Les ressources

## JS et CSS
- Pour JS et CSS Laravel possède un fichier ``webpack.mix.js`` à la racine
```js
mix.js('resources/js/app.js', 'public/assets/js') //Récupère le js dans ressources et le place dans public
    .postCss('resources/css/app.css', 'public/assets/css', [

    ]);
    //ou pour le sass
    .sass('resources/scss/app.scss', 'public/assets/css', [
        require('tailwindcss'), //Si nécessaire on ajoute les dépendances ici
    ]);
```
- ce fichier prend nos fichiers scss ou css et js dans ``ressources`` et les rassemble en un seul fichier js et un seul css dans le dossier ``public``.
- Au début du projet il faut penser à faire ``npm install`` pour installer les librairies nécessaires, il faut bien entendu s'assurer avant que npm et node sont installés
- penser à changer le contenu de webpack.mix.js en fonction de nos fichiers
- pour compiler ``npm run dev``, ou pour le faire automatiquement à chaque sauvegarde d'un fichier scss: ``npm run watch``

- Pour les images, styles ou scripts, on peut les ranger dans un fichier ``assets`` dans ``public``, puis pour y accéder:
    + ``src="{{ asset('assets/img/image.png') }}"``
    + ``link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"``

### Ignorer node_modules

Avant la version 6 de laravel mix il faut ajouter la ligne suivante dans ``webpack.mix.js`` si on souhaite exclure les fichiers node_modules de la compilation automatique:
```js
mix.webpackConfig({
    watchOptions: {
        ignored: /node_modules/
    }
}); 
```
