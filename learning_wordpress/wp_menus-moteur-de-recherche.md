# Les menus et le moteur de recherche

## Menus
+ on y accède:
    - **Apparence** > **menus**
    - ou dans le customizer : **Apparence** > **personnaliser** > **menus**

+ différences emplacemetnd de menu et menu:
    - **menu**: le menu en lui meme, que l'on pourra mettre à l'emplacement de notre choix
    - **emplacement de menu** : emplacement qui porra acceuillir différents menu (exemple en fontion de la langue choisie)

### déclarer un emplacement de menu
dans functions.php: 
```
register_nav_menus( array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
) );
```
En paramètres:
- 'slug-du-menu' => 'nom apparaissant sur l'admin WP
- Une fois déclaré, on peut alors voir nos emplacements de menu dans WP.
- On ajoute ensuite nos menus dans:
    + header.php (avant la balise de fin </header>) : ``wp_nav_menu( array( 'theme_location' => 'main' ) )`` 
    + footer.php (avant la balise de fin </footer>): ``wp_nav_menu( array( 'theme_location' => 'footer' ) )`` 
    + Le paramètre *'theme_location'* définit le slug de l'emplacemenent (qu'on a définit dans functions.php)
- On peut ajouter d'autres paramètres à la fonction ``wp_nav_menu()``:
```php
wp_nav_menu(
    array(
        'theme_location' => 'main',
        'container' => 'ul', // pour éviter d'avoir une div autour
        'menu_class' => 'site__header__menu', // Pour une classe personnalisée pour le menu
    )
);
```

### Créer le menu et l'assigner:
dans l'admin WP:
- on ajoute un menu pour 'main' et un pour 'footer' on leur attribue les pages qu'on souhaite en fonction du menu

## Moteur de recherche WP
+ pour afficher le moteur de recherche sur la page:
    - ``get_search_form()``
+ Pour personnaliser le HTML du moteur de recherche:
    - créer un fichier **searchform.php** à la racine du thème et ajouter ce code (personnalisable):
    ```php
    <form action="<?php echo home_url( '/' ); ?>" method="get">
        <label for="search">Rechercher :</label>
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
        <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.svg" />
    </form>
    ```
+ lors d'une recherche WP appelle **search.php**