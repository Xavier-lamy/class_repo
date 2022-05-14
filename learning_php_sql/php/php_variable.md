# Les variables

## types de variables
```php
$variable_name = "name"; //déclaration d'une variable pas de camelCase, underscore à l aplace des espaces
//Types de variables en php:
$string = "string";
$string_simple_quote_mark = 'string'; //quasi pas de différences pour les deux à part pour la concaténation (voir plus bas)
$integer = -45;
$float = 4.3;
$boolean = true;
$nothing = NULL; //ou null en minuscules
echo $string; //pour print une variable
```

## Concaténation (où la différence de guillemets est importante)
```php
echo "Aujourd'hui il fait {$integer} degrés"; //La plus simple à utiliser
echo 'Aujourd\'hui il fait' . $integer . 'degrés'; //on sépare les parties du texte de la variable avec des points,
```

## Calculs au sein de variables
+ Pour les calculs de variable ou au sein des variables, en plus de ``+ - * /`` , on trouve aussi:
    - Le modulo : ``%``, il permet de faire une division avec reste et retourne le reste:
    ```php
    $number = 10 % 3; //va retourner 1 car 10/3 = 3 reste 1
    $number_2 = 9 % 3; //va retourner 0 car 9/3 = 3 reste 0
    ```
