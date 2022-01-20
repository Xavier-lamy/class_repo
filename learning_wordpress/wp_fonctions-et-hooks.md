# Le fichier functions.php et les hooks

## Dans functions.php on peut : 
- activer les thumbnails
- déclarer les emplacements de menus et widgets
- déclarer les feuilles de style et scripts
- déclarer les nouveaux types de publications (CPT) et de taxonomies
- créer et déclarer des fonctions
- gérer des requetes ajax
- réécrire des url
- personnaliser des réglages d'extensions
- personnaliser l'interface d'admin
- créer des routes dans API Rest
- ...

## Les hooks
- les hooks permettent de détecter des moments clés pour agir sur le thème sans modifier le code, il existe deux sortes de hooks:
    + les actions: on lance nos propres fonctions à un moment clé
    + les filtres : on intercepte une valeur à un moment donné et on la modifie
### Exemple 
```php
<?php 
function prefix_remove_menu_pages() {
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'prefix_remove_menu_pages );
```
Dans cet exemple on:
- crée une fonction (on ajoute au début du nom de notre fonction un préfixe, par exmeple le nom du projet, pour etre sur qu'il n'y ait pas de conflit avec une autre fonction)
- on appelle notre hook avec ``add_action()`` en paramètres:
    + le moment clé: ici *'admin_menu'*
    + la fonction qu'on souhaite exécuter

## Scinder functions.php en plusieurs fichiers
- si functions.php est trop gros on peut le diviser:
    + on place nos sous-parties dans un dossier (**inc** par exemple)
    + puis on appelle nos sous parties dans functions.php
    ```php
    <?php 
        // Configuration du thème
        require_once get_template_directory() . '/inc/config.php';

        // Fonctionnalités
        require_once get_template_directory() . '/inc/features.php';
    ```

## Charger les scripts et les styles
- on ne les charge pas directement sur les pages, on les appelle dans *functions.php* 
- Le CMS chargera automatiquement nos scripts et styles dans le bon ordre grâce à ``wp_head()`` (placé dans *header.php*)
- on déclare en utilisant le hook:
    - ``add_action( 'wp_enqueue_scripts', 'function_name' )``, avec en paramètres:
        1. le moment clé (ici le moment où il doit charger les scripts)
        2. la fonction callback, qu'on a créée

### Pour déclarer les scripts
+ on utilise ``wp_enqueue_script( 'handle', get_template_directory_uri() . /js/script.js, array('jquery'), 1.0, true )``, avec en paramètres:
    - le handle = nom du script
    - l'adresse du fichier en emplacement absolu on récupère le chemin vers le thème puis les éventuels sous-répertoires et le nom du fichier
    - les dépendances sous forme d'array avec les handles des scripts, si on souhaite que ce fichier ne soit chargé qu'après un autre fichier (ex: jquery)
    - le numéro de version, utilsé pour invalider le cache du navigateur, quand on changera le script du thème on incrément à 1.1 par exemple, autrement le navigateur pourrait ne pas charger le nouveau script car il a l'ancien
    - chargement en bas de page: si *true* = le script est chargé en bas de page (via **wp_footer()**)

### Pour déclarer les styles
+ on utilise ``wp_enqueue_style( 'handle', get_template_directory_uri() . /css/custom-style.css, array(), 1.0 )``, avec en paramètres:
    - le handle = nom de la feuille de style
    - l'adresse du fichier en emplacement absolu on récupère le chemin vers le thème puis les éventuels sous-répertoires et le nom du fichier
    - les dépendances sous forme d'array avec les handles des styles, si on souhaite que ce fichier ne soit chargé qu'après un autre fichier
    - le numéro de version, utilsé pour invalider le cache du navigateur, quand on changera le script du thème on incrément à 1.1 par exemple, autrement le navigateur pourrait ne pas charger le nouveau script car il a l'ancien

### Pour déclarer style.css à la racine
+ on utilise ``wp_enqueue_style( 'handle', get_stylesheet_uri(), array(), 1.0 )``, avec en paramètres:
    - le handle = nom de la feuille de style
    - la fonction qui permet de charger style.css, utilisée seule, ce fichier est obligatoire, il définit le thème
    - les dépendances sous forme d'array avec les handles des styles,
    - le numéro de version

### Utiliser des conditionnals tags
+ on peut les utiliser pour déclareer des feuilles de styles seulement sur certaines pages: 
```php
if( is_front_page() ) {
    wp_enqueue_script( 'slider', get_template_directory_uri() . '/js/slider.js', array(), 1.0, true );
}
```

### cas des thèmes enfants
Si on créé un thème enfant il faut:
- charger la feuille de style du thème parent (avec ``get_template_directory_uri()``)
- charger les feuilles de styles du thème enfant avec cette fois: ``get_stylesheet_directory_uri()``
