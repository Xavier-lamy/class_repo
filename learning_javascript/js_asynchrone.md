# JS Asynchrone
+ JavaScript est dit **synchrone** et **mono-thread** càd :
    - qu'il n'y a qu'un seul fil d'exécution du code source, donc chaque ligne sera exécuté l'une après l'autre seulement quand la précédente aura été exécuté
    - on ne peut pas exécuter deux lignes de code en parallèle, on ne peut donc faire qu'une chose à la fois

+ Il est néanmoins possible de réaliser du code asynchorne en JS càd:
    - du code qui s'exécutera quand même ligne après ligne mais, si une ligne est asynchrone alors la ligne suivante n'aura pas besoin d'attendre la fin de l'exécution de la ligne asynchrone

+ Pour cela on utilise **l'Event loop**, une sorte de gros tunnel mono-thread:
    - quand on demande à exécuter une fonction de manière asynchrone, la fonction en question est alors placée dans une sorte de file d'attente, qui exécutera les fonctions qu'elle contient les unes après les autres, 
    - de cette manière, le code n'est pas vraiment exécuté en parallèle, mais il ne bloque quand même pas l'exécution du code depuis lequel il est appelé

+ La fonction la plus répandue pour exécuter du code asynchrone est ``setTimeout()`` qui prend 2 paramètres:
    - la fonction que l'on souhaite exécuter en asynchrone ainsi que le délai en millisecondes avant qu'elle ne soit exécutée:
    ```js
    setTimeout(function() {
        console.log("Hello!")
    }, 5000);

    console.log("Hi!"); //Dans cet exemple la console affichera d'abord "hi", et après 5 secondes "hello"
    ```

+ Pour annuler l'exécution asynchrone on peut utiliser ``clearTimeout()`` avec en paramètre la valeur qui nous est retournée par ``setTimeout()``

+ Il existe aussi d'autre méthodes mais moins répandues:
    - ``setInterval()`` : fonctionne comme ``setTimeout()``, mais en boucle à une fréquence déterminée par le temps en millisecondes, on peut là aussi utiliser ``clearInterval()`` avec en paramètre la valeur de retour de ``setInterval()`` pour stopper l'exécution en boucle
    - ``setImmediate()``: la fonction utilisée avec ``setImmediate()`` sera placé en file d'attente et exécuté avant toute les autres

+ **L'I/O** ou **Input/Output**
    - Il s'agit du flux d'entrée et de sortie, par exemple lecture/écriture de fichiers, requetes HTTP, il est aussi géré de manière asynchrone comme la plupart des **évènements**
    - Quand on utilise ``fetch()`` par exemple elle ne bloque pas l'exécution du code, c'est donc elle aussi une fonction asynchrone, ``fetch()`` retourne en effet une **Promise**


## Gérer du code asynchrone:
### Callbacks
+ Les **callbacks** sont des fonctions définies et que l'on passe en paramètre d'une fonction asynchrone

+ Par exemple les évènements (``addEventListener``) sont un exemple de fonction asynchrone utilisant des **callbacks**

+ En effet la fonction callback ne sera appelée que lorsque notre event a été détecté (ex: click sur la souris), cela ne bloque donc pas l'exécution du code. 

+ L'un des inconvénients des callbacks est que l'on peut se retoruver facilement avec du code illisible ou peu clair, (on parle de *callback hell*) car si on imbrique une callback en argument de chaque callback et ainsi de suite on se retrouve avec une couche de plusieurs callbacks pas toujours très lisible

+ Pour gérer les erreurs avec les callbacks, on va en général passer deux arguments en paramètre, l'erreur en 1er et la donnée en 2eme:
```js
fs.readFile(filePath, function(err, data) {
    if (err) {
        throw err; // cela retournera une erreur si err n'est pas "null" ou "undefined"
    }
    //Do something with data
})
```

### Promises
+ Les **promises** sont des éléments plus complexes à mettre en place que les calbacks , mais plus puissantes
et plus faciles à lire

+ Quand on exécute du code asynchrone la promise nous renvoie une promesse qu'un résultat sera bientôt retourné

+ Il s'agit d'un objet ``Promise`` qui sera soit *fullfilled* (résultat) soit *rejected* (erreur), (ou *pending* quand elle est en attente)

+ Quand on récupère une promise on utilise les fonctions ``.then()`` pour exécuter le code quand la promesse est résolue, et ``.catch()`` pour exécuter un autre code si une erreur survient

+ On peut alors chainer les **promises** car quand on utilise ``then()`` une nouvelle promise est créée avec le résultat obtenu, on peut alors utiliser cete promise dans une nouvelle fonction ``then()``, si la fonction retourne une exception, on peut intercepter avec ``catch()``, et si ``catch()`` possède aussi une fonction qui retourne une valeur on peut avoir une nouvelle promise, et donc utiliser ``then()`` à nouveau

