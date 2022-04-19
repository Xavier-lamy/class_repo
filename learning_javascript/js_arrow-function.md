# Les fonctions fléchées
- Syntaxe utilisée pour raccourcir les fonctions:
- Ne possède pas ses propres valeurs pour: ``this``, ``arguments``, ``super`` et ``new.target``
- Généralement anonymes et ne s'utilient pas pour déclarer des méthodes
- Avec ES13 il est recommandé de les utiliser autant que possible

## Syntaxe
- Paramètres entre parenthèses puis instructions de la fonction ou expression retournée après la flèche:
```js
(param1, param2) => {
   instructions //= ce qu'on fait des paramètres
}

(param1, param2) => expression //= la valeur retournée, pas besoin d'accolade lors d'une expression simple, équivalent à:
(param1, param2) => {
  return expression;
}
```

- On peut retirer les parenthèses s'il n'y a qu'un seul paramètre
```js
param => expression
```

S'il n'y a pas de paramètre on doit mettre des parenthèses vides:
```js
() => {
  instructions
}
```

Pour ajouter des paramètres par défaut:
```js
(param1 = defaultValue1, param2 = defaultValue2) => {
  instructions
}
```