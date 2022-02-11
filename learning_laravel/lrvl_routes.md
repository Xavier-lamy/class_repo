# Le routing laravel

## Bases
Dans ``routes/web.php`` on peut définir des routes c'est à dire qu'on déclare quelle page renvoyée en fonction de l'url:
```php
//Pour renvoyer sur l'accueil (on est pas obligé de mettre le slash):
Route::get('/', function() {
    return view('welcome');
})

//Pour renvoyer sur une page contact (on est pas obligé de mettre le slash):
Route::get('/contact', function() {
    return view('contact');
})

//On peut aussi renvoyer autre chose qu'une page , ex: du json:
Route::get('infos', function() {
    return response()->json([
        'title' => 'un titre',
        'content' => 'le contenu'
    ]);
})
```

## Routing avancé avec les contrôleurs
Dans :``app -> http -> controllers -> PostController.php`` on déclare une fonction index
```php
namespace App\HTTP\Controllers;

class PostController extends Controller{
    public function index(){
        return view('front-page');
    }
}
```

+ Puis dans web.php on déclare nos routes:
    - ``Route:: get('/', App\HTTP\Controllers\PostController@index)`` @index réfère à la fonction, docn dès qu'on arrive sur la racine du site on renvoie la front page

+ Ou alors on appelle notre namespace en début de document pour pouvoir le réutiliser après:
    - ``use App\HTTP\Controllers\PostController;``  
    - puis quand on appelle notre route: ``Route:: get('/', [PostController::class, 'index']);``

## Routes avec paramètres:
``Route::get('/posts{id}', [PostController::class, 'show'])->whereNumber('id);`` ici on indique que le paramètre 'id' doit etre un entier, ce qui évite d'avoir a faire des vérifs a chaque fois 

## Nommer les routes:
+ On peut donner un nom à nos routes:
    - dans web.php:
    ``Route:: get('/', [PostController::class, 'index'])->name('front');``
    - Puis une fois nommée quand on a bseoin de l'intégrer dans une url on utilise:
    ``href = {{ route('front') }}``

## Redirection avec message de session
+ dans la fonction du controleur: ``return redirect('safety-stocks')->with('success', 'Product successfully added !');``
+ Pour récupérer dans notre vue:
```php
@if(session('error') !== null)
    <div class="alert--message my--2 p--2">
        {{ session('error') }}
    </div>
@elseif(session('success') !== null)
    <div class="alert--success my--2 p--2">
        {{ session('success') }}
    </div>
@endif
```

+ Dans le cas où on fait nous même une redirection dans notre controleur et qu'on souhaite récupérer les anciennes données d'une requête avec ``old()`` dans la vue, il faut penser à ajouter ``withInput()`` à la redirection, (note: ceci n'est pas nécessaire si la redirection est la redirection de base de laravel en cas d'échec de validation):
```php
    return redirect('recipe/modify/'.$recipe_id)
        ->withInput() //Renvoie les données de la requête, on peut ensuite les récupérer avec old
        ->with('error', 'All ingredients should have same unit !');
```

## Route avec paramètre (ex: $id)
+ Dans notre vue on a un lien avec un id passé en second paramètre:
    - ``<a href=" {{ route('stock.modify', ['id' => $product->id]) }} " class="button--sm">Modify</a>``
+ Dans web.php on a une route avec l'argument entre accolades:
    - ``Route:: get('/stocks/modify/{id}', [FrontController::class, 'modify_stock_product'])->name('stock.modify');``
+ Dans notre contrôleur on a notre fonction avec le paramètre passé en argument:
``` 
public function modify_stock_product($id) {
    $products = Stock::all();

    return view('stocks', [
        'products' => $products,
        'modifying_product_id' => $id,
    ]);
}
```

## Les **resources routes**
+ On peut créer simplement toute les routes d'un crud en en déclarant une seule avec ``resource``:
    - Par exemple après avoir utiliser : ``php artisan make:controller StockController --resource`` pour créer un *controler* pour les stocks avec toutes les méthodes de CRUD
    - On peut alors utiliser la déclaration de route suivante afin de déclarer chaque route pour chaque méthode
    ```php
    use App\Http\Controllers\PostController;
    
    Route::resource('posts', PostController::class);
    ```
    - On peut vérifier la présence de ces routes avec: ``php artisan route:list``
+ On peut aussi créer les routes pour plusieurs contrôleurs avec une array:
```php
Route::resources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);
```
+ On peut exclure des méthodes en précisant seulement celles qu'on veut ou celles qu'on ne souhaite pas:
```php
use App\Http\Controllers\PhotoController;
 
Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
]);
 
Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
]);
```

## Groupe de routes
### Controllers
+ On peut grouper les routes par contrôleur pour n'avoir que la méthode à écrire à chaque fois:
```php
use App\Http\Controllers\OrderController;
 
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});
```