# Boucles php

## while:
- utile quand on se sait pas vraiment combien d'itérations il faut faire:
```php
$car_number = 1;
while($car_number <= 100) //Tant que la condition est valide
{
    echo 'Il y a'. $car_number .'voitures.'; //On exécute le code
    $car_number++; //on incrémente la valeur
}
```

## for: 
- quand on connait à l'avance le nombre d'itérations nécessaires
```php
for($bike_number = 1; $bike_number <= 100; $bike_number++) //ici on met directement toute nos données en paramètres, dans l'ordre: initialisation de la variable, condition d'arrêt, incrémentation
{
    echo 'Il y a'. $bike_number .'vélos.';
}
```
