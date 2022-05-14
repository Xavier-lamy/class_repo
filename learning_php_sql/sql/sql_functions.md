# Les fonctions SQL
+ Elles servent à retourner des données selon certains critères ou effectuer des manipulations sur les données directement

+ on distingue les fonctions d'agrégation et les fonctions scalaires

+ Ces fonctions s'utilisent toujours avec SELECT puisqu'elles ne modifient rien dans la BDD

+ Pour utiliser une fonction en sql on l'écrit généralement an majuscule comme pour les mots clés, il s'agit seulement d'une convention d'écriture

## Les **fonctions d'agrégation**
+ pour réaliser des opérations à partir de plusieurs valeurs et en retourner **une seule**
+ vu qu'elles ne renvoient qu'une seule valeur on utilise ``fetch()`` et non ``fetchAll()`` (donc pas de boucle while), de plus on ne cherchera du coup pas à récupérer deux valeurs en meme temps comme on peut le faire avec les fonctions scalaires:
    - ``MIN()``: retourne la valeur la plus petite d'une colonne sélectionnée, sur des string 'a' est considéré plus petit que 'b', etc...
        + ex: ``"SELECT MIN(age) FROM users"``
    - ``MAX()``: retourne la valeur la plus grande d'une colonne sélectionnée, sur des string 'a' est considéré plus petit que 'b', etc...
        + ex: ``"SELECT MAX(age) FROM users"``
    - ``COUNT()``: compte le nombre d'entrées
        + ex: ``SELECT COUNT(nbr_joueurs_max) AS nbjeux FROM jeux_video``
        + ex: ``SELECT COUNT(DISTINCT possesseur) AS nbpossesseurs FROM jeux_video`` (ici avec DISTINCT on veut uniquement le nombre de possesseurs totaux de la liste en ne sélectionnant qu'une fois leur nom meme quand ils apparaissent pour plusieurs jeux)
    - ``AVG()``: fait la moyenne des entrées d'un champ 
    - ``SUM()``: fait la somme des entrées d'un champ 
       
+ On peut aussi grouper les données à l'aide de ``GROUP BY`` et ``HAVING``, il faut faire attention à l'ordre de nos instructions si on veut que ça fonctionne comme prévu:
    - ``GROUP BY`` permet de grouper des données en utilisant une fonction d'agrégat comme ``AVG()``  par exemple, ainsi si on souhaite récupérer les moyennes de prix pour chaque console on peut écrire comme suit:
        + ``SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console`` 
        + dans ce cas on peut aussi récupérer le nom dela console, puisque la fonction d'agrégat retournera *plusieurs* valeurs (une moyenne d'entrées pour chaque console)
    - Une fois les données regroupées de cette manière on peut alors utiliser ``HAVING``, qui s'utilise un peu comme ``WHERE`` (et permet donc de filtrer) mais à la **fin** des opérations, du coup ``HAVING`` s'utilise **uniquement** sur le résultat de la fonction d'agrégat 
        + ex: ``SELECT AVG(prix) AS prix_moyen, console FROM jeux_video WHERE possesseur='Patrick' GROUP BY console HAVING prix_moyen <= 10``
        + ne retourne que la liste des prix moyens par console (avec le nom de console) des jeux de Patrick uniquement, si cette moyenne ne dépasse pas 10 euros

+ Il existe aussi ``AS``: 
    - mot clé utilisé pour donner un nom temporaire au champ qui est créé par une fonction, on appelle ce champ temporaire (dans lequel est stocké le résultat de la fonction) un "alias", on remarque qu'on peut toujours récupérer les autres champs sans forcément leur appliquer de fonction    

## Les **fonctions scalaires**
+ Agissent sur chaque entrée, permet par exemple de transformer an majuscules la valeur de chacune des entrées d'un champ:
    - ``UCASE()`` ou ``UPPER()`` (pour oracle): transforme l'intégralité d'un champ en majuscules:
        + ``SELECT UPPER(nom) AS nom_majuscule, possesseur, prix, console FROM jeux_video'``
    - ``LCASE()`` ou ``LOWER()`` (pour oracle): transforme en minuscules: 
        + ``SELECT LOWER(nom) AS nom_min FROM nom_de_la_table``
    - ``LENGTH()``: renvoie la longueur d'un champ en bytes (octet), donc attention une lettre accentuée vaut plusieurs octets par exemple: 
        + ``SELECT LENGTH(nom) AS longueur_nom FROM nom_de_la_table``
    - ``ROUND(param1, param2)``: arrondi une valeur en choisissant le nmbre de décimales, param1 est le nom d'une colonne ou une valeur à arrondir, param2 est le nombre de décimales souhaitées après la virgule:
        + ``SELECT ROUND(prix, 2) AS prix_jeu FROM nom_de_la_table``
        + Les règles d'arrondi sont particulières pour cette fonction:
            - Si on passe un chiffre exact: la règle pour une commande type SELECT va être d’arrondir à la valeur supérieure
            - Si on passe une *valeur approximative* (expression utilisant une exponentielle par exemple), la règle d’arrondi va dépendre de la librairie C utilisée, généralement la règle sera d’arrondir au nombre pair le plus proche pour une commande type SELECT
            - Dans le cas d’une commande de type INSERT, alors la règle d’arrondi sera d’arrondi au nombre le plus éloigné de zéro
    - ``NOW()`` renvoie la date courante, on peut ainsi contextualiser une sélection en datant la date d'export:
        + ``SELECT prenom, NOW() FROM users``: retourne les prénoms avec la date d'extraction
