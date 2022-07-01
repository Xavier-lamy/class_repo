
# Flexbox
+ ``display: flex;``: permet de changer le comportement des éléments, au lieu d'être en colonne, ils sont placés en ligne (par défaut), et peuvent être manipulés pour changer de position de manière responsive
+ ``flex-direction:`` : change la direction
	- ``row;``: en ligne (défaut)
	- ``column;``: en colonne
	- ``row-reverse;``: en ligne (inversé)
	- ``column-reverse;``: en colonne (inversé)
+ ``flex-wrap:`` 
	- ``wrap;``:  les blocs peuvent aller à la ligne quand ils n'ont plus de place
	- ``nowrap;``: pas de retour à la ligne(défaut)
	- ``wrap-reverse;``: à la ligne et en sens inverse
+ ``flex-flow: wrap row;`` combine les deux propriétés ``flex-wrap`` et ``flex-direction``
+ ``justify-content:``: change l'alignement sur l'axe principal(par défaut horizontal)
	- ``flex-start`` (défaut): les blocs sont alignés au début
	- ``flex-end``: les blocs sont alignés à la fin
	- ``center``: alignés au centre
	- ``space-between``: alignés sur tout l'axe avec un écart au milieu
	- ``space-around``: alignés avec un espace au milieu et autour
+ ``align-items:``: permet d'aligner sur l'axe secondaire(par défaut vertical)
	- ``stretch`` (défaut): les éléments sont étirés sur tout l'axe
	- ``flex-start``:alignés au début
	- ``flex-end``: alignés à la fin
	- ``center``: alignés au centre
	- ``baseline``:`alignés sur la ligne de base du texte
+ ``align-content:``: permet d'aligner nos elements quand ils sont sur plusieurs lignes et colonnes( n'a aucun effet s'il n'y a qu'une ligne)
	- ``flex-start``: au début
	- ``flex-end``: à la fin
	- ``center``: au centre
	- ``space-between``: séparés avec des espaces
	- ``space-around``: séparés au milieu et sur les cotés par des espaces
	- ``stretch`` (défaut) : s'étire dans tout l'espace
+ ``flex-grow:``: facteur d'expansion d'un élément flexible, c'est à dire la place qu'il peut prendre dans un container flex (ex: si flex-grow:2, il pourra prendre le double des autres éléments)
	- la valeur attendue est un nombre
	- par défaut = 0
+ ``flex-shrink:``: facteur de rétrécissement, c'est à dire de combien l'élément peut se réduire par rapport aux autres éléments
	- valeur attendue est un nombre
	- par défaut = 1 (fera juste en sorte de tenir dans la boite avec les autres éléments)
+ ``flex-basis:``: taille de l'élément flexible, si n'est pas égal à ``auto``, prend la priorité sur width ou height, exemple flex-basis: 50%, l'élement prendra la moitié du container
	- valeurs: n'importe quelle valeur valide pour width/height
+ ``flex:``: super propriété combinant dans l'ordre: ``flex-grow``, ``flex-shrink``, ``flex-basis``:
	- valeur par défaut: ``initial`` = ``0 1 auto``
	- autres valeurs possibles: comme pour les propriétés de bases ou ``none | 0 0 auto``, ``auto | 1 1 auto``