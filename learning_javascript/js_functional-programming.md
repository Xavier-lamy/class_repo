# La programmation fonctionnelle en JS

On utilise différents concepts pour faire de la programmation fonctionnelle:

## Des fonctions pures: 
Les fonctions:
- retournent toujours le même résultat pour un même argument, donc pour ne pas enfreindre cette règle:
    - On ne doit pas utiliser d'objets ou de variables globales directement à l'intérieur de la fonction, il faut les passer en paramètres
    - On ne peut pas faire de fonction qui lisent des fichiers externes (qui pourraient changer et donc enfreindre la règle du même argument/même résultat)
    - On ne peut pas utiliser d'éléments aléatoires directement à l'intérieur de la fonction
- ne causent pas d'effets secondaires observables, c'est à dire, que une variable passé en paramètre ne doit pas être modifiée directement, afin de ne pas impacter d'autres éléments du script, pour cela on doit:
    - retourner directement une autre valeur (qu'on peut alors mettre dans une fontion), ex:
    ```js
    let oldId = 1;

    //Au lieu de:
    function incrementId(id){
        id = id + 1;
    }

    incrementId(oldId);

    //Il faut écrire
    function incrementId(id){
        return id + 1;
    }

    let newId = incrementId(id)
    ```

- Avantages: les fonctions sont plus faciles à tester, on à pas besoin de mocker des comportements, chaque fonction se concentrant sur un seul et unique but, et renvoyant toujours la même valeur pour un même argument

## L'immutabilité
Les valeurs ne doivent pas changer de type:
- Un booléen reste un booléen, etc...
- On crée un nouvel objet si on a besoin d'avoir un nouveau type de donnée
- dans le cas d'une boucle for par exemple, on modifie à la fois une valeur de la liste/du tableau à chaque itération, ainsi que la valeur d'incrémentation:
```js
//Au lieu d'écrire ceci (i et sumOfNumbers sont modifiés):
let numbers = [1, 2, 3, 4, 5];
let sumOfNumbers = 0;

for (let i = 0; i < numbers.length; i++) {
  sumOfNumbers += numbers[i];
}

console.log(sumOfNumbers); //devrait retourner 15

//On peut utiliser une fonction récursive pour obtenir le même résultat sans changer d'éléments externes à la fonction:
let numbers = [1, 2, 3, 4, 5];
let incrementNumber = 0;

function sum(numbers, incrementNumber) {
  if (numbers.length == 0) {
    return incrementNumber;
  }

  //On fait appel à notre fonction de manière récursive, ainsi la première fois qu'on appelle la fonction le premier paramètre est une liste, et à chaque passage on aura découper numbers et ajouté cette valeur à la variable local incrementNumber, jusqu'à ce que la liste soit vide
  return sum(numbers.slice(1), incrementNumber + numbers[0]);
}

sum(numbers, incrementNumber); // 15 -> on a notre résultat séparé du reste
numbers; // [1, 2, 3, 4, 5] -> n'a pas été altéré
incrementNumber; // 0 -> n'a pas été altéré
```
- Dans le cas de la modification d'une chaine de caractères, on peut chainer les fonctions qu'on utilise pour modifier, pour que chaque fonction utilise le résultat de la précédente sans modifier la variable de base:
```js
const stringToSlugify = "This is a title";

const slugify = stringToSlugify =>
  stringToSlugify
    .toLowerCase()
    .trim()
    .split(" ")
    .join("-");

slugify(stringToSlugify); // renvoie this-is-a-title
```

## La transparence référentielle (Referential transparency)
C'est l'addition de la pureté des fonctions et l'immutabilité des données, une fonction qui retourne toujours 4 quand on lui donne 2 est une fonction référenciellement transparente
- On peut se servir de ce concept pour faire de la *memoization*, c'est à dire stocker le résultat d'une fonction en cache, pour pouvoir retourner ce résultat quand la fontion sera appelée avec le même paramètre en entrée

## Utilisation des fonctions en tant qu'entité de première classe (functions as first-class entities)
Cela signifie qu'on traite les fonctions comme des valeurs et qu'on les utilise comme des données, c'est à dire:
- Faire référence à une fonction dans une constante ou une variable
- Passer une fonction en paramètres d'une autre fonction 
- Retourner la fonction en tant que résultat d'une autre fonction
- On peut alors combiner des fonctions pour en créer de nouvelles
- Ex:
```js
const sum = (a, b) => a + b;
const subtraction = (a, b) => a - b;
const multiplication = (a, b) => a * b;
const division = (a, b) => a / b;

const complexCalculator = (firstOperation, a, b, secondOperation, c) => secondOperation(firstOperation(a, b), c);

complexCalculator(sum, 3, 1, multiplication, 2); //additionne 3 et 1 et multiplie le résultat par 2
complexCalculator(subtraction, 3, 1, addition, 3); //soustrait 1 à 3 et additionne 3 au résultat
```

## Fonctions d'ordre supérieur (higher-order function)
Des fonctions qui:
- prennent une ou plusieurs autres fonctions en argument
- retournent une fonction en tant que résultat

### Fonction filter()
Permet de filtrer chaque élément d'une liste, si l'élément correspond au filtre il sera accepté:
```js
const odd = n => n % 2 != 0;
const numbers = [0, 1, 2, 3, 4, 5];
numbers.filter(odd); // [1, 3, 5];
```

### Fonction map()
Permet de transformer une collection/listed en appliquant une fonction à chaque élément de la liste:
```js
const list = [
    { size: 'l', color: 'red'},
    { size: 'xl', color: 'green'},
    { size: 'xxl', color: 'blue'},
];

const displaySizeForListItem = listItem => console.log(`Size is: ${listItem.size}`);

const listItemsSizes = list => list.map(displaySizeForListItem);

listItemsSizes(list);
```
