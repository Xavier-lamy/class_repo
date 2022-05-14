# Le CRUD (Create Read Update Delete)

+ Remarque dans certains cours les champs dans les requêtes (ex: ``"SELECT * FROM users WHERE id = 3"``) sont entourés de backticks : ``"SELECT * FROM `users` WHERE `id` = 3"``, il s'agit d'une norme SQL en cas de caractères spéciaux , on peut l'utiliser de manière général pour être sur de pas oublier

## Connexion à la BDD:
+ On crée un *objet* appelé **$bdd** cet *objet* représente la connexion à la base de données, en paramètres on entre dans l'ordre: 
    - le **nom d'hôte** ou **DSN** (*Data Source Name*), le seul qui change en fonction du type de BDD
    - le **nom de la base de données** 
    - le **login** 
    - le **mot de passe**
```php
$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "root");
```

+ Pour éviter qu'en cas d'erreur le site ne laisse afficher un message d'ereur contenant toutes les infos (dont le mot de passe), il faut traiter l'erreur à l'aide d'un bloc ``try/catch`` :
```php
// On essaye de se connecter
try 
{
    // On crée une nouvelle instance de PDO:
    $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "root");
}
// Sinon on "capture" l'erreur et met fin au php
catch (Exception $e)
{
    die("Error: " . $e->getMessage());
}
```

+ Pour s'assurer d'envoyer les données en utf8 et ainsi avoir tous les caractères on peut aussi utiliser une requete SQL: ``SET NAMES utf8``:
```php
    // On crée une nouvelle instance de PDO:
    $bdd = new PDO("mysql:host=localhost;dbname=test", "root", "root");
    // On s'assure d'envoyer les données en utf8:
    $bdd->exec("SET NAMES utf8");
```

+ Pour traquer les erreurs dans notre requete SQL on peut:
    - ajouter le paramètre suivant à la ligne d'appel de connexion à la bdd, cela permettra d'afficher un message plus clair pour les requetes comportant des erreurs.  :
    ```php
    $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    ```
    - Ou on peut définir le mode d'erreur avec ``setAttribute()``:
    ```php
    $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "root")
    $bdd->(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ```

+ Quand on veut fermer la connexion à la BDD on détruit l'objet représentant la connexion en effaçant ses données, pour ça on peut lui attribuer ``null``:
```php
$bdd = null;
```

## Requêtes MySQL 
### Créer une base de données
+ ``CREATE DATABASE nom_db`` pour créer une nouvelle BDD et lui donner un nom
+ Lors de la création des variables ou des constantes pour les infos de connexion, on ne précise plus, cette fois, le nom de la BDD, car elle sera créée plus tard dans le script:
```php
    // Définition des variables et constantes (sans le nom de BDD)
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    //DSN de connexion:
    $dsn = "mysql:host=".DBHOST.";charset=utf8";

    //Tentative de connexion:
    try{
        $connexion = new PDO($dsn, DBUSER , DBPASS);

        //Définition du mode d'erreur de PDO sur Exception:
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On exécute nos requêtes avec la méthode exec():
        $sql = "CREATE DATABASE testdb";
        $connexion->exec($sql);
        echo "La base de données a été créée";   
    }

    //Si une exception est lancée on la capture et on affiche les infos de l'erreur, on arrete le php avec die():
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    //On ferme la connexion:
    $connexion = null;
```

