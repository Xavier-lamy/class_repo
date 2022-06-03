# Le DOM
* Document Object Model
* Présentation structurée d'un doc HTML ou XML
* Peut etre imaginé sous la forme d'un arbre, les branche aboutissent à des noeuds:
    + document
        + Noeud racine (balise ``<html>``)
            - Noeud (``<head>``)
                - Noeud (``<title>``)
            - Noeud (``<body>``)
                - Noeud (``<h1>``)
                    - ...
                - Noeud (``<p>``)
                    - ...

## Les types de noeuds
Chaque type de noeud est une constante avec une valeur

| Constante | Valeur | Description |
|----|----|----|
|``ELEMENT_NODE``|	1	|Représente un nœud élément (comme p ou div par exemple)|
|``TEXT_NODE``|	3	|Représente un nœud de type texte|
|``PROCESSING_INSTRUCTION_NODE``|	7	|Nœud valable dans le cas d’un document XML|
|``COMMENT_NODE``|	8	|Représente un nœud commentaire|
|``DOCUMENT_NODE``|	9	|Représente le nœud formé par le document en soi|
|``DOCUMENT_TYPE_NODE``|	10	|Représente le nœud doctype|
|``DOCUMENT_FRAGMENT_NODE``|	11	|Représente un objet document minimal qui n’a pas de parent|

## Les interfaces du DOM les plus utiles
Les héritages sont représentés par une indentation, en gras les **interfaces de bases**, en italique *les mixins*
- **Window**: liée au DOM
- **Event**: tout événement qui a lieu dans le DOM
- **EventTarget**: interface que vont implémenter les objets qui peuvent recevoir des évènements
    - **Node**: interface de base pour la majorité des objets du DOM
        - **Document**: le document actuel, interface la plus utilisée avec Element (car elles héritent et implémentent la majorité des autres interfaces)
            - *ParentNode*
            - *ChildNode*
            - *NonElementParentNode*
        - **Element**: interface de base pour tous les objets d’un document
            - *ParentNode*
            - *ChildNode*
            - *NonDocumentTypeChildNode*
            - *HTMLElement*

