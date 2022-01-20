# Advanced Custom Fields (ACF)

- Les groupes de champs ACF sont enregistrés dans un CPT non public (d'où le post_type dans l'url)

## Installation
+ Version gratuite: 
    - Chercher Advanced Custom Fields (pas juste ACF)
    - installer et activer
+ Version pro:
    - télécharger l'archive, décompresser et placer manuellement le dossier ACF dans wp-content/plugins/
    - Installer la clé de licence

### Création d'un groupe
1. dans ACF créer un nouveau groupe de champs, lui donner un nom
2. ajouter des champs, on peut changer le type de champs (texte, image,...) et divers paramètres (valeur minimale, maximale pour un champ nombre,...)
3. choisir sur quelle(s) page(s) le groupe de champs doit apparaitre (sous forme de condition)

### Affichage de la valeur d'un champs
+ Pour **afficher** la valeur:
    - ``the_field( 'field-slug' )`` : en paramètre le slug du champs (attention à ne pas mettre le meme slug à des champs de deux groupes différents sur la même page)
+ Pour **récupérer** sans afficher:
    - ``$var = get_field( 'field-slug' )``

### Cas particulier de l'image
Dans le cas d'un champs type image, lors de la création on peut choisir plusieurs formats de sortie pour la valeur affichée dans le template:
+ Données de l'image: ACF renvoie une array contenant plusieurs données (et non uniquement la balise image ou l'url):
    - Si on souhaite utiliser cette array on peut
    ```php
        // Condition 'if' pour vérifier la présence du champs image 

        // Récupérer l'array dans une variable:
        <?php $picture = get_field( 'picture-field-slug' ); ?>

        // On affiche les données de l'image, qui nous intéressent:
        <img
            // On récupère l'array des sizes pour l'ajouter devant l'url, cela permet de générer toutes les urls des différentes tailles, WP pourra ensuite choisir la bonne url en fonction de la situation
            src="<?php echo $picture['sizes']['post-thumbnail']; ?>"
            alt="<?php $picture['title']; ?>" />
        
    ```

+ URL de l'image (peu recommandé, car retourne l'url de la plus grand image, donc pas très performant)

+ ID de l'image: pour générer la balise image à partir de là on peut utiliser: 
```php
<?php 
    // Cette fois get_field n'aura donc que l'ID au lieu d'une array
	$image_id = get_field( 'picture-field-slug' );

    // On vérifie qu'on a bien un champs 
	if( $image_id ) {	
        // On utilise la fonction suivante pour générer la balise html de l'image avec son srcset, avec en second paramètre le slug de la taille d'image (full, large, medium, medium-large, thumbnail ou personnalisé)
		echo wp_get_attachment_image( $image_id, 'full' );
    }
```

+ Pour appliquer l'image en background CSS:
```php
<?php
    $image_id = get_field('image');
    $url = wp_get_attachment_image_src( $image_id, 'full' );
?>
    <div style="background-image: url(<?php echo $url; ?>)"></div>
```

## Assigner des champs aux taxonomies, utilisateurs, menus et widgets

### Assigner un groupe de champs à une taxonomie
+ on crée le groupe (exemple: des champs pour définir la couleur et le pictogramme pour chaque catégorie)

+ Dans les conditions d'assignation du champs: dans **Formulaires > taxonomie**, ainsi le champ apparait des qu'on ajoute ou modifie une catégorie

+ Afficher dans le template (généralement sur **category.php**, **tag.php** ou **taxonomy.php**):
```php
// Récupérer la taxonomie:
$term = get_queried_object();

// Afficher les données
$image_id = get_field( 'icon', $term );
$color = get_field( 'color', $term );
```
+ Si on souhaite faire un menu affichant les taxonomies sur le blog:
```php
$taxonomies = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => false
) );
 
if ( !empty( $taxonomies ) ) :
    foreach( $taxonomies as $category ) {
        $image_id = get_field( 'icon', $category );
    	$color = get_field( 'color', $category );
    endforeach;
endif;
```

### Assigner un groupe de champs aux médias
+ Cela peut nous permettre d'ajouter des champs, par exemple un champ copyright pour les images
+ On crée le groupe
+ On l'assigne (ex: montrer quand: Média est égal à tous les formats)
+ pour afficher
```php
// Pour une thumbnail
$image_id = get_post_thumbnail_id();
$copyright = get_field( 'copyright', $image_id );

// Pour une image ACF
$image = get_field( 'image' );
$copyright = get_field( 'copyright', $image['ID'] );
```

