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
    DB_DATABASE=/absolute/path/to/test.sqlite

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
