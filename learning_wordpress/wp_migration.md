# Migration

Quand on souhaite migrer notre site sur un serveur (ex: passer du dev à la prod):

+ On a besoin des identifiants du serveur en question
+ utiliser duplicator:
    - créer un paquet avec nos documents, cela crée ``une archive compressé`` et un fichier ``installer.php``
+ sur l'hébergement on place ``installer.php`` et ``l'archive`` à la racine dans htdoc ou html 
+ on se connecte à la base de données
+ On lance l'extraction des fichiers et l'installation du site

+ Points importants à vérifier avant d'indexer le site:
    - Désactiver l'affichage des erreurs php: ``define( 'WP_DEBUG', true );``
    - Vérifier le nombre de révisions des articles (combien wp en sauvegarde): ``define('WP_POST_REVISIONS', 3 );``
    - Supprimer les éventuels articles et CPT de tests
    - Vérifier les réglages d'écriture et de lecture (il ne devrait normalement pas y avaoir vraiment de difference avec la dev)
    - Créer les éventuels comptes pour les participants (autres admin, auteurs,...)
    - Ajouter le Re-captcha si il y a des formulaires
    - Minifier le css et le js
    - Vérifier les réglages SEO, notamment dans yoast:
        * Désactiver les archives de pages auteurs (sauf si nécessaire dans le projet)
        * Désactiver les archives par date (sauf si nécessaire dans le projet)