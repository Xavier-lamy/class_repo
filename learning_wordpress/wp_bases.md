# WordPress

## Infos
- S'écrit avec deux mjuscules: WordPress
- Est un CMS (content management system)
- créé en 2023 par Matt Mullenweg à partir d'un projet corse: B2Cafelog 
- Open source, dispo sur wordpress.org
- conçu en php
- Automattic, la maison mère, s'occupe également de la plateforme wordpress.com différente du CMS open source, elle sert à faire des petits sites,
- environ 31% des parst de marché en 2021
- wordcamp : évènements WP
- WordPress écrit les pages en php

- On peut utiliser Local de Flywheel à l apalce de Wamp ou mamp

## Débuter
1. Installer wordpress depuis Wordpress.org
2. Dézipper, on place sur le serveur local
3. Changer le nom du fichier (ou on l'intègre à un projet existant)
4. Créer une base de données avec phpMyAdmin (http://localhost/phpMyAdmin/):
    + Donner un nom
    + encodage utf8_general_ci
5. Taper dans la barre de recherche: http://localhost/nomduprojet
6. On suit les instructions pour connecter la base de données (penser à préfixer les tables, ex: avec les deux premières lettrres ou intiailes du projet):  
    - pour plus de sécurité et se prémunir des attaques se type SQL INjection on peut mettre un préfixe de table random et assez long, on a de toute façon pas besoin de s'en rappeler
7. Entrer les bases du site: titre, identifiant, mot de passse, email et visibilité par les moteursd de recherche

- Pour accéder à l'adminisatration du site on ajoute *wp-admin* après l'url, il est recommandé de changer cela (il y a des extensions)  

## Organisation des fichçiers wordpress
+ wp-content:
    - themes: penser à supprimer les thèmes non actifs
    - plugins: ex: woocommerce
    - uploads: tout le contenu de *medias*, on n'ajoute généralement rien ici sans passer par li'nterface d'admin
    - mu-plugins: must use plugins, on peut y ajouter par exemple un plugin pour empecher le client de désactiver des extensions
    - upgrade: non présent sur une nouvelle installlation

+ wp-includes: le coeur de WP, il est recommandé de ne rien modifier
+ wp-admin: code de l'administration du site, il est recommandé de ne rien modifier
+ index.php: racine de WP
+ wp-config.php : fichier de config
+ wp-login.php : fichier pour la connexion avec l'interface admin

## les tables de la bdd
- wp_users (et wp_usersmeta) : stocke les utilsateurs du site (et leurs infos supplémentaires)
- wp_options : options du site
- wp_posts (et wp_postmeta) : stockes les publications de wordpress (et des données additionnelles par exemple les données des champs personnalisés)
- wp_comments et wp_commentmeta : commentaires et métadonnées des commentaires
- wp_terms : contient les termes de taxonomie (catégories étiquettes ou personnalisé)
- wp_termmeta : métadonnées des termes
- wp_term_taxonomy : permet de connaitre la taxonomie des termes (sont ils des catégories, des étiquettes,... ?)
- wp_term_relationship : ancre les relations entre les termes et les taxonomies

## Debug
Pour voir les erreurs à l'écran:
```php
// Dans wp-config.php
<?php 

define( 'WP_DEBUG', true );
``` 
penser à supprimer cette ligne pour la mise en ligne

## Type d'environnement serveur
+ On peut définir l'environnement dans lequel se trouve le site:
    - development :site local
    - staging : préproduction
    - production : site en production
+ On peut donc lancer des actions différentes selon l'environnement:
    - Définir l'environnement:
    ```php
    // Dans wp-config.php
    <?php 

    define( 'WP_ENVIRONMENT_TYPE', 'production'); //production/development/staging
    ``` 
    - réaliser des actions en fonction de l'environnement:
    ```
    // Dans functions.php
    <?php 

    if( wp_get_environment_type() == 'development' ) {
        do_something();
    }
    ``` 

## wp-config.php 
On peut éventuellement ajouter ces options; n'importe où avant le commentaire "That's all":
- Désactiver la possibilité d'éditer les fichiers du thème dirtectment depuis l'interface admin
- Limiter le nombre de révisions pour alléger la bdd
- Espacer les enregistrements automatiques
```php
// Dans wp-config.php 

define( 'WP_DEBUG', true ); // Mettre à false avant mise en ligne

// Désactiver l'édition du thème depuis l'interface
define( 'DISALLOW_FILE_EDIT', true );

// Réduire le nombre de révisions
define( 'WP_POST_REVISIONS', 5 );

// Réduire l'interval des sauvegardes auto
define( 'AUTOSAVE_INTERVAL', 300 );
``` 

- Définir l'adresse du site
    ```php
    // Dans wp-config.php
    <?php 
    define( 'WP_HOME', 'http://sitename.com' );
    define( 'WP_SITEURL', 'http://sitename.com' );
    ```     