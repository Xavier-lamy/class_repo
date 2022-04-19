# La refactorisation

+ **refactorisation**: simplifier le code en modifiant la structure sans changer le comportement

+ On cherche à réduire le nombre de lignes, par exemple si j'ai 3 lignes de codes qui font la même chose mais avec seulement un changement de variable, alors je peux écrire une fonction à la place, puis on peut l'appeler plusieurs fois avec les variables en argument

+ Exemple:
```js
if (firstUser.online) {
    if (firstUser.account === "normal") {
        console.log(`Hello ${firstUser.name}`);
    } else {
        console.log(`Welcome lord ${firstUser.name}`);
    }
}

if (firstUser.online) {
    if (firstUser.account === "normal") {
        console.log(`Hello ${firstUser.name}`);
    } else {
        console.log(`Welcome lord ${firstUser.name}`);
    }
}

if (firstUser.online) {
    if (firstUser.account === "normal") {
        console.log(`Hello ${firstUser.name}`);
    } else {
        console.log(`Welcome lord ${firstUser.name}`);
    }
}
```
+ Peut être factorisé en:
```js
function welcomeOnlineUser(user) {
    if (user.online) {
        if (user.account === "normal") {
            console.log(`Hello ${user.name}`);
        } else {
            console.log(`Welcome lord ${user.name}`);
        }
    }
}
```

+ Principe **DRY** : **DON'T REPEAT YOURSELF**

+ Un autre principe important des fonctions est d'éviter d'écrire une seule fonction qui fait plein de choses, il vaut mieux écrire plusieurs petite fonctions chacune destinées à une chose puis une autre fonction qui les contient toutes, ainsi le code est plus clair

> **La première règle des fonctions est qu'elles devraient être petites.**   
> **La deuxième règle des fonctions est qu'elles devraient être encore plus petites.** 
> *Robert C. Martin, Clean Code: A Handbook of Agile Software Craftsmanship*

+ Il est important de commenter son code, sans pour autant trop le commenter, il faut bien doser

+ Pour les conventions de nommage: 
    - camelCase minuscule pour les variables et fonctions,
    - CamelCase majuscule pour les noms de classe, 
    - ce n'est pas obligatoire mais fortement recommandé

- Il est important de bien choisir des noms clairs et descriptifs pour les fonctions, variables, objets, classes,...

> **Vous devriez choisir un nom de variable avec le même soin que pour votre premier enfant.**  
> *Robert C. Martin, Clean Code: A Handbook of Agile Software Craftsmanship*

+ Pour la mise en forme on peut choisir plusieurs versions, comme par exemple pour le positionnement des accolades:
```js
if (condition) {
    doOneStuff();
} else {
    doAnotherStuff();
}
//or:
if (condition)
{
    doOneStuff();
}

else
{
    doAnotherStuff();
}
```