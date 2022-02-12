# Propriétés
## Propriétés des textes
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|
| ``font-family`` | ``police1, police2, Serif`` (généralement en dernier, en police par défaut) | Nom de police |
| ``@font-face`` | Nom et source de la police | Intégrer une police personnalisée | 
| ``font-size`` | ``1.3em``, ``16px``, ``15%`` | Taille de police | 
| ``font-weight`` | ``bold``, ``normal`` | Gras | 
| ``font-style`` | ``italic``, ``oblique``, ``normal`` | Italique | 
| ``text-decoration`` | ``underline``, ``overline``, ``blink``, ``line-through``, ``none`` | Soulignement, ligne au dessus, barré ou clignotant | 
| ``font-variant`` | ``small-caps``, ``normal`` | Petites lettres capitales | 
| ``text-transform`` | ``capitalize`` (première lettre), ``lowercase``, ``uppercase`` | Lettres capitales | 
| ``font`` | Voir valeurs plus haut | Super propriété de police qui combine: font-weight, font-style, font-family, font-size, et font-variant | 
| ``text-align`` | ``left``, ``justify``, ``center``, ``right`` | Alignement horizontal | 
| ``vertical-align`` | ``baseline``, ``middle``, ``sub``, ``super``, ``top``, ``bottom`` | Alignement vertical (ne concerne que les cellules de tableau et les éléments inline-block) | 
| ``line-height`` | ``18px``, ``110%``, ``normal`` | Hauteur de ligne | 
| ``text-indent`` | ``25px`` | Alinéa (indentation du texte) | 
| ``white-space`` | ``pre``, ``nowrap``, ``normal`` | césure (séparation du texte) | 
| ``word-wrap`` | ``break-word``, ``normal`` | césure forcé (force à couper le mot) | 
| ``text-shadow`` | ``5px 5px 2px black``  | Ombre de texte (horizontale, verticale, fondu, couleur) | 
			
## Couleurs et fond
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|		
| ``color`` | ``nom``; ``rgb(rouge,vert,bleu)``; ``rgba(rouge,vert, bleu, opacité)``, ``#AAAAAA`` | Couleur de police | 
| ``background-color`` | voir valeurs précédentes | couleur du fond | 
| ``background-image`` | ``url("image.png")`` | image de fond | 
| ``background-attachment`` | ``fixed``, ``scroll`` | Fond-fixe ou mobile | 
| ``background-repeat`` | ``repeat-x``, ``repeat-y``, no repeat, repeat | répétition du fond | 
| ``background-position`` | xy: ``50% 50%``, ``top``, ``center``, ``bottom``, ``left``, ``right`` | Position du fond | 
| ``background`` | Voir valeurs au-dessus | Super propriété qui combine: background-image, background-repeat, background-attachment, background-position | 
| ``opacity`` | valeurs entre 0 et 1 (0=totalement transparent, 1=totalement opaque) | Opacité |					


