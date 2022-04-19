# JavaScript

## Intro 
- langage dynamique (génère contenu dynamique, opposé= langage statique)
- langage côté client (= interprété par le navigateur pour afficher un contenu: HTML, CSS et JS, opposé= côté serveur): peut aussi être utilisé en serverside (avec Node.js par exemple)
- langage interprété: peut être interprété directement si on a un logiciel interpréteur (tous les navigateurs en ont), opposé= compilé (nécessite d'être "traduit" en un autre langage pour etre interprété)
- langage orienté objet

## Environnements
En JS il n'ya pas vraiment de foncton ``main`` comme dans beaucoup d'autres langages, JavaScript peut s'exécuter dans différents types d'environnements:
- JSBin: un outil qui permet de tester du code en JS, étant donné que JSBin parcours toutes nos lignes de code dans l'ordre, il faut faire gaffe à cet ordre
- dans des pages web (intégré dans des balises ``<script>`` dans le ``<body>`` du HTML)
- On peut aussi l'utiiser pour des serveurs (avec l'environnement "Node" par exemple)

### API / Bibliothèque / Framework
- API : Application Programming Interface: pour utiliser une application tierce (ex: google maps, twitter, ...)
- Bibliothèque/Librairie : ensemble de fichiers de code prédéfinis qu'on utilise pour gagner du temps (ex: jQuery)
- Framework : une sorte de super librairie (ex: Angular.js et React.js)

### Déclaration
- En bas du html avant ``</body>``
- ajouter l'atttribut "async" ou "defer" pour le téléchargement asynchrone des données

### Syntaxe
- point virgule pas obligatoire mais fortement recommandé (js peux les ajouter automatiquement mais cela nécessite de savoir quelles regles il utilise), à utiliser au moins au debut
- camelCase pour nommer les variables

#### Syntaxe bloc if
```js
if() {

}
else if() {

}
else {

}
```

#### Syntaxe switch :
```js
switch(x){
     case 2: 
     `code`;
     break;

     case 3:
     `code`;
     break;

     default:
     `code`;
}
```

#### Syntaxe boucles
- Les boucles doivent avoir:
    - valeur de départ qui sert de compteur
    - condition de sortie
    - itérateur pour modifier la valeur de départ 
- Types de boucles:
    - while(...){...}
    - do{...} while(...) (la boucle fonctionnera au moins une fois avant de verifier la condition)
    - for(i = startValue; stopCondition; iteration){...}
    - for ... in : boucle for pour objets
    - for ... of : boucle for pour tableaux
    - for await... of


