# Mettre en ligne le site local

## Avant le lancement
- configurer le nom de domaine:
    - si on a l'hébergment et le nom de domaine chez le meme fournisseur ce sera déja configuré
    - sinon si l'hébergement et le nom de domaine sont pris chez deux différent sprestataires il faudra faire pointer le nom de domaine vers l'hébergement, en modifiant les enregistrements DNS (qui permet d'associer une destination à un domaine ou sous domaine)

- On configure Google Analytics en se créant un compte et en suivant les instructions
- On configure Google Search Console afin de prévenir google de son existence, on se créé un compte et on suit les instructions

## Via une extension (facile)
Exemples: 
- All-in-one WP Migration
- Duplicator
Voir la doc de chaque extension en fonction de celle choisie, en général on exporte depuis le site local avec l'extension puis on ajoute sur un site vierge en ligne via l'extension également)

## Méthode manuelle
Les étapes peuvent varier un peu en fonction de l'outil utilisé pour les réaliser
1. Importer les fichiers via FTP
2. Exporter la base de données
3. Importer la base en ligne
4. Changer l'URL du site (sinon le site utilisera encore l'url locale, on peut changer ça dans la table ``wp_options`` de la bdd, dans les entrées: ``siteurl`` et ``home``)
- éventuellement ajouter le ``S`` à ``https://`` si on a le certificat SSL
5. Modifier wp-config.php (le fichier en ligne pas en local, sinon on ne pourra plus se connecter en local):
    - Indiquer les identifiants de connexion à la BDD fournis par l'hébergeur (DB_NAME, DB_USER, DB_PASSWORD, DB_HOST)
    - remettre ``WP_DEBUG`` à ``false``
6. Remplacer les urls de la base (les vieilles url locales sont encore sauvegardées dans la bdd pour les publications, réglages,...):
    - on peut utiliser l'extension **Better Search Replace** pour faciliter l'opération chercher/remplacer
7. Aller dans les réglages et réenregistrer la structure des permaliens (pour etre sur que WP soit à jour dans cs données)


## Importer le site en ligne en local
- Pour par exemple travailler dessus sur une nouvelle branche
- ON utilise la meme méthode, mais depuis le site en ligne vers le local

## Certificat SSL
- Il est important de générere un certifiact SSL pour le chiffrage des connexions, **Let's Encrypt** permet d'avoir des certificats SSL gratuits
- Si on ne fait pas la mise en ligne manuellement et qu'on veut ajouter le certificat SSL on peut utiliser une extension WP (comme **Really Simple SSL**), pour ajouter automatiquement les https:// aux liens du site (il faut juste avoir déjà un certficat SSL)

## Version payante
On peut utiliser Migrate DB Pro pou faire tout ça plus facilement (payant)
