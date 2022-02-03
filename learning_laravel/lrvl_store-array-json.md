# Stocker des données sous forme d'array dans la bdd

- On a une table dans laquelle une valeur doit être transformée en array pour le stockage
```php
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id');
            $table->date('day');
            $table->text('morning_array');
        });
    }
```

- Dans le Model de la table, on définit le type array pour cette valeur, la valeur protégé ``$casts``:
```php
protected $casts = [
    'morning_array' => 'array',
];
```

- Laravel s'occupera de transformer nos array php en json pour les stocker dans la bdd et inversement pour les lire en retour 
```php
$menu = Menu::find(1);

$morning_menu = $menu->morning_array;

$menu->morning_array = ['1' => '25'];
```
