# Bases 
- wordpress permet de faire tous types de sites, et pas uniquement des blogs, on peut donc aussi
faire du ecommerce, des solutionns intranet, des applications...

- CMS: Content Management System: une famille de logiciels destinés à créer et mettre à jour de manière dynamique, des sites webs ou autres applications multimédia.

- opensource: logiciels dont la licence respecte les critères de "l'Open SOurce Initiative", permettant notamment : la libre redistribution, l'accès au code source et la création de produits dérivés.

- l'avantage c'est que l'open source permet souvent de développer une grande communauté active sur les differents projets

- wordpress est la solution opensource de cms la plus populaire, créé en 2003 par mike little et matt mullenweg

- En 2004 la màj 1.2 ajoute les plugins, ce qui permet ainsi à n'importe qui d'ajouter et de partager des fonctionnalités pour wordpress 
- En 2005 les "pages" (qui permettent enfin de créer autre chose que des blogs) et les "thèmes" (qui permettent d'installer facilement un type de design) sont introduits

- Wordpress (wordpress.org) != wordpress.com :

- wordpress : nom du cms opensource, dont les fichiers sont téléchargeable sur wordpress.org 

- wordpress.com : solution d'hébergement à but lucratif qui se base sur le cms wordpress 

- En 2010:
    - custom post types (types de contenu personnalisés)
    - custom taxonomies (catégories personnalisées)
- Il permettent de créer des sites plus complexes (par exemple avec un type de contenu "maison" qui permet d'avoir les proprétés tellles que la surface, le nombre de pièces facilement intégrés au type)

- 2012: arrivée du customizer qui permet de customiser de manière plus direct le site en voyant directement les changements 

- wordpress 5.0 ajoute un nouveau concept de gestion standard des contenus: les blocs, cela permet de réutilser des contenus sous différentes formes 

- Gutenberg : éditeur de texte qui repose sur ce concept de blocs 

- Pour la suite on utilise themecloud 

- Pour se connecter à wordpress il faut se rendre sur l'url: nomdusite.com/wp-login.php = url de connexion par défaut, ou nomdsite.com/wp-admin qui redirige vers la précédente

- Il faut faire très attention aux login et mots de passe car l'url de connexion étant la meme pour tous les sites wordpress, il est très facile de faire une attaque par force brute si les mots de passe ne sont pas assez sécurisés. on peut aussi modifier l'url par défaut pour une url plus difficile à trouver

- Ensuite quand on est sur le wordpress de notre site on peut aller dans le dashboard

- On peut créer notemment :
    des pages : contenu statique qui a la meme valeur constante dans le temps (ça permet par exemple de présenter l'entreprise, les services)
    des articles: contenu d'actualité, daté qui a une valeur importante au moment de sa publication 

- Pour ajouter un article:
    - cliquer sur "posts" , "add new" 
    - ajouter une catégorie dans "add new category" (on peut mettre "divers")
    - ajouter une image dans "featured image" = image principale de l'article (qui sert à l'identifier dans l'article)
    - on peut cliquer sur le "plus" pour ajouter un bloc image, on peut utiliser le glissé déposé pour déplacer les blocs ainsi créés
    - on clique sur "publish" (on peut sauvegarder en brouillon ou en normal par exemple)
 
- Il existe en effet deux façons de trier des articles:
    - les catégories (elles ont une hiérarchie, avec des sous catégorie), on essaye en général de ne mettre qu'une catégorie par article (meme si ce n'est pas obligatoire)
    - les tags: pas de hiérarchie, on peut en mettre autant qu'on veut

- Dans la barre à droite on peut modifier la visibilité (publique ou privée), définir à quelle date il doit etre publié


- dans settings => general:
    - changer le titre et slogan : le titre sert en effet pour le SEO 
    - on peut modifier la langue, et divers autres options (comme l'adresse de mesagerie ou le role par défaut pour les nouveaux utilisateurs,...)
    - On peut modiifer ppour que les articles soit dans la catégorie par défaut qu'on a créé ("divers")

- dans lecture on peut activer l'option "demander aux moteurs de recherche de ne pas indexer le site" pour éviter qu'il puisse etre affihcé - dans les resultats de recherche alors qu'il n'est pas fini 
- IL NE FAUT SURTOUT PAS OUBLIER DE DECOCHER CETTE CASE QUAND ON VEUT METTRE LE SITE EN LIGNE 

- On peut aussi définir les parametres des commentaires, discussions, des permaliens (url principale pour acéder à un contenu, il est recommandé de cocher l'option "date et titre" car l'option "simple" ne possède pas le titre de l'article dans l'url ce qui est moins bon pour le référencement naturel)

- Pour une page d'accueil: 
- "pages" >> "ajouter", on saisit le titre et le contenu (slogan, ou description), puis on peut créer une autre page "blog" mais sans contenu  car elle contiendra la liste des articles du site 

- après avoir publié ces pages on va dans : "settings" >> "reading" :
    - dnas "la page d'accueil affiche" on met "une page statique", on met notre page accueil dans la partie "page accueil" et "blog" dans la page des articles 

- Ensuite dans "apparences >> menu" (ou dans le customizer: apparences >> personnaliser >> menu) on peut gérer la présence de nos menus on peut ajouter un menu en lui donnant un nom puis sélectionneez les pages que l'on souhaite voir dans le menu et les ajouter 

- L'onglet option d'écran  permet d'activer des options sur la page, comme la possibilité d'ouvrir un item de menu dans un nouvel onglet , ajouter une class css perso, ou définir le nombre d'articles à afficher dans la page administation "articles"

- dans le customizer on peut ajouter de nombreuses chose en ayant accès directement aux changements visuels:
    - on peut ajouter un logo (qui s'affichera avant le titre)
    - ajouter un favicon (l'icone a coté du nom du site sur l'onglet)

- C'est aussi dans le customizer qu'on peut régler des aprameètres comme la couleur, un thème sombre, et différentes options liées au thème :
    - comme la mise en page du site (sur une ou deux colonnes) , l'affichage du contenu  des différentes sections de la page d'accueil 

- Par défaut un site wordpressa affichera les derniers articles publiés 
