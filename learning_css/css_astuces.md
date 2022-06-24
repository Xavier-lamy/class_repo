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