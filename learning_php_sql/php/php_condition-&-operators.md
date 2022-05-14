# Conditions et opérateurs

## Types d'opérateurs
### Opérateurs de comparaisons
Pour les opérateurs qui n'observe pas le type de la variable/opérande, php réalise un transtypage, c'est à dire qu'il va mettre les deux opérandes au même type pour pouvoir les comparer
+ les opérateur suivant renvoient ``true`` si:
    - ``$a == $b`` *(Égal)* : ``$a`` est égal à ``$b`` après le transtypage
    - ``$a === $b``	*(Identique)*: ``$a`` est égal à ``$b`` et qu'ils sont de même type
    - ``$a != $b``/``$a <> $b`` *(Différent)*: ``$a`` est différent de ``$b`` après le transtypage
    - ``$a !== $b``	*(Différent)*: ``$a`` est différent de ``$b`` ou bien s'ils ne sont pas du même type
    - ``$a < $b``	*(Inférieur)*: ``$a`` est strictement plus petit que ``$b``
    - ``$a > $b``	*(Supérieur)*: ``$a`` est strictement plus grand que ``$b``
    - ``$a <= $b``	*(Inférieur ou égal)*: ``$a`` est plus petit ou égal à ``$b``
    - ``$a >= $b``	*(Supérieur ou égal)*: ``$a`` est plus grand ou égal à ``$b``
+ Il existe aussi l'opérateur *Combiné* ``$a <=> $b`` *(alias spaceship operator)* qui renvoie:
    - ``-1`` si ``$a`` inférieur à ``$b``
    - ``0`` si ``$a`` égal à ``$b``
    - ``1`` si ``$a`` supérieur à ``$b``

### Opérateurs logiques
+ Les opérateur suivant renvoient true si:
    - ``! $a``	``NOT``: ``$a`` n'est pas true.
    - ``$a && $b``	``AND``: ``$a`` ET ``$b`` sont true.
    - ``$a || $b``	``OR``: ``$a`` OU ``$b`` est true.
    - ``$a and $b`` ``AND``: ``$a`` ET ``$b`` valent true.
    - ``$a or $b`` ``OR``: ``$a`` OU ``$b`` valent true.
    - ``$a xor $b``	``XOR``*(ou exclusif)*: ``$a`` OU ``$b`` est true, mais pas les deux en même temps.


## Priorité des opérateurs
+ On parle aussi de précédence d'opérateurs
+ Comme en maths tous les opérateurs n'ont pas la même priorité, pour faire simple on peut dire que l'ordre de priorité pour les opérateurs de base est (il en existe d'autres notamment les opérateurs ``bitwise``):
    - Opérateur logique: ``!``
    - Opérateur arithmétique: ``*`` ``/`` ``%``
    - Opérateur arithmétique: ``+`` ``-``
    - Opérateur de concaténation: ``.`` (à partir de php 8)
    - Opérateurs de comparaison: ``>`` ``<`` ``>=`` ``<=`` 
    - Opérateurs de comparaison: ``==`` ``===`` ``!==`` ``!=`` ``<=>`` ``<>``
    - Opérateurs logiques: ``&&`` ``||``
    - Coalescent nul: ``??``
    - Ternaire: ``? :``
    - Opérateur logique: ``and`` ``or`` ``xor`` (attention donc, malgré leur équivalence avec ``&&`` ou ``||``, leur différence réside dans leur prévalence)


## Structures:
### Conditions de base
```php
$age = 20;
if ($age == 65) 
{
    echo "Tu as 65 ans";
}
elseif ($age <= 18)
{
    echo "Tu es mineur";
}
else 
{
    echo "Tu es majeur";
}
```
```php
//On peut utiliser les booléens sans ==true:
$is_valid = true;
$is_invalid = false;

if ($is_valid) //ici pas besoin de ==true car le booléen est "true"
{
    echo "c'est valide";
}
elseif (! $is_valid) //ici pas besoin de ==false car on a écrit "!" càd "n'est pas" ou "différent de" is_valid
{
    echo "Ce n'est pas valide";
}
else if ($is_invalid) //ici c'est évalué à false
{
    echo "Ce n'est pas valide aussi";
} 
else
{
    echo "Ce n'est pas une valeur acceptable pour is_valid, cela devrait être un booléen";
}
```
### Intégrer de l'html
```php
//Pour intégrer de l'html:
<?php
if ($condition)
{
    while ($condition)
    {
?>

<p>Voici du texte</p> //On met le texte html ici

<?php
    }
}
?>

//--------ou-------
<?php if($condition): ?>

    <p>Texte</p>

<?php endif; ?>
``` 
### Switch:
```php
//Une switch ne peut tester que les égalités, mais elle permet d'écrire un code plus propre et raccourci particulièrment quand on a beaucoup de choix à tester
<?php 
$age = 20;
switch ($age) 
{ //On indique derrière switch sur quelle variable on veut faire les verifs
    case 1: //dans le cas ou l'age est de 1
        echo "tu as 1 ans";
    break; //On ordonne de casser la boucle switch si jamais ce cas est avéré, dans le cas contraire (age != 1), le cas n'est pas lu et cela passe au suivant

    case 6:
        echo "tu as 6 ans";
    break;

    case 10:
        echo "tu as 10 ans";
    break;

    default:
        echo "pas de message à afficher pour cet age"; //sers de "else" et retourne la valeur par défaut si tous les cas sont invalides
}
```
### Conditions ternaires:
```php
//au lieu d'écrire :
$age = 29;
if ($age > 30)
{
    $valid = true;
}
else
{
    $valid = false;
}

//On peut écrire en condition ternaire:
$age = 29;
$valid = ($age > 30) ? true : false; //cela signifie si la condition est vraie alors $valid vaudra la première valeur (après le "?"), sinon elle vaudra la deuxième (après le ":")

?>
```
### Opérateur coalescent non nul
Renvoie le membre de gauche s'il n'est pas ``null`` ou ``undefined``, sinon renvoie le membre de droite
```php
//Au lieu d'écrire:
if(isset($var)){
    echo "Sometext{$var}and some other";
}
else {
    echo "sometext with a replacement if variable is undefined"
}

//On peut écrire
$text = $var ?? "Replacement text"; //Si $var était non défini ou null alors on a un texte de remplacement

echo "Sometext{$text}and some other";
```

### Opérateur elvis
Il s'agit d'une forme d'opérateur ternaire particulère qui fait un peut la même chose que le coalescent non nul, c'est à dire qu'il retournera l'élément de gauche s'il est évalué à true ou celui de droite sinon, la différence avec le ``??``, c'est que l'``opérateur elvis``, renvoie l'opérande de droite dès que la condition est de type ``falsy`` (c'est à dire ``null``, ``undefined``, mais aussi une chaine vide par exemple)`, ainsi l'opérateur elvis peut servir de ``if(empty())``, en réalité il s'agit d'un syntaxe simplifié pour une ternaire dont l'élément retourné si vrai est l'élément de la condition lui même:
```php
//au lieu de
$var = "";
if(!empty($var)){
    echo "Sometext{$var}and some other";
}
else {
    echo "sometext with a replacement if variable is undefined"
}
//ou 
$text = $var ?: "Replacement text"; //Si $var était non défini, null ou vide alors on a un texte de remplacement

echo "Sometext{$text}and some other";

//On peut plutôt écrire:
$var = '';
$text = $var ?: "Replacement string"; //Ici vu que $var est défini, mais est un chaine vide donc php va retourner la chaine de droite 

