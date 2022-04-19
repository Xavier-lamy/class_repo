# La récursivité

+ La récursivité est le fait pour une fonction de s'appeler elle meme au sein de sa définition, cela permet de créer des boucles facilement

+ Exemple pour un algorithme de recherche binaire (on cherche à la moitié d'un tabelau rangé, si on trouve on a fini, sinon on compare si notre donnée recherchée est avant ou après puis on recommence l'opération en cherchant au milieu de la "zone" ainsi trouvée):
    1. on définit notre fonction, avec en paramètre: où il faut chercher, ce qu'il faut chercher, le début de l'array et la fin de l'array
    2. On définit le ``base case`` ou cas de base:
        - il permet de mettre fin à la fonction lorsque l'élément recherché n'est tout simplement pas dans l'array, car au cours de la fonction on va diviser le tableau en deux à chaque fois jusqu'à tomber sur une sélection d'un seul élément
        - dans ce cas les index sont tous égaux: ``start = end = mid``,
        - donc quand la fonction va etre rappelé elle utilisera soit : ``start = mid + 1`` ou ``end = mid - 1``,
        - ce qui dans tous les cas correspondra à ``start > end``
        - il faut dans ce cas arrêter la fonction, car on est arrivé au dernier élément sans qu'il ne valide l'égalité avec celui recherché, 
        - si on ne fait pas ça la fonction ne comprend pas qu'elle doit s'arêter et risque de continuer à l'infini on parle d'**infinite loop** ou de **stack overflow**
```js
//1. Définition de la fonction
const binarySearch = (array, thingToFind, start, end) => { 
    //2. Base case
    if (start > end) {
        return false;
    }

    let mid = Math.floor((start + end) / 2); //On fait la somme de l'index de début et de fin et on divise par deux pour trouver l'index central
    if (array[mid] === thingToFind) {
        return true; //Avec ça si on s'aperçoit que l'élément portant l'index médian "mid" est identique à l'élément recherhcé , alors on a trouvé le bon résultat et la fonction s'arrête
    }

    if (thingToFind < array[mid]) {
        //Sinon on recherche dans la première moitié (index inférieur à celui trouvé)
        return binarySearch(array, thingToFind, start, mid - 1); /*C'est là que la récursivité entre en jeu, on fait appelle à notre fonction à l'intérieur d'elle même,
        on entre "mid - 1" à la place d'end car on cherche à aller jusqu'à l'index médian (-1 car on a déjà comparé l'index médian)*/
    } 
    
    else {
        return binarySearch(array, thingToFind, mid + 1, end); /*Dans ce cas on cherche dans la deuxième moitié */
    }
}
```

+ Il existe d'autre exemples d'algorithmes récursifs: **merge sort**, **index sort**, **tree traversal**, ...


+ exemple avec la fonction ``factorielle()``:
```js
function factorielle(number) {
    if (number <= 1) return 1;
    else return (number * factorielle(number - 1));
}

console.log(factorielle(3));
```

+ Fonction factorielle avec l'opérateur ternaire:
```js
function factorielle(number) {
    (number <= 1) ? 1 : (number * factorielle(number - 1));
}

console.log(factorielle(3));
```