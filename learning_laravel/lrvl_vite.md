# Utiliser Vite js avec laravel

+ Avec laravel 9, laravel passe de laravel mix fonctionnant avec webpack à Vitejs plus rapide

+ Le gros avantage en plus de la rapidité c'est que le hot reloading est intégré de base dans la commande de dev de vite pour Laravel

## Utiliser Vitejs 
Vite est installé de base sur les nouveaux projets laravel 9

- Créer la config dans ``vite.config.js``
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
```
- ***(Optionnel:)***Pour les SPA on peut retirer la ligne ``resources/css/app.css`` et importer le css depuis le fichier js avec: ``import '../css/app.css';``

- ***(Optionnel:)***Si le serveur de dev est en Https, il faut ajouter après plugins:
```js
export default defineConfig({
    // [...]
    server: { 
        https: true, 
        host: 'localhost', 
    }, 
});
```

- Dans nos templates il suffit simplement d'ajouter une nouvelle directive blade pour vite, dans la balise head du template:
```php
<head>
    <!--[...]-->
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!--Si on a importé le css dans le fichier js il suffit d'écrire:-->
    @vite('resources/js/app.js')
</head>
```

- Vite n'a plus que deux commandes:
    - ``npm run dev``, qui servira de ``run watch|dev`` pour le serveur de dev, puisque désormais vite regarde en permanence pour des modifications de fichier
    - ``npm run build``: qui permettra de compiler et minifier pour la production

- Pour l'importation des fichiers JS dans le fichier js principal, vite possède un alias ``@`` qui par défaut pointe vers ``'/resource/js'``, on peut modifier le chemin de l'alias en ajoutant resolve après dans le fichier de config (après plugins ou server):
```js
export default defineConfig({
    // [...]
    resolve: {
        alias: {
            '@': '/resources/ts',
        },
    },
});
```
- Si on travaille avec vue.js il faut ajouter ceci dans plugins en dessous de ``laravel()`` et penser à importer en début de fichier, ceci afin de permettre au plugin vue de rediriger les urls vers le serveur Vite au lieu de serveur laravel web, et faire en sorte que le comportement de vue pour les chemins absolus corresponde à ce qui est attendu avec vite
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; //On oublie pas d'importer le plugin vue
 
export default defineConfig({
    plugins: [
        laravel(['resources/js/app.js']),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
```
- Au niveau des urls (notamment pour les sources des images), Vite ne s'occupe que des chemins relatifs, si une src a une url en absolu, vite la laissera tel quel quand on exécutera build (il faudra donc s'assurer que l'image est bel et bien dans ``public``), en revanche si l'url est en relatif, alors Vite s'occupera de réécrire l'url en prod et ajouter l'image dans le dossier ``public``, exemple avec l'arhcitecture suivante:
```
public/
  imageabsolute.png
resources/
  js/
    Views/
      Welcome.vue
  images/
    imagerelative.png
```
```html
<!--Url absolue, Vite la laisse tel quel-->
<img src="/imageabsolute.png">
 
<!-- Vite s'occupera d'ajouter l'image au dossier public et de réécrire l'url -->
<img src="../../images/imagerelative.png">
```
- Si on bosse avec tailwind, il faudra ajouter une config pour PostCss, dans un fichier ``postcss.config.js`` à la racine:
```js
module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
};
```
- Si on travaille avec sass, Vite peut aussi s'en occuper, il suffit simplement d'installer le preprocesseur sass pour le projet avec ``npm add -D sass``:
- Si on veut bénéficier de l'auto-refresh des pages quand on travaille avec nos templates blades il suffit d'ajouter l'option ``refresh`` dans le fichier de config de vite :
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        })
    ],
});
```
- l'option ``refresh`` va par défaut autoriser Vite à observer tous les fichiers situés dans les chemins suivants:
    - ``resources/views/**``
    - ``app/View/Components/**``
    - ``routes/**``
- Si on souhaite ajouter d'autre chemins pour l'option refresh, il suffit d'ajouter une liste de chemins à la place de ``true``
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: ['resources/views/**'],
        }),
    ],
});
``` 
- Si on souhaite ajouter plus d'options pour le refresh:
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
 
