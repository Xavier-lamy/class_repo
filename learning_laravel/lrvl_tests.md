# Les features tests et les tests unitaires

- Laravel utilise phpunit, installé avec les dépendances en mode développement

- Les tests se trouvent dans le dossier ``tests`` puis dans des sous dossiers (``feature`` et ``unit``)

- Les tests que l'on crée doivent étendre la classe ``TestCase`` qui étend la classe ``CreatesApplication`` (qui se charge de créer une fausse appli pour l'environnement de test)

- Les tests se déroulent en 3 étapes:
    - Initialisation des données (ex: ``$numbers = [10, 40, 20];``)
    - Manipulation des données (ex: ``$result = array_sum($numbers);``)
    - Test du résultat à l'aide d'une **assertion** (ex: ``$this->assertEquals(70, $result);``)

- Si on souhaite avoir plus d'infos sur l'échec d'un test on peut ajouter ``$this->withoutExceptionHandling();``

- On peut créer directement un nouveau test (pour n'avoir que le contenu du test à changer) avec: ``php artisan make:test NameControllerTest``

- **Attention** depuis laravel 7 phpunit, n'exécute par  défaut que les tests dont le nom de fichier termine par ``Test.php``, le nom des méthodes de test doit commencer par ``test``, sinon il faut ajouter ``@test`` dans le commentaire de description  

## Créer un environnemnt de test
- Il est recommmandé de créer un environnement de test différent de l'environnement de développement (afin d'avoir une base de données séparée du reste), il faut penser à l'exclure de git sur ``.gitignore``:
    - Créer un fichier ``.env.testing``:
    ```
    APP_NAME=Laravel
    APP_ENV=testing
    APP_KEY=
    APP_DEBUG=true
    APP_URL=http://localhost

    LOG_CHANNEL=stack

    DB_CONNECTION=sqlite
    DB_DATABASE=database/test.sqlite

    BROADCAST_DRIVER=log
    CACHE_DRIVER=array
    SESSION_DRIVER=array
    SESSION_LIFETIME=120
    QUEUE_DRIVER=sync

    MAIL_DRIVER=array
    ```
    - ``php artisan key:generate --env=testing`` pour générer une clé pour l'environnement de test (si on ne met pas l'env de testing sur github on peut reprendre celle de l'environnement de dev)
    - Créer la bdd ``test.sqlite`` dans ``database``
    - ``php artisan migrate --seed --env=testing``: pour faire les migrations sur **l'environnment de test**

## Assertions
#### Assertions les plus courantes:
- ``assertTrue(bool $condition[, string $message = ''])``: Signale une erreur si ``$condition`` est false

- ``assertFalse(bool $condition[, string $message = ''])``: Signale une erreur si ``$condition`` est true

- ``assertEquals(mixed $expected, mixed $actual[, string $message = ''])``: Signale une erreur si les deux variables $expected et $actual ne sont pas égales

- ``assertArrayHasKey(mixed $key, array $array[, string $message = ''])``: Signale une erreur si le tableau $array ne dispose pas de la clé $key

- ``assertGreaterThan(mixed $expected, mixed $actual[, string $message = ''])``: Signale une erreur si la valeur de $actual n’est pas plus élevée que la valeur de $expected

- ``assertContains(mixed $needle, Iterator|array $haystack[, string $message = ''])``: Signale une erreur si $needle n’est pas un élément de $haystack

- ``assertNull(mixed $variable[, string $message = ''])``: Signale une erreur si $variable n’est pas null

- ``assertFileExists(string $filename[, string $message = ''])``: Signale une erreur si le fichier spécifié par $filename n’existe pas.

- ``assertRegExp(string $pattern, string $string[, string $message = ''])``: Signale une erreur si $string ne correspond pas a l’expression régulière $pattern

- ``assertDatabaseHas('users', ['name' => 'Bob'])``: Vérifie que la base de données possède une entrée avec pour nom Bob dans la table ``users``

- ``assertDatabaseCount('users', 5)`` : vérifie que le nombre d'entrées dans ``users`` est égal à 5

- ``assertDatabaseMissing('users', ['name' => 'Bob'])``:  vérifie que la bdd ne possède pas d'entrée avec un utilisateur nommé Bob dans la table ``users``

- ``assertDeleted($user)`` : vérifie la suppression d'une entrée de la base de donnée (récupérée sous la forme d'un model Eloquent au préalable)

- ``assertSoftDeleted($user)`` : vérifie le "soft delete" d'une entrée de la base de donnée (récupérée sous la forme d'un model Eloquent au préalable)

