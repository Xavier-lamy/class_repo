# Les bases du SQL et des communications avec les BDD
+ pour communiquer avec un **SGBD** (*sytème de gestion de bases de données*) on utilise le **langage SQL**, mais on ne peut pas l'utiliser directement, il faut dire à php de le faire, une base de données est constitué de:
    - la **base** : c'est un peu le "dossier" qui contient toutes les **tables** 
    - les **tables**: on peut les imaginer sous la forme de tableaux qui contiennent les **champs** et les **entrées** 
    - les **champs** sont les *"colonnes"* du tableau (les **champs** peuvent par exemple etre les noms de catégorie: nom, prénom, age,
    on peut aussi ajouter un **champ** numéro ou ID pour numéroter les **entrées** ...)
    - les **entrées**: ce sont les lignes du tableau qui contiennent les **données** des **champs** pour chaque item (exemple pour chaque visiteur,...)

+ Un SGBD (comme **MySQL**, par exemple) enregistre toutes ces infos dans des fichiers, il est recommandé ne ne jamais y toucher directement, ce n'est pas fait pour ça :
    - Il faut uniquement manipuler les données avec le langage sql via php 

+ concurrents de MySQL:
    - Oracle: SGBD le plus célèbre et le plus puissant mais payant
    - MariaDB : variante libre de MySQL (une copie de MySQL qui a pour but de rester indépendante après le rachat de mysql par oracle)
    - microsoft SQL server : par Microsoft, souvent utilisé avec ASP.NET, payant
    - PostgreSQL : libre et gratuit, avec des fonctionnalités plus avancées que MySQL

+ Pour pouvoir travailler avec une base de données sql en php, il faut se connecter avec:
    - un username 
    - un mot de passe 
+ On peut utiliser différents moyens pour se connecter à une BDD *MySQL* comme: 
    - *mysqli* (en **procédural** ou **orienté objet**)
    - le mieux est d'utiliser l'extension **PDO** car il permet d'accèder à n'importe quel type de BDD (pas seulement *mySQL* mais aussi *PostgreSQL* ou *Oracle*)

+ Avec MAMP ou WAMP , **PDO**  est activé par défaut, pour se connecter à une base de données on a besoin:
    - du **nom de l'hôte**: càd l'adresse de l'ordinateur où MySQL est installé: généralement le même que PHP, en local on met: "localhost", si l'hébergeur web nous indique une autre valeur à renseigner (par exemple sql.hebergeur.com) dans ce cas il faudra modifier la valeur pour l'envoi sur site 
    - le **nom de la BDD**
    - le **login** : (le même que pour FTP en général) *root* si on est en local
    - le **mot de passe**: root si on est sous MAMP ou rien si on est sur WAMP 
