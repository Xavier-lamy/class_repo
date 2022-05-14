# Les opérateurs et expressions

## L'opérateur ternaire 
Fonctionne comme l'opérateur ternaire d'autres langages comme le php:
- ``condition ? exprSiVrai : exprSiFaux``

## L'opérateur de coalescence des nuls (Nullish coalescing operator)
Renvoie l'expression de gauche; si celle ci vaut ``null`` ou ``undefined`` renvoie alors l'expression de droite:
```js
let message = variable ?? "Placeholder"; // variable n'est pas défini plus haut donc message vaut "placeholder"
```

