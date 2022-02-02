# Les types de publication et les taxonomies

Par défaut il y a 2 Post Types qu'on utilise directement:
- **Articles**: classés *chronologiquement*, listés dans une page archive (par défaut les 10 derniers)
- **Pages**: indépendantes: classés *hiérarchiquement* avec une relation parent/enfant (url: site.com/page-parent/page-enfant)

Il existe aussi d'autre Post Types:
- les **attachments** : les médias de la bibliothèques (images, sons, vidéos,..)
- les **menus**
- les **révisions** : sauvegardes auto des articles, récupérable en cas de problème, accessibles directement depuis l'interface des articles

## Les Custom Post Types (CPT)
- On peut utiliser des CPT quand on veut séparer un type de contenu, qui ne soit pas une page ou un article, exemple: des services, des produits,...
- ça permet de leur attribuer une mise en page différente
- On peut bien sûr ajouter notre nouveau CPT  au menu, comme pour n'importe quelle publication
- les CPT sont rangés dans la colonne **post_type** de la table **wp_posts** dans la BDD

- On peut aussi créer des CPT avec des extensions exemple CPT UI (gratuit)

### Créer un CPT
Dans functions.php déclarer:
```php
function prefix_register_post_types() {
   
    $labels = array(
        'name' => 'Services',
        'all_items' => 'Tous les services',
        'singular_name' => 'Service',
        'add_new_item' => 'Ajouter un service',
        'edit_item' => 'Modifier le service',
        'menu_name' => 'Services'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-customizer',
    );

    register_post_type( 'service', $args ); //1er paramètre = slug du CPT, utilisé notamment pour l'url
}
add_action( 'init', 'prefix_register_post_types' ); //La fonction est lancée par le hook 'init'
```
Pour les paramètres:
+ ``labels`` : Définit les intitulés du menu d'admin WP
+  ``public`` : dans le cas d'un thème= true, si on crée une extension et qu'on a besoin de cacher le CPT on peut mettre à false
+ ``show_in_rest`` : si true = autorise la prise en charge par les API
+ ``has_archive`` : définit si le cpt possède des **archives** et des **singles** (comme les articles) ou non (comme les pages)
+ ``supports`` : une array où on choisit les champs qu'on souhaite afficher dans l'interface d'administration des publications: 
    - ``title`` : champ titre
    - ``editor`` : éditeur visuel (classique par défaut, ou Gutenberg si choisi)
    - ``author`` : changer/choisir l'auteur
    - ``thumbnail``
    - ``excerpt``
    - ``comments``
    - ``revisions`` : sauvegarde auto des révisions
    - ``custom-fields`` : prise en charge custom-fields (pas utile si on utilise ACF)
    - ``page-attributes`` : si on souhaite attribuer des templates perso
    - ``post-formats`` : Posts Formats (ex: tumblr)
+ ``menu_position`` : la position dans le menu WP:
    - 5 : après **Articles**
    - 10 : après **Médias**
    - 20 : après **Pages**
    - 65 : après **Extensions**
    - 70 : après **Utilisateurs**
    - 80 : après **Réglages**
    - 100 : tout en bas
+ ``menu_icon`` : choisir l'icone du CPT, 3 possibilités:
    - Choisir une **Dashicons** = police de pictos WP (voir sur la doc des ressources pour avoir les noms des **Dashicons**)
    - Ajouter un .png: ``get_template_directory_uri() . '/img/icons/cpt-icon.png'``
    - embarquer un svg encodé en **base64**: ``'data:image/svg+xml;base64' . base64_encode( "<svg>...</svg>" ),``

>Attention!! Quand on crée un nouveau CPT ou une nouvelle taxonomie, il faut penser à aller dans **Réglages > Permaliens** et cliquer sur enregistrer (pas besoin de modifier), sinon on risque d'avoir des erreurs 404 car WP ne comprends pas la nouvelle URL générée par le CPT

### Conditionnals tags pour les CPT
- ``is_post_type_archive( 'services' )`` : vérifie si on est sur l'archive du CPT **services** (``is_archive()`` ne fonctionne pas pour les CPT)
- ``is_singular( 'services' )`` (au lieu de ``is_single()``)  : vérifie si on est dans la single du CPT **services**

### Templates perso pour les CPT
+ Il suffit d'ajouter le **slug** du CPT au nom du fichier modèle de base (**page-$slug.php**), exemple:
    - Si on veut que les pages de **Services** aient un template différents de **archive.php** et **single.php** on utilise: **archive-services.php** et **single-services.php**
+ Si on veut afficher le nom du CPT (ex: Services) en guise de titre, on utilise la fonction: ``post_type_archive_title()``
