# Gestion des évènements
## À la souris
- ``click()``: gestionnaire d'évènements au clic de la souris
- ``dblclick()``: gestionnaire d'évènements au double clic de la souris
- ``mouseenter()``: gestionnaire d'évènements quand la souris entre dans un élément, (méthode similaire: ``mouseover()``, à éviter car moins prévisible)
- ``mouseleave()``: gestionnaire d'évènements quand la souris sors d'un élément, (méthode similaire: ``mouseout()``, à éviter car moins prévisible)
- ``hover()``: raccourci pour ``mouseenter()`` et ``mouseleave()`` , la première fonction se déclenche à l'entré de la souris sur l'élément, la deuxième à sa sortie
- ``mousedown()``: gestionnaire d'évènements quand le bouton de la souris est pressé
- ``mouseup()``: gestionnaire d'évènements quand le bouton de la souris est relâché
- ``mousemove()``: gestionnaire d'évènements quand la souris bouge, renvoie les coordonnées de la souris en temps réel dans l'objet ``event`` du gestionnaire d'évènements dans les propriétés ``pageX`` et ``pageY``, coordonnées de la souris par rapport au coin inférieur gauche, attention avec ce gestionnaire d'évènements, cela peut impacter les performances, vu que chaque mouvement déclenche l'évènement

## Au clavier
- ``keydown()``: gestionnaire d'évènements quand une touche est pressée, ne se déclenche que sur les éléments qui ont le focus
- ``keyup()``: gestionnaire d'évènements quand une touche est pressée, ne se déclenche que sur les éléments qui ont le focus
- ``keyup()`` et ``keydown()`` renvoient un code en chiffres pour la touche pressée, qu'on peut récupérer avec la propriété ``which`` de notre objet ``event``
- ``keypress()``: gestionnaire d'évènements quand une touche est pressée, ne se déclenche que pour les touches liées à la saisie de caractères (donc pas ``shift``, ``alt``, ``ctrl``, ``enter``,...), l'évènement renvoie le code ASCII du caractère entré

## Evènements des formulaires
- ``focus()``: quand un élément gagne le focus
- ``focusin()``: quand un élément ou un de ses descendants gagne le focus
- ``blur()``: quand un élément perd le focus
- ``focusout()``: quand un élément ou un de ses descendants perd le focus
- ``change()``: quand la valeur d'un élément (seulement input de tous types, textarea ou select) change
- ``submit()``: quand l'utilisateur envoie le formulaire

## Gestion avancée d'évènements
- ``on("eventName", function(){})``: permet de prendre en compte tous les types d'évènements, pour gérer plusieurs évènements à la fois on écrit: ``on({eventType1: function(){}, eventType2: function(){}});``
- ``trigger("eventName")``: déclenche manuellement un évènement, fonctionne sur tous les éléments possédant les caractéristiques ciblées
- ``triggerHandler("eventName")``: déclenche manuellement le gestionnaire d'évènement d'un évènement mais sans déclencher l'action par défaut de l'évènement (ex pour submit, cela n'enverra pas le formulaire), fonctionne sur le premier élément ciblé rencontré, il n'y a donc pas de bouillonement, retourne la valeur renvoyée par le dernier gestionnaire d'évènement
- ``off("eventName")``: supprime les gestionnaires d'évènements d'un élément (tous les gestionnaires de l'élément si pas d'arguments passés)

## L'objet event
+ Objet passé à chaque gestionnaire d'évènement défini
+ Possède divers propriétés dont:
    - ``pageX``: position en x par rapport au coin supérieur gauche
    - ``pageY``: position en y par rapport au coin supérieur gauche
    - ``which``: renvoie le code de la touche pressé pour ``keydown/keyup``
    - ``target``: permet d'obtenir l'élément déclencheur de l'évènement, peut donc être l'élément auquel l'évènement est attaché ou un de ses descendants
    - ``type``: permet d'obtenir le type d'évènement déclenché
