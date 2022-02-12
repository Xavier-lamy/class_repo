# CSS print

Si on a besoin de réaliser une version de notre site web pour l'impression:
- On link le fichier de style CSS (en ajoutant l'attribut ``media``), il est recommandé de créer un fichier pour le print différent de l'afichage normal au lieu de simplement rajouter des règles: ``<link rel="stylesheet" type="text/css" href="impression.css" media="print">``

- Sous wordpress si on souhaite ajouter notre style à la queue des styles de wordpress:
```php
// Inside a parent theme
wp_enqueue_style( 'my-style', get_template_directory_uri() . '/css/my-style.css', false, '1.0', 'print' ); 

// Inside a child theme
wp_enqueue_style( 'my-style', get_stylesheet_directory_uri() . '/css/my-style.css', false, '1.0', 'print' ); 

// Inside a plugin
wp_enqueue_style( 'my-style', plugins_url( '/css/my-style.css', __FILE__ ), false, '1.0', 'print' ); 
```