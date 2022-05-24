# Utilisation de Docker

+ L'objectif de Docker est de créer des packages(*containers*) qui permettront d'uniformiser nos applcations pour qu'elles puissent tourner sous n'importe quel système, ainsi on est sûr que l'application s'installera et fonctionnera de la meme façon chez tous ceux qui travaillent sur le projet, de plus les containers seront isolés des autres processus de notre machine

+ ***Dockerfile***: Il s'agit du plan de création de l'***image*** docker 

+ ***image***: Il s'agit du pattern/template qui permettra d'exécuter un ***container***, une image peut être envoyé sur un cloud pour que les autres membres (voir tout le monde si on le met en public) puissent avoir l'image afin de recréer le ***container*** sur leur machine, l'image contient tous les éléments nécessaires à la création du container

+ ***Container***: Il s'agit de l'application ou du procédé qu'on cherche à faire fonctionner sur n'importe quel système, cela consiste en un ensemble de fichiers séparés du système (cela fonctionne en autonomie)

## Installation et utilisation
+ On peut installer la version Desktop de docker (pour mac ou windows), qui permet d'installer tous les éléments nécessaires en plus de fournir une interface pour observer et utiliser nos container

### Utilisation
> Note: On peut choisir d'utiliser le dashboard docker au lieu de réaliser la plupart des commandes suivantes

- Dans le même emplacement que le ``package.json`` on crée un fichier ``Dockerfile``
```dockerfile
# On commence par définir quelle image de base on utilise 
FROM node:12-alpine

# On définit l'espace de travail
WORKDIR /app

# On indique qu'il faut copier le fichier package.json à la racine de l'app
COPY package*.json ./

# On fait installer les dépendances node_modules dans le projet
RUN npm install

# On copie tous les dossiers de l'app pour le container
COPY . .

# On définit la variable d'environnement
ENV PORT=8080

# On demande au container d'écouter le port 8080
EXPOSE 8080

# On définit la commande qui explique comment lancer l'application
CMD [ "npm", "start" ]
```
- Ce fichier fonctionnne sur un système de couches (layer), chaque étape est donc réalisée l'une à la suite de l'autre et si docker repère qu'une étape n'opère pas de changement il la mettra en cache
- Dans le cas ou on aurait par exemple déjà un dossier ``node_modules`` localement il faut le mettre dans un fichier ``.dockerignore`` (sur le même principe que ``.gitignore``), afin qu'il ne soit pas copié (autrement il y aurait conflit avec le dossier node_modules installé par le dockerfile) quand on fait la commande ``COPY ..``
- Ensuite on peut lancer la commande pour construire notre image: ``docker build -t dockerusername/imagename:1.0 .``
    - le drapeau ``-t`` sert à donner un nom à notre image qui est généralement constitué de notre nom d'utilisateur docker, le nom qu'on donne au projet et si on le souhaite un numéro de version
    - On ajoute le chemin vers le dockerfile qu'on a créé (généralement juste un point)
- Notre image va donc se créer, on pourra s'en servir:
    - De base pour créer d'autre images
    - Pour créer un container
