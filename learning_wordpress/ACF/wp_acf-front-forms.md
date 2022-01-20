# Utiliser desformulaires ACF en front
+ Par exemple pour:
    - laisser un utilisateur connecté modifier des infos depuis le site
    - faire un formulaire d'inscription pour ajouer une nouvelle entrée

## Exemple modifier le contenu de la page
+ On limitera ceci uniquement aux auteurs avec une condition, autrement= gros problème de sécurité:
    - créer un groupe de champs (ex: texte, éditeur de contenu)
    - assigner à un template (ex: "Formulaire en front"):
    ```php
    <?php
    /*
        Template Name: Formulaire en front
    */
        // Contrôle des rôles utilisateur
        if( current_user_can( 'publish_posts' ) ) { 
            acf_form_head(); // Initialiser le formulaire ACF
        }

        get_header();
        if( have_posts() ): while( have_posts() ): the_post();
    ?>

        <h1 class="site__heading"><?php the_title(); ?></h1>
        <div class="wp-content"><?php the_content(); ?></div>

        <p>Texte : <?php the_field( 'text' ); ?></p>
        <p>Éditeur : <?php the_field( 'editor' ); ?></p>
        <p>Couleur : <?php the_field( 'color' ); ?></p>

    <?php 
        // Contrôle des rôles utilisateur
        if( current_user_can( 'publish_posts' ) ) { 
            acf_form(); // Le formulaire ACF
        }
    ?>

    <?php 
        endwhile; endif;
        get_footer(); 
    ?>
    ```
    - Ce formulaire s'affichera alors en front pour les utilisateurs connectés avec les droits de publication

## Exemple : créer une nouvelle entrée dans un CPT annuaire
+ cette fois on veut créer un nouveau contneu et non le modifier, le contenu sera cette fois affiché dans une nouvelle entrée du cpt
    - créer un groupe de champs
    - créer un template (ex: 'formulaire-front-inscription.php'):
    ```php
    <?php
    /*
        Template Name: Formulaire en front inscription
    */
        acf_form_head();

        // ...

        $args = array(
            // On va créer une nouvelle publication:
            'post_id' => 'new_post', 
            'new_post' => array(
                // Enregistrer dans le cpt annuaire:
                'post_type' => 'annuaire',
                // Enregistrer en brouillon:
                'post_status' => 'draft', 
            ),
            // L'ID du post du groupe de champs:
            'field_groups' => array( 329 ), 
            // Intitulé du bouton
            'submit_value' => 'Valider mon inscription', 
            'updated_message' => "Votre demande a bien été prise en compte.",
        );

        // Afficher le formulaire
        acf_form( $args ); 
    ?>
    ```