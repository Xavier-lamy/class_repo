# Les commentaires:

- Pour les réglages: **Réglages** > **discussions**

## Ajouter les commentaires dans le template (simple)
Dans la boucle WP de **single.php**:
- ``comments_template()``

## Ajouter les commentaires dans le template (sur mesure)
- créer un fichier **comments.php** à la racine du terme, WP l'utilisera en priorité avant le tmeplate par défaut
- ajouter au moins le contenu suivant:
```php
<div id="comments" class="comments__block">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments__title">
            // compte le nombre de commentaire (peut aussi etre utilisé ailleurs pour afficher le nombre de commentaires)
            <?php echo get_comments_number(); ?> Commentaire(s)
        </h2>
    
        <ol class="comment__list">
            <?php
            	// Liste les commentaires
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                ) );
            ?>
        </ol>
        
    <?php 
    	// S'il n'y a pas de commentaires
    	else : 
    ?>
        <p class="comments__none">
            Pas de commentaires
    	</p>
    <?php endif; ?>

    // Le formulaire d'ajout de commentaire
    <?php comment_form(); ?>
</div>
```
- On peut aussi utiliser ``comments_open()`` pour vérifier que les commentaires sont ouverts

## Les spams
Pour se protéger contre les spams on peut utiliser l'extension **Akismet Spam Protection** , pour l'activer il faut une clé API (qu'on ajoute dans les réglages)