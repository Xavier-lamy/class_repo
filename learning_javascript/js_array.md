# Les array
Les *array* permettent de ranger une liste ordonnée d'éléments, en français on peut parler de tableau, ils font partie de ce qu'on appelle les collections

```js
let array = [];
let array = ["value1","value2", "value3","value4"];
```
+ Rappel: le premier élément d'un tableau a toujours l'indice [0]

En JS il existe:
+ les types de données passées par valeur, c'est à dire que les variables contiennent vraiment la valeur, si on copie la valeur d'une variable dans une autre variable, seule la valeur est copié, il n'y a donc plus de lien avec l'autre variable:
    - boolean
    - null
    - number
    - string
    - undefined
+ et les types de données passées par référence, càd que la variable ne contient qu'une référence pour la valeur, la valeur en elle même n'est pas stockée dans la variable, mais seulemnt dans la mémoire à l'adresse où renvoie la référence

+ Propriétés des tableaux:
```js
let cakes = ["tart", "lemon cake", "strudel"];
let cakesLength = cakes.length; // "length" retourne la taille du tableau (ici 3)
cakes.push("lemon tart") // "push" ajoute un élément à la fin d'un tableau
cakes.unshift("myBigBurger") //"unshift ajoute un élément au début"
cakes.pop() //"pop" supprime le dernier élément du tableau
```

+ Méthode ``filter()``
Retourne un nouveau tableau remplissant les conditions du filtre:
```js
const weapons = ['knife', 'spoon', 'pistol', 'gun', 'nuclear bomb', 'flamethrower tank'];

const result = weapons.filter(weapon => weapon.length > 6);

console.log(result);
// Attendu: Array ['nuclear bomb', 'flamethrower tank']
```
