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