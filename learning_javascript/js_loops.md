# Les boucles
## boucles ``for``:
+ la boucle ``for`` de base prend 3 paramètres:
    - création de la variable qui sert de compteur du nombre d'exécutions de la boucle
    - condition de poursuite de la boucle (si "false" la boucle s'arrête
    - incrémentation pour passer au cycle suivant dans la boucle
    ```js
    const downloadedMusics = 20;
    for (let i = 0; i < downloadedMusics; i++) {
        console.log("Music downloaded !");
    }
    ```

+ Si on souhaitais parcourir un tableau à l'aide d'une boucle on pourrait techniquement faire:
```js
for (let i = 0; i < arrayExample.length; i++) {
    console.log("Placez votre message ici");
}
```
Néanmoins il existe des méthodes plus efficaces:

+ La boucle ``for...in...``:
```js
 const employees = [
     "Bobby",
     "Jack",
     "John",
     "Edward"
 ]

for (let i in employees) {
    console.log("Entrée de l'employé:" + employees[i]);
}    
```

+ La boucle ``for... of``: utilisée quand il n'est pas nécessaire de se soucier de l'indice des éléments d'un tableau:
```js
const customers = [
    {
    name: "Bob",
    age: 24
    },
    {
    name: "maria",
    age: 32
    },
    {
    name: "jack",
    age: 16
    },    
]

for (let customer of customers) {
    console.log("Arrivée du client: " + customer.name + ", âgé de " + customer.age);
}
```

## Boucle ``while``
+ boucle ``while``: Quand le nombre d'itérations nécessaire n'est pas connu, puisqu'on n'a pas besoin de définir une valeur max avant l'arrêt, mais seulement une condition d'arrêt qui quand elle est rencontrée arrêtera le programme.
```js
let customersInQueue = 21;
let restaurantSeat = 26;
let customersPlaced = 0;

while (customersInQueue > 0 && restaurantSeat > 0) {//tant que la condition est vraie
    customersPlaced++; //à chaque itération on ajoute un client placé
    restaurantSeat--; //On pense évidemment à le retirer de la liste des gens en attente
    customersInQueue--; // et à retirer son siège des sièges dispos
}

console.log(customersPlaced); //retourne 21 car lorsque le nombre de clients (21) a atteint 0 la boucle s'est donc arrêté
```
