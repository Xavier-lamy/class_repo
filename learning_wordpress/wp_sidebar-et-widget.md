# Les sidebar et les widgets
+ Les **widgets** sont des éléments dynamiques pour afficher des élémzents supplémentaires (derniers articles, derniers commentaires,..)
+ ils sont généralement placés dans la **sidebar**

## Sidebar
### déclarer une sidebar:
dans functions.php:
```php
register_sidebar( array(
    'id' => 'blog-sidebar', // utilisé pour appeler la sidebar
    'name' => 'Blog', // apparait dans l'admin WP
    // On peut ajouter ces paramètres:
    // changer les "li" par défaut par des div, ce qui évite d'avoir à mettre le widget dans un "ul":
    'before_widget'  => '<div class="site__sidebar__widget %2$s">', // "%2$s" pour que wordpress ajoute ses propres classes spécifiques par type de widget
    'after_widget'  => '</div>',
    // changer le "h2" par défaut par un "p" 
    'before_title' => '<p class="site__sidebar__widget__title">',
    'after_title' => '</p>',
) );
```
### Afficher la sidebar:
dans la page qu'on souhaite:
``dynamic_sidebar( 'blog-sidebar' )``, avec en paramètre l'ID de la sidebar

### Afficher les widgets souhaités
dans l'admin WP:
- **Apparences** > **Widgets**, puis sélectionner les widgets


