# Les classes

+ Comme en python les classes sont des modèles d'**objets**, contenant les types d'attributs que les **instances** d'objets devront avoir,
+ On parle de **type nommé** (car on peut choisir un nom pour la classe) ou de type **complexe** (car elles permettent de regrouper beaucoup de détails)

+ Un objet JavaScript est écrit en ``JSON``: JavaScript Object Notation, il s'agit de séries de paires **clés-valeurs**, séparées par des virgules, entre des accolades, on peut les enregister dans des variables, 
+ Les **objects** font partie de la famille des collections, au meme titre que les **arrays**

```js
let myObjectExample = {
    key : "value",
    name : "Bob",
    age : 20,
    booleanKey : true,
};
```

+ Pour accéder aux données d'un objet on utilise la **dot notation**
```js
let objectName = myObjectExample.name; //retourne "Bob"
let objectAge = myObjectExample.age; // retourne 20
```

+ On peut aussi utiliser la **bracket notation**
```js
let objectName2 = myObjectExample["name"]; //retourne "Bob"
let objectAge2 = myObjectExample["age"]; // retourne 20
/*Cela permet notamment de mettre entre [] une variable qui aura
été prédéfini avec la valeur en string du nom de la propriété recherché */
let propertyToAccess = "name";
let objectName3 = myObjectExample[propertyToAccess];
```

+ Les classes sont des modèles/plans pour définir les objets, l'objectif est de créer facilement plusieurs **instances** d'objets
```js
class NameOfClass {
    constructor(title, author, pages){
        this.title = title;
        this.author = author;
        this.pages = pages;
    }
}
```

+ **Constructor**: fonction appelée quand on crée une nouvelle instance avec ``new``
+ ``this``: mot clé qui fait référence à la nouvelle instance (un peu l'équivalent de ``self`` en python)

+ On peut alors créer de nouvelles **instances** avec ``new``
```js
let myNewBook = new NameOfClass("Just a title", "Bobby", 20);
/*Cela va créer l'objet suivant
myNewBook = {
    title: "Just a title",
    author: "Bobby",
    pages: 20
} */
```
