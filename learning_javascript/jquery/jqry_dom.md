# Agir sur le DOM
## Se déplacer dans le dom
+ Accéder aux **parents** ou **ancetres**:
    - ``parent("#selecteur")``: accède à l'élément parent (direct): argument optionnel = que si le parent correspond au sélecteur
    - ``parents("#selecteur")``: accède à tous les éléments parents d'un groupe sélectionné, argument optionnel = que si le parent correspond au sélecteur
    - ``parentsUntil(".selecteur", "filtre")``: accède aux ancètres jusqu'à l'ancetre déterminé en premier argument (NON INCLUS !), si pas d'ancetre correspondant au ``selecteur`` ou si pas d'argument passé retourne tous les parents, argument optionnel = que si le parent correspond au sélecteur
    - ``closest(".selecteur")``: sélectionne le premier ancetre de l'élément initial correspondant au selecteur (peut etre l'element initial lui meme)
    - ``offsetParent()``: accede au premier ancetre d'un element initial **positionné** çàd avec **une position css autre que static**
+ Accéder aux **enfants**:
    - ``children(".selecteur")``: accède aux éléments enfants (descendants directs) d'un ou plusieurs éléments HTML, argument optionnel = que ceux qui correspondent au sélecteur
    - ``find(".selecteur")``: accède a tous les éléments descendants (enfants, petits-enfants, ...) d'un ou plusieurs éléments HTML, argument obligatoire = que ceux qui correspondent au sélecteur (``*`` = si on veux tous les éléments)
+ Accéder aux éléments ``frères`` (partageant le meme parent)
    - ``siblings(":odd")`` = retourne tous les éléments frères d'un premier élément, argument optionnel = que les éléments correspondant au sélecteur (ici :odd pour n'avoir que ceux qui occupent une place impaire)
    - ``next("argument optionnel")`` = récupère l'élément frère immédiatement suivant
    - ``nextAll("argument optionnel")`` = récupère tous les éléments frères suivants un élément
    - ``nextUntil("argument obligatoire", "filtre optionnel")`` = récupère tous les éléments frères suivants jusqu'à l'élément passé en argument (sans inclure ce dernier)
    - ``prev("argument optionnel")`` = récupère l'élément frère immédiatement précédent
    - ``prevAll("argument optionnel")`` = récupère tous les éléments frères précédents un élément
    - ``prevUntil("argument obligatoire", "filtre optionnel")`` = récupère tous les éléments frères précédents jusqu'à l'élément passé en argument (sans inclure ce dernier)

