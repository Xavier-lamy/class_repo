# Optimisation SEO
#### Il existe deux types d'optimisations: 
- Off site:
    .Déclaration auprès de google search console
    .Création profil Google My Business
    .Mise en place de liens entrants sur des ites à fort trafics ou bien référencés sur les mots clés
    . ... 

- On site:
    .Qualité du contenu (on peut faire appel à un rédacteur web SEO)
    .Nom de domaine (ex: avoir le mot clé principal dans le nom de domaine, en cas d'activité locale ajouter el nom de la ville)
    .Titres et description de pages (balise titres et meta dans le header)

#### POur cela on peut utiliser des extensions comme SEO Press:
- Il va donner une liste de recommendations pour notre site:
    - Mettre en place un certificat SSL (pour la connexion sécurisée)
    - n'afficher que l'extrait des contenus dans le slfux rss 
    - Affihcer d'avantage d'articles par pages (ex:10)
    - Créer un compte google mybusiness (très important pour les recherches localisées)
    - Déclarer le site sur google search console , afin de dire à google que notre site existe, à faire juste avant le lancment quand le site est pret à etre référencé 
- Ensuite on peut faire attention à plusieurs autres détails:
    - minimum 300mots par page 
    - le titre de l'article oude la page doit contenir les expressions de recherche cible 
    - les titres h2 doivent contenir les mots clés cibles et etre bien structurés
    - optimiser le titre et la meta description de la page 

- Optimisation du temps de chargement:
    - On peut utiliser GT Metrix ou Pingdom pour tester les temps de chrgment, cela nous permettra d'observer:
        - le délai pour afficher le contenu de la page (doit etre inférieur à 1.2s)
        - le temps de chargement des scripts (les interactions sont bloqués pendant ce temps, il doit etre inférieru à 150ms)
        - le décalage de rendu de la page (ex: section qui s'agrandit suite au chargeent d'une image, doit etre inférieur à 0.1)

    - Solutions pour accélerer nos pages:
        - mettre en place un cache pour générer les pages à 'vance et ne pas les recharger  entièrement à chaque fois qu'elles sont visitées, il existe toris types de caches:
            - OP cache: met en cache les fichiers, à ne vider que si on modifie des ficheirs via FTP
            - Cache applicatif: met en cache les pages et/ou requetes pour les générer 
            -  cache serveur (se configure coté hébergeur): met en cahce l'intégralité des pages (full page cache)
        QUand on fait d ela maintenace sur le site il faut penser à dsactiver ou vider le cache régulièremetn, sinon nos modifs ne seront pas visibles en direct
        - Nettoyer régulièrement la base de données
        - optimiser les images en les compressant et en utilisant une taille d'image adaptée (pas prendre une image de 1200px alors qu'on a besoin d'une icone de 150px)

- Avant de mettre le site en ligne il faut:
    - supprimer le contenu non utilisé (ex: contneu généré par les pages de démo utilsiés)
    - vérifier l'affichage des paegs surr tous supports (mobiles, tablettes, pc,..)
    - Vérifier que le contneu répond aux bonnes pratiques d'accessibilité (pour les différents handicaps, malvoyant, malentandants,...):
        - titres et descriptions pour les images (pour etre lus par les liseuses)
        - contraste élevé entr le texte et le fond
        - taille de police suffisamment grande
        - labels explicites pour les liens 
    - vérifier qu'il n'y a pas de liens cassés
    - vérifier que le site est visible par les moteurs de recherche 
    - vérifier que les formulaires fonctionnent
    - créer une page pour les mentions légales obligatoires
    - protéger le site des hackers: solution de sécurité, modifier l'url de connexion,... 