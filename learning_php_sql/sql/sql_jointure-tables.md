# Jointures entre les tables
+ Dans le cas où on a deux **tables** que l'on souhaite relier on utilise des **jointures**
+ Par exemple, dans une table *jeux_video* au lieu d emettre le nom du *propriétaire* du jeu on pourrait mettre un *id_propriétaire* et dans un autre tableau les noms et infos pour chaque proprio avec en plus un champ *id_propriétaire* 
+ Ou dans le cas d'un blog, on peut avoir une colonne *id_user* dans la table *commentaire* qui permet alors de retrouver les infos de l'utilisateur lié à ce commentaire dans la table *user*

+ Il existe deux types de jointure :
    - les **jointures internes**: qui ne vont sélectionner que les données ayant une correspondance entre les deux tables (par exemple si on avait un propriétaire qui n'est pas dans la table jeux_video, mais seulement dans la table propriétaire, alors il n'apparaitrait pas)
    - les **jointures externes**: elles sélectionnent toutes les données même si elles n'ont pas de correspondances entre les tables (exemple si un commentaire n'est lié à aucun utilisateur ou un utilisateur n'a pas de commentaire ces infos apparaitraient tout de même, malgré leur absence dans l'un des tableaux, dans ce cas la valeur manquante marquera null)
+ On utilise les **alias** avec ``AS`` pour plus de clarté, attention  les **alias** peuvent être utilisés avec les clauses ``GROUP BY``, ``ORDER BY`` et ``HAVING`` mais **pas** ``WHERE``


## Jointures internes:
+ avec ``WHERE`` (ancienne syntaxe, préférer l'autre quand c'est possible):
    - Exemple:
    ``` 
    'SELECT jeux_video.nom AS nom_jeu, proprietaires.prenom AS prenom_proprietaire
    FROM proprietaires, jeux_video 
    WHERE jeux_video.ID_proprietaire = proprietaires.ID' 
    ```
    - Explications:
        +  pour ``SELECT``: On écrit le nom de la table devant le nom du champs séparé par un point, de cette manière si un nom de champs est identique dans les deux tables, sql saura lequel on veux, ici on a également ajouté un **alias** avec le mot clé ``AS``, remarque: ``AS`` n'est en réalité pas obligatoire, on peut écire directement l'**alias** simplement séparé par un **espace** 
        + pour ``FROM``: On indique les deux tables sur lesquelles on souhaite travailler
        + pour ``WHERE``: On établit le lien entre les deux tables, ici on souhaite que l'ID_proprietaire de jeux_video soit lié au champs ID de la table proprietaire
        + Le résultat pourrait être représenté sous la forme d'un tableau temporaire avec une colonne nom_jeu (repris depuis la tabel jeux_video) et une colonne prenom_proprietaire (repris depuis la table propriétaire et lié par l'ID)

+ On peux aussi utiliser des **alias** pour les noms des tables (généralement des initiales):
```
'SELECT j.nom AS nom_jeu, p.prenom AS prenom_proprietaire
FROM proprietaire AS p, jeux_video AS j
WHERE J.ID_proprietaire = p.ID'
```

