# Les contrôleurs

Il permettent de séparer la vue des fonctions (ainsi on a l'affichage d'un coté et le traitement de données de l'autre)


## Bases
+ On crée un fichier de controleur (ex: PostController) : ``app -> Http -> controllers -> PostController.php``, on étend nos contrôleurs depuis le contrôleur de base (ici dans un controleur nommé PostController):
    - Ex: on va pouvoir créer les fonctions pour renvoyer les routes
    ```php
    namespace App\Http\Controllers;

    class PostController extends Controller{
        public function index(){
            return view('articles) //pas besoin d'ajouter .blade.php
        }
    }
    ```

+ Quand on utilise une class ou un contrôleur il ne faut pas oublier de déclarer son utilisation en début de fichier:
    - ``use App\Http\Controllers\PostController;``  
    - puis quand on appelle notre route: ``Route:: get('/', [PostController::class, 'index']);``

+ On peut aussi créer des controlleurs avec php artisan:
Dans le terminal du projet: ``php artisan make:controller PostController`` (crée automatiquement le namepsace et le nom de la classe on a plus qu'a ajouter nos fonctions)

## Interpoller des variables dans une vue
Par exemple si on souhaite renvoyer la valeur d'un titre à l apage qu'on souhaite afficher , on peut déclarer une variable qu'on passera ensuite en argument
* interpoler une variable dans une vue:
    +  dans ``Controller``:
    ```php
    public function index()
    {
        $title = "titre";
        return view("articles", compact('title'));
    }

    //ou
        public function index()
    {
        $title = "titre";
        return view("articles") -> with('title', $title); //'title' est la clée et $title indique la variable qu'on veut ajouter
    }
     
    ``` 
* interpoler plusieurs variables:
    +  dans ``Controller``:
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
    ```
    
    + Puis dans la vue on interpolle notre variable (qui est issu de la clé donné en paramètre de with dans le cas ou on a utilisé with, qui est l'argument passé dans compact dans le cas ou on utilise compact) avec des doubles accolades:
    ```php
    @foreach($posts as $post)
        <h2>{{ $post }}</h2>
    @endforeach
     
    ``` 
