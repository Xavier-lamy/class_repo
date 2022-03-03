# Authentification Laravel

## Starters kits
Si on est au début d'un projet il existe des starters kits, que l'on peut installer sur le projet qui permettent d'ajouter tous les fichiers nécessaire à une authentifiaction:
- Laravel Breeze: le plus simple pour une authentification basique
- Laravel Fortify: contient uniquement du backend (headless) et est plus avancé dans ce qu'il propose
- Laravel JetStream : Un Starter kit avancé qui utilise Laravel Fortify en backend et tailwind pour les vues

Si l'appli est supposé etre une API Laravel possède aussi deux librairiess pour l'authentification:
- Laravel Passport
- Laravel Sanctum

### Installer Breeze
Après la création de notre nouvelle appli laravel et les migrations de base, on exécute:
```
composer require laravel/breeze --dev

php artisan breeze:install
 
npm install
npm run dev
php artisan migrate
```

- Une fois tous les fichiers mis en place on a accès à différentes méthodes:
```php
use Illuminate\Support\Facades\Auth;
 
//Utilisateur actuel
$user = Auth::user();
 
//Id de l'utilisateur actuel
$id = Auth::id();
```

- Si on utilise l'objet requête de laravel ``use Illuminate\Http\Request`` on peut utiliser la méthode ``user()`` sur notre requête: ``$request->user()``

- Pour vérifier si un utilisateur est connecté on peut utiliser la facade ``Auth``:
```php
use Illuminate\Support\Facades\Auth;

//Retourne "true" si l'utilisateur est connecté: 
if (Auth::check()) {
    
}
```

- On peut laisser l'accès à des routes uniquement à des utilisateurs connectés:
```php
Route::get('/private', function () {
    //Nécessite d'être authentifié
})->middleware('auth');
```

- Par défaut un utilisateur non connecté qui accède à une route protégé par authentifcation est renvoyé sur la route login afin de se connecter, on peut changer ce comportement dans la fonction ``redirectTo()`` de ``app/Http/Middleware/Authenticate.php``

## Utiliser les méthodes vanilla de laravel
On peut aussi créer un système d'identifiaction sans passer par une librairie, en utilisant les méthodes d'authentificationn de Laravel

### Créer un utilisateur et le connecter directement:
````php
public function register(Request $request){
    //validate request
    $request->validate([
        'username' => ['required', 'string', 'min:2', 'max:80'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:10', 'max:80'],
    ]);

    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->intended(route('front'));
}        
````
### Exemple pour le login:
```php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            //Redirect to previous page (intended before login) or to a default page
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
```
### Créer une case remember me
Si on souhaite ajouter un champ remember me, il suffit d'ajouter un deuxième argument à la méthode ``attempt()``:
```php
use Illuminate\Support\Facades\Auth;
 
if (Auth::attempt($credentials, $remember)) {
    //Si remember est égal à "true" l'appli garde l'utilisateur identifié
}
```

### Déconnecter l'utilisateur
```php
/**
 * Disconnect user and end session
 * 
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    
    $request->session()->regenerateToken();
    
    return redirect('guest');
}
```


 