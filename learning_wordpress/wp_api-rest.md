# L'API Rest de WP

+ **API REST** = norme permettant la communication entre deux systèmes logiciels pour l'échange de données sous forme de requêtes HTTP, via des URL:
    - La transmission se fait généralement au format JSON (successuer du XML)
    - N'importe quelle application peut alors communiquer avec n'importe quelle autre (ex: une *java* avec une *c#*)
    - ex: sur un site e-commerce on peut connecter la partie e-commerce (ex: woocommerce) avec les logiciels de gestion de l'entreprise cliente

+ Principe:
    - Les requetes se font en **HTTPS** sous la forme d'**URL**
    - l'URL est spéciale, on l'appelle aussi **route**
    - chaque **route** représente une **ressource** différente (ex: sur WP: page, article, catégorie, utilisateur,...)
    - Les données sont envoyées en **JSON**
    - Les routes se composent comme ceci (ex: api Pokemon):
        + https://pokeapi.co/api/v2/pokemon/pikachu
        + https://nom-du-site/url-base-api/numero-version/ressource/filtre-ressource:
            - Après le nom du site se situe une **URL de base** (``/base/api/`` ou ``/api/``) et la version (v2/), chaque API à une version afin de conserver les anciennes API et ne pas casser tous les sites basés dessus
            - La ressource: c'est ce qu'on souhaite, ici un pokémon (si on s'arrete la on aura une liste de pokemon en retour)
            - Le filtre: pour affincer la recherche, si on veut Pikachu on aura alors un objet JSON le concernant

+ Pour tester les API on peut
    - directement dans la barre d'URL du navigateur (si pas besoin d'authentification)
    - Ajouter en plus l'extension chrome **JSON View** si on souhaite avoir une mise en forme lisible du JSON 

+ Sur WP: 
    - l'API REST est activée par défaut
    - il est recommandé de ne pas la désactiver (elle est utilisé par gutenberg)
    - URL de base de WP = ``/wp-json/``:
        + https://mon-site-wp.com/wp-json/wp/v2/
        + -------URL-------------/-base-/api/version/
        + Pour Woocommerce: https://mon-site-wp.com/wp-json/wc/v3/
        + on peut ensuite ajouter des **endpoints**: ressources et filtres, ex:
            - ``posts/12`` : recherche l'article à l'ID 12
            - ``posts?filter[category_name]=tutoriels_wordpress`` : n'affiche que les articles de catégorie Tutoriels
            - ``posts?per_page=2&page=2`` : récupère 2 articles sur la page 2
            - ``users`` : liste les utilisateurs (sans les mdp et identifiants pour des raisons de sécurité)
            - et bien d'autres filtres (voir doc)
+ Pour les CPT, il faut autoriser la prise en charge par les API lors de la déclaration en ajoutant deux lignes dans l'array des arguments:
    - ``'show_in_rest' => true,`` : Disponible dans l'API
    - ``'rest_base' => 'recipes',`` : Nom pour l'**endpoint** (au pluriel)
