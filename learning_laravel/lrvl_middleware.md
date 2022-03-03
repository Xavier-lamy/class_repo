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

## Middleware dans un controller
Au lieu de vérifier si un utilisateur est connecté avec ``Auth::check()`` au début de chaque méthode d'un controlleur on peut définir des middlewares au début du controlleur dans le constructeur (``__construct``):
- Au lieu de:
```php
class FrontController extends Controller
{
    /**
     *  Display the shopping list
     */ 
    public function index() {
        if (Auth::check()){
            $user_id = Auth::user()->id;

            $products = Command::where([
                'must_buy' => 1,
                'user_id' => $user_id,
            ])->get();

            return view('front', [
                'products' => $products,
            ]);
        }
        abort(404);
    }
}
```
- On peut utiliser:
```php
class FrontController extends Controller
{
    public function __construct() {
        //Force use of authentication with middleware
        $this->middleware('auth');
    }

    /**
     *  Display the shopping list
     */ 
    public function index() {
        $user_id = Auth::user()->id;

        $products = Command::where([
            'must_buy' => 1,
            'user_id' => $user_id,
        ])->get();

        return view('front', [
            'products' => $products,
        ]);
    }
}
```
- On peut définir des méthodes non impactées par le middleware:
```php
$this->middleware('log')->only('index');
```
- Ou bien ne définir le middleware que pour certaines méthodes
```php
$this->middleware('subscribed')->except('store');
```