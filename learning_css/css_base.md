# Le Css

## Bases
- Héritage: les éléments héritent des propriétés des parents
- Spécificité: Si deux propriétés différentes sont définies pour un même élément HTML c'est la spécificité (c'est à dire sa place dans la "cascade", plus l'élément est générique, moins il est prioritaire)

### Trois façons de lier le code css:
1. mettre un lien dans ``<head>``, vers un fichier à part qui contiendra le css (*recommandé*):
	- ``<link rel="stylesheet" href="style.css" />``

2. mettre le css directement dans ``<head>`` dans une balise style:
	- ``<style>.selector { font-size: 10px;}</style>``

3. mettre directement le code css à l'intérieur d'une balise 
	- ``<p style="color: blue;">``

### Fonctions css
| Fonction | Description |
|-----------|-------------|
| ``attr()`` | Renvoyer la valeur d'attribut de l'élément |
| ``calc()`` | Calculer des valeurs (marges, espacements, ...) |
| ``counter()`` | Renvoyer la valeur actuelle du compteur (pour la propriété ``counter-increment`` css, qui permet de compter le nombre d'élément d'un type) |
| ``cubic-bezier()`` | Créer une courbe de Bézier |
| ``hsl()`` | Créer une couleur selon le modèle Hue-Saturation-Lightness (HSL) |
| ``hsla()`` | Créer une couleur selon le modèle Hue-Saturation-Lightness-Alpha (HSLA): ajoute la transparence | 
| ``rgb()`` | Créer une couleur selon le modèle Red-Green-Blue (RGB) | 
| ``rgba()`` | Créer une couleur selon le modèle Red-Green-Blue-Alpha (RGBA): ajoute la transparence | 
| ``conic-gradient()`` | Créer un dégradé de forme conique |
| ``linear-gradient()`` | Créer un dégradé linéaire |
| ``radial-gradient()`` | Créer un dégradé radial (qui part du centre) |
| ``repeating-conic-gradient()`` | Répéter un motif de dégradé conique |	
| ``repeating-linear-gradient()`` | Répéter un motif de dégradé linéaire |
| ``repeating-radial-gradient()`` | Répéter un motif de dégradé radial |
| ``min()`` | Définir une valeur à la plus petite d'une liste de valeurs |
| ``max()`` | Définir une valeur à la plus grande d'une liste de valeurs |
| ``var(--varname)`` | Insère une variable, prédéfinie dans ``:root`` |


### Les couleurs en CSS
#### Couleurs officielles css
- white
- silver
- gray
- black
- red
- maroon
- lime
- green
- yellow
- olive
- blue
- navy
- fuchsia
- purple
- aqua(turquoise)
- teal(bleu sarcelle sorte de turquoise pâle)

#### Autres façons de définir des couleurs:
- **RGB** : ``rgb(255, 255, 255)``
- **RGBA** ajoute la transparence (*alpha* de 0 à 1) : ``rgba(0, 125, 255, 0.5)``
- **HEX** hexadécimal (16 chiffres de 0 à F) : ``#45FE63``, ``#fff``
- **HSL** (teinte sur une roue de 0 à 360, saturation de 0 à 100%, luminosité de 0 à 100%) : ``hsl(360, 100%, 50%)``
- **HSLA** ajoute la transparence : ``hsla(360, 100%, 50%, 1)``   


### Tailles de polices
Pour la taille du texte on peut utiliser:
+ Une valeur absolue (très précis mais risque d'indiquer une taille trop petite pour certains lecteurs):
	- Pixels: ``px``
	- Centimètres: ``cm``
	- Millimètres: ``mm``
	- Pouces/Inches: ``in`` (1 = 2.54cm)
	- Pica: ``pc`` (1pc = 12pt)
	- Point: ``pt`` (1pt = 1/72 in)

+ Une taille relative (préférable):
	- Mots: de ``xxsmall à xxlarge`` ou ``smaller/larger``
	- ``em``: unité de mesure proportionnelle à la police du bloc parent 
	- ``rem``: *root em* , c'est un *em* par rapport à la taille spécifié à la racine (sélecteur *html*, voire *root*), par défaut sur de nombreux navigateur elle est fixée à 16px
	- ``20%`` : pourcentage du bloc parent
	- ``ex`` : calculé par rapport à la hauteur de la minuscule ``x`` de l'élément parent
	- ``vw`` (viewport-width) : largeur de la partie visible de l'écran

+ Différences ``rem`` vs ``em``
``Rem`` : en général, peut permettre d'avoir toujours la même taille (proportionnellement) pour tous nos textes
``em`` : un peu plus "délicat" puisqu'il faut faire attention à la taille du bloc parent, le em n'est donc pas stable, vu qu'il prend la taille de la police parente, c'est pratique pour les margins et paddings (notamment pour les boutons) puisqu'on pourra changer uniquement la taille de police du texte d'un bouton et les margins et padding s'acorderont automatiquement s'ils sont en em
