# Les thèmes et les extensions

Avant de créer un site avec wordpress il faut savoir quel type de projet on veut faire (vitrine en ligne, génération de traffic, de contact ou de ventes,...), puis d'installer ce qu'on a besoin en plugin et en thèmes:

1. definir les objectifs du site 
2. penser au référencement dès le début du site :
  - définir les expressions de recherche qu'on utilisera pour positionner le site dans les moteurs de recherche,
  - faire attention à prendre des mots clés pas trop générique, il faut que la concurrence soit faible sur ces mots clés mais que le traffic potentiel qu'ils peuvent générer soit fort 

  - On peut utiliser des outils comme "neil patel" pour comparer la différence concurrence/traffic potentiel de mots clés et expressions de recherche 
  - Il faut réfléchir aux expressions de recherche principales mais aussi secondaires que l'on souhaite (exemple: en principale "agence wordpress dijon" en secondaire on  pourrait chercher pour "freelance wordpress dijon" (déclinaison), ou "création logo dijon", "référencement dijon" (expressions ciblant les activités que le visiteur pourrait etre amené a rechercher))  

3. Définir la structure du site :
  - créer un plan du site  en définissant une arborescence notamment:
    - Exemple:
      Sur tout le site:
        - pop up newsletter
      Accueil:
        - Présentation des services
        - Compétences de l'agence 
        - Incitation à prendre contact:
            . services 
            . expertises 
            . carroussel de témoignages
            . carroussel de logos des références clients
      Création de site wordpress
        - présenter ce service 
        - exemples de réalisation 
        - incitation à prendre contact 
      référencement naturel
        - description
        - résultats obtenus avec des stats, des compteurs dynamiques 
      contact 
        - formulaire de contact 
  - créer des wireframes: des schémas simples expliquant la structure , soit sur crayon et papier ou avec des outils comme "cacoo" ou "wireframe.cc"


## Thèmes:
- un thème sous wordpress permet de definir une apparence pour le site avec des options de personnalisation, de design et de compatibilité qui diffèrent en fonction du thème 
le thème gère l'affichage à l'aide de templates Php, qui vont définir l'affichage et les options dispo pour:
  - le header (logo, menu, barre de recherche)
  - le contenu (articles, pages, listes de produits sur un site ecoomerce)
  - le footer (menu de pages, mentions légales, politiques de confidentialité)
  - les "aside" (barres de filtres sur les sites e-commerce, publicités, réseaux sociaux,..)


## Page Builder:
- composant permettant de de créer des pages en "drag and drop" , et généralement en "front-end editing" (on voit directement les modifs quand on les fait)
- dispose d'une bibliothèque de modules/widgets (comme des colonnes, slider, caroussel, bloc titre, boutons, ...) pour faciliter la construction des pages sans avoir à coder en HTML/CSS/JS 
- Deux pages builder intéressants:
  - "Beave builder": plus pour les dev, il possède une version gratuite mais pas très fournie en composants 
  - "Elementor" : plus pour les designers, avec une bibliothèque plus riche meme pour la version  gratuite.
- Il en existe plein d'autres (Site Origin Page Builder, Brix, ...)

- Afin de choisir son thème il existe plusieurs axe de catégorisation:
  - Gratuit/Fremium/Premium:
      - Gratuit: de très nombreux thèmes parfois installables directement depuis la bibliothèque wordpress 
      - Fremium: des thèmes gratuits mais avec certaines fonctionnalités payantes qu'on peut ajouter
      - Premium: thèmes payants uniquement dispo via des marketplaces spécialisées comme Themeforest qui en regroupe environ 10K 
  - Starter themes (frameworks)/thèmes spécialisés/thèmes multirôles
      - Starter themes (frameworks): neutres et minimalistes, généralement utiles pour des dev qui peuvent ensuite les modifier en faisant leur propre code (ex: Genesis Framework, UNderscore,...)
      - thèmes spécialisés: la majorité des thèmes, par exemple pour faire des blogs, des sites divers : immobilier, e-commerce, marketplace, annonces, ils ont pour inconvénient de générer du code généralement lourd et mal codé 
      - thèmes multirôles (multipurpose): permet de faire divers choses, parmi les récents certains génèrent du code assez léger et propre.

Pour choisir son thème on regarde ensuite divers infos:
- la dernière date de màj pour éviter de prendre un thème plus supporté 
- les notes et commentaires
- la notoriété
- la rapidité de chargement
- l'aspect multilingue
- le support et la documentation sur le thème 
- la source (privilégier les thèmes reconnus sur la bibliothèque officielle wordpress)
- la qualité du design, la flexibilité et les fonctionnalités (mieux vaut un design simple qui rendera mieux quand on le modifiera)

Quand on se sert d'un thème il faut faire nos modifications dans un "thème enfant" du thème principale , afin qu'en cas de màj nos modifications ne soient pas suppriés par la màj 

- Pour installer un thème on va dans "Apparence >> thèmes >> Ajouter" puis on choisit le thème qu'on veut , on l'installe, puis on installe les extensions recommandées, si besoin  
- Si notre thème est au format ZIP on clique sur "téléverser un thème", en choisissant l'archive ZIP que l'on a précédemment téléchargé (depuis un market place comme Themeforest par exemple)
- La majorité des thèmes permettent d'installer des sites de démo qui peuvent servir de base pour nos sites pour l'installer on peut la prévisualiser puis on importe la démo, on choisit les extensions nécessaires (pas la peine de prendre les modules, qui sont payants) et on valide l'installation

- En plus des thèmes on peut etre amené à installer des extensions , certaines s'installent automatiquement avec le thème ou la démo de site, mais on peut en ajouter d'autres en suivant les memes
critères de sélection que pour les thèmes. Il existe deux types d'extensions:
  - Extensions standard (elles sont quasi indispensables pour tous types de sites): 
  Par exemple:
    - "SEO Press" : pour le référencemet naturel 
    - "Broken Link Checker" : pour une alerte en cas de lien cassé 
    - "Redirection": pour identifier les erreurs 404 et rediriger sur des pages existantes 
    - "short pixel" : optimisation du pids des images
    - "Central color palette": pour définir de façon centralisée les couleurs disponibles dans dans les palettes de choix de couleur du thème et de l'éditeur wordpress classique 
    
  - Il faut faire attention à ne pas télécharger trop d'extensions, notamment des extensions qui font la même chose qu'une autre extension d éjà présente 

  - Extensions spécifiques (qui répondent à des besoins spécifiques)
    - "Hustle" : pour créer des pop up 