### Assigner un groupe de champs aux widgets
+ dans les faits on utilise plus trop les widgets
+ On crée et assigne le groupe (quand widget est égal...)
+ Pour l'affichage c'est un peu plus complexe:
```php
// Dans functions.php
function prefix_dynamic_sidebar_params( $params ) {
	
	// Récupérer les données du widget
	$widget_name = $params[0]['widget_name'];
	$widget_id = $params[0]['widget_id'];
	
	// Viser seulement le widget text
	if( $widget_name != 'Text' ) {
		return $params;
	}
	
	// Récupérer la valeur ACF
	$color = get_field( 'color', 'widget_' . $widget_id );
	
    // Injecter le style dans le widget
	if( $color ) {
		
		$params[0]['before_widget'] .= '<style type="text/css">';
		$params[0]['before_widget'] .= sprintf('#%s { background-color: %s; }', $widget_id, $color);
		$params[0]['before_widget'] .= '</style>';	
	}

	return $params;
}

add_filter( 'dynamic_sidebar_params', 'prefix_dynamic_sidebar_params' );
```

### Assigner un groupe de champs aux menus
+ Assigner au menu globalement: pour par exmeple définir une couleur de fond avec un champ ACF (appliquée ensuite en CSS): pas très utile il vaut mieux passer par une page d'options pour ça
    - Assigner: "menu = tous"
    - Afficher:
    ```php
    //Dans functions.php
    function prefix_wp_nav_menu_items( $items, $args ) {
        
        // Récupération du menu
        $menu = wp_get_nav_menu_object( $args->menu );
        
        // Valide pour le menu principal seulement (défini dans functions.php)
        if( $args->theme_location == 'main' ) {
            
            // Champs ACF
            $color = get_field( 'color', $menu );
                    
            // Insérer le style
            $html_color = '<style type="text/css">.navigation-main{ background: '.$color.';}</style>';
            
            // On ajoute au HTML
            $items = $items . $html_color;
        }
        
        return $items;	
    }
    add_filter( 'wp_nav_menu_items', 'prefix_wp_nav_menu_items', 10, 2 );
    ```
+ Assigner à chaque élément du menu: pour les personnaliser (ex: ajouter une icône à un élément de menu): c'est plus utile
    - Assigner le champ ACF: "élément de menu = tous"
    - Afficher:
    ```php
    function prefix_wp_nav_menu_objects( $items, $args ) {

        foreach( $items as &$item ) {
            
            // var_dump( $item ); // Pour savoir ce qui se trouve dans cet objet
            
            // Champ ACF
            $color = get_field( 'color', $item );
            
            if( $color ) {	
                $item->title .= '
                    <span class="dot" style="background-color: '. $color .'"></span>';
            }
        }
        
        return $items;	
    }

    add_filter( 'wp_nav_menu_objects', 'prefix_wp_nav_menu_objects', 10, 2 );
    ```

### Assigner un groupe de champs aux commentaires
+ Cela peut servir par exemple à afficher une case à cocher "accepter la politique de confidentialité
+ créer et assigner
+ afficher:
```php
// Dans functions.php
    // Exemple pour un affichage d'une case RGPD
    function prefix_comment_confirm( $author, $comment ) {
        
        $accept = get_field( 'gdrp', $comment );
        $accept_html = $accept ? "<p>✅RGPD accepté</p>" : '';
        
        return $author . $accept_html;
    }
    add_filter( 'comment_author', 'prefix_comment_confirm', 10, 2 );

    // Exemple pour laisser insérer une image à la suite d'un commentaire
    function prefix_comment_text( $comment_text, $comment ) {
        
        // Si on souhaite que seul l'admin puis le faire on ajoute ceci
        if( ! is_admin() ) { return $comment_text; } 
        
        $image_id = get_field( 'screenshot', $comment );
        $image_url = wp_get_attachment_image( $image_id, 'thumbnail' );
        
        return $comment_text . $image_url;
    }
    add_filter( 'comment_text', 'prefix_comment_text', 10, 2 );  
```

### Assigner un champ à un profil utilisateur
+ Exemple pour ajouter des infos à leur profil
+ Assigner : "quand formulaire utilisateur = Ajouter/modifier"
+ afficher:
```php
<?php
	$id = get_current_user_id(); // Pour l'utilisateur en cours
	$id = $post->post_author; // ou pour l'auteur de l'article
?>
    // On récupère le champs twitter, en concaténant son ID à 'user_'
    <p><?php the_field( 'twitter', 'user_' . $id ); ?></p>
```


## Hooker des champs ACF pour modifier les valeurs
### Injecter des valeurs dynamique dans un *select*
+ Supposons que le client souhaite un champs select avec des compétences qu'il peut modifier facilement:
    - On crée un groupe de champs avec un champs select "compétences" qu'on laisse vide (c'est dans ce champs qu'on viendra injecter nos valeurs)
    - On crée un second champ textarea (skills_list), dans une page d'options, dans ce champs on pourra lister toutes les compétences (une par ligne, pour pouvoir découper à chaque retour à la ligne en PHP), et en ajouter ou supprimer facilement
    - Afficher:
    ```php
    function prefix_load_skills_choices( $field ) {

        // On récupère la valeur du champ skills_list dans les options
        $values = get_field( 'skills_list', 'options' );

        // On crée un tableau à partir des données : une ligne = une entrée
        $choices = explode( "\r\n", $values );

        // On assigne les choix au champ
        $field['choices'] = $choices;

        // On retourne la donnée
        return $field;
    }
    // On utilise le hook "acf/load_field en lui ajoutant "name=skills" pour limiter uniquement aux champs "skills"
    add_filter( 'acf/load_field/name=skills', 'prefix_load_skills_choices' );
    ```

