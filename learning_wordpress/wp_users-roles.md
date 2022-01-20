# Les rôles utilisateurs

| Capacité | Administrateur | Editeur | Auteur | Contributeur | Abonné |
|----------|----------------|---------|--------|--------------|--------|
| Gérer les réglages, thèmes, extensions | ✔ | ❌ | ❌ | ❌ | ❌ |
| Gérer les pages | ✔ | ✔ | ❌ | ❌ | ❌ |
| Gérer *tous* les articles | ✔ | ✔ | ❌ | ❌ | ❌ |
| Gérer *tous* les commentaires | ✔ | ✔ | ❌ | ❌ | ❌ |
| Gérer les comms de *ses* articles | ✔ | ✔ | ✔ | ❌ | ❌ |
| Publier *ses* articles | ✔ | ✔ | ✔ | ❌ | ❌ |
| Importer des médias | ✔ | ✔ | ✔ | ❌ | ❌ |
| Rédiger des articles | ✔ | ✔ | ✔ | ✔ | ❌ |

## Créer des rôles:
+ Avec une extension: comme **User Role Editor**
+ Soi même en php, pour cela on utilise la fonction ``add_role()``:
    - Exemple si on veut créer un role **référenceur SEO** on pouraait lui donner quasi tous les droits exceptés ajouter des extensions ou créer des nouveaux utilisateurs:
    ```php
    // dans functions.php
    function prefix_add_custom_role() {
        /* On vérifie déjà que la fonction custom_roles_version n'existe pas avant de créer le nouveau rôle, autrement le role sera recréer à chaque fois*/
        if ( ! get_option( 'custom_roles_version' ) ) {
            $capabilities = array( 
                'edit_posts' => true,
                'upload_files' => true,
                'manage_options' => true 
            );
            add_role( 'seo_manager', 'SEO Manager', $capabilities );
            update_option( 'custom_roles_version', 1 );
        }
    }
    add_action( 'init', 'prefix_add_custom_role' );
    ```
+ Exemples de capacités:
    - ``edit_pages`` : peut modifier les pages ?
    - ``delete_posts`` : peut supprimer les articles ?
    - ``activate_plugins`` : peut activer une extension ?
    - ``manage_options`` : peut modifier les paramètres du site ?
+ Pour changer les droits d'un rôle après l'avoir créé il faut utiliser ``add_cap()`` ou ``remove_cap()``:
```php
/*On intègre ça à notre méthode pour éviter d'exécuter le code à chaque fois, en incrémentant le numéro de version*/

function prefix_add_custom_role() {
    $version = get_option( 'custom_roles_version' )
    
    // V1 • Ajouter le rôle    
    if ( $version < 1 ) {
        $capabilities = array( ... );
        add_role( 'seo_manager', 'SEO Manager', $capabilities );
        update_option( 'custom_roles_version', 1 );
    }
    
    // V2 • Modifier le rôle
    if ( $version < 2 ) {

        // Récupérer le rôle:
        $role_object = get_role('seo_manager');

        // Ajouter une capacité
        $role_object->add_cap('manage_categories');

        // Retirer une capacité
        $role_object->remove_cap('upload_files');

        update_option( 'custom_roles_version', 2 );
    }
}
add_action( 'init', 'prefix_add_custom_role' );
```
+ Pour tester si un utilisateur à les droits:
    - ``current_user_can( 'admnistrator' )`` : tester directement le rôle
    - ``current_user_can( 'manage_options' )``: tester la capacité