# Les thumbnails et les tailles d'images
+ sur WP , quand on ajoute une image, des versions de différentes tailles sont créées par WP, exemple par défaut:
    - miniatures : largeur = 150, hauteur = 150 (recommandé: ne pas toucher)
    - moyenne : largeur = 300, hauteur = 300 
    - grand : largeur = 1024, hauteur = 1024 
+ on peut changer ces tailles dans **réglages** > **médias**
+ on trouve les images de **médias** dans le fichier **uploads** de **wp-content**, elles sont triées avec l'année et le mois  

## créer des nouvelles tailles d'images
+ dans functions.php en dessous de ``add_theme_support()``
```php
    // Définir la taille par défaut des images mises en avant
    set_post_thumbnail_size( 2000, 400, true );

    // Définir d'autres tailles d'images
    add_image_size( 'size-name', 800, 600, false );
    add_image_size( 'size-name2', 256, 256, false );
```
+ ``set_post_thumbnail_size( 1200, 600, true )`` : définit la taille par défaut utilisée donc par ``the_post_thumbnail()``, en paramètres:
    1. la largueur de l'image
    2. la hauteur max (0 = sans limite)
    3. si *true* = peut découper l'image pour suivre ces dimensions exactes
+ ``add_image_size( 'name', 1500, 300, false )`` : pour ajouter des tailles d'images en plus, en paramètres:
    1. nom à donner à la taille (éviter: large, medium, medium-large, car déjà utilisé par Wp)
    2. la largueur de l'image
    3. la hauteur max (0 = sans limite)
    4. si *true* = peut découper l'image pour suivre ces dimensions exactes

### Appeler une taille d'image spécifique
+ il suffit d'indiquer le nom de la taille d'image en paramètre:
``the_post_thumbnail( 'size-name' )``
