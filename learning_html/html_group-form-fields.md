# Grouper des champs de formulaire
Exemple: On souhaite ajouter plusieurs utilisateurs avec leurs noms et prénoms , on pourra ajouter autant d'utilisateur que l'on souhaite, afin de récupérer les champs liés à un utilisateur, on peut utiliser une syntaxe d'array pour nommer les champs:
```html
<!--On créé ici une réponse qui est une array 'user' qui contient en clé 1 le nom et prénom de la personne 1 et en en clé 2 le nom et prénom de la personne 2-->
User 1:
<label>First name</label>
<input name="user[1][first_name]">

<label>Last name</label>
<input name="user[1][last_name]">

User 2:
<label>First name</label>
<input name="user[2][first_name]">

<label>Last name</label>
<input name="user[2][last_name]">
```

Cela retourne une array en backend:
```js
user = [
    [
        'first_name' => 'Bob',
        'last_name' => 'Bab',
    ],
    [
        'first_name' => 'Bib',
        'last_name' => 'Beb',
    ]
]
```

```php
$user = array(
    array(
        'first_name' => 'Bob',
        'last_name' => 'Bab',
    ),
    array(
        'first_name' => 'Bib',
        'last_name' => 'Beb',
    )
);
```

