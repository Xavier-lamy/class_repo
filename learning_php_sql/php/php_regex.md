# Les regex en php

+ En Php on peut aussi utiliser les regex pour vérifier que des caractères souhaité sont présents ou non dans une chaine

+ Il esxiste deux types de langage regex pour php:
    - le POSIX créé pour php, plus simple à utiliser mais moins puissant que PCRE 
    - le PCRE issu du langage perl il est beaucoup plus puissant mais un peu plus difficile

+ Il existe plusieurs fonctions qui utilisent le langage PCRE:
    - ``preg_grep()``
    - ``preg_split()``
    - ``preg_quote()``
    - ``preg_match()``
    - ``preg_match_all()``
    - ``preg_replace()``
    - ``preg_replace_callback()``

+ ``preg_match`` renvoie un booléen: vrai si elle trouve le mot dans la chaine et false si elle ne trouve pas:
    - en paramètre on indique, la regex, puis le texte ou on fait al recherche:
    ```php
    if (preg_match("#Regex#OptionRegex", "Chaine-où-on-recherche"))
    {
        echo "Le mot est présent";
    }
    else
    {
        echo "le mot n'est pas présent";
    }
    ```

+ Pour les bases des regex voir [general/regex](../../learning_general/regex.md):

### Exemples de regex:
```
#^0[1-68]([-. ]?[0-9]{2}){4}$#
```
- On veut qu'il n'y ait que le numéro de téléphone: ``^`` et ``$`` 
- qu'il commence par 0: ``#^0``
- puis qu'il y est soit un chiffre entre 1 et 6, soit 8
- puis on cherche à répéter, 4 fois, et à la fin: ``{4}$#``, l'élément suivant:
    - peut commencer par un tiret, un point, un espace ou rien : ``([-. ]?``
    - continue avec deux chiffres: ``[0-9]{2})``

```
#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#
```
- On veut que l'adresse mail commence par une chaine de plus d'un caractère comprenant lettre en minuscules, chiffres, tiret, underscore et point: ``#^[a-z0-9._-]+``
- ensuite on veut un @: ``@``
- puis le même type de chaine qu'avant l'``@`` mais d'au moins deux caractères: ``[a-z0-9._-]{2,}``
- puis un point, qu'il faut donc échapper: ``\.``
- puis on termine par l'extension constitué de lettre minuscules (entre 2 et 4): ``[a-z]{2,4}$#``

+ On peut utiliser des regex avec **MySQL**, la seule différence est qu'il faut utiliser le langage POSIX, les différneces sont:
    - pas de délimiteurs, et donc pas d'options, donc on n'entoure pas la regex de ``#`` 
    - pas de clases abrégées (\d,\D,...) excepté le ``.`` pour "n'importe quel caractère"
    - Exemple si on veut sélectionner des noms de visiteurs dont l'adresse IP correspond à un certain patern on peut faire:
    ```sql
        SELECT nom FROM visiteurs WHERE ip REGEXP '^84\.254(\.[0-9]{1,3}){2}$'
    ```
    - ``REGEXP`` est le mot clé utilisé pour rechercher la présence de cette regex dans les entrées du champs ip 


+ Capture et remplacement:
    - Les parenthèses capturantes: quand on utilise des parenthèses en Regex cela créé des variables (dans l'ordre d'ouverture des parenthèses), ainsi on peut ajouter des parenthèses qui n'ont pas d'intéret dans la regex mais qui serevent juste à envelopper une variable 
    - Cela sert pour utiliser: ``preg_replace()``:
    ```php
    $text = preg_replace('#\[b\](.+)\[/b\]#i', '<strong>$1</strong>', $text);
    ```
    - Dans cet exemple on cherche à créer du BBCode (un code pour les forums , pour créer par exemple les balises ``[spoiler]``,...), ici on veut que le texte entre ``[b][/b]`` soit mis en gras.
    - pour cela on tape notre regex on oublie pas d'échapper les crochets des balises ``[b]``,
    - puis entre parenthèses on écrit qu'on veut au moins un caractère (n'importe lequel): ``(.+)``, cela créé ainsi une variable ``$1``, si on faisait d'autres textes entre parenthèses on aurait ``$2``, ``$3``,... 
    - ici on a jouté ``i`` en option pour que cela fonctionne meme en majuscule 
    - ensuite on ajoute en 2eme argument le texte de remplacement (ici on indiqe qu'on veut que le contneu de la variable ``$1`` soit mis en gras): ``<strong>$1</strong>``
    en dernier paramètre on ajoute le texte dans lequel on travaille.
    - C'EST L'ORDRE D'OUVERTURE DES PARENTHESES QUI EST IMPORTANT pour déterminer l'ordre des variables 
    - On peut utiliser jusqu'à 99 parenthèses capturantes (``$99``)
    - la variable ``$0`` contient toute la regex 
    - Si on ne souhaitait pas que la parenthèse soit capturante (quand on en a plusieurs), il faut ajouter "?:" au début de la parenthèse:
        - ex: ``(?:.+), para(?:chute)``
    