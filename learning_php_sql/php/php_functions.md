
# Les fonctions:

+ Paramètres: informations à donner en entrée d'une fonction, qu'elle utilisera pour agir
+ Deux types de fonction:
    - elle retourne une valeur (dans ce cas en général on mettra cette valeur dans une variable) (similaires aux *accessors* ou *getters*)
    - elle ne retourne pas de valeur et fait juste une action (similaires aux *mutators* ou *setters*)

## Exemples de fonctions php:

+ traitements de string:
```php
$length = strlen("Coucou, c'est nous les mecs de cité"); //retourne la longueur de la string (espaces compris)

$replacing = str_replace('t', 'p', 'titi et toto'); //remplace une string par une autre
//En paramètres: string recherchée (pas obligatoirement une seule lettre), string que l'on veut à la place, string dans laquelle on recherche, ici cela donnera donc pipi et popo

$everyday_im_shuffling = str_shuffle('une phrase à mélanger'); //mélange aléatoirement les caractères (dont les espaces)

$minu = strtolower('BONJOUR'); //met tous les caractères en minuscules

$maju = strtoupper('bonjour'); //met en majuscule

$day = date('d','m','Y','H','i','s'); //renvoie les différents éléments de la date (on est pas obligé de tous mettre)
//en paramètres (veiller à respecter les majuscules): d=day, m=month, Y=year, H=hour, i=mInute (m étant déja pris), s=second
$text = nl2br('Bonjour,
            Monsieur'); //remplace les retour à la ligne de la string par des balises <br /> (pratique pour les formulaires notemment, cela permet de récupérer le texte tel qu'il est tapé par l'utilisateur)
```

## Pour créer ses propres fonctions:
+ On déclare puis on l'appelle quand on en a besoin (comme d'hab)
```php
function SayHello($name)
{
    echo 'Bonjour' . $name . ' !<br />';
} 
//Pas de ";" à la fin car il ne s'agit pas d'une instruction on ne fait que la déclarer

SayHello('Robert');

//Pour une fonction qui retourne une valeur:
function ConeVolume($radius, $height)
{
    $volume = $radius * $radius * 3.1415 * $height * (1/3); //calcul le voulme d'un cône
    return $volume; //indique ce qu'il faut retourner
}

ConeVolume(3, 6); //demande la valeur du volume d'un cone de 3cm de rayon et 6cm de hauteur

$capitalized_word = ucfirst('word'); //renvoie le mot avec la première lettre mise en majuscule (Word)
```
+ Quand on définit une fonction , on peut définir le type de valeur en entrée et en sortie:
    - Définir que le paramètre en entier doit être un entier 
    ```php
    function randomFunction(int $a) {
        var_dump($a);
    }
    ```
    - On peut définir null ou la valeur avec ``?``
    ```php
    function randomFunction(?int $a) {
        var_dump($a);
    }
    ```
    - On peut aussi définir la valeur de sortie , pareil avec ou sans la possibilité de la rendre nullable
    ```php
    function randomFunction(?int $a) : ?int {
        var_dump($a);
    }
    ```
+ On peut aussi décrire nos fonctions en ajoutant les types en paramètres et qui seront retournés:
```php
/**
 * A random function
 * 
 * @param int
 * 
 * @return int
 */
function randomFunction(?int $a) : ?int {
    return $a;
}
```