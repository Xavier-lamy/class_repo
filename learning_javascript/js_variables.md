# Les variables et constantes

## Variables
- Pour les variables on essaye de faire des noms suffisament descriptifs (quantityInStock plutôt que "quantity" ou "qty"), 
- On respecte la convention de nommage camelCase, ou une autre aussi courante*/


- Pour déclarer (créer) une variable et l'initialiser (donner une valeur):
```js
let variableName = "variableValue";
let numberOfPeople = 120;
```

- On peut ensuite modifier la valeur d'une variable, on dit qu'une variable est mutable
```js
variableName = "otherVariableValue";
```

- On peut ajouter, soustraire, multiplier et diviser des variables ou leur ajouter des nombres:
```js
let a = 10;
let b = 15;
let c = a + b;
let d = a - b;
let e = a * b;
let f = a / b;

a += 3; // ajoute 3 à a
a -= 2; // soustrait 2 à a
a *= 5; // multiplie a par 5
a /= 3; // divise a par 3

a++; // ajoute 1 à a
a--; // soustrait 1 à a
```

## Les Constantes
- elles ressemblent à des variables à ceci près qu'elles ne sont pas mutables 
- ce qui nous permet de les déclarer en étant certain qu'elles garderont la même valeur tout le temps 
- si une erreur de notre code nous fait changer la valeur d'une constante, la console renverra une erreur
```js
const nomPrénom = "Lamy Xavier"; //le nom ne devrait pas pouvoir changer durant mon code, on peut donc le déclarer en tant que constante
nomPrénom = "Bob"; //La console renverra une erreur car on ne peu pas changer la valeur d'une constante
```

## Types primitifs des variables
- Il existe trois types primitifs principaux (types primitifs = briques de base d'une structure de données)
- ``number`` (nombre): ``integers`` (entier) ou ``floating-point`` (virgule flottante, nombres décimaux) 
```js
let number = 3; 
```

- ``string`` (chaîne de caractères) encadrées par des guillemts simples ou doubles, si on veut utiliser une apostrophe par exemple on utilisera alors les guillemets doubles, afin que l'apostrophe ne soit pas considéré comme un guillemet de fermeture
```js
let string = "I am a string"; 
```

- ``boolean`` (valeur logique ``true`` ou ``false``)
```js
let boolean = true;
``` 

- Il existe 8 types de données au total: 
    - 7 types primitifs:
        - Boolean
        - Null (représente la nullité=absence de valeurs)
        - Undefined (affecté aux variables sans valeurs )
        - Number
        - BigInt (pour représenter des entiers plus grands qu'avec number, des très grands nombres)
        - String
        - Symbol (valeur unique et immuable qui peut servir de clé pour une propriété d'un objet)
    - 1 autre type:
        - Object

## Concaténation
- On peut "concaténer" des chaînes de caractères
```js
let firstString = "Bonjour";
let secondString = "Bob";
let greetingString = firstString + " " + secondString;
```

- Pour concaténer une variable dans une *string* on peut utiliser la *string interpolation*
```js
let myName = "Bob"
let greetings = `Bonjour ${myName}` // il faut utiliser les accent graves en guise de guillemet (alt gr + 7)
```

- On dit que javascript est un langage à "types dynamiques" et à "typage faible":
    - ce qui veut dire que l'on peut commencer avec une variable en tant que nombre et la réaffecter en "string"

## Différence entre *var* et *let*
- ``var``: 
    - Sa portée est celle de la fonction (function scope)
    - on peut y accéder même avant sa déclaration car elle est initialisé avant le lancement du code (elle vaut alors ``undefined``)
    - Déclarée globalement (hors de tout bloc), cela crée une propriété pour l'objet ``window`` (donc ``window.varName`` renverrait la valeur de ``varName``)
    - On peut la redéclarer sans erreur en mode strict (``'use strict'`` au début du script):
    ```js
    var foo = "foo1";
    var foo = "foo2"; //Fonctionne la variable peut etre redéclarée 
    ```

- ``let``: 
    - Sa portée est celle du bloc ``{}`` (block scope)
    - On ne peut pas y accéder avant sa déclaration( renvoie une *ReferenceError*)
    - Déclarée globalement (hors de tout bloc), cela ne crée pas de propriété pour l'objet ``window`` (donc ``window.letName`` ne renverrait pas la valeur de ``letName``)
    - On ne peut pas la redéclarer en mode strict, cela retournera une erreur (``SyntaxError: Identifier 'variableName' has already been declared``):
    ```js
    let foo = "foo1";
    let foo = "foo2"; //Retourne l'erreur 'SyntaxError: Identifier 'foo' has already been declared'
    ``` 

- ``var`` est obsolète et donc à éviter, car cela peut mener à des erreurs, si on souhaite accéder à une variable à l'extérieur d'un bloc, il suffit de la déclarer dans le bon scope:
    - la déclarer en dehors des blocs: elle est alors ``globale`` et peut être utilisée n'importe où
    - la déclarer dans un ``bloc`` (``if``,``for``,...) ou  dans une ``fonction``: elle est alors ``locale`` et ne peut être utilisée que dans ce bloc 

