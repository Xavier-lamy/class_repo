# Les pages builders

+ Il est possible d'utilser un page builder et de faire du sur mesure à coté pour d'autres parties, on a donc:
    - l'efficacité du page builder
    - la maléabilité du sur-mesure

+ Exemples de page builder:
    - Divi : l'un des plus anciens (payant)
    - Elementor (freemium: gratuit et Pro) 
    - Beaver builder
    - Oxygen BUilder: plus technique (payant)


## Approche hybride thème/page builder
+ Pour un projet il faut:
    - Aller vite (page builder)
    - Etre souple (page builder)
    - Etre rentable (page builder)
    - Répondre aux éventuels besoins spécifiques (thème sur mesure)
+ Approche hybride = garder le meilleur des deux
+ Elementor par exemple possède aussi des **hooks** pour pouvoir modifier ajouter des éléments

+ Les shortcodes: ancienne méthode encore utilisée parfois (formulaires notamment) pour ajouter des blocs au sein d'un contenu: si on veut ajouter un shortcode , on peut dans **functions.php**:
```php
function prefix_shortcode_first_name( $atts ) {
    
    if( ! is_user_logged_in() ) {
        return 'invité'; 
    }
    
    $current_user = wp_get_current_user();
    
    return $current_user->user_firstname;
}
add_shortcode( 'prenom', 'prefix_shortcode_first_name' );
// quand on utilisera le short code: Bonjour [prenom], cela retournera le prénom de l'user
```