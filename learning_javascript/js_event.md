# Les évènements du DOM
+ Un événement est une **réaction** à une **action** émise par l'utilisateur (ex: clic sur un bouton, saisie de texte dns un formulaire
+ Un événement est représenté par un **nom** (click, mousemove,...) et une fonction que l'on définira appelée **callback**
+ Par défaut un événement est dit **propagé** càd qu'il sera transmis à l'élément parent et ainsi de suite jusqu'à l'élément racine

+ Pour réagir à un événement, il faut **écouter** cet événement avec la fonction:
```js
addEventListener(event, callback); //event est à remplacer par le nom de l'événement recherché, et callback par la fonction voulue
```

+ Exemple si on veut **écouter** quand l'utilisateur **clic sur la souris**:
```js
Element.addEventListener(click, onclick); //Onclick sera notre fonction qu'on définira, le comportement par défaut de l'événement sera tout de même exécuté, sauf si on précise qu'on ne le souhaite pas
```

+ La fonction doit normalement prendre un argument en paramètre, qui correspond au contenu de l'événement qui vient de se produire, c'est aussi de cette manière que l'on pourra désactiver le comportement par défaut de l'événement:
```js
const elt = document.getElementById(lien); //on récupère l'élément sur lequel on veut repérer un event
elt.addEventListener(click, function(event) {//On écoute l'event click, la callback prend un paramètre (ici:event)
    event.preventDefault();//preventDefault permet d'empêcher le comportement par défaut de cet élément
    event.stopPropagation();//stopPropagation permet d'empêcher la propagation par défaut qui autrment ferait remonter l'événement à tous les parents de l'élément
})
```

### Pour écouter les données liées à un événement:
+ Pour écouter le mouvement de la souris on utilise l'événement ``mousemove``, avec pour objet event, un objet de type MouseEvent qui nous renverra des données telles que:
    - ``clientX / clientY``: position de la souris dans les coordonnées locales (contenu du DOM)
    - ``offsetX / offsetY``: position de la souris par rappoort à l'élément sur lequel on écoute l'événement
    - ``pageX / pageY``: position de la souris par rapoort au document entier
    - ``screenX / screenY``: position de la souris par rapport à la fenetre du navigateur
    - ``movementX / movementY``: position de la souris par rapport à sa position lors du dernier event mousemove

+ Par exemple:
```js
elt.addEventListener(mousemove, function(event) {
    const x = event.offsetX; //Renvoie les coordonnées X de la souris dans l'élément sélectionné
    const y = event.offsetY; //Renvoie les coordonnées Y de la souris dans l'élément sélectionné
});
```


### Contenu d'un champs de texte:
+ Pour cela on va utiliser l'event ``change``, il fonctionne avec les éléments de type **input**, **select**, **textarea**, **checkbox** et **radio**, il est déclenché quand le champs ou la case à cocher perd le **focus**

+ Cela permet de détecter que le texte saisi dans un champ a changé, ou qu'une case a été cochée

+ Pour récupérer la valeur du champ après qu'il ai été modifié on accède à la valeur de l'élément cible: ``event.target.value``
    - ``target`` correspond à l'élément ou s'est produit l'event et ``value`` permet de récupéerer ou définir la valeur du champ
    ```js
    const input = document.querySelector(input);
    const log = document.getElementById(log)
    input.addEventListener(change, updateValue);
    
    function updateValue(e) {
        log.textContent = e.target.value; //va retourner le contenu tapé dans l'input, à l'intérieur de log, des qu'un changement (perte de focus) est détecté dans l'input
    }
    ```

+ On peut aussi utiliser ``input``, de la même façon si on souhiate que le changement soit pris en compte dès que du texte est tapé, et pas uniquement au changement de champ:
```js
input.addEventListener(input, updateValue);
```