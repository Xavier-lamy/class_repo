# Sass

**Préprocesseur**: un programme qui procède à des transformations sur un code source avant l'étape de traduction (compilation pour Sass)

**Syntaxe .sass**: ou syntaxe indentée, syntaxe originelle de Sass, indentation à la place des accolades

**Syntaxe .scss**: surensemble du css, syntaxe plus simple

## Installation
- En clonant le dépot sass depuis github
- En installant le paquet Sass via NPM (Node Package Manager), installé avec node.js : ``npm install -g sass``, ``-g``=global (ne pas mettre pour une installation en local), la version installée via npm s'exécute plus lentement que les autres, déconseillé pour un travail de prod

## Sous VSCode 
extension *Live Sass Compiler* : très utile, (par Glenn Marks, la version de Ritwick Dey n'est plus à jour)

## Variables 
``$var-name: value;``

|Variable CSS|Variable Sass|
|------------|-------------|
|Peut avoir différentes valeurs pour différents éléments|Une seule valeur à  la fois|
|Variable déclarative|Variable impérative|

*Variable déclarative* = en cas de modif, toutes les utilisations de la var sont affectées (antérieur et ultérieur)

*Variable impérative* = si on utilise une var et qu'on modifie ensuite sa valeur, son utilisation antérieure reste la même

### Interpoler une variable
Si on souhaite ajouter une variable dans un calcul (avec la fonction ``calc()``) il faut penser à l'interpoler:
```scss
element {
    $var: 16px;

    margin: calc(10px + #{$var});
}
```


### Valeur par défaut
``$var: value !default;`` = la valeur n'est affecté à la variable que si la variable n'est pas définie ou est null, sinon la valeur existante sera utilisé

### Locales et globales
``$var: value`` :
- si déclaré en dehors des accolades = variable globale, utilisable n'importe où y compris autre feuille de style

- si déclaré dans des accolades = variable locale

- Si on veut définir une variable globale depuis un espace local (entre accolades) on peut utiliser : ``$var: value !global;``

- Si on a une globale et une locale qui portent le meme nom, les deux peuvent exister en meme temps, dans son propre espace la var locale a la priorité

### Fonctions
#### Fonctions prédéfinies 
``random()``: retourne un nombre aléatoire:
- sans arguments: nbr décimal entre 0 et 1
- un argument plus grand que 1: nbr entier entre *1* et *arg* ex: ``random(255)``= nbr entier entre 1 et 255, on peut ainsi l'intégrer dans la fonction css ``rgb()``: ``rgb(random(255), random(255), random(255))``

- ``round()``: arrondit un nbr décimal à l'entier le plus proche

- ``adjust-color()``: ajuste une couleur en modifiant certains de ses composants, les 5 arguments sont:
- couleur
- nbr : canal *red* de rgb, ou *hue* (*teinte*) de *hsl*
- nbr : canal *green* de rgb, ou *saturation* de *hsl*
- nbr : canal *blue* de rgb, ou *lightness* de *hsl*
- niveau d'opacité

- ``darken($color, 50%)``: rend une couleur plus foncée de 50%

- ``lighten($color, 50%)``: rend une couleur plus claire de 50%

#### Créer des fonctions
```scss
@function multiply($arg1, $arg2){  
    $result: $arg1 * $arg2;  
    @return $result; 
}  
```

### Sélecteurs et imbrications
+ ``&`` permet de faire référence au sélecteur extérieur: 
```scss 
a {  
    text-decoration: none;  
    &:hover {
        text-decoration: underline;
    }  
}
```

### Héritage
#### Héritage de propriétés
+ ``@extend`` : permet d'hériter les propriétés d'un autre sélecteur:  
```scss
button {  
    text-decoration: none;   
}  
a {  
    @extend button;  
    color: black;  
}  
```

### Sélecteur placeholder
``%`` : les règles créées après ce sélecteur n'apparaissent pas dans la sortie en css, elle peuvent par contre etre utilisé par @extend (ce qui permet de créer une règle de base non utilisée telle quelle, donc on ne souhaite pas l'afficher, mais que l'on peut étendre pour d'autres sélecteurs):
```scss
%button {  
    text-decoration: none;   
}  
a {  
    @extend %button; 
    color: black;  
}
```

### Les mixins
+ permettent de faire des groupes de règles css, auxquels on donne des noms et que l'on peut ensuite utiliser n'importe où dans le document:
```scss
@mixin mixin-name($property){  
    /*différentes règles css*/   
}  
a {    
    color: black;  
    @include mixin-name(properties, ex: rotate(45deg));    
}  
p {          
    @include mixin-name(properties, ex: rotate(185deg));      
} 
``` 
+ **Dans la mesure du possible on évite de les utiliser**

### Conditions et boucles
#### les opérateurs Sass
##### concaténation
- ``+`` : retourne une chaine avec les 2 expressions concaténées
- ``-`` : retourne une chaine avec les 2 expressions concaténées et séparées par ``-``
- ``/`` : retourne une chaine avec les 2 expressions concaténées et séparées par ``/``

##### opérations arithmétiques
- ``+`` : addition
- ``-`` : soustraction
- ``*`` : multiplication
- ``/`` : division
- ``%`` : modulo (retourne le reste d'une division)

##### comparaisons
- ``==`` : est strictement égal
- ``!=`` : est différent
- ``<`` : est strictement inférieur
- ``>`` : est strictement supérieur
- ``<=`` : est inférieur ou égal
- ``>=`` : est supérieur ou égal

##### logique
- ``and``
- ``or``
- ``not``

##### ordre de priorité des opérateurs
- Les opérateurs ``not`` et de concaténation ``+``, ``-``, et ``/``
- Les opérateurs arithmétiques ``*``, ``/`` et ``%``
- Les opérateurs arithmétiques ``+`` et ``–``
- Les opérateurs ``>``, ``<``, ``>=``, ``<=``
- Les opérateurs ``==`` et ``!=`` 
- L’opérateur ``and``
- L’opérateur ``or``


### Structures de controles Sass
``@if`` et ``@else`` : bloc if/else
``@each`` : pour évaluer un bloc pour chaque élément d'une liste
``@for`` : pour évaluer un bloc un nbr de fois précisé à la création de la règle
``@while`` : pour une boucle



### importer du code
+ la règle ``@import`` de Sass est mieux que celle de css car elle ne créé pas une nouvelle requete à chaque fois mais combine juste tous les fichiers que l'on importe dans un seul fichier.
+ On a pas besoin de marquer l'extension du fichier ``@import variables`` importera *variables.scss*

+ On peut aussi utiliser :
``@use 'style/variables';``  

### Partials
+ ajouter ``_`` devant le nom d'un fichier SASS indique à Saas que ce fichier est uniquement utilisé pour être importé par un autre Sass, et qu'il ne doit pas etre compilé seul