+ avec ``JOIN`` (il est recommandé d'utiliser plutôt cette syntaxe):
    - ``SELECT j.nom nom_jeu, p.prenom prenom_proprietaire``: On sélectionne les infos qu'on veut, ici le nom dans la table jeu et le prénom dans la table proprio, on leur donne des **alias** (ici séparés uniquement par un espace et non ``AS``)
    - ``FROM proprietaire p``: on précise la table principale (celle dont on se servira de l'ID pour retrouver les données dans la deuxième table)
    - ``INNER JOIN jeux_video j``: On précise la table utilisée pour la **jointure interne**, celle qui contient une case ID_proprietaire qui sera lié à l'ID de la 1ere table
    - ``ON j.ID_proprietaire = p.ID``: ``ON`` fait la liaison entre les champs en précisant selon quelle clause il faut les lier (ici en fonction de l'ID_proprietaire qui fait alors référence à l'ID dans la table proprietaire) 
    - On peut ajouter des mots clés de tri, de filtrage, ou de limite après ça (WHERE,ORDER BY,LIMIT,...)
    ```
    <?php
    SELECT j.nom nom_jeu, p.prenom prenom_proprietaire
    FROM proprietaire p
    INNER JOIN jeux_video j
    ON j.ID_proprietaire = p.ID
    ?>
    ```

## Jointures externes: 
+ Récupère même les données sans correspondance
+ Le fonctionnement des ``LEFT JOIN`` et ``RIGHT JOIN`` est quasi le même que les jointures internes, avec l'ajout d'un mot clé ``LEFT`` ou ``RIGHT`` pour choisir quelle table doit être celle qui retourne ses données même quand il n'y a pas de correspondance:
    - ``LEFT OUTER JOIN`` ou ``LEFT JOIN``: récupère toute la **table de gauche**: càd la **table principale**, proprietaire dans l'exemple, ainsi même si un proprio n'a pas de jeu il apparaitra quand meme et sa valeur correspondante dans la colonne **de droite** vaudra NULL, en revanche un jeu sans proprio n'apparait pas:
    ```
    <?php
    'SELECT j.nom AS nom_jeu, p.prenom AS prenom_proprietaire
    FROM proprietaire AS p
    LEFT JOIN jeux_video AS j /*Toutes les valeurs de "proprietaire apparaitront meme sans equivalent dans jeux_video */
    ON j.ID_proprietaire = p.ID'
    ?>
    ```    
    - ``RIGHT OUTER JOIN`` ou ``RIGHT JOIN`` : récupère toute la **table de droite**: càd la **table jointe** à la principale, jeux_video dans l'exemple, si un jeux video n'a pas de proprio, il apparaitra tout de même et sa valeur correspondante dans la colonne **de gauche** vaudra NULL, en revanche un proprio sans jeu n'apparait pas:
    ```
    <?php
    'SELECT j.nom nom_jeu, p.prenom prenom_proprietaire
    FROM proprietaire p
    RIGHT JOIN jeux_video j /*Toutes les valeurs de "jeux_video" apparaitront, même celles sans equivalent dans proprietaire */
    ON j.ID_proprietaire = p.ID'
    ?>
    ```
### Le ``FULL (OUTER) JOIN``:
- Récupère toutes les données pour les deux colonnes sélectionnées, peu importe qu'elles aient une correspondance ou non
- Non supporté nativement par MySQL
- En MySQL on peut utiliser une combinaison de ``LEFT JOIN`` et ``RIGHT JOIN`` avec une clause ``WHERE`` et l'opérateur ``UNION`` ou ``UNION ALL``:
- On sélectionne les même données avec un ``LEFT JOIN`` puis un ``RIGHT JOIN``, sur l'un des deux ``SELECT`` (ici le ``RIGHT``, pour dire qu'on veut uniquement ceux dont l'id utilisateur est vide, les autres sont déjà retournés par ``LEFT JOIN``) on ajoute une clause ``WHERE`` pour éviter d'avoir les données qui satisfont les deux ``SELECT`` en double, puis on les joint avec ``UNION ALL``
```
SELECT u.prenom, u.nom, c.contenu, c.dateComment FROM users AS u
LEFT JOIN comments AS c ON u.id = c.userId
UNION ALL
SELECT u.prenom, u.nom, c.contenu, c.dateComment FROM users AS u
RIGHT JOIN comments AS c ON u.id = c.userId
WHERE u.id IS NULL
```                    

### Le ``CROSS JOIN``: 
- retourne la liste des produits des entrées de deux tables jointes quand aucune clause ``WHERE`` n'est utilisée
- peu utilisé dans les faits car rarement utile
- avec une requete type ``SELECT`` par exemple, chaque ligne de la première table est couplée à chaque ligne de la seconde table et forme une nouvelle ligne à chaque fois qui est retournée:
```
<?php
//Dans cet exemple le contenu de chaque commentaire est joint aux noms et prénoms de la première table pour former des nouveaux résultats:
SELECT users.prenom, users.nom, comments.contenu
FROM users //On indique la table principale
CROSS JOIN comments //On indique la table qui doit etre croisée
?>
```

### Le ``SELF JOIN``:
- Il n'y a pas réellement de mot clé ``SELF``
- ce type de jointure est un concept
- il consiste à utiliser n'importe quel autre méthode de jointure mais cette fois sur une seule table
- Utile s'il y a un lien hiérarchique entre les données de colonnes (patron/employé)
- Exemple si on a une table 'employes' tous les membres sont des employés, certains sont les managers d'autres employés, jusqu'à arriver au PDG:
    + une colonne id
    + une colonne nom
    + une colonne prenom
    + une colonne id_manager fera référence à la colonne id d'une autre entrée, pour le PDG cette colonne vaut 0, car aucune personne n'est son manager
- On a donc une correspondance entre des données au sein d'un meme tableau, pour faire ça on utilise les alias pour *créer deux tables fictives* à partir de notre table, et on les joint avec le mot clé qu'on veut
```
//On référence la table une fois avec l'alias e pour les employés et une fois avec l'alias m pour les managers:
SELECT e.nom AS nom_employe, m.nom AS nom_manager
FROM employes e
LEFT OUTER JOIN employes m
ON e.manager_id = m.id
```

### L'opérateur ``UNION``:
+ Il sert à combiner les résultats de deux déclarations ``SELECT`` ou permet de simuler un comportement ``FULL OUTER JOIN``
+ Pour qu'il fonctionne il faut respecter ces règles:
    - Chaque ``SELECT`` dans un ``UNION`` doit posséder le même nombre de colonnes
    - Chaque colonne de chaque ``SELECT`` doit posséder le même type de données que la colonne qui lui correspond dans le deuxième ``SELECT``
    - En revanche les colonnes peuvent avoir un nom différent entre les ``SELECT``
+ Par défaut ``UNION`` ne sélectionne pas les doublons dans valeurs (une valeur trouvée plusieurs fois n'apparait donc qu'une fois):
```
SELECT nom, prenom FROM employes
UNION 
SELECT nom, prenom FROM users
```
#### L'opérateur ``UNION ALL``:
+ Il fonctionne comme ``UNION``, excepté qu'en cas de doublons il les affichera quand même:
```
SELECT nom, prenom FROM employes
UNION ALL 
SELECT nom, prenom FROM users
```

## Les opérateurs de sous-requête
### ``EXISTS``
- teste l'existence d'une entrée dans une sous-requete
- renvoie **true** si au moins un résultat a été trouvé, la requête principale pourra alors s'exécuter
- permet de retourner des résultats seulement si une condition est vérifiée
```
/*Sélectionne toutes les données d'un utilisateur de la table si un commentaire dont l'Id est identique à l'id de l'utilisateur est trouvé dans la table comments (=si l'utilisateur a déjà écrit un commentaire):*/
SELECT * FROM users
WHERE EXISTS (SELECT * FROM comments WHERE comments.userId = users.id)
```
### ``ANY``
- S'utilise avec une clause ``WHERE`` ou ``HAVING``
- compare une valeur avec le résultat d'une sous-requête
- retourne **true** si au moins une valeur de la sous-requête répond à la condition, la requête principale pourra alors s'exécuter
```
/*Sélectionner les prénoms des utilisateurs qui ont commenté depuis le 18 mai 2018 à midi SI AU MOINS l’un d’entre eux a posté un commentaire depuis*/
SELECT prenom FROM users
WHERE id = ANY (SELECT userId FROM comments WHERE dateComment > '2018-05-18 12:00:00')
``` 
### ``ALL``
- S'utilise avec une clause ``WHERE`` ou ``HAVING``
- compare une valeur avec le résultat d'une sous-requête
- retourne **true** si toutes les valeurs de la sous-requête répondent à la condition, la requête principale pourra alors s'exécuter
```
/*Sélectionner les prénoms ds utilisateurs qui ont commenté depuis le 18 mais 2018 à midi S’ILS ONT TOUS posté un commentaire depuis*/
SELECT prenom FROM users
WHERE id = ALL (SELECT userId FROM comments WHERE dateComment > '2018-05-18 12:00:00')
```