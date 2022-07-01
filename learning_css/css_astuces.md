# Astuces

### Centrer correctement le texte d'un bouton
Si le align-center ne suffit pas on peut aussi se soucier du line-height du bouton afin de centrer correctement le contenu

### Dans un display flex
Pour faire en sorte que nos deux blocs fassent la meme hauteru (celle du plus grand), on met align-item à stretch (c'est la valeur par défaut)

### faire un effet d'animation de trois images au hover
(voir *Challenge : 1h pour faire cette animation qu'en CSS ?*)
```css
/*Pour chacune des 3 images*/
.item { 
    background-position: center top;
    background-size: auto 100%;
    border-radius: .5rem;
    flex-grow: 1;
    transition: width 300ms ease;
    width: 33%;
}

.item:hover {
    width: 100%;
}
```

### Nommer des variables de couleur scss
Il est préférable d'écrire en premier le nom de la couleur et ensuite le qualificatif, cela facilite l'autocomplétion:
- grey-brownish au lieu de brownish-grey

### Avoir une taille de police responsive
Afin d'avoir les tailles de police responsive, on peut les définir en ``rem``, exemple normal: 1rem, small: 0.8rem, ensuite il suffit de changer la valeur du rem en fonction de la taille du mobile, par exemple si on veut que nos tailles diminuent en dessous de 400px il suffit de mettre:
```scss
html {
    @media (max-width:400px){
       fontSize: 14px; 
    }
}

```

### ``clamp()``
- ``clamp(MinValue, Value, MaxValue)``: renvoie:
    - La valeur du milieu si elle est comprise entre ``min`` et ``max``
    - la valeur minimale, si ``val < min``
    - la valeur maximale, si ``val > max``

- ça peut notamment servir quand on veut faire du responsive, avec les ``rem``, imaginons qu'on aie la situation suivante:
```css 
html {
    font-size: 100%; /*Récupère la taille par défaut du navigateur, en général = 16px*/

    /*Note: astuce pour que les rem valent 10px (facilitant le calcul)*/
    font-size: 62.5%;
}

h1 {
    font-size: 6rem;

}

/*Notre titre est trop grand en mobile, il faudra le réduire, une manière de faire est donc de réduire la taille dans le html, cela modifiera donc la valeur du root em, et tous les titres et éléments basés sur le rem seront automatiquement réajusté:*/
@media(max-width:992px) {
    html {
        font-size: 12px;
    }
}

/*Le problème c'est que si le body a une font-size de base de 1rem , il sera aussi réduit à 12px, ce qui pourrait être trop petit, on pourrait alors déterminer de manière fixe la taille du body en px pour les mobiles, mais on peut aussi utiliser clamp*/

body {
    font-size: clamp(14px, 1rem, 16px);
    /*Ainsi dans ce cas sur desktop puisqu'un rem vaut 16px le body sera de 1rem, mais en mobile puisqu'un 1rem vaut 12px, alors la font-size sera de 14px*/
}

```

- Aussi surprenant que cela puisse paraître, internet explorer ne supporte pas cette fonction

## créer du texte qui s'adapte à la taille de l'écran

On peut aussi utiliser les ``vw`` pour faire une police qui s'adapte à la taille de l'écran:
```css
body {
    font-size: 5vw; /*Le texte fera 5% de la taille de l'écran (1vw = 1% de la largeur de l'écran*/
}
```