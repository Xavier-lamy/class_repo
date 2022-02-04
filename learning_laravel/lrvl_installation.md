# Pour installer Laravel

## Installer un nouveau projet:
- ``composer create-project laravel/laravel example-app``
- ``cd example-app``
- ``php artisan serve``
- créer la db et la linker dans le ``.env``
- ``php artisan migrate``

## Installer laravel sur un projet existant:
dans le dossier du projet;
- ``composer install``
- ``php artisan serve``
- créer la db
- linker dans le ``.env``
- ``php artisan key:generate``
- ``php artisan migrate``

## Sous laragon:
- créer un site web rapidement: --> laravel
- ``php artisan serve``
- créer la db
- linker dans le ``.env``
- ``php artisan key:generate``
- ``php artisan migrate``

## Quand on revient sur un projet ou qu'on le clone depuis github
Certaines parties ne sont pas embarquées avec git (car on les met dans .gitignore), exemple:
- .env
- .env.testing
- ...
Donc il faut:
1. Installer les bibliothèques et composants (à chaque fois qu'on en installe elles se mettent dans composer.json, donc composer install permet de récupérer celles du projet): ``composer install``
2. Installer les modules npm (pareil ceux installés sur le projet sont déterminés dans package.json): ``npm install``
3. créer la base de donnée
4. linker dans la bdd dans le ``.env``
5. générer la clé : ``php artisan key:generate``
6. générer les migrations: ``php artisan migrate`` ou ``php artisan migrate:refresh --seed`` pour virer les anciennes et lancer les seeders
7. Lancer le serveur``php artisan serve``
8. Créer un ``.env.testing`` avec les infos de l'environnement de test
9. Créer un fichier ``test.sqlite`` dans ``database`` et le linker dans le ``.env.testing`` -> ``database/test.sqlite``
10. Créer la clé de l'environnement de test ``php artisan key:generate --env=testing``
11. Lancer les migrations de l'environnement de test: ``php artisan migrate --seed --env=testing``