export default defineConfig({
    plugins: [
        laravel({
            //[...]
            refresh: [{
                paths: ['path/to/watch/**'],
                config: { delay: 300 }
            }],
        }),
    ],
});
``` 

## Passer un projet webpack/mix vers Vitejs
> note: pour sail ce sera la même chose, il faudra juste penser à ajouter ``sail`` (ou la commande complète si on n'a pas d'alias) devant les commandes à exécuter dans le terminal comme composer

1. Exécuter ``composer update`` pour s'assurer qu'on est à jour
2. Exécuter ``composer require laravel/framework:^9.19.0`` pour passer à la version 9.19 (minimum requis pour vitejs)
3. Installer vite: ``npm install --save-dev vite laravel-vite-plugin``, si besoin ajouter les dépendances pour vue (ou react): ``npm install --save-dev @vitejs/plugin-vue``
4. Créer un fichier de config ``vite.config.js`` à la racine:
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; //Seulement nécessaire si on a besoin de vue

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js' //Sur une SPA, ne mettre que cette ligne, et importer le css dans le js
            ],
            refresh: true,
        }),
        //Seulement nécessaire si on a besoin de vue:
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
```
- Créer le fichier ``postcss.config.js`` si nécessaire:
```js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  }, 
}
```
5. Modifier les scripts de compilation dans ``package.json`` (virer tous ceux de webpack et ajouter les deux pour Vite):
```json
  "scripts": {
    //On dégage:
    "dev": "npm run development",
    "development": "mix",
    "watch": "mix watch",
    "watch-poll": "mix watch -- --watch-options-poll=1000",
    "hot": "mix watch --hot",
    "prod": "npm run production",
    "production": "mix --production",

    //On ajoute:
    "dev": "vite",
    "build": "vite build"
  }
```
6. S'il y a un fichier style.ci: il faut penser à changer webpack par vite.config.js:
    - Remplacer:
    ```yml
    finder:
        not-name:
        - webpack.mix.js
    ```
    - par:
    ```yml
    finder:
        not-name:
        - vite.config.js
    ```
      
7. Si on a des ``require()`` dans nos fichiers js, il faudra les remplacer par des ``import`` (support des modules ES uniquement avec Vite)
8. Dans le fichier ``.env`` et le fichier ``.env.example`` penser à changer les variables préfixés de ``MIX`` par des variables préfixées de ``VITE``:
```
//On supprime:
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

//On ajoute:
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

9. Faire la même chose dans le fichier bootstrap.js si nécessaire:
```js
//On supprime:
key: process.env.MIX_PUSHER_APP_KEY,
cluster: process.env.MIX_PUSHER_APP_CLUSTER,

//On ajoute:
key: import.meta.env.VITE_PUSHER_APP_KEY,
cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
```

10. Remplacer les ``mix()`` pour les assets par des directives ``@vite``
```php
//On supprime:
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}" defer></script>

//On ajoute:
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

11. Désinstaller mix et supprimer le fichier ``webpack.mix.js``
```
npm remove laravel-mix

rm webpack.mix.js
```

12. Optionnel: on peut aussi ajouter le dossier ``/public/build`` créé par vite, à la liste des fichiers dans ``.gitignore``, vu qu'il sera recompilé à chaque changement ça sert à rien de le versionner

13. Pour sail: penser à ajouter le serveur vite dans le ``docker-compose.yml`` (en remplacement du port pour lHMR s'il est présent ou en-dessous du port de l'app):
```yml
ports:
    - '${APP_PORT:-80}:80'
    - '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
```
- Il faut penser à remonter le container docker si on en a un

14. Si le hot reloading ne marche pas, on peut ajouter, dans le fichier de config de vite (au dessus de plugins):
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js' //Sur une SPA, ne mettre que cette ligne, et importer le css dans le js
            ],
            refresh: true,
        }),
    ],
});
```
15. Quand on utilise wsl2 avec un système windows (not pour sail), il y a un bug connu qui fait que notre distro linux, ne peut pas observer les changements, pour remédier à cela, il faut déplacer notre dossier de projet à la racine de notre distro:
    - On utilise ``cp -R /mnt/c/<folder_name> /home`` éventuellement exécuter en administrateur: ``sudo cp -R /mnt/c/<folder_name> /home``
    - Puis quand on veut exécuter des commandes et qu'on nous indique un problème de droits d'accès: ``sudo chown –R <username> <folder_name>``

Tests sur mon projet starter-pack, changement d'une couleur dans le css, les temps sont très long car docker sur pc pas tous jeune, 3 tests par changement: 
    - avec webpack: 11825ms + 6000ms + 5451ms = en moyenne 7758ms