## Accès à un élément
* Avec **Document** (recherche dans l'ensemble du document)
    - ``querySelector('cssSelector')``: retourne le premier objet **element** correspondant au sélecteur CSS en argument
    - ``querySelectorAll('cssSelector')``: retourne tous les objets **element** correspondant au sélecteur CSS en argument, sous la forme d'une liste de type **NodeList**, on peut les traiter individuellement avec la méthode **forEach()**, ex:
        ```
        let allParas = document.querySelectorAll('p');
        allParas.forEach(function(name, index)){
            name.textContent += `name: ${name}, index: ${index}`;
        };
        ```
    - ``getElementById('#id')``: renvoie l'élément correspondant à l'ID
    - ``getElementsByClassName('.class')``: renvoie une **liste** d'éléments correspondant à la classe en argument
    - ``getElementsByTagName('p')``: renvoie une liste d'éléments correspondant au nom de balise en argument, sous forme d'un objet HTMLColection, liste mise à jour en direct en fonction des modifs du DOM
    - ``getElementsByName('attr')``: renvoie un objet NodeList avec la liste des éléments portant l'attribut en argument

* Avec **Element** (recherche dans l'élément sélectionné)
    - ``querySelector('cssSelector')``: retourne le premier objet **element** correspondant au sélecteur CSS en argument
    - ``querySelectorAll('cssSelector')``: retourne tous les objets **element** correspondant au sélecteur CSS en argument, sous la forme d'une liste de type **NodeList**, on peut les traiter individuellement avec la méthode **forEach()**, ex:
        ```
        let allParas = document.querySelectorAll('p');
        allParas.forEach(function(name, index)){
            name.textContent += `name: ${name}, index: ${index}`;
        };
        ```
    - ``getElementsByClassName('.class')``: renvoie une **liste** d'éléments correspondant à la classe en argument
    - ``getElementsByTagName('p')``: renvoie une liste d'éléments correspondant au nom de balise en argument, sous forme d'un objet HTMLColection, liste mise à jour en direct en fonction des modifs du DOM

## Propriétés de l'interface Document
Elles permettent de renvoyer directement certains éléments:
- ``body``: retourne le noeud de l'élément body
- ``head``: retourne le noeud de l'élément head
- ``links``: retourne une liste de tous les éléments **a** ou **area** possédant un **href** avec une valeur
- ``title``: retourne le contneu de l'élément titre ou permet de le redéfinir dans une variable
- ``url``: retourne l'url du document sous forme de string
- ``scripts``: liste de tous les éléments script du document
- ``cookie``: liste de tous les cookies liés au document sous forme de string, ou définit un nouveau cookie

## Modifier le contenu
A partir d'un objet **Element**:
- ``innerHTML``: récupère ou redéfinit la syntaxe **interne** d'un élément (ex: si on a un élément ``<p>``, il restera un élément ``<p>``, et le code sera injecté dedans)
- ``outerHTML``: récupère ou redéfinit **l'ensemble** de la syntaxe d'un élément (ex: si on a un élément ``<p>``, il pourra etre modifier par outerHTML, et on ajoutera du code à l'intérieur)
- ``textContent``: représente le contenu textuel complet d'un noeud et ses descendants (y compris le texte invisible, ex: hidden)
- ``innerText``: représente le contenu textuel visible uniquement, d'un noeud et ses descendants

## Se déplacer dans le DOM avec les noeuds
- ``parentNode``: renvoie le parent (quelque soit son type: document ou **element**) du noeud spécifié
- ``parentElement``: renvoie le parent d'un noeud que s'il s'agit d'un noeud **element** 
- ``childNodes``: liste de tous les noeuds enfants (tous types: noeuds éléments, noeuds textes, noeuds commentaires)de l'élément
- ``children``: liste uniquement les noeuds enfants de type noeuds éléments
- ``firstChild``: renvoie le premier noeud enfant direct d'un noeud (null s'il n'y en a pas), quel que soit le type
- ``lastChild``: renvoie le dernier noeud enfant direct d'un noeud (null s'il n'y en a pas), quel que soit le type
- ``firstElementChild``: renvoie le premier noeud enfant direct de type élément d'un noeud (null s'il n'y en a pas)
- ``lastElementChild``: renvoie le dernier noeud enfant direct de type élément d'un noeud (null s'il n'y en a pas)
- ``previousSibling``: renvoie le noeud précédent (de même niveau)
- ``nextSibling``: renvoie le noeud suivant (de même niveau)
- ``previousElementSibling``: renvoie le noeud **element** précédent (de même niveau)
- ``nextElementSibling``: renvoie le noeud **element** suivant (de même niveau)

## Obtenir le nom d'un noeud, son type ou son contenu
- ``nodeName``: retourne une string avec le nom du noeud (nom balise pour un **element**, #text pour un noeud type text)
- ``nodeValue``: renvoie ou redéfinit la valeur du noeud
- ``nodeType``: renvoie un entier avec le type du noeud, (voir tableau **types de noeuds**)

## Ajouter, modifier ou supprimer des éléments
* Créer un noeud Element ou noeud Text:
    - ``createElement('p')``: crée un element de type 'p'
        - On peut ensuite ajouter du contenu, avec textContent() par exemple
    - ``createTextNode('text')``: crée un noeud Text (on peut ensuite ajouter ce type Text dans un autre élément)
* Insérer un noeud dans le DOM:
    - ``prepend()``: insère le noeud comme premier enfant d'un element
    - ``append()``: insère le noeud comme dernier enfant d'un element
    - ``appendChild()``: insère le noeud comme dernier enfant d'un élément, mais:
        - n'accepte que les objets types **Nodes**, pas de string directement
        - un seul noeud à la fois
        - retourne l'objet ajouté (append, lui ne retourne rien)
    - ``insertBefore(child1, child2)``: insert le noeud enfant child1 avant le noeud enfant child2 dans l'élement parent commun
    - ``insertAdjacentElement('position', 'element')``: insère un noeud élément à une position donnée par rapport à l'élément d'où il est appelé
    - ``insertAdjacentText('position', 'text')``: insère un noeud texte à une position donnée par rapport à l'élément d'où il est appelé
    - ``insertAdjacentHTML('position', 'html')``: insère une chaine de caractère HTML spécifiée à une position spécifiée
        - pour les 3 précédents , 'position' peut etre: 
            - ``beforebegin``: insère avant l'élément
            - ``afterend``: insère après l'élément
            - ``afterbegin``: insère avant le premier enfant de l’élément
            - ``beforeend``: insère après le dernier enfant de l’élément
* Déplacer dans le DOM, pour cela on réutilise des méthodes en ajoutant des arguments
    - ``parent.appendChild('move', 'ref')``: ici on a ajouté un deuxième argument , un élément déjà présent dans le DOM, qui sert de référent, ici ça veut dire qu'on souhaite que 'move' se place après l'élément 'ref' dans l'élément parent
    - ``parent.insertBefore('move', 'ref')``: le deuxième est un élément déjà présent dans le DOM, qui sert de référent, ici ça veut dire qu'on souhaite que 'move' se place avant l'élément 'ref' dans l'élément parent
* Cloner ou remplacer un noeud
    - ``cloneNode('boolean')``: clone le noeud, l'argument est un booléen (si = true: les enfants seront aussi clonés, défaut, si = false: les enfants ne sont pas clonés )
    - ``replaceChild('A', 'B')``: remplace le Noeud B par le noeud A, si le noeud A était déjà présent ailleur dans le document cela le supprime de sa place d'origine pour le déplacer à la nouvelle place
* Supprimer un noeud du DOM
    - ``removeChild('A')``: supprime le noeud enfant A du noeud parent et retourne le noeud retiré
    - ``remove('A')``: supprime le noeud enfant A du noeud parent   

## Manipuler les attributs
- ``hasAttribute('attrName')``: vérifie la présence de l'attribut
- ``attributes()``: renvoie la liste des attributs d'un élément dans un objet de **NamedNodeMap** interface de l'interface **Attr**, sous la forme clef/valeur. pour récupérer tout ça on peut faire une boucle for pour récupérer les propriétés **name** et **value** de **Attr**
- ``getAttributeNames()``: renvoie un array des noms d'attribut d'un élément
- ``getAttribute('name')``: renvoie la valeur d'un attribut pour un élément 
- ``setAttribute('name', 'value')``: ajoute un nouvel attribut ou change la valeur d'un attribut
- ``className('value')``: ajoute ou redéfinit la valeur de l'atribut classe d'un élément
- ``id('value')``: ajoute ou redéfinit la valeur de l'atribut id d'un élément
- ``removeAttribute('name')``: supprime l'attribut de l'élément
- ``toggleAttribute()``: inverse la valeur logique d'un attribut type booléen (genre "required")

### Attributs de données
- Il s'agit d'attribut qu'on peut ajouter à un élément en HTML
- Ils commencent tous par ``data-``
- On peut y accéder en JS via ``dataset``
- Exemple:
```html
<div id="myelement" data-index-test="10"></div>
```
```js
//Fetch element
let element = document.getElementById('myelement');

//Get data attribute (les attributs composés avec un tiret dans l'HTML sont transformé en camelCase)
element.dataset.indexTest //Return 10

//Set data attribute
element.dataset.indexTest = 5

//Si on souhaite récupérer par l'attribut:
let element = document.querySelectorAll("[data-index-test]");
```

## Modifier le style d'un élément
On utilise la propriété style de l'élément HTMLElement, puis on ajoute le nom de la propriété CSS "traduit" en camelCase JS ex:
- element.style.color = 'red';
- element.style.fontSize= '12px';

## Gestion d'évènements
Exemple d'évènements: chargement du document, clic sur un bouton, survol d'un élément

### Utiliser les attributs HTML pour gérer l'évènement (non recommandé)
Méthode la plus ancienne: on écrit directement un attribut d'évènement (onclick, onmouseover, onmouseout)

### Utiliser les propriétés JS pour gérer les event
On ajoute les event directement en JS ex:
- ``p.onclick = function(){.....}``
- Ceci est moins efficace que la 3eme méthode, en partie car on ne peut ajouter qu'un event par element

### Utiliser AddEventListener()
Ici on peut utiliser autant d'event qu'on veut par element ex:
- Ajouter un évènement
```js
p.addEventListener('click', function()doSomething{....});
p.addEventListener('mouseover', function(){something});
p.addEventListener('mouseover', function(){anotherthing});
p.addEventListener('mouseout', function(){....});
```
- Supprimer un évènement
```js
p.removeEventListener('click', doSomething);
```
#### Evènements
+ ``keydown`` : quand une touche est pressé, propriétés:
    - ``keydown.code``: retourne le code de la touche, ce qui permet d'avoir sa position sur le clavier (utile pour de jeux par exemple, si on veut la position de la touche plutôt que la valeur retournée, ainsi peut importe qu'il s'agisse d'un clavier français ou anglais, le code sera le même, si le français presse ``a``, ce sera l'équivalent de ``q`` pour l'anglais, la touche est donc toujours au même endroit)
    - ``keydown.key``: retourne la valeur de la touche, prend en considération les modifications de shift, ctrl,... ainsi presser ``shift`` + ``,`` retournera ``?`` au lieu de ``,`` permet d'avoir la touche que le caractère que l'utilisateur a voulu plutôt que la position de la touche , ce cas est donc utile par exemple pour une calculatrice, ou quel que soit la touche que l'utilisateur utilise pour taper ``1``, on veut que ce soit 1

## Propagation des éléments
Quand un élément se propage il passe par deux phases:
- phase de capture: l'évènement se propage de l'ancêtre le plus éloigné au plus rapproché de l'élément (ex: de html à p), phase descendante, par défaut aucun évènment ne se déclenche
- phase de bouillonnement: l'évènement se propage de l'ancêtre le plus rapproché au plus éloigné de l'élément (ex: de p à html), phase montante, c'est dans cette phase que les gestionnaires d'évènement s'exécutent par défaut (on peut changer ça mais ça sert à rien, cela est du à d'anciennes methodes qui ont fusionné)


## Stopper la propagation et annuler le comportement par défaut
- ``stopPropagation()``: stoppe la propagation ........


///online formapro module 8 , chap 8