## Propriétés des boites
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|
| ``width`` | ``150px``, ``50%`` | Largeur | 
| ``height`` | ``150px``, ``50%`` | Hauteur | 
| ``min-width`` | ``150px``, ``50%`` | Largeur minimale | 
| ``max-width`` | ``150px``, ``50%`` | Largeur maximale | 
| ``min-height`` | ``150px``, ``50%`` | Hauteur minimale | 
| ``max-height`` | ``150px``, ``50%`` | Hauteur maximale | 
| ``margin-top`` | ``35px`` | Marge en haut | 
| ``margin-bottom`` | ``35px`` | Marge en bas | 
| ``margin-left`` | ``35px`` | Marge à gauche | 
| ``margin-right`` | ``35px`` | Marge à droite | 
| ``margin`` | ``35px 35px 35px 35px`` | Super propriété de marge, combine les 4 précédentes (haut, droite, bas gauche), ``margin: auto;`` permet de centrer le bloc si une vale | 
| ``padding-top`` | ``35px`` | Marge intérieure en haut | 
| ``padding-bottom`` | ``35px`` | Marge intérieure en bas | 
| ``padding-left`` | ``35px`` | Marge intérieure à gauche | 
| ``padding-right`` | ``35px`` | Marge intérieure à droite | 
| ``padding`` | ``35px 35px 35px 35px`` | Super propriété de marge intérieure, combine les 4 précédentes (haut, droite, bas gauche) | 
| ``border-width`` | ``3px`` | Epaisseur de bordure | 
| ``border-color`` | voir valeurs dans color | Couleur de bordure | 
| ``border-style`` | ``solid``, ``dotted``, ``dashed``, ``double``, ``groove``, ``ridge``, ``inset``, ``outset`` | Type de bordure | 
| ``border`` | ``3px solid black`` | Superpropriété de bordure (on peut aussi ajouter les préfixes top-, bottom-, left- et right- pour n'avoir que des parties de la bordure | 
| ``border-radius`` | ``5px / 10px`` | Bordure arrondie (ajouter un slash et une deuxième valeur pour des courbes éliptiques |
| ``border-image`` | ``url("url.img") 20 round`` | Image en bordure: url, manière dont est coupée l'image (en pixels ou en pourcentage), manière dont elle gère le milieu (round, repeat, stretched) |
| ``box-shadow`` | ``6px 6px 0px 1px black`` | Ajoute une ombre à la boite (horizontale, verticale, fondu, expansion, couleur)| 
| ``outline`` | ``5px dotted green`` | Entoure la bordure d'une sorte de halo, superpropriété avec tous les attributs, ou chaque propriété du genre: outline-style  | 
		
## Positionnement et affichage
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|
| ``display`` | ``block``, ``inline``, ``inline-block``, ``table``, ``table-cell``, ``none`` | type d'élément (transforme une ligne en block,..., none pour ne pas afficher) | 
| ``visibility`` | ``visible``, ``hidden`` | Visibilité | 
| ``clip`` | ``rect(0px, 60px, 30px, 0px)``|  Affichage d'une partie de l'élément (haut, droite, bas, gauche) | 
| ``overflow`` | ``hidden``, ``visible``, ``auto``, ``scroll`` | comportement en cas de dépassement auto est comme scrollbar mais ne l'ajoute que si ça dépasse | 
| ``text-overflow`` | ``clip``, ``ellipsis`` | comportement du texte en cas de dépassement, clip s'arrête à la bordure, ellipsis:coupe le texte et ajoute des points de suspension | 
| ``float`` | ``left``, ``right``, ``none`` | flottant permet d'avoir une image qui "flotte" à droite ou a gauche d'un texte par exemple (généralement à éviter) | 
| ``clear`` | ``left``, ``right``, ``both``, ``none`` | Arrêt d'un flottant | 
| ``position`` | ``relative``, ``absolute``, ``fixed``, ``static`` (default) | positionnement | 
| ``top`` | ``20px`` | Position par rapport au haut | 
| ``bottom`` | ``20px`` | Position par rapport au bas | 
| ``left`` | ``20px`` | Position par rapport à la gauche | 
| ``right`` | ``20px`` | Position par rapport à la droite | 
| ``z-index`` | ``10`` | Ordre d'affichage en cas de superposition, la plus grande valeur est affichée au-dessus | 

## Propriété des listes
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|
| ``list-style-type`` | ``disc``, ``circle``, ``square``, ``decimal``, ``lower-roman``, ``upper-roman``, ``lower-alpha``, ``upper-alpha``, ``none`` | type de liste | 
| ``list-style-position`` | ``inside``, ``outside`` | inside: le marqueur est à l'intérieur du texte et le texte s'adapte autour, outside le marqueur est à l'extérieur du texte et le texte s'aligne verticalement | 
| ``list-style-image`` | ``url("nom.png")`` | Puce personnalisée | 
| ``list-style`` | voir 3 valeurs précédentes | Super propriété de type de liste, combine les 4 précédentes | 

## Propriétés des tableaux
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|
| ``border-collapse`` | ``collapse``, ``separate`` | Fusion des bordures (par défaut il y a séparation entre les cellules| 
| ``empty-cells`` | ``hide``, ``show`` | Affichage des cellules vides | 
| ``caption-side`` | ``bottom``, ``top`` | position du titre du tableau | 
			
#### Autres propriétés
| Propriété | Exemples de valeurs | Description |
|-----------|---------------------|-------------|
| ``cursor`` | ``crosshair``, ``default``, ``help``, ``move``, ``pointer``, ``progress``, ``text``, ``wait``, ``e-size``, ``ne-size``, ``auto``... | curseur de souris | 