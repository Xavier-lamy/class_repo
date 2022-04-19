# NPM

+ ``NPM`` est compris dans ``node.js``, qui est un programme permettant d'écrire des applis en JS

+ NPM nécessite un fichier ``package.json`` afin d'avoir les infos du projet telles que le nom, la version, les modules à installer

+ ``npm init`` (pour créer le fichier ``package.json``)

+ Pour installer un module:
    ```
    npm install <module_name> --save-dev
    ```
    - ici --save-dev signifie que l'on veut qe npm sauvegarde cette dépendance dans le fichier ``package.json`` en tant que dépendance de développement
    - on peut aussi utiliser --save qui ajoute alors la dépendance en tant que dépendance de production

+ Quand on clone un projet pour la première fois depuis un repository git on peut excéuter:
    - ``npm install`` (pour installer toutes les dépendancesdu projet qui ont été ajoutés dans le fichier ``package.json``)