## Manipuler le DOM avec les **getters** et les **setters**
+ Dans beaucoup de langages (et notamment en js natif):
    - **getters** : récupère une info (ex: ``getAttribute()`` = récupère l'attribut)
    - **setter** : met à jour ou définit une info (ex: ``setAttribute()`` = met à jour ou définit l'attribut)
    -  en jQuery le getter récupère généralement seulement pour le premier élément d'une sélection ou un seul élément, le setter définit pour plusieurs éléments d'une sélection
+ en jQuery il n'y a pas de distinction entre les deux:
    - si on ne passe pas d'argument c'est un **getter** (ex: ``.html()`` = récupère le contneu html d'un élément)
    - si on passe en argument les éléments à modifier ou définir c'est un **setter** (ex: ``.html("nouveau contenu")`` = met à jour le contenu html d'un élément)
+ Méthodes **setter/getter**:
    - ``html()`` : récupére le contenu HTML du premier élément d’une sélection, ``avec argument``: définit le contenu HTML de tous les éléments de la sélection
    - ``text()`` : récupére les contenus textuels uniquement, de **tous** les éléments d’une sélection ``avec argument``: définit les contenus textuels uniquement, de tous les éléments d’une sélection, ``text()`` est la seule méthode qui en mode **getter** récupère pour tous les éléments
    - ``attr()`` : récupére la valeur d’un attribut du premier élément d’une sélection, ``avec argument``: définit un ou plusieurs attributs pour tous les éléments de la sélection
    - ``prop()`` : récupére la valeur d’une propriété du premier élément d’une sélection, ``avec argument``: définit une ou plusieurs propriétés pour tous les éléments de la sélection
    - ``val()`` : récupére la valeur (le contenu de l’attribut value) du premier élément d’une sélection, ``avec argument``: définit une valeur pour tous les éléments de la sélection
    - ``css()`` : récupére la valeur d’une propriété CSS pour le premier élément d’une sélection, ``avec argument``: définit les valeurs d’une ou de plusieurs propriétés CSS pour tous les éléments de la sélection
    - ``height()`` : récupére la hauteur de la boite élément du premier élément d’une sélection, ``avec argument``: définit cette hauteur pour tous les éléments de la sélection
    - ``innerHeight()`` : Idem height() mais inclut les **padding** dans le calcul
    - ``outerHeight()`` : Idem height() mais inclut les **padding**, les **bordures** et de manière optionnelle les **margin** dans le calcul
    - ``width()`` : récupére la largeur de la boite élément du premier élément d’une sélection, ``avec argument``: définit cette largeur pour tous les éléments de la sélection
    - ``innerWidth()`` : Idem width() mais inclut les **padding** dans le calcul
    - ``outerWidth()`` : Idem width() mais inclut les **padding**, les **bordures** et de manière optionnelle les **margin** dans le calcul
    - ``offset()`` : récupére les coordonnées actuelles du premier élément d’une sélection, ``avec argument``: définit les coordonnées de tous les éléments de la sélection relativement au document
    - ``scrollLeft()`` : récupére la position actuelle de la barre de défilement horizontale du premier élément d’une sélection, ``avec argument``: définit cette position pour tous les éléments de la sélection
    - ``scrollTop()`` : récupére la position actuelle de la barre de défilement verticale du premier élément d’une sélection, ``avec argument``: définit cette position pour tous les éléments de la sélection.

## Insérer ou déplacer du contenu
### Insérer du contenu (enfant) dans un élément:
- ``$("container").prepend("<p>content</p>");`` : insère du contenu en tant que premier enfant de l'élément cible
- ``$("container").append("<p>content</p>");`` : insère du contenu en tant que dernier enfant de l'élément cible
- ``$("<p>content</p>").prependTo("container");`` : insère du contenu en tant que premier enfant de l'élément cible (syntaxe inversé, on écrit en premier l'élément a ajouter puis où on l'ajoute)
- ``$("<p>content</p>").appendTo("container");`` : insère du contenu en tant que dernier enfant de l'élément cible (syntaxe inversé, on écrit en premier l'élément a ajouter puis où on l'ajoute)
### Insérer du contenu avant ou après (frère) un élément:
- ``$("#element").before("<p>content</p>");`` : insère du contenu avant l'élément cible
- ``$("#element").after("<p>content</p>");`` : insère du contenu après l'élément cible
- ``$("<p>content</p>").insertBefore("#element");`` : insère du contenu avant l'élément cible (syntaxe inversé, on écrit en premier l'élément a ajouter puis où on l'ajoute)
- ``$("<p>content</p>").insertAfter("#element");`` : insère du contenu après l'élément cible (syntaxe inversé, on écrit en premier l'élément a ajouter puis où on l'ajoute)
### Insérer autour d'un élément: 
+ si on souhaite utilise plusieurs méthodes pour ajouter des structures autour d'une meme sélection il faut les ajouter de la plus englobante à la plus spécifique, donc dans l'ordre suivant:
    - ``$("p").wrapAll("<section></section>");`` : insère une structure html autour de l'ensemble d'une sélection (ex: une section autour de l'ensemble des paragraphes)
    - ``$("p").wrap("<div></div>");`` : insère une structure html autour de chaque élément d'une sélection (ex: une div autour de chaque paragraphe)
    - ``$("p").wrapInner("<span></span>");`` : insère une structure html autour du contenu de chaque élément de la sélection (ex: une span autour du texte de chaque paragraphe) 
### Déplacer du contenu
+ Si on essaie d'insérer un contenu déjà existant avec une des méthodes précédentes, alors le contenu sera déplacé là ou on souhaite l'insérer, ex:
    - ``$("#1").prependTo("container");`` : si l'élément avec l'ID 1 existe déjà alors il sera déplacé en tant que premier enfant du container
    - ``$("#2").insertBefore("container");`` : si l'élément avec l'ID 2 existe déjà alors il sera déplacé avant le container

## Copier, supprimer, remplacer
### Copier ou cloner:
- ``let bobaFett = $(".jango-fett").clone();`` : effectue une *copie profonde* (càd l'élément ainsi que tous les éléments qu'il contient et leurs contenus textuels) d'un ou plusieurs éléments , on peut ensuite placer cet élément où on veut dans le **DOM** avec les methodes précédentes
### Supprimer
- ``$("p").remove("#p1");`` ou ``$("#p1").remove();`` : supprime un élément et tout ce qu'il contient sans conserver les données jQuery et les events associés, argument optionnel = les éléments à supprimer de la sélection
- ``let titre = $("h1").detach();`` :  supprime un élément et tout ce qu'il contient mais en conservant les données jQuery et les events associés, cela permet de les récupérer pour réinsérer l'élément plus tard, argument optionnel = les éléments à supprimer de la sélection
- ``$("#p2").empty();`` : supprime tout le contenu d’un ou de plusieurs éléments sans supprimer les éléments en eux mêmes, conserve le balisage HTML
- ``$("p").unwrap("section");`` : supprime l’élément parent d’un ou de plusieurs éléments, argument optionnel = ne supprime le parent que s'il répond à ce critère
### Remplacer
- ``$("<p>content</p>").replaceAll("section");`` : prend la sélection d’éléments à remplacer en argument (ici les éléments "section") et s'applique sur l'élément qui sert de remplacement (ne renvoie rien)
- ``$("#p1").replaceWith("<span>content</span>");`` : fonctionne dans l'autre sens s'applique aux éléments à remplacer et prend en argument le contenu de remplacement (retourne la liste des éléments supprimés)