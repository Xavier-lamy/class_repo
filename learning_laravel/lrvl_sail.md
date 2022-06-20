# Laravel sail

Avec laravel on peut mettre en place un projet conteneurisé assez facilement grâce à ``laravel sail``, il s'agit d'un interface en ligne de commande qui permet de créer facilement un container docker adapté à laravel pour notre projet. Une fois le container créé sail permet aussi d'utiliser de nombreuses commande laravel avec notre container, on peut ainsi:
- utiliser les commandes php artisan,
- mettre en place XDebug,
- mettre en place un environnement de test,... 

Le container appartient à un volume et possède aussi un container avec MySQL, afin d'avoir un lien vers une bdd et la persistence des données entre les container 

## Installation et préparation
- Pour windows il faudra s'assurer qu'on a WSL2 d'installé (Windows Subsystem for Linux)
- Quand on crée un nouveau Laravel, sail est déjà installé dessus

### Installation d'un nouveau projet avec docker
- On utilise ``curl -s "https://laravel.build/example-app" | bash`` pour créer un nouveau projet laravel (qui contiendra déjà ``sail``) dans le dossier de notre choix (l'option ``-s`` signifie ``-silence``, cela désactive l'affichage de la progression)
- > Il faut s'assurer d'entrer cette commande dans un shell Unix (comme bash, wsl2 pour window)
- On utilise ensuite ``sail up`` pour créer le fichier ``docker-compose.yml`` et lancer les containers
- Si on souhaite choisir des services particuliers on peut ajouter des paramètres à l'url de création:
    - ``curl -s "https://laravel.build/example-app?with=mysql,redis" | bash`` pour exécuter avec mysql et redis
    - les services supportés sont: ***mysql***, ***pgsql***, ***mariadb***, ***redis***, ***memcached***, ***meilisearch***, ***minio***, ***selenium***, et ***mailhog***
    - les services par défaut si on entre aucun service en paramètre sont: ***mysql***, ***redis***, ***meilisearch***, ***mailhog***, et ***selenium***

+ Si la méthode ci dessus ne marche pas on peut installer un projet laravel, puis installer sail dessus:
```bash
composer create-project laravel/laravel app-name
cd app-name
php artisan sail:install
./vendor/bin/sail up 
```

### Installation sur un projet existant
Si on a déjà un projet installé avec composer et qu'on souhaite ajouter et utiliser sail, il faut:
- exécuter ``composer require laravel/sail --dev`` pour indiquer que sail doit être ajouté au dépendances utilisées
- exécuter ``php artisan sail:install`` qui va créer un fichier ``docker-compose.yml`` à la racine, ou:
    - ``php artisan sail:install --devcontainer`` si on souhaite créer un ``devcontainer`` pour VSCode
- Par défaut les commandes sail nécessite de taper ``./vendor/bin/sail`` à chaque fois, on peut définir un alias: ``alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'``, ainsi on aura juste à taper ``sail``

#### Lancer les containers
- exécuter ``./vendor/bin/sail up`` ou juste ``sail up`` pour lancer les différents container définit dans le ``docker-compose.yml``
- ou ``sail up -d``, pour excuter en mode détaché, c'est à dire en arrière-plan

#### Arrêter les containers
- ``CTRL C`` pour arrêter l'exécution des containers si on est pas en mode détaché
- ``sail stop`` pour arrêter si on est en mode détaché (c'est à dire pas dans le terminal)

#### Utilser des commandes
On peut utiliser de nombreuses commandes habituelles de laravel avec sail, par exemple:
- ``sail artisan migrate`` (ou tout autre commance ``artisan``) au lieu de ``php artisan migrate``
- ``sail php anyexamplescript.php`` va lancer une commande php en utilisant la version de php du container
- ``sail composer require laravel/sanctum`` utilisera la version de ``composer`` du container pour lancer nos commandes ``composer``

### Installer les dépendances quand on a cloné un repo déjà commencé par une autre équipe
Dans ce cas on peut utiliser la commande suivante pour lancer un mini container avec php et composer qui installera les dépendances dont on a besoin (contenues dans ``composer.json``):
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
- dans la partie ``laravelsail/php81``... on doit remplacer le 81 par la version qu'on souhaite utilise dans le container (exemple ``74`` pour ``php 7.4``) 

### Le container MySQL
Le container MySQL créé dans le volume lance deux bases de données, une de base pour l'application et une autre pour les tests, qui sera utilisée quand on lancera des tests

### Les tests
Toutes les commmandes qu'on peut utiliser pour ``php artisan test`` fonctionne aussi avec ``sail``, on peut donc lancer ``sail test`` pour lancer les tests sur la BDD de test du volume

### Modifications du fichier docker
- Il est utile de renommer le nom de l'image du container (afin qu'il soit unique pour cette application), après avoir apporté des changements au fichier de config docker il faut reconstruire l'image avec ``sail build``, puis relancer les containers si besoin avec ``sail up``

- On peut publier notre image comme pour n'importe quelle image docker avec ``sail artisan sail:publish``
