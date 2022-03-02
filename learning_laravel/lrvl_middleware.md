# Les middlewares
Ils servent d'intermédiaire pour les requetes HTTP, exemple si l'utilisateur n'est pas connecté, il ne pourra pas accéder à une route qui inclu u midleware de vérification authentification

+ les middleware de bases sont déjà créés dans laravel mais on peut créer les notres

+ Pour créer un middleware pour un groupe de routes on peut l'assigner de la manière suivante (exemple pour un middleware d'authentification):
```php
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });
 
    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});
```

+ on peut également mettre une array si on veut plusieurs middleware sur le meme groupe de routes