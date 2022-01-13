# Les actions GitHub

- Pour optimiser et automatiser le workflow,
- On peut réaliser des actions en fonction de différents évènements, on peut par exemple :
    - lancer les tests à chaque push , git nous préviendras si quelquechose ne fonctionne pas
    - Lancer une action s'il y à une "issue"

## Préparations
- Sur un Repo GitHub on peut setup des workflows (au début du projet ou en cours), il y en a des préfaits pour de nombreux types d'applications ou langages utilisés.
- cela va créer un fichier ``.yml`` dans un dossier, pour laravel par exemple le fichier ressemble à ça:
```yaml
name: Laravel

on:
  push:
    branches: [ laravel ]
  pull_request:
    branches: [ main ]

jobs:
  laravel-tests:

    runs-on: ubuntu-latest
    env:
      DB_CONNECTION: sqlite
      DB_DATABASE: database/database.sqlite
    steps:
    - uses: shivammathur/setup-php@15c43e89cdef867065b0213be354c2841860869e
      with:
        php-version: '8.0'
    - uses: actions/checkout@v2
    - name: Copy .env
      run: php -r "file_exists('.env') || copy('.env.example', '.env');"
    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite
    - name: Install Dependencies
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
    - name: Generate key
      run: php artisan key:generate
    - name: Directory Permissions
      run: chmod -R 777 storage bootstrap/cache
    - name: Clear cache
      run: |
        php artisan route:clear
        php artisan view:clear
        php artisan cache:clear
    - name: Run migrations
      run: php artisan migrate
    - name: Execute tests (Unit and Feature tests) via PHPUnit
      run: vendor/bin/phpunit
    - uses: actions/upload-artifact@v2
      if: failure()
      with:
        name: laravel.log
        path: storage/logs/
```
Résumé des étapes:
- On précise quand on veut lancer le workflow (avec ``on:``) 
- On ajoute les jobs:
    - Sous quel os ils tournent (``runs-on``)
    - On définit les détails de l'ENV (``env:``)
    - On définit les étapes:
        - Utiliser un setup php déjà préparé
        - Checkout sur la branche voulue
        - créer le .env
        - créer la bdd de test
        - installer les dépendances avec composer
        - générer la clé avec artisan
        - Ajouter les permissions
        - vider le cache (normalement pas nécessaire mais peut etre utile quand on rencontre certains bugs)
        - Lancer les migrations (quand nos tests nécessitent les vrais bases de données)
        - Exécuter les tests
        - Facultatif (si l'étape d'avant echoue on peut choisir de charger des logs)