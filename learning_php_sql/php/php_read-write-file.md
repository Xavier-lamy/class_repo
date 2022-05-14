# Ecriture et lecture de fichiers
+ Si on souhaite garder une quantité d'info supérieure à celle pouvant etre contenue dans les variables de $_SESSION et $_COOKIE, on peut utiliser des fichiers, cela permet aussi de stocker les infos plus longtemps, car la durée de vie d'une variable n'est pas infinie, par exemple les messages d'un forum ne peuvent etre contenus dans des variables, on peut donc utiliser les bases de données, ou bien écrire dans des fichiers:

+ Pour cela il faut déjà autoriser l'écriture de fichiers dans notre logiciel FTP:
    - En effet la majorité des serveurs tournent sous Linux, or sous linux il n'est de base pas possible de modifier un fichier avec les droits d'écriture 
    - il faut donc attribuer des droits d'écriture à php en modifiant le **chmod** du fichier ou du dossier, il s'agit de la commande permettant de modifier ces droits sous linux
    - Le **chmod** est un nombre à 3 chifffres que l'on attribue au fichier, et qui indique à linux quelles modifications  une entité est autorisée à réaliser.
    - Dans FileZilla par exemple il faut faire un clic droit sur le fichier ou dossier en question puis aller dans "permission de fichier" ou **chmod** (dans d'autres configs que filezilla), puis on obtient une fenetre qui nous affiche les droits d'écriture, de lecture et d'exécution pour chaque entité, ainsi qu'une valeur numérique à 3 chiffres indiquant ces droits pour chacun:

        - le propriétaire: utilisateur qui a créé le fichier, a en général tous les droits (lire/écrire/exécuter), il a le premier chiffre de la valeur numérique (7 s'il a tous les droits)
        - le groupe : concernent les droits du groupe d'utilisateur auqe=uel appartient le fichier, cela correspond au 2eme chiffre du chmod 
        - les permissions publiques: elles concernent tout le monde, notamment nos fichiers php, (auxquels on cherche à donner les droits d'écriture, de base les scripts php ne peuvent rien modifier sur des fichier sous linux), il s'agit du 3eme chiffre du chmod (par défaut 5 il faut lui mettre 7)

+ La valeur numérique 777 donne donc un accès complet aux fichiers (ou dossiers) pour tous les programmes du serveur, pour utiliser des scripts php il faut donc mettre le chmod à 777
    - ces valeurs numériques fonctionnent comme suit:
    | droit:     |  chiffre: |
    |------------|-----------|
    | r (read)   |      4 |
    | w (write)  |      2 |
    | x (eXecute)|      1 |
    - Ensuite on additionne en fonction des droits qu'on veut donner:
    |droit:    | chiffre:   calcul: |
    | ---      |    0       0 + 0 + 0 |
    | r--      |    4       4 + 0 + 0 |
    | -w-      |    2       0 + 2 + 0 |
    | --x      |    1       0 + 0 + 1 |
    | rw-      |    6       4 + 2 + 0 |
    | -wx      |    3       0 + 2 + 1 |
    | r-x      |    5       4 + 0 + 1 |
    | rwx      |    7       4 + 2 + 1 |

## Ouvrir et fermer un fichier :
Supposons qu'on créé un fichier ``compteur.txt`` qui a pour but de compter le nombre de vues d'un site:
- on commence par lui attribuer les droits d'écriture (chmod=777)
- on ouvre le fichier puis on le referme quand on a fini de le modifier:
```php
//Ouverture du fichier, la fonction fopen renvoie une info que l'on garde dans une variable et qui servira plus tard pour le refermer:
$compute = fopen('compteur.txt', 'r+'); //On indique le nom du fichier et la méthode d'ouverture (similaire à python, voir plus bas)

//On fait des modifs
$line = fgets($compute);

//Quand on a fini de l'utiliser on referme le fichier:
fclose($compute); //On précise le fichier à fermer grace a notre variable
```

+ Les différents modes d'ouverture de fichier:
    - ``r ``: lecture seule 
    - ``r+`` : lecture et écriture (souvent utilisé)
    - ``a`` : lecture seule, mais si le fichier n'existe pas il sera créé
    - ``a+`` : lecture et écriture, si le fichier n'existe pas il est alors créé, s'il existe le texte s'ajoute (append) à la fin 

+ Pour lire dans un fichier: 
    - ``fgetc()`` : permet de lire caractère par caractère (on s'en sert assez peu car il nécessite de fair eune boucle pour lire caractère par caractère)
    - ``fgets()`` : permet de lire ligne par ligne, la fonction renvoie la première ligne (et s'arrête au premier saut de ligne, on peut récupérer les autres lignes à l'aide d'une boucle)

+ Pour écrire dans un fichier:
    - ``fputs('file_name', 'text')`` : écrit la ligne que l'on souhaite dans le fichier, son fonctionnement est un peu particulier, en effet vu qu'on vient de lire la ligne du fichier le texte va s'écrire à la suite de ce qu'on vient de lire , car le curseur se trouve à la fin de la ligne, pour remédier à cela, on utilise:
    - ``fseek('file_name', integer)`` : cela permet de remettre le curseur où on veut dans le fichier (0 en valeur le met au début):
        - ``fseek('filename', 0);`` cela remet le curseur au début, si on utilise ensuite fputs() on écrit alors par dessus l'ancienne ligne (on l'écrase donc)
    - Si on est en mode a ou a+ cette fonction ne sert à rien car le texte ira à la fin quoi qu'il arrive 

+ Par exemple:
```php 
$compute = fopen('compteur.txt', 'r+');

$pages_vues = fgets($compute); //lit la 1ere ligne (nombre de pages vues)

$pages_vues += 1; //on incrémente de 1 vue
fseek($compute, 0); //On remet le curseur à zéro (début du fichier)
fputs($compute, $pages_vues); //On écrit le nouveau nombre de pages vues (en écrasant donc l'ancien)

fclose($compute);
``` 
    