# Eloquent
+ C'est l'**ORM** (*Object-Relationnal Mapper*) utilisé par laravel pour la communication avec la base de données
+ L'interaction se fait au travers des modèles (dans ``app/models``)

## Récupérer toutes les données
Si on souhaite récupérer les données (exemple nos articles en bdd) pour les envoyer interpollés dans une variable en meme temps qu'on retourne la vue:
1. Dans ``PostController`` (ou n'importe quel controleur):
    + On déclare  le modèle qu'on va utiliser en début de document (après le namespace):
        - ``use App\Models\Post;``
    + On peut ensuite l'utiliser dans notre fonction (exemple index qui renvoie la liste de tous les articles sur la home page):
    ```php
    public function index() {
        $posts = Post::all();

        return view('blog', [
            'posts' => $posts //On peut utiliser n'importe quelle manière d'interpollation bien entendu
            
            //Pour tester le résultat on peut utiliser "die and dump" :"dd" pour observer ce que retourne la variable
            dd($posts)
        ])
    }
    ```
    + Notre route: ``Route:: get('/', [PostController::class, 'index'])->name('blog');`` redirigera sur la vue home avec la variable $posts
2. Dans notre vue (ici le blog)
    + Laravel nous renvoie la vue avec la variable ``$post`` on peut alors en extraire les infos, dans une boucle on extrait pour chque élément de la variable ses infos à l'aide de **méthodes** représentant les **titres des colonnes** souhaitées, on vérifie au préalalble qu'il y a bien des infos à afficher, en utilisant la **méthode ``count()``** sur notre variable
    ```php
    @section("wrapper")
    <h1>Nos articles</h1>

        @if ($posts->count() > 0)
            @foreach($posts as $post)
                <h3> {{ $post->title }} </h3>
            @endforeach
        @else
            <span>Rien à afficher</span>
        @endif

    @endsection
    ```

## Récupérer une donnée en particulier

### Avec find():
+ Exemple: sur un lien pour les titres du blog on souhaite récupérer l'article correspondant:
    - ``<a href={{ route('posts.show', ['id' => $post->id]) }}>{{ $post->title }}</a>``
    - Il va donc falloir créer la redirection pour la route posts.show avec l'id lié au post
1. On crée une route (si elle n'existe pas encore) avec une fonction show:
    - ``Route:: get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');``
2. Dans ``PostController`` on utilise find() pour trouver un élément par son id, ou (recommandé) findOrFail() qui renverra automatiquement une 404 si la page n'existe pas (exemple id passé par une personne mal intentionnée):
    ```php
    public function show($id) {
        $post = Post::findOrFail($id);

        return view('single', [
            'post' => $post
        ])
    }
    ```
3. Dans notre vue:
    ```php
    @section("wrapper")

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    @endsection
    ```

### Avec une clause where():
1. Dans ``PostController`` 
    + on utilise une clause ``where()`` qui a pour avantage de ne pas nécessiter l'id on peut donc rechercher un élément par son nom si on le souhaite, 
        - > Note: le '=' dans la clause ``where()`` est facultatif
    + puis on utilise ``get()`` pour récupérer l'nformation (elle n'est pas exploitable en l'état avec juste ``where``), ``get()`` renvoie une array de toutes les itérations trouvées correspondant au filtre ``where()``, 
    + dans le cas où on ne souhaite avoir qu'un seul élément on utilisera plutôt ``first()``, ou ``firstOrFail()`` pour renvoyer une 404 en cas d'échec 
     ```php
    public function show($id) {
        $post = Post::where('title', '=', 'Un titre')->firstOrFail();

        return view('single', [
            'post' => $post
        ])
    }
    ```
2. Dans notre vue:
    ```php
    @section("wrapper")

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    @endsection


## créer des données
+ On souhaite maintenant créer des articles
1. On créer une route avec une fonction ``create``, (attention dans le cas présent il faudrait la mettre avant la route /posts/{id} autrement le routing croira que create est l'id):
    + ``Route:: get('/posts/create', [PostController::class, 'create'])->name('posts.create');``
    + Donc quand on créera un lien vers posts.create cette route appellera la fonction create
2. On crée la fonction ``create()``:
    ```php
    public function create() {
        return view('add-post');
    }
    ```
3. On crée la vue ``add-post.blade.php`` dans laquelle on mettra notre formulaire pour créer un élément (exemple pour ajouter un titre et un contneu), **on oublie pas d'ajouter le jeton ``@csrf```pour sécuriser l'envoi automatiquement avec blade (cela créé un input hidden avec un token généré aléatoirement, cela permet de s'assurer que c'est bien la personne sur la session qui envoie les données ):
```php
<form method="POST" action={{ route('posts.store') }}>
    @csrf
    <input type="text" name="title">
    <textarea name="content" cols="30" rows="10"></textarea>
    <button type="submit">Créer</button>
</form>
```
4. On crée ensuite une nouvelle route pour ``POST`` les données du formulaire:
    - ``Route:: post('/posts/create', [PostController::class, 'store'])->name('posts.store');``

5. On crée la fonction store passée dans la route on pense à ajouter Request avec use si on a créé le controller manuelllement
    + **Méthode 1**:
    Dans ``PostController``:
    ```php
    use Illuminate\Http\Request;  //déjà ajouté par défaut quand on créé le contrôleur automatiquement , à ajouter sinon

    public function store(Request $request) {

        //On peut tester que la requete a bien eu lieu:
        dd($request->title);
        //ou 
        dd($request->content);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

    }
    ```

    + **Méthode 2 (recommandée)**:
    - Dans ``PostController``:
    ```php
    use Illuminate\Http\Request  //déjà ajouté par défaut quand on créé le contrôleur automatiquement , à ajouter sinon

    public function store(Request $request) {

        Post::create([
            'title'=> $request->title,
            'content'=> $request->content,
        ])

    }
    ```
    - Dans ``Post`` (Model) il faut déterminer qu'on veut que les colonnes title et content soient remplissables:
    ```php
    class Post extends Model
    {
        use HasFactory;

        //Ajouter:
        protected $fillable = ['title', 'content'];
    }
    ```

## Clause whereIn
``$products = Stock::whereIn('id', $array)->get();``

## Chaîner des méthodes
+ On peut chaîner des méthodes pour par exemple récupérer les 3 derniers articles rangés par titre, voir la doc pour la liste des méthodes dispo:
    ```php
    public function index() {
        $posts = Post::orderBy('title')->take(3)->get();

        return view('blog', [
            'posts' => $posts
        ])
    }
    ```

## Update un élément
+ La fonction nécessaire pour update:
    ```php
    public function update($id) {
        $post = Post::find($id);

        $post->update([
            'title' => 'new title',
        ]);

    }
  ```

## Supprimer un élément
+ Avec la méthode delete:
    ```php
    public function delete($id) {
        $post = Post::find($id);

        $post->delete()
    }
    ```
## Chercher des éléments dont les ids sont dans une liste
```php
$post = Post::whereIn('id', $ids)->get();
```