# Les relations Eloquent

## One to Many
1. Chaque entrée de la table principale peut avoir plusieurs entrées liées dans la table secondaire:
    - ex: une table **posts** peut avoir plusieurs commentaires qui lui sont liés dans une table **comments**, en revanche un commentaire n'est lié qu'à un seul article

2. Il faut d'abbord créer une relation entre nos deux tables
    + dans le ``Schema`` pour ``comment`` on ajoute une colonne avec un id renvoyant à ``posts``:
    ````php        
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->timestamps();

        //On ajoute une case id non auto-incrémentable, et on ajoute qu'elle est une clée étrangère faisant référence à la colonne id de la table posts, cette clé étrangère n'est pas obligatoirement sur l'id , mais généralement oui
        $table->unsignedBigInteger('post_id');
        $table->foreign('post_id')->references('id')->on('posts');

        //Ou alors si on est sur qu'on souhaite utiliser l'id et qu'on a suivi la convention de nommage classique (notre table principale s'appelle post et sa case id s'appelle id):
        $table->foreignId('post_id')->constrained();
    });
    ````
    + Puis
        - dans Model/Post (si on a pas suivi les conventions de nommage, on peut ajouter 'foreign_key' et 'owner_key', par défaut ce sera id pour owner_key et le nom du owner au singulier + _id pour la foreign_key):
        ```php
        use App\Models\Comment;

        class Post extends Model {
            ...

            public function comments(){ //Au pluriel
                return $this->hasMany(Comment::class, 'foreign_key', 'owner_key');
            }
        }
        ```
        - dans Model/Comment:
        ```php
        use App\Models\Post;

        class Comment extends Model {
            ...

            public function post(){ ///Au singulier
                return $this->belongsTo(Post::class, 'post_id', 'id');
            }
        }
        ```
3. Dans notre vue on peut alors utiliser un foreach (ou un forelse, afin de gérer les cas où il n'y a pas de données) pour afficher les différents commentaires en fonction de l'article
```php
//Après avoir récupéré le contenu du poste de la table poste
<p>{{ $post->content }}</p>

//On récupère les commentaires en chainant des méthodes:
@forelse($post->comments as $comment)
    <div>{{ $comment->content }}</div>
@empty
    //Ecrire ici le code si comments est vide, le forelse va déjà essayer la première vérif, si c'est vide il exécutera le @empty
@endforelse
```
- Si on souhaite récupérer un élément particulier on peut chainer des méthodes: exemple avec un dd():
``dd($posts[0]->comments[1]->title);`` : renvoie le titre du 2eme (index1) commentaire du premier (index0) article 

## One to One
Elle consiste à ne lier une seule entrée d'une table avec une seule entrée d'une autre table
- Exemple: une table images, pourrait stocker les thumbnails de chaque post d'une table post
- On met en place la relation de la meme façon que pour le One to Many:
```php
//Dans le model Post
public function image(){
    return $this->hasOne(Image::class);
} 

//Dans le model Image (note: on est pas obligé de définir les deux, si on sait qu'on utilisera uniquement une image depuis son article le premier suffit)
public function post(){
    return $this->belongsTo(Post::class);
}

``` 
- On pourra alors appeler l'url de l'image d'un article en appelant la méthode ``image()``: 
    + ``{{ $post->image->path }}``
- Ou récupérer le post lié à une image en appelant la méthode ``post()``:
    + ``{{ $image->post }}``


## Many to Many
+ Par exemple dans le cas d'une table ``users`` et d'une table ``roles``, un utilisateur peut avoir plusieurs roles et un rôle peut etre partagé par plusieurs utilisateurs
+ Cela consiste à ajouter une troisième table (*table pivot*) pour lier les 2 tables, par convention de nommage cette troisième table prend le nom des deux tables dans l'ordre alphabétique au singulier lié par un ``_``:
    - ici ce serait ``role_user``, dans cette table on met deux colonnes (on peut en mettre plus, mais ce sont les deux importantes): une colonne ``role_id`` et une colonne ``user_id``
+ On peut créer un model pour notre table pivot, avec sa migration (``php artisan make:model RoleUser -m``) ou créer seulement la migration si on a pas besoin du modèle php artisan make:migration create_role_user_pivot_table
+ Ensuite dans notre table pivot on ajoute nos 2 colonnes foreignId pour lier nos deux autres tables:
    - ``$table->foreignId('role_id')->constrained()->onDelete('cascade');``
    - et ``$table->foreignId('user_id')->constrained()->onDelete('cascade');``
+ Puis on définit les relations dans les ``models`` de chaque classe(table) (sans oublier le ``use`` pour les classes):
    - ``public function roles() {return $this->belongsToMany(Role::class);}`` pour la fonction roles de User
    - ``public function users() {return $this->belongsToMany(User::class);}`` pour la fonction users de Role
+ On peut ajouter après coup un role à un utilisateur déjà créé ou un utilisateur à un rôle déjà créé:
    - Pour attacher (id en premier paramètre et autre donnée facultative à update en meme temps en deuxième paramètre) : 
        - ``$user->roles()->attach($roleId, ['expires' => $expires]);``
        - attacher une liste d'ids : 
        ```php
        $user->roles()->attach([
            1 => ['expires' => $expires],
            2 => ['expires' => $expires],
        ]);
        ```
    - Pour détacher (supprimer la relation entre les deux sans supprimer aucune des deux entrées):
        - détacher un rôle donné: ``$user->roles()->detach($roleId);``
        - détacher tous les rôles: ``$user->roles()->detach();``
        - détacher une liste d'ids:
        ```php
        $user->roles()->detach([1, 2, 3]);
        ```
+ On peut mettre à jour les données de la table pivot:
    - Exemple si on ajoute un champ ``active`` dans la table pivot pour déterminer si ce role est actif pour cette utilisateur, on peut vouloir ne modifier que l'état (actif ou non) du role, sans le supprimer de l'utilisateur ni k'ajouter (s'il est déjà présent):
    ```php
    $user->roles()->updateExistingPivot($roleId, [
        'active' => true,
    ])
    ```
    - Si on ajoute un champ en plus dans une table pivot, il faut le déclarer dans la relation pour qu'on puisse le récupérer dans le model pivot:
    ```php
    public function users(){
        return $this->belongsToMany(Role::class)->withPivot('active', 'created_by');
    }
    ```
    - Si on veut ajouter un timestamp qui automatique sur notre table pivot:
    ```php
    public function users(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    ```