### Filtrer les résultats d'un champ
+ Exemple si on a un champ "note" d'un cpt jeu vidéo et qu'on veut seulement afficher si leur note est strictement supérieure à 15/20
+ Créer un champ realtionnel (best_games) pour qu'il récupère els meilleurs jeux de ce CPT
+ Afficher en utilisant le hook ``acf/fields/relationship/query``, ce hook intervient juste avant de faire la requête à  la bdd, on peut donc modifier les paramètres de la WP Query, pour ne demander que les jeux à la note supérieur à 15:
```php
function prefix_filter_games_query( $args, $field, $post_id ) {

    // ajouter des arguments à la requête
    $args['meta_query'] = array(
    	array(
      		'key'     => 'note',
      		'value'   => 15,
      		'compare' => '>',
        )
  	); 

    // renvoyer les arguments modifiés
    return $args;
}

add_filter( 'acf/fields/relationship/query/name=best_games', 'prefix_filter_games_query', 10, 3 );
```

### Afficher une donnée dans un résultat de champ
+ Comme précédemment
+ Afficher: cette fois on utilise le hook ``acf/fields/relationship/result/`` car on veut intervenir une fois le résultat reçu et non avant la requete:
```php
function add_note_to_game_name( $text, $post, $field, $post_id ) {
  
    // On récupère la note
    $note = get_field( 'note', $post->ID );

    // On l'ajoute à la suite du nom
    $text = $text . " • " . $note . "<small>/20</small>";

    // On renvoit la valeur
    return $text;
}
add_filter( 'acf/fields/relationship/result/name=best_games',  'add_note_to_game_name', 10, 4 );
```

## Créer un bloc Gutenberg avec ACF
+ Exemple: un bloc extension, pour présenter une extension WP, on peut aussi s'en servir pour créer des blocs gutenberg que l eclient pourra utiliser  n'importe ou dans le contenu
    - Déclarer
    ```php
    // dans functions.php
    function prefix_register_acf_block_types() {

        //On utilise une fonction surcouche d'ACF qui fait appel à la fonction native de WP pour la création de blocs
        acf_register_block_type( array(
            'name'              => 'plugin',
            'title'             => 'Extension',
            'description'       => "Présentation d'une extension WordPress",
            'render_template'   => 'blocks/plugin.php',
            'category'          => 'formatting', 
            'icon'              => 'admin-plugins', 
            'keywords'          => array( 'plugin', 'extension', 'add-on' ),
            //On définit une feuille de style pour ce bloc, car elle sera chargé par l'éditeur visuel
            'enqueue_assets'    => function() {
                wp_enqueue_style( 'prefix-blocks', get_template_directory_uri() . '/css/blocks.css' );
            }
        ) );
    }

    add_action( 'acf/init', 'prefix_register_acf_block_types' );
    ```

    - On peut ensuite créer un groupe de champ et l'assigner à ce nouveau bloc

    - On crée le fichier de template du bloc (que l'on link dans 'render_template' dans l'array), exemple:
    ```php
    <div class="plugin">
        <div class="plugin__content">
            <p class="plugin__title">
                <?php the_field( 'title' ); ?>
            </p>
            <p class="plugin__description">
                <?php the_field( 'description' ); ?>
            </p>
            <p>
            <a href="<?php the_field( 'url' ); ?>" class="plugin__link" style="background-color: <?php the_field( 'color' ); ?>">
                Télécharger l'extension
            </a>
            </p>
        </div>
        <div class="plugin__icon">
            <?php echo wp_get_attachment_image( get_field( 'icon' ), 'full' );  ?>
        </div>
    </div>
    ```
    
    - On crée le fichier CSS pour ce bloc (qu'on range dans un dossier css pour les blocs)

## Add-ons utiles pour ACF
+ On peut en trouver une liste sur **awesomeacf.com**:
    - **ACF Content Analysis for Yoast SEO** permet d'ajouter le contenu des champs ACF à l'ananlyse de Yoast (par défaut Yoast ne peut pas lire les champs ACF)
    - **Advanced Custom Fields: Font Awesome Field** : ajoute un champ acf pour choisir une icone Font Awesome
    - **Advanced Custom Fields: Table Field** : ajoute un champs pour des tableaux
