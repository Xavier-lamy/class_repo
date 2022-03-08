# Enlever les points après les numéros des listes ordonnées
Il suffite de désactiver le style de basee et de le remplacer par le compteur css
```css
ol { 
    counter-reset: item;
    list-style-type: none;
}
li { 
    display: block; 
}
li:before { 
    content: counter(item) "  "; 
    counter-increment: item 
}
```