```js
returnAPromiseWithNumber2()
    .then(function(data) { //data = 2
        return data + 1;
    })
    .then(function(data) { //data = 3
        throw new Error("error");
    })
    .then(function(data) {
        //Ne sera pas exécuté car le then() précédent renvoie une erreur qui sera donc intercepté avec catch
    })
    .catch(function(err) {
        return 5; //si on a une erreur à un moment donné, catch prend le relais et dans ce cas renvoie 5, une nouvelle valeur qui sert de promise pour les then suivants
    })
    .then(function(data) { //data = 5
        //action de la fonction
    });

    //Fetch() par exemple utilise les "promises" pour répondre aux requetes http
```

### Async/await:
+ Il s'agit de deux mots clés qui permettent aussi de gérer des fonctions asynchrones:
    - quand on utilise ``async`` devant une fonction on la rend asynchrone et on bloque son résultat, en attendant qu'il soit débloqué par ``await``:
    ```js
    async function fonctionAsynchrone1() {/*code asynchrone */}
    async function fonctionAsynchrone2() {/*code asynchrone */}
    async function fonctionAsynchrone3() { //Ici la fonction 3 est asynchrone et utilise ``await`` pour faire appel au résultat des deux fonctions asynchrones précédentes
        const value1 = await fonctionAsynchrone1();
        const value2 = await fonctionAsynchrone2();
        return value1 + value2;
    }
    ```
+ Les fonctions asynchrones utilisent généralement les **promises** en arrière plan, donc on peut utiliser les deux en même temps
+ Pour gérer les erreurs avec ``async/await`` on peut mettre notre code dans un bloc ``try{}/catch(e){}``



## Enchainer plusieurs requetes HTTP
### Avec les callbacks
+ pour l'exemple on imagine qu'on a créé deux fonctions au préalable:
    - get() qui fait une requete GET
    - post() qui fait une requête POST
    - les deux prennent en paramètre l'url et une callback à exécuter quand on a le résultat et qui prend en 1er paramètre une variable d'erreur:
    ```js
    let GETRequestCount = 0;
    let GETRequestResults = []; //Sert à conserver les requetes des get(), car elles ne sont pas obteunues exactmetn en meem temps

    function onGETRequestDone(err, result) { //Puisque nous voulons que la requete post ne soit faite que lorsque les deux get on été exécutés
        if (err) throw err;

        GETRequestCount++; //On a donc créé la variable getrequestcount, afin de savoir si les 2 get() sont terminées, on l'incrémente à chaque fois que l'on réalise un get(), car elle est en argument des get()
        GETRequestResults.push(result);

        if (GETRequestCount == 2) { //quand on a réalisé nos deux get(),onGETRequestDone est incrémenté à 2 et donc on peut exécuter cette fonction à son tour qui fera le post() 
            post(url3, function(err, result) {
                if (err) throw err;
            })
        }
    }

    get(url1, onGETRequestDone); //On appelle deux fois la fonction get(),puisque'elle est asynchrone
    get(url2, onGETRequestDone); //elle ne bloque donc pas l'exécution du code et les deux requetes peuvent etre en parallèle
    ```

### Avec les promises:
+ On utilise la fonction ``Promise.all`` qui prend en arguments une liste de promises, par exemple nos fonctions ``get()`` exécute les fonctions en parallèle et renvoie les nouvelles promises:
```js
Promise.all([get(url1), get(url2)]) //Promise.all nous retourne les promises de nos deux fonctions get() qui prend en argument l'url de la requete
    .then(function(results) { //then reçoit les résultats des promises sous forme de tableau
        return Promise.all([results, post(url3)]); //quand nos requetes get() sont terminées, alors la requete post() se lance à sont tour
    })
    .then(function(allResults) { //Ici on récupère la liste de toutes les promises:
        //allResults = [ [ getResult1, getResult2 ], postResult ]
    });
```

    
### Avec async/await
+ On imagine qu'on a créé des fonctions asynchrones ``async function get("url")`` et ``async function post("url")``:
```js
async function requests() {
    let getResults = await Promise.all([get(url1), get(url2)]); //là aussi on utiise Promise.all avec cette fois "await" devant,
    let postResult = await post(url3); // ce qui force à attendre la fin de l'exécution des deux requetes get() avant d'utiliser await devant post pour attendre le résultat
    return [getResults, postResult]; //On retourne ensuit un tableau avec les résultats
}

requests().then(function(allResults) { //On appelle ensuit notre fonction avec .then pour récupérer tous els résultats
});
```