- On peut pousser notre image sur un service de cloud comme **DockerHub** ou **AmazonECR**, avec ``docker push``, cette image pourra ensuite etre utilisé par d'autres grâce à la commande ``docker pull``
- On peut utilise la commande ``docker run`` pour utiliser notre image afin de créer un container, pour ce faire on ajoute en paramètre soit l'id de l'image (qui a été donné à la fin de la création de l'image), soit le nom du container (le tag name qu'on a créé):
    - ``docker run -d -p 80:80 docker/getting-started`` cette commande permet de lancer le container:
        - les drapeaux (que l'on pourrait aussi simplifier en ``-dp``) signifie qu'il faut faire tourner en arrière plan (``-d``), et qu'il faut mapper le port de la machine (``80`` ici, mais à remplacer par notre propre port) avec le port du container (``80``)
        - Le nom de l'image ``docker/getting-started`` pour savoir quelle image doit etre utilisée pour le container

### Les volumes
Par défaut quand on arrête ou relance un container les informations qu'on a créées pendant sa durée de vie (exemple données des input) ne sont pas conservées, si on souhaite néanmoins les conserver, voir les transmettre d'un container à un autre (exemple d'un container qui contient l'app à celui qui contient la bdd) on peut utiliser les volumes, qui sont des sortes de dossiers contenant plusieurs container et autorisant la persistance des données au sein des containers

#### Volumes nommés
- Pour créer un volume nommé on utilise ``docker create volume volume-name``
- Ensuite on peut exécuter un container dans un volume en ajoutant le flag ``-v`` suivi du nom du volume auquel on attribut le chemin ou on veut sauvegarder nos données, ici un exemple pour une base de données sqlite: ``docker run -dp 3000:3000 -v volume-name:/etc/todos getting-started``

#### Bind mounts
Au lieu des volumes nommés on peut utiliser les *bind mounts*, cela permet notemment de choisir l'emplacement ou les données seront sauvegardés:
```powershell
docker run -dp 3000:3000 `
    -w /app -v "$(pwd):/app" `
    node:12-alpine `
    sh -c "npm install && npm run dev"
```
- Dans cet exemple on définit:
    - Le mapping des ports (avec ``-dp 3000:3000``) et l'exécution en arrière plan (le ``d`` de ``-dp``)
    - Le répertoire de travail (``-w /app``) ou sera exécuté la commande
    - Le volume ou on pourra rendre nos données persistantes(``$(pwd)`` représente le chemin absolu, on en a besoin pour le *binding mounts*)
    - L'image utilisée ``node:12-alpine``
    - La commande qu'on utilise (``sh -c "npm install && npm run dev"``)

### COntainers multiples
Si on souhaite avoir un container pour mysql qui pourra interagir avec le container de notre app:
- On crée un container pour notre bdd avec mysql, en lui attribuant un volume et des variables d'environnement ``(-e``):
```powershell
docker run -d `
    --network todo-app --network-alias mysql `
    -v todo-mysql-data:/var/lib/mysql `
    -e MYSQL_ROOT_PASSWORD=secret `
    -e MYSQL_DATABASE=todos `
    mysql:5.7
```
- Ensuite on peut lancer le container de l'app en le connectant à notre bdd:
```powershell
docker run -dp 3000:3000 `
  -w /app -v "$(pwd):/app" `
  --network todo-app `
  -e MYSQL_HOST=mysql `
  -e MYSQL_USER=root `
  -e MYSQL_PASSWORD=secret `
  -e MYSQL_DB=todos `
  node:12-alpine `
  sh -c "yarn install && yarn run dev"
```

### Docker compose
La règle de base est de créer un container par procédé (un pour la bdd, un pour l'app, ...), si on souhaite créer un ensemble de container faits pour interagir ensemble, on peut utiliser ``docker compose``, qui est un outil permettant de faire tourner plusieurs container en même temps
- Pour cela on crée un fichier ``docker-compose.yml`` dans lequel on écrit la configuration  de notre docker compose:
```yml 
version: '3'
# On définit les différents services (procédés qu'on aura), ici notre appli web et un autre container pour le bdd
services:
  web: 
    # On indique ou prendre le container, ici ce sera le dossier ou on se trouve afin de reprendre notre dockerfile
    build: .
    ports: 
      - "8080:8080"
  db: 
    # Ici on précise quelle image on veut pour la bdd mysql et on définit les éventuelles variables d'environnement ainsi qu'un "volume" ou on pourra conserver les données de manière persistante
    image: "mysql"
    environment:
      MYSQL_ROOT_PASSWORD: password
    volumes:
      - db-data: /database

# On reprécise les volumes ici:
volumes:
  db-data:
```
- On peut aussi créer uniquement un fichier ``docker-compose.yml`` sans créer de ``dockerfile`` et entrer toutes les infos des container dans ce même fichier:
```yml
version: "3.8"

services:
  #on donne un alias au service
  app:
    # on définit l'image utilisée, la commande ainsi que le mapping de ports et le répertoire de travail
    image: node:12-alpine
    command: sh -c "yarn install && yarn run dev"
    ports:
      - 3000:3000
    working_dir: /app
    # On définit un nom pour le volume
    volumes:
      - ./:/app
    # On définit les variables d'environnement
    environment:
      MYSQL_HOST: mysql
      MYSQL_USER: root
      MYSQL_PASSWORD: secret
      MYSQL_DB: todos
  # Alias pour le service de la bdd
  mysql:
    # On définit l'image à utiliser
    image: mysql:5.7
    # On définit le volume en le liant à celui de "volumes" ou sera stocké la bdd et les variables d'environnement pour s'y connecter
    volumes:
      - todo-mysql-data:/var/lib/mysql
    environment: 
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: todos

# On définit le volume (les options par défaut seront utilisés si on ne rajoute rien après le nom du volume)
volumes:
  todo-mysql-data:
```

- Il suffit alors d'éxecuter ``docker compose up`` pour lancer nos containers (ou notre container, il est tout aussi intéressant d'utiliser docker compose même avec un seul container), ``docker-compose up -d`` pour exécuter en arrière plan
- Pour arrêter les container on utilise: ``docker compose down``

### Commandes
- ``docker ps`` : affiche la liste de tous les containers docker présents sur notre système, cela nous permet par exemple d'avoir l'id d'un container pour pouvoir le supprimer
- ``docker stop <container-id>``: arrête un container en cours d'exécution (si on souhaite utiliser le port sur lequel il tourne pour un autre process)
- ``docker rm <container-id>`` : supprime un container par son id
- ``docker push USER-NAME/getting-started:tagname`` : push notre image sur un repo docker (penser à créer ce repo en public)
- ``docker scan getting-started`` : pour scanner notre image et vérifier qu'elle ne contient pas de failles de sécurité connues

## Exemples
- Dockerfile pour une appli vuejs
```dockerfile
FROM node:lts-alpine

# Install a live server
RUN npm install -g http-server

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

EXPOSE 8080

CMD [ "http-server", "dist" ]
```