# Laravel sanctum

- Laravel sanctum est un système d'authentification par token pour créer des API avec Laravel

- Inspiré du tuto (Laravel 8 - Sanctum API Authentication Tutorial)[https://www.laravelcode.com/post/laravel-8-sanctum-api-authentication-tutorial] et (Building a Role-Based REST API with Laravel Sanctum)[https://www.amezmo.com/laravel-hosting-guides/role-based-api-authentication-with-laravel-sanctum]

- L'objectif de cette doc est de réaliser une api similaire avec sanctum+laravel ui, mais avec 2 modèles au lieu d'un, les deux modèles ont une relation, et on voit aussi pour ajouter des paramètres en url quand on récupère la liste des items

- Pour le modèle on prend des musiques qui ont pour modèles parents un groupe, quand on récupère avec l'url on doit pouvoir récupérer des musiques, dans les infos retournées on trouve le détail du groupe, les paramètres qu'on peut mettre sont le genre (all ou défini), le nombre de musiques souhaitées (all ou nombre)

## 1. Créer le projet
```
composer create-project laravel/laravel music-api
```

## 2. Installer les dépendances nécessaires
- Obligatoire:
```
composer require laravel/sanctum
```

- Optionnel: Si une identification avec une interface est nécessaire par la suite dans le back end du projet on peut aussi installer laravel ui (et désactiver temporairement les routes tant qu'on a pas besoin):
```
composer require laravel/ui
php artisan ui:auth
```

## 3. Créer la base de données et la lier dans le .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=music-api
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Mettre en place la configuration de laravel sanctum
- Publier la configuration:
```
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

- Enregistrer le middleware de Sanctum en décommentant la ligne de laravel sanctum (``\Laravel\Sanctum\Http...``) dans ``app/Http/Kernel.php`` (ou l'ajouter si elle n'est pas présente sur des laravel plus anciens)
```php
protected $middlewareGroups = [
//[...]
    'api' => [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
//[...]
];
```

## 5. Exécuter les migrations pour créer les tables pour Sanctum
```
php artisan migrate
```

## 6. Ajouter la class HasApiTokens dans le modèle User
- ou vérifier qu'elle soit présente, sur les versions plus récentes elle semble se mettre à la config de Sanctum
```php
//app\Models\User.php
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// sanctum
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
```

## 7. Créer les modèles avec leur migration
```
php artisan make:model Group -m
php artisan make:model Music -m
```
- Dans la migration de ``group``:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('creation_date');
            $table->string('members_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
```
- Dans la migration de ``Music``:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('length');
            $table->string('genre');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['group_id']);
        Schema::dropIfExists('musics');
    }
};
```

- Dans le modèle de ``Group`` ajouter les champs remplissables ainsi que la relation avec ``Music``:
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creation_date',
        'members_amount',
    ];

    public function musics()
    {
        return $this->hasMany(Music::class, 'group_id', 'id');
    }
}
```

- Dans le modèle de ``Music`` faire de même pour les champs et la relation avec ``Group``
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'length',
        'genre',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
```

## 8. Exécuter les migrations
```
php artisan migrate
```

## 9. Construire les ressources pour l'API
- Créer le fichier de ressources pour chaque modèle:
```
php artisan make:resource Group
php artisan make:resource Music
```
- Dans ces fichiers on ajoute alors la fonction qui permettra à l'appli de savoir quelles données JSON retourner
    - Dans ``app\Http\Resources\Group.php``:
    ```php
    <?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class Group extends JsonResource
    {
        /**
        * Transform the resource into an array.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
        */
        public function toArray($request)
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'creation_date' => $this->creation_date,
                'members_amount' => $this->members_amount,
                'musics' => $this->musics,
            ];
        }
    }
    ```
    La dernière ligne renverra toutes les musiques qui sont liées à ce groupe avec leurs infos

    - Dans ``app\Http\Resources\Music.php``: 
    ```php
    <?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class Music extends JsonResource
    {
        /**
        * Transform the resource into an array.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
        */
        public function toArray($request)
        {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'length' => $this->length,
                'genre' => $this->genre,
                'group' => $this->group,
            ];
        }
    }
    ```
    la dernière ligne utilisera la relation belongsTo pour renvoyer la liste JSON des infos du groupe

## 10. Créer les controlleurs
- Créer un dossier ``API`` dans le dossier ``App\Http\Controllers``
- Créer un fichier ``BaseController.php``, ``AuthController.php``, et un fichier pour chaque modèle (``GroupController.php`` et ``MusicController.php``)
- Dans ``BaseController.php``:
```php
<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}

