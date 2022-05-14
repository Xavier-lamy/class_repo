# La fonction ``match()``

Introduite par ``php 8.0``



## Utilisations possibles
- Pour remplacer un ``switch``:
```php
//Au lieu de:
public function doSomething() {
    switch ($number) {
        case 1: 
            return 'Number is 1';
            break;
        case 2: 
            return 'Number is 2';
            break;
    }
}

//On peut écrire:
public function doSomething() {
    return match($number) {
        1 => 'Number is 1',
        2 => 'Number is 2',
    }
}
```

