# Les tests

Il esxiste 3 grands types de tests:

## Test Unitaire:
+ Vérifie des unités individuelles du code (une fonction, une classe), d'où l'intéret de faire des petite fonctions qui n'ont qu'un usage
+ Pour tester on commence par un **cas simple**, puis sur un ou plusieurs **cas limites**
+ Par exemple il peut arriver qu'une fonction marche pour un cas normal, mais ne fonctionne pas si on l'utilise avec un tableau vide par exemple

+ Par exemple pour une fonction qui compte le nombre de mots dans une ``string``:
    - On fait un essai avec une chaîne dont on connait le nombre de mots (cas simple)
    - puis on essaye avec une chaîne vide et/ou une chaine qui ne contient que des espaces (cas limite)

+ On peut écrire nos tests sous forme de fonctions:
    - Par exemple si on voulait tester une fonction ``getWordCount`` supposée retourner le nombre de mots dans une phrase on pourrait faire:
    ```js
    //test cas simple
    const testSimpleWordCount = () => {
        const testString = "There is four words!";
        if (getWordCount(testString) !== 4) {
            console.error("Simple getWordCount failed!");
        }
    }

    //test cas limite
    const testEdgeWordCount = () => {
        const testString = "          ";
        if (getWordCount(testString) !== 0) {
            console.error("Edge getWordCount failed!");
        }
    }
    ```
+ Pour des vérifications rapide les fonctions peuvent être utiles, mais en général on préfère utiliser une **architecture de Test** ou une **bibliothèque de test**:
    - Il s'agit de bibliothèques qui contiennent des fonctions et syntaxes spécifiques par exemple les deux tests précédents pourraient etre écrit comme suit avec certaines architetures:
    ```js
    describe("getWordCount()", function() {
        it("should find four words", function() {
            expect(getWordCount("There is four words!").to.equal(4));
        });
        it("should find no word", function() {
            expect(getWordCount("            ").to.equal(0));
        });
    });

+ Les tests unitaires représentent entre 60 et 80% des tests en JS

## Les tests d'intégration: 
+ L'objectif est de vérifier que des éléments qui fonctionnent correctement continuent de fonctionner correctement lorsqu'ils sont utilisés ensemble:
    - Par exemple deux tiroirs qui s'ouvrent correctement mais qui parce qu'ils sont dans un coin  ne peuvent plus s'ouvrir ensemble car ils se bloquent mutuellement


## Les tests fonctionnels ou E2E (bout en bout)
+ Ils permettent de vérifier des scénarios complets dans un certain contexte (exemple, un utilisateur se connecte, ouvre ses notifs et les marque comme lues)

+ Ils peuvent aussi vérifier les ressources externes (comme les système de paiement)


## Débogage
Pour déboguer un programme on peut:
+ Afficher les résultats en console, cela permet de vérifer que les valeurs retournées par une focntion ne sont pas faussées
    - Le problème de cette méthode est sa lenteur, on perds en effet beaucpup de temps à débogguer en console
    - Avant la mise en ligne on veillera à supprimer les console.log

+ les navigateurs peuvent aussi aider à déboguer avec les outils développeurs, on peut notamment ajouter des "breakpoints" ou points d'arret qui permettent de tester un code jusqu'a un point donné, d'ignorer une partie du code , on peut ainsi observer les résultats de chaque ligne

+ certains EDI possèdent aussi des débogueurs (comme visual studio code par exemple)

+ alternativement on peut aussi tenter de reformuler notre code à voix haute, cela permet parfois de repérer des erreurs évidentes que l'on avait pas vues

