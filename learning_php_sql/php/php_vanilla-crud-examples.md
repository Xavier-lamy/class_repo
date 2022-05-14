# Modèles de crud php vanilla


## Connexion à la BDD
```php
    // On crée des variables ou des constantes pour les infos de connexion:
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "root"); //Sous MAMP
    define("DBNAME", "test");
    //DSN de connexion:
    $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8";

    //Tentative de connexion:
    try{
        $connexion = new PDO($dsn, DBUSER , DBPASS);

        //Définition du mode d'erreur de PDO sur Exception:
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Définition du mode de fetch()
        $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        //On exécute du code, par exemple afficher connexion réussie:
        echo "Connexion réussie"; 
    }

    //Si une exception est lancée on la capture et on affiche les infos de l'erreur, on arrete le php avec die():
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    //On ferme la connexion:
    $connexion = null;
```

## Création d'une nouvelle base de données
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

## Insertion d'une donnée (requête préparée)
```php 
$request2 = $bdd->prepare('INSERT INTO jeux_video(nom, possesseur, console, prix) VALUES(:nom, :possesseur, :console, :prix)');
$request2->execute(array(
    ':nom' => $nom,
    ':possesseur' => $possesseur,
    ':console' => $console,
    ':prix' => $prix 
));
```


## Requête préparée avec ``bindParam()``
+ la valeur de la variable peut etre changé avant l'exécution, elle sera prise en compte
```php 
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

## Requête préparée avec ``bindValue()``
+ la valeur de la variable ne pas sera prise en compte si elle est changée, la valeur est directement liée
```php
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

## Mettre à jour
```php
$req = $bdd->prepare('UPDATE jeux_video SET prix = :nv_prix WHERE nom = :nom_jeu');
$req->execute(array(
    'nv_prix' => $nv_prix,
    'nom_jeu' => $nom_jeu
    ));
```

## Insérer plusieurs valeurs en utilisant ``bindParam()``
```php
//Créer une table Users
    $sql = "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Prenom VARCHAR(30) NOT NULL,
    Nom VARCHAR(30) NOT NULL,
    Mail VARCHAR(50) NOT NULL
    )";
    $bdd->exec($sql);
//On prépare la requête et on lie les paramètres
    $sth = $bdd->prepare("
    INSERT INTO Users (Prenom, Nom, Mail)
    VALUES (:prenom, :nom, :mail)
    ");
    $sth->bindParam(':prenom', $prenom);
    $sth->bindParam(':nom', $nom);
    $sth->bindParam(':mail', $mail);
    //Insère une première entrée
    $prenom = "Maurice"; $nom = "Ravel"; $mail = "maurice@gmail.com";
    $sth->execute();
    //Insère une deuxième entrée
    $prenom = "Jean-Sébastien"; $nom = "Bach"; $mail = "js.bach@gmail.com";
    $sth->execute();
    //Insère une troisième entrée
    $prenom = "George Friedrich"; $nom = "Haendel"; $mail = "jf.haendel@gmail.com";
    $sth->execute();
```


## Connaitre le nombre de lignes modifiées par une requête de type ``DELETE``, ``INSERT`` ou ``UPDATE``:
```php
    //On fait notre requete:
    $myquery = $bdd->exec($sql);
    //On souhaite savoir combien de lignes ont été modifiées:
    echo $myquery->rowCount();
```

## Modifier la structure d'une table
```php
    //Ajoute une colonne UserRole de type VARCHAR avec une limite de 30 caractères:
    $sql = "
        ALTER TABLE Users
        ADD UserRole VARCHAR(30)
        ";
    $bdd->exec($sql);

    //Modifie la colonne UserRole en passant de 30 à 50 caractères:
    $sql = "
        ALTER TABLE Users
        MODIFY COLUMN UserRole VARCHAR(50)
        ";
    $bdd->exec($sql);

    //Supprime la colonne UserRole:
    $sql = "
        ALTER TABLE Users
        DROP COLUMN UserRole
        ";
    $bdd->exec($sql);
```

## Créer une BDD puis une table dans cette BDD 
+ comme on vient de créer la BDD on a pas son nom dans les infos de connexion
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

## Suppression
```php
    //Supprimer les données de la table Users:
    $sql = "DELETE FROM Users";
    $sth = $bdd->prepare($sql);
    $sth->execute();

    //Supprimer la table Users
    $sql = "DROP TABLE Users";
    $bdd->exec($sql);

    //Supprimer la BDD testdb
    $sql = "DROP DATABASE testdb";
    $bdd->exec($sql);
```

## Sélectionner des données
```php
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    define("DBNAME", "test");
    //DSN de connexion:
    $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8";

    //Tentative de connexion:
    try{
        $connexion = new PDO($dsn, DBUSER , DBPASS);

        //Définition du mode d'erreur de PDO sur Exception:
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Définition du mode de fetch()
        $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        //Pour sélectionner les prénoms par ordre croissant et les mails par ordre décroissant:
        $sth = $connexion->prepare("SELECT firstname, lastname FROM users ORDER BY firstname ASC, lastname DESC");
        $sth->execute();

        //Retourner un tableau associatif pour chaque entrée avec le nom des colonnes sélectionnées en guise de clefs
        $result = $sth->fetchAll();

        //Affichage des résultats avec print_r et les balises <pre> pour rendre l'ensemble plus lisible
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }

    //Si une exception est lancée on la capture et on affiche les infos de l'erreur, on arrete le php avec die():
    catch(PDOException $e){
        die("Error: ".$e->getMessage());
    }

    //On ferme la connexion:
    $connexion = null;
```    