- [Liste complète des assertions sur la doc de phpunit](https://phpunit.readthedocs.io/fr/latest/assertions.html)
- [Liste complète des assertions propre à laravel](https://laravel.com/docs/8.x/http-tests#available-assertions)

#### Exemples d'utilisation
- On les utilise généralement sur l'objet de test (avec ``$this->assertMethod()``)
- ``$this->assertTrue(Str::startsWith($tested_start_by_chicken, 'cow');``->**fail**
- ``$this->assertFalse(Str::startsWith($tested_start_by_chicken, 'cow');``->**success**
- ``$this->assertSame(Str::startsWith($tested_start_by_chicken, 'cow'), false);``->**success**
- ``$this->assertStringStartsWith('cow', $tested_start_by_chicken);``->**fail**
- ``$this->assertStringEndsWith('cow', $tested_start_by_chicken_end_by_cow);``->**success**


## Tests sur les routes
- Dans le dossier feature on utilise une assertion de laravel: ``assertSuccessful``
```php
public function testRouteSuccess()
{
    $response = $this->get('/'); // On récupère la réponse (le return renvoyé par la route '/', pour l'exemple on return juste le mot "chicken")
    $response->assertSuccessful(); // On vérifie qu'on est une réponse type 200
    $this->assertEquals('chicken', $response->getContent()); // On vérifie que le contenu de notre réponse soit bien celui attendu
}
```
- Tester une redirection:
```php
public function testRedirectionSuccess()
{
    $response = $this->post('/contact/form'); // On récupère la réponse)
    $response->assertStatus(302); // On vérifie qu'on est une réponse type 302 (redirection temporaire)
}
```

## Tests sur les vues
- Si on a une route qui renvoie une vue, ex:
```php
//Route dans web.php
Route::get('/', function () {
    return view('welcome')->with('error', "Didn't say hello");
});

//Vue welcome.blade.php
{{ $error }}
``` 
- On peut alors vérifier que la vue en question a bien ce message:
```php
public function testViewHasErrorMessage()
{
    $response = $this->get('/');
    $response->assertViewHas('error', "Didn't say hello");
} 
```

## Tests sur les contrôleurs
- Si on a ce contrôleur:
```php
//Dans WelcomeController
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}

//Dans web.php
use App\Http\Controllers\WelcomeController;
Route::get('welcome', [ WelcomeController::class, 'index']);
```
- On peut alors vérifier dans un test ``WelcomeControllerTest`` si la fonction index() fait bien ce qui est attendu
```php
public function testIndex()
{
    $response = $this->get('welcome');
    $response->assertStatus(200);
}
```

## Isolement des tests
- Il est important d'isoler et spécialiser nos tests, en ne testant qu'une chose à la fois
- Pour cela on peut utiliser ``Mockery`` inclu avec les dépendances de la version dev de laravel, cela permet de simuler le comportement d'une classe
- Exemple dans le code suivant le controlleur fait appel à une classe custom, donc il faudrait que le test fasse appel à deux fichiers, ce qui enfreint son rôle de test *unitaire*
```php 

//Dans le controller WelcomeController
namespace App\Http\Controllers;
 
use App\Models\CustomClass;
 
class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
 
    public function index(CustomClass $custom_class)
    {
        $name = $custom_class->getName();
        return view('welcome', compact('name'));
    }
}

//Dans le fichier de la classe 
namespace App\Models;
class CustomClass 
{
    public function getName() {
        return 'Name';
    }
}
```
- On peut donc créer une fausse classe avec **Mockery**, que le test utilisera pour se lancer:
```php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\CustomClass;
class WelcomeControllerTest extends TestCase
{
    public function testIndex()
    {
        // On crée la simulation de classe avec mockery
        $this->mock(CustomClass::class, function ($mock) {
            $mock->shouldReceive('getName')->andReturn('Name');
        });
        // Action
        $response = $this->get('welcome');
        // Assertions
        $response->assertSuccessful(); //S'assure d'un code type 200
        $response->assertViewHas('name', 'Name'); //Vérifie que la vue a bien ce qu'on cherche
    }
}
```

### Utiliser les seeders pour les tests
- Avec laravel 8 on peut utiliser des seeders facilement avec ``refreshdatabase``
- à chaque test on peut donc exécuter les seeders (par défaut la classe ``DatabaseSeeder`` qui exécute tous les seeders qu'on a déclaré dans cette classe)
- On peut changer les seeders qui seront exécutés (par exemple si on souhaite avoir des seeders particuliers juste pour les tests)
```php
namespace Tests\Feature;
 
use Database\Seeders\TestMenuSeeder;
use Database\Seeders\TestRecipeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
 
class MenuTest extends TestCase
{
    use RefreshDatabase;
 
    /**
     * Test creating a new menu.
     *
     * @return void
     */
    public function testMenuCreatedCorrectly()
    {
        //Si on veut seed la base de données:
        $this->seed();
 
        //Si on veut seulement certains seeders:
        $this->seed(TestMenuSeeder::class);
 
        //Pour une array de seeders:
        $this->seed([
            TestMenuSeeder::class,
            TestRecipeSeeder::class,
        ]);

        //Test ici
    }
}
```
- On peut par exemple préparer des seeders faits pour les tests dans un sous-dossier ``seeders/tests`` 

### Tests authentification
Si on souhaite tester une route ou une vue avec un middleware, en prétendant que l'utilisateur est connecté on peut utiliser ``actingAs()``, ici pour laravel 8:
```php
/**
 * Test front view
 *
 * @return void
 */
public function testFrontView()
{
    //Create a fake user
    $user = new User();

    //Check while acting as a user
    $response = $this->actingAs($user)->get('/');

    $response->assertViewIs('front');
}
```
- Attention cette dernière méthode ne renvoie pas l'id (elle crée juste un modèle de user), cela peut donc être utile uniquement si la méthode de la route testée ne demande pas l'id utilisateur, dans le cas ou a besoin d'un id, il faut créer un utilisateur avec un id en bdd, ou tester la redirection en absence d'id

### La fonction ``setUp()``
- Si on souhaite réaliser toujours la meme action avant chaque test on peut utiliser la fonction ``setUp()``:
```php
class CommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Prepare the database for tests with the test seeders
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed(TestDatabaseSeeder::class);

        $this->user = User::find(TestDatabaseSeeder::TESTENV_USER_ID);
    }

    //Différents Tests de bdd
}
```