### Créer des tables dans une BDD
+ ``CREATE TABLE Table-name(colonnes)`` pour créer une nouvelle table et lui donner un nom,avec entre parenthèses une liste d'éléments séparés par des virgules comprenant pour chaque élément:
    - Le nom de la colonne (ex: ``Nom``)

    - Le type de donnée avec en option le nombre de caractères que le champ peut contenir (ex: ``VARCHAR(30)``) ces types de données sont entre autre:
        + ``INT`` : Nombre entier de 4 octets (entre -2 147 483 648 et 2 147 483 647 pour les entiers relatifs, et entre 0 et 4 294 967 295 pour les entiers positifs
        + ``VARCHAR`` : une chaine de caractères variable (entre 0 et 65 535 caractères) dépendant de la taille d'une ligne
        + ``TEXT`` : une chaine de caractères (longeur max = 65 535 caractères)
        + ``DATE`` : une date située entre le *1er Janvier 1000* et le *31 décembre 9999* format: AAAA-MM-JJ
        + ``DATETIME``: format AAAA-MM-JJ HH:MM:SS
        + ``TIMESTAMP`` : la valeur de la date actuelle sera stockée à chaque nouvelle entrée

    - des attributs ou des contraintes pour chaque colonne (ex: ``NOT NULL``), qui peuvent être:
        + ``NOT NULL`` : chaque entrée **doit** contenir une valeur (``null`` non acceptée)
        + ``UNIQUE`` : chaque valeur dans la colonne doit être unique (évite par exemple d'avoir deux comptes avec la meme adresse mail), en SQL il est conseillé d'ajouter un dernier élément dans la liste avec ce ``UNIQUE`` et le nom de l'élément qu'on veut rendre unique (ex: ``UNIQUE(MAIL)``)
        + ``PRIMARY KEY`` : combinaison de ``UNIQUE`` et ``NOT NULL``, elle ne doit être appliquée qu'à **une seule colonne** de la table, et chaque table **doit avoir** une ``PRIMARY KEY``, il s'agit généralement d'une colonne **ID** qu'on auto-incrémente
        + ``FOREIGN KEY`` : pour empêcher des actions pouvant détruire des relations entre les tables, sert à identifier une colonne identique à  une colonne portant l'attribut ``PRIMARY KEY`` dans une autre table
        + ``CHECK`` : les valeurs de la colonne doivent suivre une certaine condition ou se trouver dans un certain intervalle spécifié, comme pour ``UNIQUE`` on l'ajoute à  la fin de la liste ex: ``Age INT, CHECK (Age<=18)``
        + ``DEFAULT`` : renseigne une valeur par défaut qui sera renseignée si aucune valeur est fournie
        + ``AUTO_INCREMENT`` : Ajoute 1 au champ à chaque nouvelle entrée (permet de faire une colonne ID)
        + ``UNSIGNED`` : limite les données reçues à des nombres positifs (0 inclus), interdit donc la présence d'un signe ``+`` ou ``-`` devant
+ Exemple avec une base client:
```php
$sql = "CREATE TABLE Customers (
    Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    FirstName VARCHAR(30) NOT NULL,
    Address VARCHAR(70) NOT NULL,
    City VARCHAR(30) NOT NULL,
    PostCode INT UNSIGNED NOT NULL,
    Country VARCHAR(30) NOT NULL,
    Mail VARCHAR(50) NOT NULL,
    DateInscription TIMESTAMP,
    UNIQUE(Mail) //On indique ici qu'on veut que mail soit unique
)";
$bdd->exec($sql); 
```

### Créer une table dans une BDD qu'on vient de créer
+ Quand on vient de créer la BDD, on s'y est connecté sans indiquer le nom (car on l'a créé après)
+ Afin de créer une table dans cette BDD, il va falloir lui préciser dans qelle BDD ajouter la table
+ Pour ça on utilise ``use`` suivi du nom de la BDD, en créat une première requete:
```php
$createDB = "CREATE DATABASE users";
$dbco->exec($createDB);
//On précise qu'on veut utiliser cette BDD grâce à "use", avec une première requete:
$createTb = "use users";
$dbco->exec($createTb);
//Puis on peut continuer normalement, en créant la table 
$createTb = "CREATE TABLE users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(30) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    mail VARCHAR(50),
    dateInscrit TIMESTAMP)";
$dbco->exec($createTb);
```

### Lire dans la Base de données
+  Créer un autre objet ``$answer`` qui contiendra la requête exécutée sur notre objet ``$bdd`` (qui représente la connexion à la base)
```php
$sql = "SELECT * FROM jeux_video";
$answer = $bdd->query($sql); 
```
+ Dans cet exemple on a déjà les bases du langage SQL:
    1. ``SELECT``: indique le type d'opération que doit effectuer MySQL, SELECT demande à afficher le contenu de la table 
    2. ``*`` : après SELECT il faut indiquer  quels champs doivent être récupérés, ici tous
    3. ``FROM`` : mot de liaison pour indiquer dans quelle table on veut prendre les données, ici jeux_video 
+ ``$answer`` contient donc désormais la réponse de MySQL à notre requête malheureusement MySQL renvoie beaucoup trop d'infos ce qui rend ``$answer`` inexploitable en l'état 

#### Extraire les réponses 
+ Pour cela on utilise ``fetch()`` pour récupérer uniquement la première entrée de la table ou une seule entrée selon le critère choisi, ou ``fetchAll()`` pour les récupérer toutes :
```php
$data = $answer->fetch(); //renvoie la première ligne/entrée, sous la forme d'un array contenant les valeurs des champs
```
+ On peut utiliser ceci pour faire une boucle pour parcourir chaque entrée:
```php
while ($data = $answer->fetch())
{
    echo '<p>Nom: ' . $data['nom'] . ', console: ' . $data['console'] . ', prix: ' . $data['prix'] . '.<br /></p>';
}

$answer->closeCursor(); //Pour terminer le traitement de la requête
```
+ Explications:
    - ``$answer`` est un objet qui contient toute la réponse MySQL en vrac sous la forme d'un objet, 
    - ``$data`` est un array renvoyé par la fonction ``fetch()``, à chaque passage de la boucle ``while`` ``fetch()`` cherche l'entrée suivante dans $answer et organise les champs dans cet array 

    - Explication de ``while ($data = $answer->fetch())``: fait en réalité deux actions:
        - à chaque boucle elle place dans l'array ``$data`` une nouvelle entrée de ``$answer`` grâce à la fonction ``fetch()``
        - elle vérifie si ``$data = false``, en effet si on arrive à la fin des données du tableau , fetch() renverra alors ``false`` dans ce cas la condition du while vaudra faux et la boucle s'arrêtera 

    - ``closeCursor()`` : il est nécessaire d'appeler cette fonction à la fin de chaque requête, elle provoque l'arrêt du curseur d'analyse de résultats

+ On peut ajouter un paramètre pour ``fetch()`` si on souhaite changer le type de données que nous renvoie la requête:
```php
$data = $answer->fetch(PDO::FETCH_ASSOC); //Le plus courant, rnevoie un tableau associatif avec les noms des différentes colonnes (ex: mail, pass,...)
```
+ On peut aussi changer le mode de ``fetch()`` par défaut directement lors de la création de notre objet PDO de connection (voir plus haut), on a ainsi plus beosin de le remettre à chaque fois:
```php
//Instancier:
$bdd = new PDO($dsn, DBUSER, DBPASS);
// On définit le mode de fetch par défaut:
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
```

### Filtrer les données
+ On peut utiliser des mots clés pour pouvoir filtrer et trier les données:
- ``WHERE possesseur='Michel'`` : signifie qu'on ne sélectionne que les entrées dont le champs possesseur est égal à 'Michel'
- ``WHERE possesseur='Patrick' AND prix < 30`` : même chose mais cette fois on ajoute que l'on souhaite aussi que le champs prix soit inférieur à 30 on peut aussi utiliser le mot clé OR 
- ``AND``, ``OR``, ``NOT``: on peut les combiner
- ``ORDER BY prix`` : permet d'ordonner les résultats par ordre croissant (ici en fonction du prix), si on choisit un champs composé de string cela trie par ordre alphabétique 
- ``ORDER BY prix DESC`` : permet d'ordonner par ordre décroissant
- ``LIMIT 0, 20`` : permet de ne sélectionner qu'une partie des résultats:
    - le 1er nombre après la virgule indique à partir de quelle entrée on commence à lire la table, (il ne s'agit pas du champs d'ID !), si on indique 0 on lit à partir de 1, si on indique 20 on lit à partir de 21, 
    - le 2eme nombre indique le nombre d'entrées qu'on lit 
    - ex: ``LIMIT 5, 10`` : affiche 10 résultats à partir de la sixième entrée c'est à dire 6,7,8,9,10,11,12,13,14,15  
    - ex: ``LIMIT 10, 3`` : affiche 3 résultats à partir de 11, çàd 11,12,13
    - On peut aussi écrire ``LIMIT 20 OFFSET 0`` (l'ordre des chiffres est inversé par rapport à la précédente méthode), pour une limite de 20 items à partir (``OFFSET``) de 0, donc du premier
- ``LIKE`` qu'on utilise avec ``%`` qui signifie **0,1 ou plusieurs caractères** et ``_`` qui signifie **1 seul caractère**, ex:
    - ``WHERE users LIKE 'p%'``: valeurs commençant par p
    - ``WHERE users LIKE '%e'``: valeurs terminant par e
    - ``WHERE users LIKE '%e%'``: valeurs possédant un e 
    - ``WHERE users LIKE 'p%e'``: valeurs commençant par p et terminant par e
    - ``WHERE users LIKE 'p____e'``: valeurs commençant par p, terminant par e et ayant 6 caractères
    - ``WHERE users LIKE 'p_%'``: valeurs commençant par p et ayant au moins 2 caractères
- ``IN`` et ``BETWEEN``: permet de trouver une donnée dans une liste ou dans un intervalle inclusif (première et dernière valeur en font partie) donné:
    - ``WHERE firstname IN ('Jack', 'Victor')``: dont le prénom est dans la liste
    - ``WHERE lastname BETWEEN 'F%' AND 'G%'``: dont le nom de famille est situé entre les noms commençant par F et ceux començant par G, ces deux valeurs ont incluses
+ On peut aussi utiliser des fonctions voir cours **sql_functions**

### Ne récupérer que les valeurs uniques (par colonne)
+ Si dans une table on a plusieurs fois les même prénoms, mais qu'on souhaite uniquement retourner **une seule fois** chaque prénom on peut utiliser ``SELECT DISTINCT``:
```php
$sth = $dbco->prepare("SELECT DISTINCT prenom FROM users");
$sth-> execute();
```

### Requetes préparées
> Si on souhaite utiliser des variables php dans les requêtes il ne **FAUT SURTOUT PAS LES UTILISER DIRECTEMENT DANS LA REQUETE** (afin d'éviter les attaque de type **injection SQL**, qui consiste en l'ajout par un utilisateur d'une requete sql au milieu de la notre, ce qui pourrait lui donner accès aux mots de passes des utilisateurs par exemple)
+ Avant de préparer la requête il faut nettoyer les données:
    - avec strip_tags() qui enlève carrément les balises
    - avec htmlspecialchars() qui transforme les ``< >`` en leur équivalent``&lt; &gt;``
    - les deux permettent donc d'éviter les attaques xss mais pas de la meme façon

+ Pour éviter cela il faut utiliser les "requêtes préparées" qui en plus d'être plus sûr sont aussi plus rapides pour la bdd, il existe plusieurs méthodes:
    1. On commence par préparer la requête sans la partie variable, que l'on remplace par des **marqueur interrogatifs**: ``?``, et en utilisant ``prepare()`` au lieu de ``query()``:
    ```php
    //On prépare la requete avec des ? à la place des variables
    $request = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = ? OR prix <= ?');

    //On exécute alors la requête en transmettant les paramètres sous la forme d'une array dans l'ordre ou ils doivent être injectés, en utilisant cette fois execute()
    $request->execute(array($_GET['possesseur'], $_GET['prix_max'])); 
    ```
    2. On peut faire la meme chose avec les **marqueurs nominatifs** à la place des ``?`` cela permet de ne pas se soucier de l'ordre dans l'array et d'avoir plus de clarté quand il y a beaucoup de paramètres, les **marqueurs nominatifs** commencent par ``:`` exemple ``:possesseur``, ``:prixmax``
        - On utilise cette fois un array associatif:
        ```php 
        $request = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix <= :prixmax');
        $request->execute(array('prixmax' => $_GET['prix_max'], 'possesseur' => $_GET['possesseur']));
        ```

+ Pour l'exécution des requêtes, il existe 2 méthodes différentes:
    - La plus simple et celle par défaut est celle vue dans les 2 exemples précédents, elle consiste à passer une array de paramètres en entrée, c'est aussi la plus couramment utilisée car elle est efficace dans la majorité des cas
    - Dans certains cas assez rares, il faudra définir explicitement le type de données:
        +  notamment si:
            - La requête contient une clause ``LIMIT`` ou une autre clause n'acceptant pas de valeur *string* et le **mode emulation** est activé (``ON``)
            - La table contient des colonnes avec un type particulier n'acceptant que des valeurs d'un certain type (``BOOLEAN``, ``BIGINT``,...)  
        + Dans ces cas il faut lier les variables avant d'utiliser ``execute()``, avec:
            - ``bindParam()``: qui lie le paramètre à un nom de **variable spécifique**, donc si la variable change de valeur avant l'appel d'``execute()`` c'est la dernière valeur qui sera utilisée
            - ``bindValue()``: lie directement le paramètre à une **valeur**
        + Ces deux méthodes nécessitent 2 paramètres obligatoires et 3 facultatifs dont un vraiment utile :
            - (Obligatoire) L'identifiant de forme :
                + ``:nom`` si on utilise les **marqueurs nommés**
                + L'index de base 1 du paramètre si on utilise les **marqueurs interrogatifs**
            - (Obligatoire):
                + Pour ``bindParam()``: le nom de la variable à lier au paramètre
                + Pour ``bindValue()``: la valeur à lier au paramètre
            - (Facultatif) le type de données explicite pour le paramètre spécifié en utilisant des constantes, les plus utilisées sont:
                + ``PDO::PARAM_STR``: représente le type de données CHAR, VARCHAR et les autres types de données 'string' SQL
                + ``PDO::PARAM_INT``: représente le type de données SQL INTEGER (nombre entier)
                + ``PDO::PARAM_NULL``: représente le type de données SQL NULL
                + ``PDO::PARAM_BOOL``: représente le type de données booléen
+ Exemple de requêtes préparées avec ``bindParam()`` ou ``bindValue()``:
```php
//Avec bindParam(), la valeur de la variable peut etre changé avant l'exécution, elle sera prise en compte
$name = "Velle";
$firstname = "Lara";
$city = "Dijon";
$postalcode = 21000;
$mail = "laravelle@gmail.com";
$request = $bdd->prepare("
    INSERT INTO Customers(Name, Firstname, City, Postalcode Mail)
    VALUES (:name, :firstname, :city, :postalcode, :mail)
    ");
    // La constante de type par défaut est PARAM_STR, il faut donc penser à préciser la constante si ce n'est pas _STR:
    $request->bindParam(':name', $name);
    $request->bindParam(':firstname', $firstname);
    $request->bindParam(':city', $city);
    $request->bindParam(':postalcode', $postalcode, PDO::PARAM_INT);
    $request->bindParam(':mail', $mail);
    $request->execute();
```

```php
//Avec bindValue(), la valeur de la variable ne pas sera prise en compte si elle est changée, la valeur est directement liée
$name = "Velle";
$firstname = "Lara";
$city = "Dijon";
$postalcode = 21000;
$mail = "laravelle@gmail.com";
$request = $bdd->prepare("
    INSERT INTO Customers(Name, Firstname, City, Postalcode Mail)
    VALUES (?, ?, ?, ?, ?)
    ");
    // La constante de type par défaut est PARAM_STR, il faut donc penser à préciser la constante si ce n'est pas _STR:
    $request->bindValue(1, $name);
    $request->bindValue(2, $firstname);
    $request->bindValue(3, $city);
    $request->bindValue(4, $postalcode, PDO::PARAM_INT);
    $request->bindValue(5, $mail);
    $request->execute();
```

+ même si cela empêche les attaques par injection SQL il est toujours recommandé de vérifier les données entrées, car elles sont rentrées par un utilisateur (exemple le prix est bien un nombre ? ne dépasant pas un certain intervalle ?) 


### Insérer une entrée
- ``INSERT INTO`` : permet d'ajouter une entrée , on définit quels champs on veut remplir et leur valeur
- Il est inutile de préciser des valeurs de ``TIMESTAMP`` ou possédant un ``AUTO_INCREMENT``, puisqu'elles s'auto-incrémentent
- Afin d'exécuter des modifications sur la base de données on utilise ``exec()`` au lieu de ``query()``:
```php
$bdd->exec("INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) VALUES('Battlefield 1942', 'Patrick', 'PC', 45, 50, '2nde Guerre Mondiale')");
```
- On peut bien sur écrire cela sous la forme de requetes préparées, comme précedemment avec un array associatif:
```php
$request2 = $bdd->prepare('INSERT INTO jeux_video(nom, possesseur, console, prix) VALUES(:nom, :possesseur, :console, :prix)');
$request2->execute(array(
    'nom' => $nom,
    'possesseur' => $possesseur,
    'console' => $console,
    'prix' => $prix 
));
```
- Pour ajouter un **json** dans les valeurs: ``VALUES ('[\"ROLE_USER\"]')``

### Insérer plusieurs entrées (méthode moins recommandée)
+ On utilise les méthodes:
    - ``beginTransaction()``: démarre une **transaction** et désactive le mode **autocommit**, en gros toutes les manipulations sur la base de données ne seront appliqués que quand on mettra fin à la transaction en appelant ``commit()``, cela permet d'être sûr que toutes les requetes se sont exécutés correctement avant d'être appliqués
    - ``commit()``: valide la **transaction**, replace la connexion en mode **autocommit**
    - ``rollBack()``: annule la **transaction** si une erreur survient, restaure aussi le mode **autocommit** après l'exécution

### Insérer plusieurs entrées (méthode plus recommandée)
+ On utilise les requêtes préparées (qui permettent de mettre des variables, et donc de faire des boucles):
    - soit avec ``execute(array())``
    - soit avec ``execute()`` puis ``bindParam()`` ou ``bindValue()``

### Modifier une entrée
+ ``UPDATE`` : permet de modifier des données
+ on utilise:
    - le mot clé ``UPDATE`` pour signifier qu'on modifie une entrée, puis on précise dans quelle table,
    - le mot clé ``SET`` pour introduire la liste des champs à modifier, on sépare les champs par des virgules
    - le mot clé ``WHERE`` **(EXTREMEMENT IMPORTANT)**, il permet de préciser dans quelle(s) entrée(s) on veut modifier des champs, si on ne le fait pas on risque d'**écraser des données non voulues**, en général on utilise les valeurs de la colonne Id en guise de condition:
```php 
//Pour changer la valeur du prix du jeu warzone par 10
$bdd->exec("UPDATE jeux_video SET prix = 10 WHERE nom = 'Warzone'");

//Attribuer 'xavier' dans le champs possesseur de toutes les entrées dont le possesseur est Patrick
$nb_modifs = $bdd->exec("UPDATE jeux_video SET possesseur = 'Xavier' WHERE possesseur = 'Patrick'"); 
```
+ Dans l'exemple ci-dessus on utilise une variable ``$nb_modifs``, car ``exec()`` renvoie une valeur correspondant au nombre de lignes modifiées, cela permet d'afficher un message, par exemple: ``echo $nb_modifs . " entrées ont été modifiées !";``
    - Pour faire ça on peut aussi utiliser la **méthode** ``rowCount()``:
    ```
    //On fait notre requete:
    $myquery = $bdd->exec($sql);
    //On souhaite savoir combien de lignes ont été modifiées:
    echo $myquery->rowCount();
    ```

+ On peut encore une fois utiliser une requete préparée :
```php
$req = $bdd->prepare('UPDATE jeux_video SET prix = :nv_prix WHERE nom = :nom_jeu');
$req->execute(array(
    'nv_prix' => $nv_prix,
    'nom_jeu' => $nom_jeu
    ));
```

### Modifier la structure de la table
+ En général on a rarement besoin de modifier la structure d'une table
+ On utilise l'instruction ``ALTER TABLE table-name`` puis:
    - ``ADD column-name data-type-wanted`` pour ajouter une colonne en précisant son nom et le type de données attendu:
    ```php
    //Ajoute une colonne UserRole de type VARCHAR avec une limite de 30 caractères:
    $sql = "
        ALTER TABLE Users
        ADD UserRole VARCHAR(30)
        ";
        $bdd->exec($sql);
    ```
    - ``DROP COLUMN column-name`` pour supprimer une colonne en précisant son nom:
    ```php
    //Supprime la colonne UserRole:
    $sql = "
        ALTER TABLE Users
        DROP COLUMN UserRole
        ";
        $bdd->exec($sql);
    ```
    - ``MODIFY COLUMN column-name modification`` pour modifier une donnée, il faut faire très attention quand on l'utilise on risque de corrompre la table si la modification du type de données pose problème à des données déjà présentes (ex: passer de VARCHAR(50) à VARCHAR(30) posera problème si des données avaient plus de 30 caractères):
    ```php
    //Modifie la colonne UserRole en passant de 30 à 50 caractères:
    $sql = "
        ALTER TABLE Users
        MODIFY COLUMN UserRole VARCHAR(50)
        ";
        $bdd->exec($sql);
    ```


### Supprimer des données
+ ``DELETE FROM``: permet de supprimer des données, 
> **ATTENTION ! cela peut etre dangereux, si on a pas de sauvegarde et qu'on fait une fausse manip (si on oublie le ``WHERE``, on risque de supprimer toute la table)**
+ on utilise: 
    - ``DELETE FROM`` suivi du nom de la table dans laquelle on souhaite supprimer quelque chose
    - ``WHERE`` **(NE PAS L'OUBLIER)** pour indiquer quelle(s) entrée(s) on veut supprimer, on va par exemple préciser l'Id du champ à suppprimer, le mail,...
+ là encore on peut utiliser une requete préparée si on abesoin de travailler avec des variables:
```php
$req2 = $bdd->prepare("DELETE FROM jeux_video WHERE nom = :nom_jeu AND  prix <= :nv_prix");
$req2->execute(array(
    'nom_jeu' => $nom_jeu,
    'nv_prix' => $nv_prix
    ));
```
### Supprimer seulement certaines données selon une liste d'id
```php
    if (isset($_POST) && !empty($_POST)) {

        //Strip tags from all ids, and concatenate array into a string

        //On initialise l'array
        $array = array();
        
        //on striptags chaque élément de $_post, puis on l'ajoute à l'array
        foreach ($_POST as $value) {
            strip_tags($value);
            $array[] = $value;
        }
        //On transform l'array en string séparée par des virgules (IN ne peut pas lire dans une array, il a besoin d'une string)
        $ids = implode(",", $array);

        //Connection to db
        require_once "./inc/_connect.php";

        $sql = "SELECT * FROM `stocks` WHERE `stocks_id` IN ($ids)";

        $query = $db->prepare($sql);

        $query->execute();

        //store results in array
        $results = $query->fetchAll();
    }
```

### Supprimer toutes les données d'une table
+ Pour ça on utilise ``DELETE FROM`` sans préciser la clause ``WHERE``, il faut toujours penser à faire un backup de la base de données au cas où, car cette action est irréversible
```php
//Supprimer les données de la table Users:
$sql = "DELETE FROM Users";
$sth = $bdd->prepare($sql);
$sth->execute();
```

### Supprimer une table de la BDD
+ ``DROP TABLE table-name``, pas besoin de requete préparée
```php
//Supprimer la table Users
$sql = "DROP TABLE Users";
$bdd->exec($sql);
```

### Supprimer une BDD
+ ``DROP DATABASE table-name``, pas besoin de requete préparée
```php
//Supprimer la BDD testdb
$sql = "DROP DATABASE testdb";
$bdd->exec($sql);
```

### Afficher les erreurs SQL
+ Pour repérer une erreur sql en php ce n'est pas simple car php ne donne généralement pas beaucoup d'info sur la cause de l'erreur (si ce n'est qu'elle provient de la requete sql)
+ on repère la requête SQL qui plante (il s'agit généralement de celle cité avant la boucle while que php aura désignée comme coupable) et on demande d'afficher l'erreur comme ceci:
```php
$reponse = $bdd->query("SELECT nom FROM jeux_video") or die(print_r($bdd->errorInfo()));
```
+ Ainsi si la requete fonctionne il n'y aura pas d'erreur affichée sinon si ça plante on aura une erreur sql plus précise du genre *"You have an error in your SQL syntax near XXX"*

### Astuces
+ utiliser des conventions de nommage pour les fichiers, avec par exemple des underscores ``_update``, ``_delete``,...: 
    - ex pour les formulaires = ``form_update.php``, ``form_delete.php``
