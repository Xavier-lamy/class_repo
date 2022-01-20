# Quelques fonctions utiles sous wordpress

Source: [LES FONCTIONS WORDPRESS PHP UTILES POUR DÉVELOPPEURS](https://www.seomix.fr/fonctions-wordpress-php-utiles-pour-developpeurs/)

### ``wp_unique_id()``:
- Génère un id unique à chaque fois qu'elle est appelée
- Exemple d'utilisation: si on crée un bloc acf ou gutenberg qui risque d'etre appelé plusieurs fois par page, on utilise cette fonction pour être sûr que l'id est différent à chaque bloc

### ``make_clickable()``:
Convertit une chaine de caractère de type email ou uri en un lien HTML

### ``get_theme_file_uri()``:
Renvoie l'url du thème actif (thème enfant ou parent)

### ``antispambot()``:
Encode certains caractères des adresses email pour transformer le code html, ce qui réduit le spam

### ``wp_safe_redirect()``:
Version plus sécurisée de ``wp_redirect()``, pemret de filtrer le nom d'hote de destination, et ne laisser la possibilité de rediriger uniquement vers le nom de domaine, donc de faire uniquement des redirections internes 

### ``wp_ext2type()``:
- Renvoie le type de fichier (audio pour mp3, ...)

### ``size_format()``:
- Convertit un chiffre en bytes
- ex: ``1048576bytes`` en ``1Mo``

### ``get_dirsize()``:
Retourne le poids d'un dossier complet

### ``wp_remote_get()``:
Récupère tout le contenu et les entêtes d'une url

### ``wp_remote_retrieve_response_code()``:
Récupère le code de réponse d'une adresse web

### ``get_status_header_desc()``:
Renvoie la description textuelle  d'un entête Http (ex pour 404: ``page non trouvé``, pour 201: ``ok``)

### ``url_shorten()``:
Raccourci une url à 35 caractères maximum (retire le protocole et le sous domaine ``www``)

### ``links_add_base_url()``:
Transforme des liens relatifs en lien absolus (en rajoutant par exemple le protocole et le nom de domaine)

### ``user_trailingslashit()``:
Si nécessaire, modifie une url pour qu'elle corresponde au paramétrage utilisé dans réglages

### ``links_add_target()``:
Ajoute l'attribut target aux liens, remplace s'il esxiste déjà

### ``wp_cache_add()``, ``wp_cache_set()``, ``wp_cache_get()``, ``wp_cache_delete()``:
- Ces fonctions permettent de mettre en cache des données et de les réutiliser plus tard
- Il faut faire attention car selon notre configuration le cache peut devenir persistant

### ``wp_list_sort()``:
- Trie une liste d'objets selon une clée
- ex:
```php
wp_list_sort( $posts, 'post_date', 'DESC');
``` 

### ``wp_list_pluck()``:
- Nettoie un tableau associatif pour ne conserver qu'une clé précise de chaque élément
- ex:
```php
$monsters = [
    'spider' => [ 'name' => 'spider', 'spit fire' => false ],
    'dragon' => [ 'name' => 'dragon', 'spit fire' => true],
    'wolf'   => [ 'name' => 'wolf', 'spit fire' => false],
];
 
var_dump ( wp_list_pluck( $monsters, 'spit fire' ) ) ;
/* return array (size=3)
  'spider' => boolean false
  'dragon' => boolean true
   'wolf' => boolean false */
``` 

### ``wp_array_slice_assoc($array, $key)``:
Permet de ne retourner que les données d'un tableau correspondant à la ou les clés données en paramètre

### ``acf_maybe_get($array, 'key', $optionnal_returned_value)``:
Fonction d'ACF qui permet d'extraire une clé d'un tableau seulement si elle existe, et de renvoyer null ou la valeur en 3 eme paramètre si la clé n'existe pas

### ``is_post_type_viewable('page')``:
Retourne true si le type de post est visible publiquement