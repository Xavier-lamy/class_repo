## Utiliser le hook "save_post"
### save_post pour ajouter le temps de lecture de l'article
+ ``save_post`` se lance après l'enregistrement d'une publication (article, page, CPT) et envoie les données enregistrées
+ Il va donc falloir faire certaines vérifications pour s'assurer d'enregistrer uniquement pour le post_type voulu et à **la modification** de la publication et **non**:
    - à la création de l'article (quand on clique sur ajouter), il n'y aura pas de contenu donc c'est pas utile
    - lors d'une révision
    - lors d'une save auto
+ Dans **functions.php**:
```php
function prefix_reading_time( $post_id, $post, $update )  {

	// Ne pas lancer dès le clic sur "ajouter"
	if( ! $update ) {
    	return;
	}

	// Ne pas executer le code lorsque c'est une révision:
	if( wp_is_post_revision( $post_id ) ) {
		return;
	}

	// Eviter les sauvegardes automatiques:
	if( defined( 'DOING_AUTOSAVE' ) and DOING_AUTOSAVE ) {
		return;
	}

	// Seulement pour les articles
	if( $post->post_type != 'post' ) {
    	return;
	}

	// Calculer le temps de lecture
    $word_count = str_word_count( strip_tags($post->post_content) );

    // On considère une vitesse de lecture de 250 mots/minute
    $minutes = ceil( $word_count / 250 );

    // On sauvegarde ce temps dans la meta du post
    update_post_meta( $post_id, 'reading_time', $minutes );
}
add_action( 'save_post', 'prefix_reading_time', 10, 3 );
```

+ Les 3 paramètres renvoyés par le hook:
    - ``$post_id`` : ID de la publication
    - ``$post`` : données de la publication (titre, contenu,...)
    - ``$update`` : boolean si true=enregistrement de l'article, si false=première création de l'article
+ Explication méthode de calcul:
    - ``$post->post_content`` : récupère le contenu de l'article
    - ``strip_tags()`` : supprime les balises HTML
    - ``str_word_count`` : compte le nombre de mots
    - ``ceil()`` : arrondi à l'entier supérieur (pour que nos minutes soient un entier)
    - ``update_post_meta()`` : enregistre notre valeur dans les métadonnées de la publication, et crée la méta donnée si elle n'existe pas encore
+ Afficher (ex: dans la page article), avec la fonction ``get_post_meta()``, avec en paramètres: 
    - l'identifiant du post,
    - la clé de la méta-donnée dont on cherche la valeur
    - un booléen, si true= valeur unique, retourne donc une string et non une array
```php
<p> 
    Temps de lecture : 
    <?php echo get_post_meta( $post->ID, 'reading_time', true ); ?> minutes
</p>
```

### Utiliser save_post pour créer un sommaire
+ On commence par faire les même vérifs que précédemment:
```php
function prefix_table_of_contents( $post_id, $post, $update )  {

	if( ! $update ) { return; }
	if( wp_is_post_revision( $post_id ) ) { return; }
	if( defined( 'DOING_AUTOSAVE' ) and DOING_AUTOSAVE ) { return; }
	if( $post->post_type != 'post' ) { return; }

	// 1.Création des ancres: ....

    // 2.Génération du sommaire: ...

}
add_action( 'save_post', 'prefix_table_of_contents', 10, 3 );
```
+ On créé ensuite les 2 parties de la fonction:
    1. Après nos tests on ajoute ceci dans la fonction afin de récupérerer nos titres et de leur ajouter une ancre (un ID créé à partir du titre transformé en slug)
    ```php
    // 1.Création des ancres:

        /* On recherche les titres h2 à h4 dans le contenu avec une regex, et des parenthèses capturantes et l'option "i" pour ignorer la casse, (.*?): n'importe quel contenu (permet de détecter les classes): */
        $content = preg_replace_callback(
            //Param 1: Regex: 
            "#<h([2-4])(.*?)>(.*?)<\/h([2-4])>#i",
            // Param 2: La fonction de remplacement:
            function( $matches ) { 
                $level = $matches[1]; //récupère le rang du titre (de 2 à 4)
                $slug = sanitize_title( $matches[3] ); // assaini le titre pour créer un slug ppour l'ID
                $title = $matches[3]; // récupère le titre sans les balises

                return "<h$level id='$slug'>$title</h$level>";
            }, 
            // Param 3: Le contenu dans lequel faire la recherche:
            $post->post_content 
        );

        // Pour éviter une boucle infinie, on désactive le hook:
        remove_action( 'save_post', 'prefix_table_of_contents', 10, 3 );

        // On met à jour le HTML de l'article avec la balise contenant l'id:
        wp_update_post( array( 'ID' => $post_id, 'post_content' => $content ) );

        // Réactiver le hook:
        add_action( 'save_post', 'prefix_table_of_contents', 10, 3 );
    ```
    2. On génère le sommaire:
        - On crée une variable ``$summary``, qui contiendra notre sommaire et qu'on incrémente à chaque fois avec ``.=``
        - on utilise à nouveau ``preg_match_all()`` pour récupérer les titres
        - on fait une boucle pour analyser les titres, pour chaque titre on crée une ``<li>`` avec un lien vers les ancres créées précédemment (``#$slug``)
        - on enregistre dans une nouvelle **post meta** nommée ``summary``
    ```php
    // 2. Génération du sommaire
        /* Initialiser le html du sommaire:*/
        $summary = "<ul class='summary'>";

        /* Récupérer les titres */
        preg_match_all(
            "#<h([2-4])(.*?)>(.*?)<\/h([2-4])>#i",
            $post->post_content,
            $matches,
            PREG_SET_ORDER
        );

        /* Ajouter une entrée au sommaire*/
        foreach( $matches as $match ) {
            $slug = sanitize_title( $match[3] );
            $title = $match[3];
            $summary .= "<li><a href='#$slug'>$title</a></li>";
        }
    
        /* Refermer le sommaire (toujours avec un point pour concaténer et ne pas écraser la variable):*/
        $summary .= "</ul>";

        /* Et on l'enregistre dans une meta liée à l'article:*/
        update_post_meta( $post_id, 'summary', $summary );
    ```
+ On peut ensuite afficher le sommaire (on peut aussi modifier légèremetn le code précédent de manière plus complexe, pour créer une hiérarchie entre les titres dans le sommaire), puis ajouter un peu de CSS pour styliser le tout:
    - Dans single.php: ``<?php echo get_post_meta( $post->ID, 'summary', true ); ?>``
    - pour le CSS , en plus du style de base du somaire on puet aussi ajouter ceci pour avoir un défilement plus animé et pas trop brut:
    ```css
        html {
    scroll-behavior: smooth;
    }

    h2, h3, h4 {
    scroll-margin-top: 40px; /* pour laisser une légère marge au dessus quand le scroll est terminé*/
    }
    ```

### Hookr.io
Il s'agit d'un site qui recense tous les hooks et fonctions wordpress, où elles sont déclarées et ce qu'elles contiennent