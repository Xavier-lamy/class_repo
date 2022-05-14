# date()

## Elements de formatage de date:
- ``l`` : jour en toutes lettres (monday,...)
- ``j`` : jour en chiffres
- ``jS`` : jour format: 15th, 1st,...
- ``F`` : mois en toutes lettres (august,...)
- ``Y`` : année complète (2004,...)
- ``h`` : heure
- ``i`` : minute
- ``s`` : seconde

## Exemples de la doc php
```php
// Définit le fuseau horaire par défaut à utiliser.
date_default_timezone_set('UTC');


// Affichage de quelque chose comme : 
// Monday
echo date("l");

// Affichage de quelque chose comme : 
// Monday 8th of August 2005 03:12:46 PM
echo date('l jS \of F Y h:i:s A');

// Affiche : 
// July 1, 2000 is on a Saturday
echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));


// Affichage de quelque chose comme :
// Wed, 25 Sep 2013 15:28:57 -0700
echo date(DATE_RFC2822);

// Affichage de quelque chose comme : 2000-07-01T00:00:00+00:00
echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));

// On peut protéger les caractères avec un antislash pour qu'ils ne soient pas lus comme un élément de date:
// Wednesday the 15th
echo date('l \t\h\e jS');
```
```php
$today = date("F j, Y, g:i a");                   // March 10, 2001, 5:16 pm
$today = date("m.d.y");                           // 03.10.01
$today = date("j, n, Y");                         // 10, 3, 2001
$today = date("Ymd");                             // 20010310
$today = date('h-i-s, j-m-y, it is w Day');       // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
$today = date('\i\t \i\s \t\h\e jS \d\a\y.');     // It is the 10th day (10ème jour du mois).
$today = date("D M j G:i:s T Y");                 // Sat Mar 10 17:16:18 MST 2001
$today = date('H:m:s \m \e\s\t\ \l\e\ \m\o\i\s'); // 17:03:18 m est le mois
$today = date("H:i:s");                           // 17:16:18
$today = date("Y-m-d H:i:s");                     // 2001-03-10 17:16:18 (le format DATETIME de MySQL)
```