### Types de données
- String
- Number
- Boolean
- Null (valeur inconnue: quand on choisit d'attribuer null, retourne Object: pas très logique)
- Undefined (valeur non définie: quand on n'attribue pas de valeur)
- Symbol
- Object (Contient plusiuers valeurs, ex: en js les tableaux sont des objets)


### Fonctions
- ``typeof nomVariable``: retourne le type de la valeur
- déclaration : ``function functionName(param1, param2){ return ... }``
- exécution : ``functionName();``

#### Fonction anonyme
Une fonction qu'on declare sans nom, on peut l'appeler:
- en la déclarant dans une variable puis en appelant la variable avec des `()` :
    ```js 
    let varName = function(){...};
    varName();
    ```
- en la déclarant tout en l'appelant avec des `()`:
    ```js
    function(){...}(),
    ```
- en l'appelant dans un déclenchement d'évènement: 
    ```js
    varName.addEventListener('click', function(){...});
    ```

#### fonctions recursives
Qui s'appelle elle meme, on peut créer des boucles de cette manière:
```js
function funcName(n) {
    if (n < 0) {
        doSomething();
        return funcName(n - 1);
    }else{
        return n;
    }
};
funcName(10);
```


### variables
- déclaration: ``let varName = value``
- portée: 
    - globale (script entier)
    - locale (dans une fonction)


### Opérateurs
#### Arithmétiques
- ``+``: Addition
- ``–``: Soustraction
- ``*``: Multiplication
- ``/``: Division
- ``%``: Modulo (reste entier d’une division euclidienne)
- ``**``: Exponentielle (n exposant e)

Attention: si pour les priorités c'est comme en math, en ce qui concerne les exposants c'est un peu différent: 2 ** 3 ** 2 revient à écrire 2 ** (3 ** 2) et non (2**3) **2

#### Affectation
- ``+=``:	Additionne puis affecte le résultat
- ``-=``:	Soustrait puis affecte le résultat
- ``*=``:	Multiplie puis affecte le résultat
- ``/=``:	Divise puis affecte le résultat
- ``%=``:	Calcule le modulo puis affecte le résultat

#### Concaténation
- "stringA" + 'stringb'
- On peut aussi utiliser les backticks: `` ex:
    - `Le résultat de ${x} plus ${y} est égal à ${x + y}` cela garde les retours à  la ligne on a donc pas besoin de \n  

#### comparaison
- ``==``: test égalité valeurs
- ``===``: test égalité valeurs et types
- ``!=``: test différence valeurs
- ``<>``: test différence valeurs (autre syntaxe)
- ``!==``: test différence valeurs et types
- ``<``: test strictement inférieur
- ``>``: test strictement supérieur
- ``<=``: test inférieur ou égal
- ``>=``: test supérieur ou égal

#### Logiques
Nom : Symbole
- AND : &&
- OR : ||
- NO : !

#### Opérateur ternaire et structure conditionnelle ternaire
"Test" ``?`` "code si true" ``:`` "code si false" 

#### Associativité et précédence
Associativité : opérations de droite à  gauche ou de gauche  à droite
Précédence: ordre de priorité des opérations

|Précédence|Opérateur|Symbole|Associativité|
|---|---|---|---|
|0 |Groupement	                    |``( … )``	            |Non applicable|
|1 |Post-incrémentation	            |``… ++``               |Non applicable|
|1 |Post-décrémentation	            |``… —``	            |Non applicable|
|2 |NON (logique)	                |``! …``	            |Droite|
|2 |Pré-incrémentation	            |``++ …``	            |Droite|
|2 |Pré-décrémentation	            |``— …``	            |Droite|
|3 |Exponentiel	                    |``… ** …``	            |Droite|
|3 |Multiplication	                |``… * …``	            |Gauche|
|3 |Division	                    |``… / …``	            |Gauche|
|3 |Modulo	                        |``… % …``	            |Gauche|
|4 |Addition	                    |``… + …``	            |Gauche|
|4 |Soustraction	                |``… – …``	            |Gauche|
|5 |Inférieur strict	            |``… < …``	            |Gauche|
|5 |Inférieur ou égal	            |``… <= …``	            |Gauche|
|5 |Supérieur strict	            |``… > …``	            |Gauche|
|5 |Supérieur ou égal	            |``… >= …``	            |Gauche|
|6 |Égalité (en valeur)	            |``… == …``	            |Gauche|
|6 |Inégalité (en valeur)           |``… != …``	            |Gauche|
|6 |Égalité (valeur et type)        |``… === …``	        |Gauche|
|6 |Inégalité (valeur ou type)      |``… !== …``	        |Gauche|
|7 |ET (logique)	                |``&&``                 |Gauche|
|8 |OU (logique)	                |``\|\|``	                |Gauche|
|9 |Ternaire	                    |``… ? … : …``	        |Droite|
|10|Affectation (simple ou combiné) |``=, +=, etc.``        |Droite|


### Objet 
exemple avec un objet littéral: 
```js
let user = {
    // Propriétés
    name : ['Peter', 'McPeter'],
    age: 30,
    // Méthodes
    hello: function(){
        return `Hello I am ${this.name[0]}, I am ${this.age} years old`;
    }
};
// On accède à l'élément d'un objet de la manière suivante
let randomName = user.name[1]; 
// On ajoute une nouvelle propriété ou méthode comme ceci
user.mail = name@mail.com;
```
4 Méthodes pour créer un objet:
- créer un objet littéral (comme précédemment)
- utiliser le constructeur ``Object()``
- utiliser une fonction constructeur personnalisée
- utiliser la méthode ``create()``
#### créer un objet avec un constructeur
```js
function User(n, a, m){
    this.name = n;
    this.age = a;
    this.mail = m;
    this.hello = function(){...};
}
```
Par convention, pour le constructeur, pour différencier d'un simple objet on met une majuscule au début du nom, après chaque this. on met un point virgule et non une virgule comme avec un objet
On utilise ``new`` pour créer une "instance" de l'objet à partir de ce constructeur
```js
let peter = new User(['Peter', 'McPeter'], 30, name@mail.com);
```
#### Boucle for... in
Pour parcourir les éléments dans un objet
```js
let objectName = {
    'name' : 'Peter',
    'age' : 24
};
for(let value in objectName){
    doSomething for each value in objectName;
}
```

#### tableau
consiste en une liste d'ensembles "clé: valeur"
en js il n'ya que des tableaux numérotés pas de tableaux associatifs càd que la clé est un nombre (on commence à 0), (dans un tableau associatif la clé est textuelle et définie à la main)
```js
let tableName = ['a', 'b', 'c'];
// les clés sont 0, 1 et 2
```

En JS la syntaxe ``[]`` est en fait une version simplifiée et plus performante de ``new Array()``
```js
let tableName = ['a', 'b', ['c', 'd']];
// pour accéder à 'c' il faudra faire tableName[2][0]
```

##### Boucle for... of
Pour circuler dans un tableau
```js
let tableName = ['a', 'b', 'c', 'd'];
for(let value of tableName){
    doSomething for each value of tableName;
}
```

### Prototypage
* JS est un langage orienté objet basé sur des prototypes
* La plupart des langages sont orientés objets basés sur des classes:
    - Une classe est un plan général pour la création d'un objet
    - les objets **héritent** des propriétés et méthodes de la classe
* Les prototypes:
    - Il n'ya pas de classes, tout est objet, les constructeurs aussi
    - l'héritage se fait par les prototypes: toutes les fonctions ont une propriété prototype, 
    utilisée quand la fonction est utilisée en tant que construteur (avec **new**)
    - la propriété **prototype** a deux propriétés:
        - ``constructor``: renvoie vers le constructeur contenant le proto
        - ``__proto__``: contient des propriétés et méthodes
    - Tous les objets créés à partir d'un constructeur héritent de la propriété ``prototype`` de ce constructeur, ils peuvent y faire appel sans vraiment les posséder
    - On peut ajouter des propriétés et méthodes à ``prototype``, tous les objets créé à partir de ce constructeur les partageront donc
    - Si on veut accéder à un **membre** d'un objet, le navigateur  (en exécutant js) recherche le membre en plusieurs étapes:
        - Au sein de l'objet
        - s'il ne trouve pas il regarde dans la propriété ``__proto__`` de l'objet (contenu = ``prototype`` du constructeur)
        - s'il ne trouve pas il va chercher dans ``__proto__`` du constructeur de l'objet (contneu = ``prototype`` du constructeur de ce constructeur)
        - Il remonte alors tous les constructeurs parents jusqu'au constructeur ``Object()`` qui est le constructeur ultime
    - Pour mettre en place un héritage js (ou **délégation**) il y a 3 étapes:
        1. on créer un constructeur parent
        2. on créer un constructeur enfant qui appelle le parent
        3. on modifie le ``__proto__`` de ``prototype`` dans l'enfant pour qu'il soit égal au parent

### Creer une classe en JS
Il est depuis peu egalement possible de créer une classe en js
```js
class Name{
    // On initialise les propriétés avec un constructeur
    constructor(name, age){
        this.name = name;
        this.age = age;
    }
    // On crée les méthodes
    funcName(){....}
}
```
Pour faire en sorte qu'une classe hérite d'une autre on peut étendre la classe parent:
```js
class Name extends parentClass{
    constructor(name, age, mail){
        super(name, age); // appelle le constructeur parent
        this.mail = mail;
    }
    // On crée les méthodes
    funcName(){....}
}
```

### deux types de valeurs
- Valeurs primitives: Toutes sauf objets (string, number,...)
- objets

Les valeurs primitives ont en réalité aussi une version objet, on ne s'en sert jamais directment mais c'est bon a savoir pour utiliser ses propriétés (tous ont une propriété prototype )

#### Propriétés et méthodes de l'objet String
1. Propriétés :
    - **a**.length : longueur de la string **a**
2. Méthodes:
    - **a**.includes(**b**): vérifie si présence string **b** dans string **a** (case sensitive)
    - **a**.startWith(**b**): vérifie si **a** commence par **b** 
    - **a**.endWith(**b**): vérifie si **a** termine par **b**
    - **a**.substring(5, 6): retourne une sous chaine de la chaine d'origine, qui commence à partir de la position de début (1er arg), et éventuellement jusqu'à une position de fin (2eme arg facultatif)
    - **a**.indexOf(**b**): recherche la première position de **b** dans **a** (case sensitive), on peut ajouter un deuxième argument optionnel pour déterminer où commence la recherche, renvoie **-1** si rien n'est trouvé
    - **a**.lastIndexOf(**b**): recherche la dernière position de **b** dans **a** (case sensitive), on peut ajouter un deuxième argument optionnel pour déterminer où commence la recherche, renvoie **-1** si rien n'est trouvé
    - **a**.slice(5, 6): Extrait une section de **a** sans modifier **a**, en argument: postion de départ (obligatoire), position d'arrêt de l'extraction (optionnel), différences avec substring(): si valeurs négatives = départ et fin calculés à partir de la fin de la chaine, si départ plus lointain que la chaine = renvoie string vide, slice envoie une nouvelle string sans modifier la chaine d'origine
    - **a**.replace(**b**, **c**): Recherche **b** dans **a** et le remplace par **c**, crée une nouvelle string sans modifier **a**
    - **a**.toLowerCase(): string en minuscule, crée une nouvelle string sans modifier **a**
    - **a**.toUpperCase(): string en majuscule, crée une nouvelle string sans modifier **a**
    - **a**.trim(): supprime les espaces blancs en début et fin de string, crée une nouvelle string sans modifier **a**

#### Propriétés et méthodes de l'objet Number
1. Propriétés (s'utilise directement avec l'objet Number = propriétés statiques) :
    - MIN_VALUE: plus petite valeur numérique positive représentable en js
    - MAX_VALUE: plus grande valeur numérique représentable en js
    - MIN_SAFE_INTEGER: plus petit entier représentable de façon sûr par js
    - MAX_SAFE_INTEGER: plus grand entier représentable de façon sûr par js
    - NEGATIVE_INFINITY: infini négatif
    - POSITIVIE_INFINITY: infini positif
    - NaN: Not a Number
2. Méthodes:
    - Number.isFinite(**n**): vérifie si **n** est une valeur finie
    - Number.isInteger(**n**): vérifie si **n** est un entier valide
    - Number.isNaN(**n**): vérifie si **n** a pour valeur **NaN** (valeur appartenant au type number)
    - Number.isSafeInteger(**n**): vérifie si **n** est un entier sûr (= représentable par JS)
    - Number.parseFloat(**n**): convertit une string en un nombre décimal, la méthode ne doit rencontrer que les caractères suivant: + - chiffre point ou exposant; si elle rencontre un autre caractère la méthode s'arrête et ignore la suite, renvoie NaN si la string commence par un caractère non valide
    - Number.parseInt(**0A**, 16): convertit une string (généralement un nombre dans une base autre que 10, ex: binaire, hexadécimal) en un entier en base 10, en argument la string (ici en hexadécimal) et la base de conversion (ici 16, base 16= hexadécimal), note en hexadécimal: les chiffres de 10 à 15 on écrit de 0A à 0F (pas seulement A à F)
    - **n**.toFixed(2): arrondi **n** à 2 décimales
    - **n**.toPrecision(4): représente un nombre avec un nombre de chiffres donné (ici 4), exemple pour 1234.450 : toPrecision(2) donnerait 1.2e+3 (soit 1.2*10^3 = 1200), avec toPrecision(5): 1234.5 (suit les règles d'arrondi mathématiques)
    - **n**.toString(16): transforme un nombre en string (en paramètre on peut ajouter une base ici 16, avec 255 on obtiendrait donc ff)

#### Propriétés et méthodes de l'objet Math (s'utilise directement avec l'objet Math)
1. Propriétés:
    - Math.E: valeur = le nombre d’Euler (base des logarithmes naturels ou encore exponentiel de 1), environ 2,718 ;
    - Math.LN2: valeur = le logarithme naturel de 2, environ 0,693 ;
    - Math.LN10: valeur = le logarithme naturel de 10, environ 2,302 ;
    - Math.LOG2E: valeur = le logarithme naturel de 2, environ 0,693;
    - Math.LOG10E: valeur = le logarithme naturel de 10, environ 2,302 ;
    - Math.pi: valeur = pi, environ 3,14159 ;
    - Math.SQRT1_2: valeur = la racine carrée de ½, environ 0,707 ;
    - Math.SQRT2: valeur = la racine carrée de 2, environ 1,414.
2. Méthodes:
    - Math.floor(**n**): arrondi à l’entier immédiatement inférieur (ou égal) à **n**
    - Math.ceil(**n**): arrondi à l’entier immédiatement supérieur (ou égal) à **n**
    - Math.round(**n**): arrondi à l’entier le plus proche (suit les règles d'arrondi mathématiques)
    - Math.trunc(**n**): ne retourne que la partie entière de **n**
    - Math.random(): génère un nombre décimal compris en 0 (inclus) et 1 (exclus) 
    - Math.min(2, 10, 4): renvoie le plus petit nombre passé en argument
    - Math.max(2, 10, 4): renvoie le plus grand nombre passé en argument
    - Math.abs(-4): renvoie la valeur absolue du nombre (càd sans le signe)
    - Math.cos(), sin(), tan(), acos(), asin(), atan(): retournent respectivement le cosinus, sinus, tangente, arc cosinus, arc sinus et arc tangente de la valeur passée en argument, résultat en radians
    - Math.exp(**n**): renvoie l'exponentielle de **n**
    - Math.log(**n**): renvoie le logarithme népérien (ou naturel) de **n**

#### Propriétés et méthodes de l'objet Array
1. Propriétés :
    - **a**.length : nombre d'éléments de **a**
2. Méthodes:
    - **a**.push('b', 'c'): ajoute b et c à la fin du tableau **a** et retourne la nouvelle taille du tableau
    - **a**.pop(): supprime le dernier élément du tableau et retourne  l'élément supprimé
    - **a**.unshift('b', 'c'): ajoute b et c au début du tableau **a** et retourne la nouvelle taille du tableau
    - **a**.shift(): supprime le premier élément du tableau et retourne  l'élément supprimé
    - **a**.splice('startPosition', 'NbrElementsàRemplacer', 'ElementsàAjouter'): si startPosition est négatif le se fait en comptant à partir de la fin, si NbrElementsàRemplacer = 0 alors on devra seulement ajouter des elements, si ElementsàAjouter = 0 alors on supprimera simplement les éléments choisis avec NbrElementsàRemplacer, retourne un tableau avec les éléments supprimés
    - **a**.join(' - '): retourne une string avec les valeurs de **a** concaténées (séparé par défaut par une virgule, on peut ajouter un séparateur en argument)
    - **a**.slice('b', 'c'): renvoie un tableau créé en découpant le tableau **a**, argument 'b' = début de la découpe, 'c' = fin de la découpe (tous deux optionnels, si nbr négatifs = commence par la fin)
    - tab1.concat(tab2, tab3) : fusionne les tableaux 2 et 3 avec le tableau 1
    - **a**.includes(**b**): vérifie si présence valeur **b** dans tableau **a** (case sensitive) 
