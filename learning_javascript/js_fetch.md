# L'API fetch

- Permet l'accès et la manipulation des éléments d'HTTP comme les requêtes ou les réponses

- Avant on utilisait notamment la méthode ``XMLHttpRequest()``, on préfère désormais utiliser ``fetch()``

## ``fetch()``
+ fonctionne sur le principe de l'asynchrone
+ prend en argument:
    - l'url que l'on cherche à atteindre
    - (optionnel) un objet ``init`` pour ajouter des réglages:
    ```js
    let customHeaders = new Headers();

    let customInit = { 
        method: 'GET',
        headers: customHeaders,
        mode: 'cors',
        cache: 'default' 
    };

    fetch('imgurl.jpg', customInit)
        .then(response => response.blob();)
        .then(responseBlob => {
            let objectURL = URL.createObjectURL(responseBlob);
            customImage.src = objectURL;
        });
    ```

+ Fonctionne avec des promises (``then()/catch(err)``) que l'on peut chaîner:
```js
//Requete fetch() avec gestion d'erreur
const customImage = document.getElementById('img');

fetch('https://api.apiname.com/docs/test')
    .then(response => {
        //On check si la propriété 'ok' de notre réponse est bien égale à true:
        if(response.ok){
            response.json().then(data => {
                customImage.src = data[0].url
            })
        } else {
            console.error("Error");
        }
    })
```

## Axios
Axios est une API qui permet de faire la même chose que fetch() mais avec plus d'options
+ On peut l'installer avec:
    - ``npm install axios``
    - un cdn: ``<script src="https://unpkg.com/axios/dist/axios.min.js"></script>``

+ Il y a quelques petites différences avec fetch():
    - Axios doit être installé, fetch est déjà présent sur la plupart des navigateurs
    - Axios contient directement les données souhaitées dans sa propriété ``data`` sous forme d'objet, alors que la propriété équivalente pour fetch: ``body`` doit être transformé en string
    - Axios a une valeur ``statusText: ok`` si la requête est ok, alors que fetch a une propriété ``ok: true`` 
    - Axios n'a pas besoin d'appeler la méthode ``.json()`` sur une réponse, car il transforme automatiquement les données en JSON
    - Axios peut intercepter les requêtes HTTP
