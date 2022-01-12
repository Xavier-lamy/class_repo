# Le terminal

## Bases
Sous windows il faut installer un vrai terminal, car l'invite de commande n'est pas aussi complète qu'un terminal, sur les autres OS ce n'est pas nécessaire , un terminal est déjà installé.

Pour windows:
- Cygwin 
- Shell Bash

## Naviguer dans le terminal:
- ``flèche haut``/``flèche bas`` pour revenir à une commande préalablement entrée
- ``tab`` pour l'auto-complétion
- ``ctrl+r`` pour faire une recherche dans l'historique de commandes
- ``ctrl+a`` et ``ctrl+e`` pour aller automatiquement au début ou à la fin de la ligne de commande si elle est longue

## A propos des commandes:
- Les commandes peuvent avoir des options ou des paramètres en plus (introduits par ``--`` ou ``-``)

- Quand on liste des fichiers avec ``ls`` on obtient les données suivantes:
	- ``d`` en début de ligne, pour ``directory``
	- ``-`` en début de ligne, pour un fichier
	- la date de modification, 
	- la taille du fichier

- ``.`` = le répertoire courant (dans lequel on se trouve)

- ``..`` = le répertoire parent

- S'il y a un espace dans le nom du fichier ou du dossier, mettre des guillemets ou un back-slash entre le premier mot et l'espace

- On peut utiliser ``>`` pour rediriger la sortie d'une commande:
	- par exemple ``ls`` doit normalment nous lister le contenu d'un dossier en console, si on utilise ``ls > liste.txt`` alors le contenu ne sera pas affiché en console mais dans un nouveau fichier ``liste.txt`` créé pour l'occasion
	- Cela peut permettre de garder une trace de ce que l'on a affiché

### Les Fileglobs
Des caractères ``wildcards`` ou ``joker`` qui possèdent une signification spéciale:
``*`` : n'importe quel caractère, ex: ``*.txt`` = tous les fichiers avec l'extension ``.txt`` 
``?`` : quand on recherche une chaine de caractère en ligne de commande on peut mettre un ``?`` pour remplacer un caractère qu'on ne connait pas

## Liste des commandes

|Commande|Signification|Résultat|
|--------|-------------|--------|
|``--help``| |Après une commande affiche l'aide de la commande au lieu de retourner le résultat|
|``pwd``|*Print Working Directory*|Affiche le répertoire de travail où on se trouve|  
|``ls``|*list*|Liste le contenu d'un répertoire| 
|``ls -l``| |Liste: demande l'affichage de plus d'infos|
|``ls -a``| |Liste: tous les fichiers doivent apparaitre y compris les fichiers cachés|
|``ls -l -a``| |Liste : combinaison des deux précédents|
|``ls -la``| |Liste : variante du précédent|
|``ls dirName``| |Affiche le contenu d'un répertoire choisi et non le répertoire courant|
|``ls "dir Name"``| |Affiche le contenu d'un répertoire choisi dont le nom contient un espace|
|``ls ..``| |Affiche le contenu du répertoire parent|
|``cd dirName``|*change directory*|Naviguer dans les répertoires|
|``mkdir dirName``|*make directory*|Créer un répertoire/dossier|
|``touch path/file.txt``| |Créer un nouveau fichier|
|``mv file.txt destination``|*move*|Déplacer des fichiers d'un dossier à l'autre (couper/coller)|
|``mv folder/file.txt .``| |Sortir un fichier d'un sous-dossier pour le mettre dans le dossier courant|
|``mv old.txt new.txt``| |Renommer un fichier|
|``cp file.txt destination``|*copy*|Copier des fichiers d'un dossier à l'autre (copier/coller)| 
|``cp old.txt new.txt``| |Copier avec un autre nom|
|``cp -r folder folderCopy``|*copy recursively*|Copier un dossier et tous ses sous dossiers (récursivité)|
|``rm file.txt``|*remove*|Supprimer des fichiers|
|``rm -r dossier``|*remove recursively*|Supprimer un dossier et tous ses sous dossiers (récursivité)|
|``man``|*manual*|Afficher le manuel d'une commande expliquant tout sur la commande|
|``q``|*quit*|quitter le manuel d'une commande ou la version paginée d'un fichier| 
|``cat file.txt``| |Afficher le contenu d'un fichier dans la console|
|``less``| |Afficher le contenu d'un fichier mais sous une forme paginée, se déplacer avec les flèches|
|``more``| |Ancienne version de ``less``, moins complet|
|``grep thingLookedFor whereToLookFor.txt``| |Chercher des éléments dans un fichier sans même l'ouvrir, ne fonctionne pas avec les répertoires, la console retournera un message d'erreur|
