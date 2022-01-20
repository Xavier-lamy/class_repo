# La WP Query

+ Une classe PHP WordPress pour effectuer les requêtes des données spécifiques du CMS sans avoir à écrire de requetes SQL
+ par exemple si on veut récupérer les derniers articles pour les afficher n'importe où 

## Créer la requête
+ A l'endroit ou on veut afficher le contenu dans un modèle de page (page.php, single.php,...), on place le code suivant:
```php 
/* 1. Paramètres (query vars): On définit les arguments pour définir ce que l'on souhaite récupérer, consulter la doc officielle wp Query pour connaitre les query vars dispo:*/
$args = array(
    'post_type' => 'post',
    'category_name' => 'films',
    'posts_per_page' => 3,
);

/* 2. On exécute la requête WP Query avec le mot clé new et nos paramètres en argument:*/
$my_query = new WP_Query( $args );

/* 3. On lance une boucle wordpress (on ajoute simplement en préfixe, notre variable dans laquelle est stockée la requête (ici: $my_query)):*/
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
    
    the_title();
    the_content();
    the_post_thumbnail();

endwhile;
endif;

/* 4. On oublie pas de réinitialiser à la requête principale, pour retourner sur la boucle principale WP (important)*/
wp_reset_postdata();
```

## Paramètres les plus courants:
+ ``'post_type' => 'page',`` : filtre le type de publication (page, article, CPT,...)
+ ``'order' => 'DESC',`` : rangement ascendant (ASC) ou descendant (DESC)
+ ``'orderby' => 'date',`` : sur quelle donnée le tri est effectué (titre, date, nombre de commentaires, valeur champs ACF,...)
+ ``'orderby' => 'meta_value', 'meta_key' => 'note',`` : dans le cas d'un champs personnalisé ou ACF (*'meta_value'*), il faut ajouter le champs souhaité dans *'meta_key'*
+ ``'posts_per_page' => get_option('posts_per_page'),`` : valeur par défaut (celle des réglages du site) pour le nombre d'article par page; mettre un nombre personnalisé, ou ``-1`` si on les veut tous
+ ``'posts_per_page' => 10, 'offset' => 20,`` : indique qu'on veut 10 articles mais à partir du 20ème (``'offset' => 20,``)
+ Requêtes sur les dates: on peut faire des requetes très précises sur les dates (de publication par exemple):
```php
'date_query' => array(
    array(
        'after'     => 'January 1st, 2020', /* soit avec la date à l'américaine*/
        'before'    => array( /*Soit en décomposant chaque partie de la date, on peut voir la doc pour plus de façons de l'écrire*/
            'year'  => 2021,
            'month' => 12,
            'day'   => 31,
        ),
        'inclusive' => true,
    ),
),
```
+ ``'meta_key' => 'price',`` : nom du champ personnalisé
+ ``'meta_value_num' => 20, 'meta_compare' => '<=',`` : pour tester la valeur contenu dans un champ (ici on veut *<=20>*)
+ ``'meta_value' => 'string', 'meta_compare' => '!=',`` : pour tester la valeur contenu dans un champ pour du texte (ici on ne veut pas que ce soit "string")
+ Pour créer une requête complexe (les résultats de plusieurs champs personnalisés):
```php
'meta_query' => array(
    'relation' => 'AND', //toutes les conditions doivent être réunies
    array(
        'key' => 'price', //slug du champ
        'value' => array( 20, 49 ), //valeur à comparer
        'type' => 'numeric', // type de valeur attendu
        'compare' => 'BETWEEN', //élément de comparaison, ici on veut donc un nombre entre 20 et 49
    ),
        array(
        'key' => 'note',
        'value' => 16,
        'type' => 'numeric',
        'compare' => '>',
    ),

),
```

## Connaitre le nombre d'articles retournés par la WP Query
+ On utilise la méthode ``found_posts``:
```php
$args = array(
    'post_type' => 'post'
);
$my_query = new WP_Query( $args );
echo $my_query->found_posts . " articles trouvés";
```


## Modifier la WP QUery de la boucle principale
+ Si on souhaite effectuer une modification sur la boucle principale 
    - exemple: sur le CPT portfolio seulement, on veux que le nbr d'éléments par page soit 12 au lieu des 10 de nos réglages WP
+ On utilise le **hook** ``pre_get_posts`` pour modifier la WP Query juste avant l'exécution par WP, dans **functions.php**:
```php
    function prefix_override_query( $wp_query ) {
        if( $wp_query->is_main_query() and is_post_type_archive( 'portfolio' ) ): 
            $wp_query->set( 'posts_per_page', 12 );
        endif;
    }

    //On utilise le hook
    add_action( 'pre_get_posts', 'prefix_override_query' );
```
+ On commence donc par une condition pour vérifier:
    - qu'on modifie bien la requete principale (et non une requete personnalisée): ``is_main_query()`` 
    - qu'on est bien sur le CPT portfolio uniquement avec un conditionnal tag, ici:``is_post_type_archive('portfolio')``
+ On peut ensuite modifier ou ajouter des paralètres existants à la requête avec: ``$wp_query->set()``, on la répète autant de fois qu'il y a d'éléments à personnaliser
+ Si on souhaite afficher les valeurs des paramètres par défaut des **query vars** de la WP Query initiale de WP, pour pouvoir les modifier:
```php
function prefix_override_query( $wp_query ) {
  var_dump( $wp_query->query_vars );
}
add_action( 'pre_get_posts', 'prefix_override_query' );
```

## Système de filtre avec la WP Query
>Cours CaptainWP en construction
