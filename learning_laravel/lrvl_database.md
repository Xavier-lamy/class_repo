# Les bases de données

## Préparation
- On vérifie dans le ``.env`` que les infos de liaison à notre base de données sont correctes (en fonction du type de bdd qu'on veut: MySQL, SQLite,.. on pourra changer ça dans ``config/database.php``) 

## Migrations
Sorte de version control pour les bdd laravel, elles nous permettent de créer nos tables et/ou de les mettre à jour, les fichiers des migrations peuvent suivre des modèles (situés dans ``app/models``): pour créer un modèle (``Post``) et la migration (avec une table ``posts``) qui va avec:
- ``php artisan make:model Post -m``

Dans les migrations laravel utilise **la facade ``schema``** pour créer, supprimer,... les tables, la classe blueprint sert pour définir les types de champs de la table elle possède des fonctions pour retourner par exemple un type booléen, text,...:
````php        
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique(); //On peut ajouter des méthodes, ici pour rendre la valeur unique
    $table->timestamp('email_verified_at')->nullable(); //Ici pour autoriser une valeur NULL
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
````
- Ensuite on utilise ``php artisan migrate`` quand on doit migrer les tables c'est à dire les créer à partir des migrations
- On a aussi ``php artisan migrate:reset`` pour revenir à zéro
- ``php artisan migrate:refresh`` pour revenir à zéro puis effectuer une migration
- les migrations permettent de pouvoir charger les tables sur chaque environnment de développement
- si on a besoin de modifier une valeur dans une table (exemple paser une valeur en unique après coup), il faut ajouter cela dans le ``model``
- Exemple: par défaut la table dans les migrations prend pour nom le nom du modèle sans majuscule et mis au pluriel, on peut changer ça
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['ingredient', 'quantity', 'unit', 'alert_stock', 'must_buy']; //Indique quels champs protégés sont remplissables

    public $timestamps = false; //Retire le timestamp des tables

    protected $table = 'all_posts'; //change le nom par défaut de la table (posts) par un custom
    protected $primaryKey = 'commands_id'; //change le nom de la colonne clé primaire (id) par un custom
}
```

## Créer une relation entre des tables 
### Exemple dans le cas d'une relation ``one to many`` (voir relationships pour le reste):
+ On peut créer une relation entre deux tables avec une clé étrangère, càd que la table secondaire aura une colonne qui rapellera une des colonnes de la table principale (généralmeent l'id)
+ dans le ``Schema`` pour ``comments`` on ajoute une colonne avec un id renvoyant à posts:
````php        
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->timestamps();

    //Onn ajoute une case id non auto-incrémentable, et on ajoute qu'elle est une clée étrangère faisant référence à la colonne id de la table posts, cette clé étrangère n'est pas obligatoirement sur l'id , mais généralement oui
    $table->unsignedBigInteger('post_id');
    $table->foreign('post_id')->references('id')->on('posts');

    //Ou alors si on est sur qu'on souhaite utiliser l'id et qu'on a suivi la convention de nommage classique (notre table principale s'appelle post et sa case id s'appelle id):
    $table->foreignId('post_id')->constrained();
});
````
+ Puis
    - dans Model/Post:
    ```php
    use App\Models\Comment;

    class Post extends Model {
        ...

        public function comments(){
            return $this->hasMany(Comment::class);
        }
    }
    ```
    - dans Model/Comment:
    ```php
    use App\Models\Post;

    class Comment extends Model {
        ...

        public function post(){
            return $this->belongsTo(Post::class);
        }
    }
    ```
### Supprimer toutes les entrées de la table secondaire liées à la table principale 
On peut utiliser la méthode ``->onDelete('cascade')`` après ``constrained()`` pour déterminer qu'on souhaite la suppression des entrées liées quand l'entrée principale a été supprimée:
- Exemple avec une table "image" dont chaque entrée est liée à un article de "post":
```php 
//Dans la migration à la création de la table:
public function up(){
    Schema::create('images', function(Blueprint $table){
        $table->id();
        $table->string('path')->default('img.png'); //On peut ajouter la méthode default pour spécifier une valeur par défaut
        $table->foreignId('post-id')->constrained()->onDelete('cascade'); //Ici après avoir déterminé une colonne d'Id étranger que l'on contraint avec m'ID de "post", on détermine que l'on souhaite la supression de l'image automatiquement quand on supprime le post (suppression en cascade)
    })
}
``` 

## Factories
Il s'agit de classes qui servent à générer des données qu'on inscrit dans la bdd, (exemple ajouter des faux articles lorem impsum pour les tests), on peut les trouver dans ``database/factories``
- Ca reessemble aux ``fixtures`` d'autres langages
- les factories utilise entre autres, la méthode ``faker`` (``$this->faker->name``) pour générer du faux contneu aléatoire, exemple pour créer une factory pour créer des articles, il s'agit d'un plugin directement intégré à laravel
- ``php artisan make:factory PostFactory --model=Post`` : l'option --model=Post permet à artisan d'ajouter automatiquement le nom du modèle (contenu dans ``app/models``), notre factory va suivre le modèle avec le contenu aléatoirec choisi pour créer ce contneu quand on l'aura appelé
- une fois la factory créée si on souhaite lancer des instances de notre factory:
    + ``php artisan tinker`` qui permet de renvoyer du code depuis la console: on peut donc lui donner un ordre: ``Post::factory()->count(10)->create();`` laravel comprends alors qu'on souhaite lancer 10 articles aléatoires suivant la factory, pour nos test 
- Exemple de factory:
```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
```

## Seeders
- Ils permettent de remplir la base de données avec des données (générés à la main ou automatiquement avec une factory)
- ``php artisan make:seeder UserSeeder`` pour générer un seeder (trouvables dans ``database/seeders``)
- On peut aussi appeler des classes de seeder dans un seeder général, pour pouvoir diviser en plusieurs petites parties
- Exemple de seeder
```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Run the database seeders.
     *
     * @return void
     */
    
    //De base:
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }

    //Avec une factory:
    public function run()
    {
        User::factory()
                ->count(50)
                ->hasPosts(1)
                ->create();
    }

    //En appelant d'autres classes de seeders
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
```
- Pour exécuter une seed: 
    - ``php artisan db:seed``: lance la classe par défaut (``Database\Seeders\DatabaseSeeder``)
    - ``php artisan db:seed --class=UserSeeder``: lance une classe spécifiée
    - ``php artisan migrate:refresh --seed``: lance un refresh des migrations puis un seeding