## One to many (polymorphic)
- Quand un modèle a plusieurs parents différents: exemple une table commentaire peut etre liée à une table vidéos et à une table articles en meme temps
- Dans la table commentaire on veut donc pouvoir stocker les commentaires des vidéos et ceux des artilces en meme temps car ils partagent une base commune (colonne titre, colonne contenu, auteur,..) 
- la seule différence est leur type (commentaires de vidéo ou d'articles), on va donc ajouter une colonne qui définira si cette entrée de la table comments doit etre reliée à videos ou à articles, et une colonne avec l'id lié à la table articles ou vidéos
- laravel va donc regarder dans laquelle des deux tables chercher puis en fonction de l'Id va regarder à quelle video ou article le commentaire est lié
- Le fonctionnement Polymorphique est le même pour n'importe quel type de relation:
    - On crée une table ``posts``, une table ``videos`` et une table ``comments`` commune aux deux:
        - posts
            - id (int)
            - title (string)
            - content (text)
        
        - videos
            - id (int)
            - title (string)
            - url (string)

        - comments
            - id (int)
            - content (text)
            - commentable_id (int): L'id correspondant à un des id soit de posts, soit de videos
            - commentable_type (string): le type de commentaires correspondant au nom de la table dans laquelle il faut chercher l'id (posts ou video)
        ```php
        //dans la migration pour créer la table comments:

        public function up()
        {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->string('content');
                $table->integer('commentable_id');
                $table->string('commentable_type');
            })
        }
        ```
    - Ensuite il faut définir les modèles pour les tables:
    ```php
    //Dans le model Comment
    public function commentable(){
        return $this->morphTo();
    } 

    //Dans le model Post (on oublie pas d'appeler la classe en déut de document)
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    //Dans le model Video la fonction comments est la même que dans posts (on oublie pas d'appeler la classe comment en déut de document)
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    ```
    - On peut ensuite ajouter des commentaires et les lier à nos posts ou videos (exemple avec une fonction register)
    ```php
    public function register()
    {
        $post = Post::find(11);
        $video = Video::find(1);

        $comment1 = new Comment(['content' => 'Random comment 1']);

        $comment2 = new Comment(['content' => 'Random comment 2']);
        $comment3 = new Comment(['content' => 'Random comment 3']);

        //On appelle la fonction comments() puis save() sur $post
        $post->comments()->save($comment1);

        //On appelle la fonction comments() puis saveMany() sur $video
        $post->comments()->saveMany([
            $comment2,
            $comment3            
        ]);
    }
    ```

## Has One Through (ou Has Many Through)
- Il s'agit d'une relation basée sur une relation **one to one** ou **one to many**, elles lient donc deux tables qui ont une relation commune avec une troisième table centrale
- On a 3 tables qui ont une relation entre elles:
    - La première a une relation avec la seconde
    - La seconde a une relation avec la troisième
    - La première peut donc également avoir une relation avec la troisième **à travers** la seconde
- Exemple:
    - Une table ``Post`` qui a plusieurs ``Images``
    - Une table ``Images`` qui est donc liée à ``Post`` et dont chaque image possède un ``Artist``
    - Une table ``Artist`` liée à ``Images``
    - On peut donc retrouver l'artiste d'une image liée à un poste
- Après avoir défini tous nos modèles on ajoute à ``Post`` la fonction qui permet de retrouver ``l'artiste`` via ``l'image``:
```php
//Dans Post (ne pas oublier d'importer les modèles d'artiste et d'image)
public function imageArtist()
{
    return $this->hasOneThrough(Artist::class, Image::class); //Arguments: One (artist), Through (image)
}
```

## Has One Of Many
- Cela consiste à combiner les relations **Has One** et **Of Many** dans le but de retrouver le plus récent ou le plus ancien élément
- Exemple si un article a plusieurs commentaires on peut vouloir afficher seulement le plus récent ou seulement le plus ancien:
    - Sur notre modèle **Post**, on crée donc une fonction pour définir la relation:
    ```php
    public function latestComment()
    {
        return $this->hasOne(Comment::class)->latestOfMany();
    }

    //Ou
    public function oldestComment()
    {
        return $this->hasOne(Comment::class)->oldestOfMany();
    }
    ```

### Utiliser ``create()`` et ``createMany()``
Quand on ajoute une entrée dans une table et qu'on souhaite ajouter des entrées dans les entrées en relation avec cette entrée parente, dans une autre table on peut:
- Insérer l'entrée puis récupérer son id (la méthode retourne l'objet créé) et ajouter des entrées avec cet id en guise de foreign_key:
```php
$menu = Menu::create([
    'day' => $day,
]);

$dish = Dish::create([
    'menu_id' => $menu->id,
    'meal_time' => $meal_time,
    'recipe_id' => $recipe_id,
    'portion' => $portion,
]);
```
- Ou on peut utiliser les relations eloquent pour ajouter directement au modèle parent (en profitant de la relation hasOne/belongsTo qu'on a mis en place), on a donc pas besoin d'entrer le foreign ID qui sera automatiquement ajouté par laravel:
```php
//Pour ajouter une entrée
$menu = Menu::create([
    'day' => $day,
])->dishes()->create([
    'meal_time' => $meal_time,
    'recipe_id' => $recipe_id,
    'portion' => $portion,
]);

//Pour ajouter plusieurs entrées
$menu->createMany([
    [
        'meal_time' => $meal_time,
        'recipe_id' => $recipe_id,
        'portion' => $portion,
    ],
    [
        'meal_time' => $meal_time2,
        'recipe_id' => $recipe_id2,
        'portion' => $portion2,
    ],
]);
```

### ``UpdateOrCreate()`` et ``upsert()``
On peut utiliser ``updateOrCreate()`` pour mettre à jour une table: si une entrée existe elle sera mise à jour, sinon elle sera créée avec les données fusionnées de la vérification (1er argument) et des données à mettre à jour (2eme argument)
```php
//Ajouter ou mettre à jour l'entrée d'ID 1 de la table dishes:
$menu = Dish::updateOrCreate(
    ['menu_id' => '1'],
    ['recipe_id' => 3, 'portion' => 4]
);

//Ajouter plusieurs entrées (1er argument: les entrées à modifier ou ajouter, 2eme: les colonnes sur lesquelles on vérifie, 3eme: les valeurs à modifier)
Dish::upsert(
    [
        ['menu_id' => 1, 'recipe_id' => 2, 'portion' => 4],
        ['menu_id' => 1, 'recipe_id' => 3, 'portion' => 5]
    ],
    ['menu_id'],
    ['recipe_id', 'portion']
);
```