```
- Dans ``AuthController.php``:
```php
<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
   
class AuthController extends BaseController
{

    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('music-api')->plainTextToken; 
            $success['name'] =  $authUser->name;
   
            return $this->sendResponse($success, 'User signed in');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('music-api')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User created successfully.');
    }
   
}
```
- Dans ``GroupController.php``:
```php
<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\Group;
use App\Http\Resources\Group as GroupResource;
   
class GroupController extends BaseController
{

    public function index()
    {
        $groups = Group::all();
        return $this->sendResponse(GroupResource::collection($groups), 'Groups fetched.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'members_amount' => 'required',
            'creation_date' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $group = Group::create($input);
        return $this->sendResponse(new GroupResource($group), 'Group created.');
    }
   
    public function show($id)
    {
        $group = Group::find($id);
        if (is_null($group)) {
            return $this->sendError('Group does not exist.');
        }
        return $this->sendResponse(new GroupResource($group), 'Group fetched.');
    }
 
    public function update(Request $request, Group $group)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'members_amount' => 'required',
            'creation_date' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $group->name = $input['name'];
        $group->members_amount = $input['members_amount'];
        $group->creation_date = $input['creation_date'];
        $group->save();
        
        return $this->sendResponse(new GroupResource($group), 'Group updated.');
    }
   
    public function destroy(Group $group)
    {
        $group->delete();
        return $this->sendResponse([], 'Group deleted.');
    }
}
```
- Dans ``MusicController.php``: on imagine que les urls d'appels de musiques auront la forme suivante: ``http://host/api/musics/?num=10&genre=rap``
```php
<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\Music;
use App\Http\Resources\Music as MusicResource;
use Illuminate\Support\Str;
use Carbon\Carbon;
   
class MusicController extends BaseController
{
    public function index()
    {
        //fetch url num parameter
        $num = request()->num;
        if(empty($num) || !is_numeric($num)){
            //Set limit of musics to maximum (all), if num is not a number
            $num = PHP_INT_MAX;
        }

        //Fetch genre from url parameters
        $genre = request()->genre;       

        $musics = Music::where('title', 'LIKE', "%{$tag}%" )->take($num)->get();
        return $this->sendResponse(MusicResource::collection($musics), 'Musics fetched.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'length' => 'required',
            'genre' => 'required',
            'group_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $music = Music::create([
            'title' => $input['title'],
            'length' => $input['length'],
            'genre' => $input['genre'],
            'group_id' => $input['group_id'],
        ]);
        return $this->sendResponse(new MusicResource($music), 'Music created.');
    }
   
    public function show($id)
    {
        $music = Music::find($id);
        if (is_null($music)) {
            return $this->sendError('Music does not exist.');
        }
        return $this->sendResponse(new MusicResource($music), 'Music fetched.');
    }
 
    public function update(Request $request, Music $music)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'length' => 'required',
            'genre' => 'required',
            'group_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $music->title = $input['title'];
        $music->length = $input['length'];
        $music->genre = $input['genre'];
        $music->group_id = $input['group_id'];
        $music->save();
        
        return $this->sendResponse(new MusicResource($music), 'Music updated.');
    }
   
    public function destroy(Music $music)
    {
        $music->delete();
        return $this->sendResponse([], 'Music deleted.');
    }
}

```



## 11. Créer les routes d'API:
- Dans ``routes/api.php`` ajouter les routes pour l'api:
```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\MusicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
     
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('groups', GroupController::class);
    Route::resource('musics', MusicController::class);
});
```

## 12. Utilisation:
- On peut tester dans postman
- On peut utiliser une commande curl:
```curl
curl "http://localhost:8000/api/musics/?num=10&genre=pop" 
    -H "Accept: application/json"
    -H "Authorization: Bearer {token}"
```
- On peut utiliser du code php avec la bibliothèque ``curl`` (doc à continuer)
- On peut utiliser du Javascript (doc à continuer)