## Avec wordpress on peut aussi ajouter :
- un formulaire de contact avec WP Form (ou Contact Form 7, Gravity Form):
- Quand on souhaite insérer une fonctionnalité (réalisé avec une extension) dans un article ou une page, il existe deux solutions:
    - Un shortcode: un petit code simple avec des variables, qui sera interprété dynamiquement lors de la génération de la page, pour l'obtenir on clique sur "Embed" en haut (pour wpForm), puis il suffit de coller ce shortcode dans le contenu de la page, avec Elementor par exemple: on ajoute une section à la page, on choisit "pleine largeur", dans l'icone d'accès aux modules on cherche "code court", puis on glisse le composant dans la section et on colle le code, on applique.
    - Un widget:  exemple dans Elementor: 
        - cliquer sur l'icone d'accès aux modules 
        - chercher wpform glisser le module dans la section souhaitée
        - utiliser le menu contextuel pour choisir le formulaire souhaité 
- Quand on met en place un formulaire de contact il faut choisri une solution qui enregistre les demandes en base de données, ou utiliser un addon pour le faire, afin d'éviter que les e-mails se perdent ou soient mal configurés 


- Une pop-up d'inscription à une newsletter avec le plugin Hustle


- On peut utiliser Updraft Plus pour faire des sauvegardes régulièrement, meme si l'h"bergeur propose des saves auto il est recommandé d'en faire aussi soi meme au cas ou 
    - On installe updraft plus 
    - on sauveagrde en gardatn coché 'base de données' et 'fichiers' pour sauvegarder l'intégralité du site , on peut alors retrouver cette sauvegarde dans "sauvegardes existantes" 
    - On peut aussi réaliser des sauvegardes distantes:
        - dans réglages on sélectionne "quotidiennement", puis on choisit le nombre de sauvegardes à conserver,  puis on se connecte à notre compte google pour pouvoir sauvegarder dans notre drive, on peut vérifier que tout a fonctionné en checkant notre drive et en téléchargant une fois les dossiers pour vérifier que tout y est 
 

- fonctionnalités avancées:
    - Une page d'attente personnalisée: avec elementor on peut créer une page d'attente si on souhaite que les visiteurs puissent accéder au site quand il est en construction il seront donc en attente sur cette page.
        - on créé une nouvelle page que l'on nomme "attente" , une fois qu'on l'a personnalisé selon nos souhaits on va dans elementor>>outils>>maintenance>>arrive bientot>> on choisit ensuite le modèle qu'on vient de créer 


- Avec Elementor et OceanWP on peut créer des footer et header personnalisés, cela permet d'avoir des designs plsu complexes que ceux créés avec le customer (avec la version premium d'elementor on peut meme faire cela pour toutes les parties (body, articles, pages,...)) dans ce cas le thème n'est quasi plus utilisé.

- On peut aussi ajouter des règles css personnalisées dans la section "css et JS personnalisé" du customizer:
    - On localise déjà le composant souhaité (en mode inspection par exemple), on lui ajoute une classe un id, ou on retient le code utilisé pour le cibler situé dans la colonne de droite, puis on peux ajouter du css grâce à ces sélecteurs.

- On peut aussi créer des types de contenu personnalisés, les CPT(Custom Post Types) (par exemple un pattern de site de voitures d'occasion) pour cela on peut utiliser par exemple CPT UI qui est gratuit, une fois l'extension installé on clique sur add/edit post types, puis on peut chanegr les champs selon ce que l'on souhaite créer. 
