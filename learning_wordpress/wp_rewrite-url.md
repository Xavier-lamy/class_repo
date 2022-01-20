# L'URL rewriting

+ En tenmps normal on a pas besoin de réécrire des urls sous WP
+ On peut utiliser l'URL rewriting parfois afin de par exemple:
    - créer une architecture artificielle parent/enfant entre des pages qui ne sont pas supposés en avoir
    - avoir une url plus "clean"  dans certains cas (beaucoup de paramètres par exmeple)
+ Pour utiliser l'URL Rewriting on utilise (exemple pour un CPT catalogue dans lequel on veux afficher les filtres brand, color et size plus proprement dans la barre de recherche):
```php
// dans functions.php
function prefix_rewrite_url() {

    /*On déclare des tags, càd les paramètres que le CMS doit reconnaitre et transmettre  à la page:*/
    add_rewrite_tag( '%brand%','([^&]+)' );
    add_rewrite_tag( '%color%','([^&]+)' );
    add_rewrite_tag( '%size%' ,'([^&]+)' );
    
    /*On ajoute ensuite la fonction pour récupérer les paramètres dans l'URL, avec 3 paramètres:*/
    add_rewrite_rule(
      'catalogue/([^/]+)/([^/]+)/([^/]+)',
      'index.php?post_type=catalogue&brand=$matches[1]&color=$matches[2]&size=$matches[3]',
      'top'
    );
}
add_action( 'init', 'prefix_rewrite_url' );
```
+ Les 3 paramètres sont: 
    - l'URL telle quel apparaitra dans le navigateur (avec une regex)
    - l'url non réécrite (native), utilisé pour indiquer à WP quelle page aller chercher via la WP Query:
        + page: ``index.php?pagename=<slug>``
        + article: ``index.php?p=<id>``
        + CPT: ``index.php?post_type=<slug>``
    - la priorité (top = haute)
+ Bien penser à aller dans **Réglages > Permaliens** et enregistrer pour demander à WP de prendre en compte nos changements