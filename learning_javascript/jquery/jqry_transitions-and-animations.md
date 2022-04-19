# Animations avec JQuery
## Transitions
- ``fadeOut()``: passe opacity de 1 à 0 progressivement, puis cache l'élément, args: durée transition, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition
- ``fadeIn()``: passe opacity de 0 à 1 progressivement, args: durée transition, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition
- ``fadeTo()``: définit un seuil d'opacité à atteindre, args: durée transition, niveau d'opacité, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition
- ``fadeToggle()``: bascule entre ``fadeOut()`` et ``fadeIn()``
- ``slideDown()``: déplie progressivement l'élément, args: durée transition, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition
- ``slideUp()``: replie progressivement l'élément, args: durée transition, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition
- ``slideToggle()``: bascule entre plier/déplier
- ``show()``: affiche un contenu html caché, 
    - si args: durée transition, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition, 
    - sans args: s'occupe juste de la propriété display de l'élément
- ``hide()``: cache un contenu html visible, 
    - si args: durée transition, fonction d'accélération (swing ou linear), callback à exécuter à la fin de la transition, 
    - sans args: ``display:none`` l'élément
- ``toggle()``: bascule entre ``show()`` et ``hide()``, peut prendre les même arguments

## Animations
- ``animate()``: permet d'animer les propriétés css à valeur numérique, args: durée d'animation, fonction d'accélération (swing ou linear), callback à exécuter à la fin de l'animation, les propriétés css raccourcies comme ``border`` sont mal supportées, voir la [doc](https://api.jquery.com/animate/) pour plus d'infos