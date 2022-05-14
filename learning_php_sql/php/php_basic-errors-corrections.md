# Les erreurs les plus courantes en php:
Les 3 erreurs les plus courantes sont:
+ ``Parse error``: 
    - La plus courante elle signifie qu'on a fait un erreur de syntaxe, php nous indique à quelle ligne se situe l'erreur mais elle peut néanmoins se trouver quelques lignes autour, selon l'erreur
    - exemple d'erreurs qui peuvent provoquer une ``parse error``:
        - oublie du ";" après une instruction,
        - parenthèse mal fermée ou obliée,
        - crochet manquant,
        - erreur de concaténation (oubli d'un point)

+ ``Undefined function``:
    - quand on utilise une fonction qui n'existe pas soit:
        - car on s'est trompé dans le nom de la fonction en l'appelant par exemple (faute de frappe)
        - la fonction existe mais elle n'est pas reconnue par php, 
        - car elle se trouve dans une extension ou bibliothèque non activée
        - car elle n'est pas disponible dans la version de php utilisée

+ ``Wrong parameter count``:
    - Quand on s'est trompé sur le nombre de paramètres à donner à une fonction (trop ou pas assez)


Il existe aussi:
+ ``Header already sent by``:
    - Les headers sont des infos qu'on envoie au navigateur par exmeple pour le prévenir que ce qu'on envoie est du html,... 
    - Vu qu'il s'agit de fonctions à placer avant d'écrire le moindre code html, si on écrit une balise html avant on aura cette erreur

+ ``maximum execution time exceeded``:
    - Quand on a fait une boucle (while par exemple) et qu'on a pas de conditons d'arrêt, celle ci riquse de tourner à l'infini
    - php arrete l'exécution d'une page php si celle ci met plus de 30secondes à se générer, donc on aura ce message d'erreur
   