# Les taxonomies
+ Système de classification des publications, par défaut les articles peuvent être classés par:
    - **catégorie** : hiérarchisée (parent/enfant), ne bouge pas beaucoup une fois définie
    - **étiquette** : peuvent être différentes pour chaque publication
+ On peut créer nos propres taxonomies pour les attribuer à nos CPT, ex: **Type de recette**

## Créer des taxonomies 
Dans functions.php déclarer :
```php
function prefix_register_post_types() {
    //Exemple pour un CPT de recettes de cuisine
    $labels = array(...);
    $args = array(...);

    register_post_type( 'recettes', $args );

    // Déclaration de la taxonomie type de recettes (exemple de termes: dessert, dessert de saison, plat, plat hivernal,...)
    $labels = array(
        'name' => 'Type de recettes',
        'new_item_name' => 'Nom du nouveau type de recette',
        'parent-item' => 'Type de recette parent'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
    );

    // Déclaration de la taxonomie
    register_taxonomy( 'type-recettes', 'recettes', $args ); 
        // 1er paramètre = slug de la taxonomie
        // 2eme paramètre = slug du CPT lié (mettre une array si on veux le lier à plusieurs CPT)
}
add_action( 'init', 'prefix_register_post_types' );
```
Pour les paramètres:
+ ``labels`` : Définit les intitulés
+  ``public`` : dans le cas d'un thème= true, si on crée une extension et qu'on a besoin de cacher le CPT on peut mettre à false
+ ``show_in_rest`` : si true = l'éditeur visuel sera **Gutenberg** au lieu de **Tiny MCE**
+ ``hierarchical`` : *true* = les taxonomies sont hiérarchiques

### Afficher les taxonomies dans le template:
+ Basique:
    - ``the_terms( get_the_ID() , 'type-recettes' )``
+ Avec contrôle de l'affichage: 3 derniers paramètres = 'affichage avant', 'séparateur', 'affichage après':
    - ``the_terms( get_the_ID() , 'type-recettes', 'Type de recette: ', ' - ', ''  )``

### Conditionnals tags pour les taxonomies
- ``is_tax( 'type-recettes' )`` : vérifie si on est dans la taxonomie **type-recette**
- ``is_tax( 'type-recettes', 'dessert' )`` : vérifie si on est dans la taxonomie **type-recette** et si le terme **dessert** de la taxonomie est sélectionné

### Templates perso pour les taxonomies et leur termes
+ On peut ajouter le **slug** (nom taxonomie, ex: *type-projet*) et le **terme** (ex: *video*): ``taxonomy-$slug-$term.php`` ou ``taxonomy-$slug.php``
