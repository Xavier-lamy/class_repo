# Les thèmes enfants

+ On ne doit pas modifier un thème choisi directmeent, sinon en cas de maj on risque de tout perdre
+ on utilise donc un thème enfant pour modifier le thème parent
+ Les thèmes enfant peuvent servir:
    - quand on a un thème (genre bootscore ou divi) qu'on veut modifier
    - quand on a créé son propre thème (genre immobilier) et qu'on veut juste modifier le style ou la charte graphique

## déclarer un thème enfant
+ Un peu comme pour le thème parent
+ on ajoute un dossier pour le thème enfant (exemple pour un thème parent: **custom_theme**): **custom_theme-child**
+ On déclare le thème dans le ``style.css``:
```php
/*
Theme Name: Custom_theme Child
Theme URI: http: //example.com/
Description: Thème enfant Custom_theme
Author: Xavier
Template: custom_theme
Version: 1.0
*/
```
+ Il faut indiquer le nom du thème enfant dans *Theme Name* et celui du theme parent dans *Template*
+ Dans functions.php on déclare les feuilles de style et scripts:
```php
function prefix_enqueue_assets(){
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'prefix_enqueue_assets' );
```
+ On active le thème enfant dans l'interface WP
