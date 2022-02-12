# Reset

Avant de commencer un projet on peut reset les styles par défaut des navigateurs, pour par exemple simplifier et uniformiser le calcul des marges 
Exemple
```css
/*Before et after sont nécessaires autrement les pseudos éléments ne sont pas pris en compte par "*" */
*,
*::before,
*::after, {
    box-sizing: border-box;
}

/*Reste margins*/
h1, h2, h3, h4, h5, h6, p {
    margin: 0;
}
```