# Les conditions

+ **le déroulement du programme**: Un terme qui décrit l'ordre d'exécution des lignes de codes, qui selon la situation, pourront être *lues*, *ignorées*, *répétées*

## Instructions conditionnelles:
- Booléens
```js
let condition = true;
if (condition) {
    console.log("Accepted")
} else {
    console.log("Denied")
}
```

- expressions de comparaison + chainage d'instructions conditonnelles: ``<`` ``<=`` ``==`` ``>=`` ``>`` ``!=``(différent de)
```js
let valueA = 1;
let valueB = 2;
if (valueA > valueB) {
    console.log("A > B");
} else if (valueA < valueB) {
    console.log("A < B");
} else {
    console.log("A = B");
}
```

## Différence **égalité simple** et **égalité stricte**
- ``5 == "5"`` : Si on vérifiait l'égalité cela retournerait ``true`` car il s'agit d'une **égalité simple** qui ne vérifie que la valeur
- ``5 === "5"``: Dans ce cas: ``false`` car on a bien une égalité de valeurs mais pas de type (number!=string)
- fonctionne aussi pour les inégalités:
    - ``5 != "5"``
    - ``5 !== "5"``

## Les opérateurs logiques:
```js
let registered = true;
let premium = true;
let premiumPro = false;

registered && premium; // "and", les deux sont vrai, retournerais "true"
registered && premiumPro; //"and", les deux sont vrai, retournerais "false"

registered || premium; // "or", au moins l'un des deux est vrai, retournerais "true"
registered || premiumPro; //"or", au moins l'un des deux est vrai, retournerais "true"

!registered; // "isnot", la condition n'est pas vraie, ici "false", car registered est bien "true"
```

## Le **scope**
C'est la portée des variables:
- **locale**: si une variable est déclarée dans un bloc elle ne peut être utilisé que dans le bloc dans lequel elle est déclarée
- **globale**: si elle est déclarée en dehors de tout bloc
```js 
let globalVari = true;

if (globalVari) {
    let internalVari = "hey"
} else {
    let internalVari = "Ho"
}

console.log(internalVari); //cela va renvoyer un message d'erreur car internalVari n'a pas été déclaré en global mais seulement en local

//Pour y remédier:
let globalVari = true;
let internalVari = ""; //on déclare en global en premier

if (globalVari) {
    internalVari = "hey"
} else {
    internalVari = "Ho"
}

console.log(internalVari); //on a juste réattribué en local la variable déclarée en global donc ça marche cette fois
```

## Les instructions **switch**
+ switch prend en argument la variable à vérifier, et dans son bloc de code, une liste de différents cas possibles:
    - ``case`` détermine un des cas possible, si le cas s'avère vrai, alors l'opération est exécuté
    - lorsque c'est exécuté ``break``, va permettre de sortir du bloc, autrement cela continuerais avec les autres cas, meme lorsque le bon est dejà trouvé
    - ``default``: Si aucunes des conditions n'est vrai alors la valeur par défaut est retournée
```js
let accountUser = {
    name: "bob",
    age: 23,
    accountType: "normal",
};

switch (accountUser) {
    case "normal":
        console.log("This is a normal account");
    break;
    case "premium":
        console.log("This is a premium account");
    break;
    case "premium-pro":
        console.log("This is a premium-pro account");
    break;

    default:
        console.log("Unknown type of account")
}
```

## ``Truthy`` vs ``Falsy``
+ Quand il y a besoin de valider un booléen, JS transformera certains types de valeurs en ``true`` ou ``false``, quand il les rencontre
+ toutes les valeurs sont ``truthy`` et seront évalués à ``true`` par défaut sauf:
    - ``false``,
    - ``0``, 
    - ``-0``,
    - ``0n``,
    - ``""``,
    - ``null``,
    - ``undefined``,
    - ``NaN``