## Pour n'afficher qu'un exemplaire de chaque prénom, meme s'il y en a plusieurs dans la bdd:
```php
    $sth = $bdd->prepare("SELECT DISTINCT prenom FROM users");
    $sth->execute();
```

## Jointure interne:
+ ne retourne que les résultats qui ont une correspondance entre les tables
```php
    $sql = "SELECT j.nom nom_jeu, p.prenom prenom_proprietaire /*Sélectionne et donne des alias*/
            FROM proprietaire p /*Indique la table principale et son alias*/
            INNER JOIN jeux_video j /*Indique la table à joindre et son alias*/
            ON j.ID_proprietaire = p.ID"; /*Indique sur quel critère on va faire la jointure*/
    $sth = $bdd->prepare($sql);
    $sth->execute();
```

## Jointure interne:
```php
//LEFT = table principale renvoie toutes ses données même celles sans correspondance
    $sql = "SELECT j.nom AS nom_jeu, p.prenom AS prenom_proprietaire
            FROM proprietaire AS p
            LEFT JOIN jeux_video AS j /*Toutes les valeurs de proprietaire apparaitront meme sans equivalent dans jeux_video */
            ON j.ID_proprietaire = p.ID";
    $sth = $bdd->prepare($sql);
    $sth->execute();
//RIGHT = table jointe renvoie toutes ses données même celles sans correspondance
    $sql = "SELECT j.nom AS nom_jeu, p.prenom AS prenom_proprietaire
            FROM proprietaire AS p
            LEFT JOIN jeux_video AS j /*Toutes les valeurs de proprietaire apparaitront meme sans equivalent dans jeux_video */
            ON j.ID_proprietaire = p.ID";
    $sth = $bdd->prepare($sql);
    $sth->execute();
```

## CROSS JOIN:
+ Dans cet exemple le contenu de chaque commentaire est joint aux noms et prénoms de la première table pour former des nouveaux résultats:
```php
    $sql = "SELECT users.prenom, users.nom, comments.contenu
            FROM users /*On indique la table principale*/
            CROSS JOIN comments"; /*On indique la table qui doit etre croisée*/
    $sth = $bdd->prepare($sql);
    $sth->execute();
```

## SELF JOIN
```php
    $sql = "SELECT e.nom AS nom_employe, m.nom AS nom_manager
            FROM employes e /*On créé une table fictive 'e' à partir d'employes*/
            LEFT OUTER JOIN employes m /*On créé une table fictive 'm' à partir d'employes et on la joint*/
            ON e.manager_id = m.id"; /*On indique sur quel critère on se base ici les ID et manager_id */
    $sth = $bdd->prepare($sql);
    $sth->execute();
```

## UNION:
+ si on veut combiner plusieurs ``SELECT``, 
    - ``UNION ALL:`` si on veut afficher même les doublons
```php
    $sql = "SELECT nom, prenom FROM employes
            UNION 
            SELECT nom, prenom FROM users"; 
    $sth = $bdd->prepare($sql);
    $sth->execute();
```

## FULL JOIN
```php
/*On sélectionne les même données avec un LEFT JOIN puis un RIGHT JOIN, sur l'un des deux SELECT (ici le RIGHT) on ajoute une clause WHERE pour éviter d'avoir les données qui satisfont les deux SELECT en double, puis on les joint avec UNION ALL*/
    $sql = "SELECT u.prenom, u.nom, c.contenu, c.dateComment FROM users AS u
            LEFT JOIN comments AS c ON u.id = c.userId
            UNION ALL
            SELECT u.prenom, u.nom, c.contenu, c.dateComment FROM users AS u
            RIGHT JOIN comments AS c ON u.id = c.userId
            WHERE u.id IS NULL"; 
    $sth = $bdd->prepare($sql);
    $sth->execute();
```

## Les opérateurs de sous requête
+ ``EXISTS``
```php
    /*Sélectionne toutes les données d'un utilisateur de la table si un commentaire dont l'Id est identique à l'id de l'utilisateur est trouvé dans la table comments (=si l'utilisateur a déjà écrit un commentaire):*/
    $sql = "SELECT * FROM users
            WHERE EXISTS (SELECT * FROM comments WHERE comments.userId = users.id)";
    $sth = $bdd->prepare($sql);
    $sth->execute();  
```
+ ``ANY``
```php    
    /*Sélectionner les prénoms des utilisateurs qui ont commenté depuis le 18 mai 2018 à midi SI AU MOINS l’un d’entre eux a posté un commentaire depuis*/
    $sql = "SELECT prenom FROM users
            WHERE id = ANY (SELECT userId FROM comments WHERE dateComment > '2018-05-18 12:00:00')";
    $sth = $bdd->prepare($sql);
    $sth->execute();
```
+ ``ALL``
```php
    /*Sélectionner les prénoms ds utilisateurs qui ont commenté depuis le 18 mais 2018 à midi S’ILS ONT TOUS posté un commentaire depuis*/
    $sql = "SELECT prenom FROM users
            WHERE id = ALL (SELECT userId FROM comments WHERE dateComment > '2018-05-18 12:00:00')";
    $sth = $bdd->prepare($sql);
    $sth->execute();
```
