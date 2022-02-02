# Laravel

- Quand on a beaucoup de variable pour des routes en laravel on peut utiliser ``get_defined_vars()`` pour renvoyer toutes les variables définies dans la fonction

- laravel daily: chaine youtube

# A retravailler

- penser au ``@csrf`` ppour les formulaires laravel, ajouter ``{{old('value')}}``

## Installer un nouveau projet;
- ``composer create-project laravel/laravel example-app``
- ``cd example-app``
- ``php artisan serve``
- créer la db et la linker dans le ``.env``
- ``php artisan migrate``

## Installer laravel sur un projet existant
dans le dossier du projet;
- ``composer install``
- ``php artisan serve``
- créer la db
- linker dans le ``.env``
- ``php artisan key:generate``
- ``php artisan migrate``


## Liens et images:
- ``href = {{route(  )}}``
- ``img src = {{asset(  )}}``

## Divers 
- le path de laravel est dans le dossier public (donc pas besoin d'ajouter ``public`` devant nos path)
- les templates des vues vont dans ``views``: on peut utiliser ``blade`` pour avoir accès à de nombreuses fonctionnalités: ``.blade.php``
- `` php artisan`` = liste des commandes possibles

## Exemple d'héritage:
```
/*dans app.blade.php  ====> dans home.blade.php*/
                            @extend("app") //pas besoin de .blade.php
@section('nom')  =========> @section('nom')
...                           value
@show            =========> @endsection


//Ou 
@yield("content") =========> @section("content", "value")

//Ou
@yield("content") =========> @section("content")
                                value
                             @endsection
```

## Laravel controller
+ dans: ``app -> http -> controllers -> exampleControllers.php``
```
namespace App\HTTP\Controllers;

class PostController extends Controller{
    public function index(){
        return view('articles)
    }
}
```

## Routes
On reprend le retour de vue déclarée dans le controller
- ``Route:: get('/', App\HTTP\Controllers\PostController@index)`` @index réfère à la fonction

## Créer une classe avec php artisan
- ``php artisan make:controller PostController``

## A retravailler:
* interpoler une variable dans une vue:
    -  dans ``Controller``:
    ```
    public function index()
    {
        $title = "titre";
        return view("articles", compact('title'));
    }

    //ou
        public function index()
    {
        $title = "titre";
        return view("articles") -> with('title', $title);
    }
     
    ``` 
* interpoler plusieurs variables:
    -  dans ``Controller``:
    ```php
    public function index()
    {
        $title1 = "titre 1";
        $title2 = "titre 2";
        return view("articles", compact('title1', 'title2'));
    }

    //ou
    public function index()
    {
        $title1 = "titre 1";
        $title2 = "titre 2";
        return view("articles", [
            title1 => $title1,
            title2 => $title2
        ]);
    }

    //ou 
    public function index()
    {
        $posts = [
            "titre 1",
            "titre 2"
        ];
        return view("articles", compact('posts'));
    }
    //puis dans la vue:
    @foreach($posts as $post)
        <h2>{{ $post }}</h2>
    @endforeach
     
    ``` 
