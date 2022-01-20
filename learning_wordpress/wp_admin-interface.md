# L'interface Admin

## Personnaliser la page de connexion  de WP et le logo:

+ Dans functions.php on peut ajouter un hook qui nous permettra d'ajouter un fichier CSS pour modifier le style de la page login:
```php
function prefix_login_logo() {
	wp_enqueue_style( 
        'custom-login', 
        get_template_directory_uri() . '/css/custom-login.css', 
        array( 'login' ) 
    );
}
add_action( 'login_enqueue_scripts', 'prefix_login_logo' );
```
