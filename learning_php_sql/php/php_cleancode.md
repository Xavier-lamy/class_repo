# Ecrire du code propre en Php

## Améliorer les blocs ``if/else``
Source principale: [Bonnes pratiques PHP #4 se passer des else… et des if](https://tainix.fr/article-technique/Bonnes-pratiques-PHP-4-se-passer-des-else-et-des-if)
### Eviter les ``else``
On peut généralement éviter d'utiliser des ``else`` dans nos codes en définissant une valeur par défaut
- Au lieu de:
```php
public function chooseMagic(string $monster): string
{
    if ($monster === 'frostbite spider') {
        $magic = 'firebolt';
    } elseif ($monster === 'flame atronach') {
        $magic = 'ice spike'; 
    } elseif ($monster === 'dragon') {
        $magic = 'fus roh dah';
    } else {
        $magic = 'thunderbolt';
    }

    return $magic;
}
```
- On peut écrire plutôt:
```php
public function chooseMagic(string $monster): string
{
    //Initialize $magic with a default value (instead of a else)
    $magic = 'thunderbolt';

    if ($monster === 'frostbite spider') {
        $magic = 'firebolt';
    } elseif ($monster === 'flame atronach') {
        $magic = 'ice spike'; 
    } elseif ($monster === 'dragon') {
        $magic = 'fus roh dah';
    }

    return $magic;
}
```

### Return anticipé
Les ``return`` terminent la fonction/méthode en plus de retourner une valeur, donc ce qui est après n'est pas exécuté:
```php
public function chooseMagic(string $monster): string
{
    //With return we don't have to create a variable because each case will be dealt on his own

    if ($monster === 'frostbite spider') {
        return 'firebolt';
    } elseif ($monster === 'flame atronach') {
        return 'ice spike'; 
    } elseif ($monster === 'dragon') {
        return 'fus roh dah';
    }

    return 'thunderbolt';
}
```

### Switch
On peut aussi utiliser des ``switch`` avec des ``return`` à la place des ``break``
```php
public function chooseMagic(string $monster): string
{

    switch ($monster){

        case 'frostbite spider':
            return 'firebolt';

        case 'flame atronach':
            return 'ice spike';

        case 'dragon':
            return 'fus roh dah';

        default:
            return 'thunderbolt'; 
    }    
}
```

### Match
Une nouvelle structure de Php 8 qui ressemle un peu a un ``switch`` mélangé a un tableau associatif:
```php
public function chooseMagic(string $monster): string
{
    return match ($monster){
        'frostbite spider' => 'firebolt',
        'flame atronach' => 'ice spike',
        'dragon' => 'fus roh dah',
        default => 'thunderbolt'
    };   
}
```

### Tableau de correspondance
```php
public function chooseMagic(string $monster): string
{
	$choose_magic = [
		'frostbite spider' => 'firebolt',
		'flame atronach' => 'ice spike',
		'dragon' => 'fus roh dah'
	];
	
    //Check if $monster is found in choose magic, otherwise return the default magical power
	if (isset($choose_magic[$monster])) {
		return $choose_magic[$monster];
	}

	return 'thunderbolt';
}
```

### Opérateur null coalescent (ou de fusion Null)
Il s'agit d'un opérateur qui sert à condenser un ``if(isset)/ else``
```php
public function chooseMagic(string $monster): string
{
	$choose_magic = [
		'frostbite spider' => 'firebolt',
		'flame atronach' => 'ice spike',
		'dragon' => 'fus roh dah'
	];
	
    //Check if the frist expression is set, otherwise if it is null return the default magical power
	return $choose_magic[$monster] ?? 'thunderbolt';
}
```

### Opérateur ternaire
Sert à condenser les if/else
- Au lieu de:
```php
public function chooseMagic(string $monster): string {
    if ($monster === 'dragon'){
        return 'fus roh dah';
    }

    return 'thunderbolt';    
}

```
- On peut écrire:
```php
public function chooseMagic(string $monster): string {

    //If 'ExpressionA' is true so it returns 'ExpressionB', else it return 'ExpressionC' 
    return ($monster === 'dragon') ? 'fus roh dah' : 'thunderbolt';    

}

```

### foreach: continue
Suppposons que les monstres ont un type et qu'on souhaite choisir une action de notre personnage en fonction de ce type:
```php
foreach ($monsters as $monster) {

	if ($monster->type === 'weak') {
		$this->punchWithOnlyOneFinger($monster);
	} else {
		$this->magic = $this->chooseMagic();
		$this->attack($monster);
	}
}
```
- On pourrait l'écrire comme ceci:
```php
foreach ($monsters as $monster) {
	
    //If monster is weak we use this
	if ($monster->type === 'weak') {
		$this->punchWithOnlyOneFinger($monster);
		continue;
	}

    // In general we do that (only in some cases we do the previous action)
    $this->magic = $this->chooseMagic();
    $this->attack($monster);
}
```

### foreach: break
```php
foreach ($monsters as $monster) {
	
    //If monster is too much powerfull cry 
	if ($monster->type === 'too much powerfull for you boy') {
		$this->cryToYourMomOrDadBecauseThereIsNoReasonMomAlwaysHasToListenToYourComplaints();
		break;
	}

    // In others conditions we do as usual
    $this->magic = $this->chooseMagic();
    $this->attack($monster);
}
```

### Return avec un booléen
- Au lieu d'écrire un if/else qui renvoie ``true`` ou ``false``
```php
public function alduinIsWeak(Ennemi $alduin): bool
{
	if ($alduin->type === 'can kill it quite fast') {
		return true;
	} else {
		return false;
	}
}
```
- On peut écrire uniquement un return avec la condition, puisque cela renverra l'évaluation de la condition (est elle vrai ou fausse)
```php
public function alduinIsWeak(Ennemi $alduin): bool
{
    //If the condtion is true our function return true, else it return false, so if/else is not needed
	return ($alduin->type === 'can kill it quite fast');
}
```

### Compter un nombre d'éléments en fonction de leur type
- Au lieu d'écrire un if avec chaque type de monstre:
```php 
foreach ($killed_monsters as $killed_monster) {

	if ($killed_monster->nom === 'dragon') {
		$killed_dragons++;
	}

	if ($killed_monster->nom === 'giant') {
		$killed_giants++;
	}

	if ($killed_monster->nom === 'spider') {
		$killed_spiders++;
	}
}
```
- On peut utiliser les types pour tout condenser directement dans le foreach, dans cet exemple on utilise ``(int)`` qui est un **type cast** qui sert à transformer une variable en integer:
```php
//Initialize counters
$killed_dragons = 0;
$killed_giants = 0;
$killed_spiders = 0;

foreach ($killed_monsters as $killed_monster) {
    //If name is assessed true (int) will transform it in "1", if it is false it became "0"
	$killed_dragons += (int) ($killed_monster->nom === 'dragon');
	$killed_giants += (int) ($killed_monster->nom === 'giant');
	$killed_spiders += (int) ($killed_monster->nom == 'spider');
}
```
