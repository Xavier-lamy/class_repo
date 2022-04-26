# Les Expressions Régulières Regex
<style>
    * {
        color: black;
        background-color: white;
        font-size: 1rem;        
    }
    h1, h2 {
        text-decoration: underline;
        text-align: center;
        font-size: 1.6rem;
    }
    h2 {
        font-size: 1.3rem;
    }
    ul {
        list-style: none;
    }
    strong {
        color: black;
    }
    li {
        margin-top: 1rem;
    }
</style>
## Bases
- __#mot#__ : cherche "mot" dans la chaîne
- __#mot1|mot2#__ : cherche "mot1" _ou_ "mot2"
- __#^papier#__ : _doit commencer_ par "papier"
- __#papier$#__ : _doit terminer_ par "papier"
- __#^papier$#__ : _contient uniquement_ "papier"
## Classes de caractères
- __#gr\[ioa]s#__ : contient "gris", "gros" ou "gras""
- __#\[a-z]#__ : minuscules de "a" à "z"
- __#\[0-9]#__ : chiffres de "0" à "9"
- __#\[a-e0-9]#__ : minuscules "a" à "e" et/ou chiffres de "0" à "9"
- __#\[0-57A-Za-z.-]#__ : "0" à "5", "7", "majuscules", "minuscules", "." ou "-"
- __#\[^0-9]#__ : ne _contient pas_ de chiffres (dans une class "^" ne vaut donc pas "commence")
- __#^\[^0-9]#__ : ne _commence pas_ par un chiffre
## Quantifications
- __#a?#__ : "a" _peut_ apparaître 0 ou 1 fois (≤1)
- __#a+#__ : "a" _doit_ apparaître au moins 1 fois (≥1)
- __#a*#__ : "a" _peut_ apparaître (0, ≥1)
- __#bor?is#__ : "bois" ou "boris"
- __#Ay(ay|oy)*#__ : autorise "Ay", "Ayay", "Ayoy",...
- __#a{3}#__ : "a" _doit_ apparaître 3 fois
- __#a{3,5}#__ : "a" _doit_ apparaître entree 3 et 5 fois
- __#a{3,}#__ : "a" _doit_ apparaître au moins 3 fois
## Classes abrégées
- __\d__ : \[0-9]
- __\D__ : \[^0-9]
- __\w__ : \[a-zA-Z0-9_]
- __\W__ : \[^a-zA-Z0-9_]
- __\t__ : tabulation
- __\n__ : saut de ligne
- __\r__ : retour chariot
- __\s__ : espace blanc (\t, \n, \r)
- __\S__ : pas un espace blanc
- __.__ : classe universelle (n'importe quel caractère)
- __\b__: word boundary, match une limite de mot, c'est à dire soit le début d'une string, la fin d'une string, ou au milieu de deux caractères dont l'un est un caractère alpha numérique et l'autre non (ex:whitespace)
- __\B__: match là où __\b__ ne match pas, c'est à dire au milieu de deux caractères alphanumériques ou de deux caractères non alphanumériques

## Lookahead et lookbehind (lookaround)
> Les parenthèses ne comptent pas comme des parenthèses capturantes  
Les éléments type lookaround sont des assertion, ils sont uniquement pris en compte pour vérifier la présence d'un élément proche de l'élément souhaité

- __#q(?=u)#__: positive lookahead: cherche les "q" suivis d'un "u"
- __#q(?!u)#__: negative lookahead: cherche les "q" non suivis d'un "u"
- __#(?<=q)u#__: positive lookbehind: cherche les "u" précédés d'un "q" (le moteur de regex fonctionne à l'envers pour la recherche)
- __#(?<!q)u#__: negative lookbehind: cherche les "u" non précédés d'un "q"
## Métacaractères
- Quand on souhaite rechercher les métacaractères (tous les caractères utilisés pour les regex):
- __\# ! ^ $ ( ) [ ] { } | ? + * .__
- Il faut les échapper avec un backslash: "\\"
## Métacaractères dans une classe
- Au sein d'une classe seuls 3 caractères doivent être échappés avec un "\\" pour pouvoir être recherchés:
    - __\#__ (fin de regex)
    -  __]__ (fin de classe) 
    -  __\\__ (échappement) 
- Si on cherche un "-" dans une classe il faut le mettre en début ou en fin, pour qu'il ne compte pas comme un séparateur
## Parenthèses capturantes
- __#^a(.+)a$#__ : les parenthèses créent des variables (dans l'ordre d'ouverture des parenthèses): 
    - $1, $2, ..., $99
    - $0 comprend l'ensemble de la regex
- __(?:texte)__ : avec "?:" les parenthèses capturantes sont annulées, la variable n'est pas créée
## Options
- __i__ : indifférence entre majuscule et minuscule
- __s__ : "." fonctionne aussi désormais pour \n (ce n'est pas le cas par défaut)
- __U__ : la regex s'arrête le plus tôt possible