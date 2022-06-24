# Installer wordpress sur un container docker

- Objectif: créer un environnement de travail avec un container docker, un container mysql et un pour phpmyadmin

- Sources: 
    - [Article d'Armand Philippot](https://www.armandphilippot.com/article/docker-installation-wordpress)
    - [Vidéo de Learn Computer Technologies](https://www.youtube.com/watch?v=Tcxwq048ZMc)

## Configuration
1. A l'intérieur du dossier du projet créer un fichier ``docker-compose.yml`` (ou ``.yaml``)
2. Vérifier le numéro de version avec ``docker --version`` et se référer à la [table de la doc](https://docs.docker.com/compose/compose-file/compose-versioning/#compatibility-matrix) pour savoir quelle version donner à notre ``docker-compose.yml``
3. Définir la configuration docker-compose:
```yml
version: '3.8'

services:
    #Définit le container pour la base de données mysql
    db: # Nom du container
        image: mysql:5.7 # Définit l'image à utiliser pour construire le container ainsi que la version
        restart: always # Définit le redémarrage à toujours, ce qui veut dire qu'elle démarrera toujours en même temps que les autres container
        environment: # Définit les variables d'environnement pour la bdd
            MYSQL_ROOT_PASSWORD: wordpress
            MYSQL_DATABASE: wordpress
            MYSQL_USER: wordpress
            MYSQL_PASSWORD: wordpress
        volumes: # Monte un volume à l'extérieur du container pour permettre la perstistence des données
            - db_data:/var/lib/mysql
    
    #Définit le container wordpress
    wordpress: # Nom du container
        depends_on:
            - db # Indique que docker doit d'abord démarrer la bdd avant de démarrer wordpress
        image: wordpress:latest # Récupère l'image avec la dernière version de wordpress
        ports:
            - "127.0.0.1:80:80" # Map le port Https (80) de notre machine sur celui de docker
            - "127.0.0.1:443:443" # Map le port Https (443) de notre machine sur celui de docker
        restart: always # Définit la politique de démarrage sur toujours
        environment: # Définit les variables d'environnement pour l'accès de wordpress à la bdd
            WORDPRESS_DB_HOST: db:3306
            WORDPRESS_DB_USER: wordpress
            WORDPRESS_DB_PASSWORD: wordpress
            WORDPRESS_DB_NAME: wordpress
        working_dir: /var/www/html # Définit le répertoire de travail du container
        volumes:
            - "./:/var/www/html" #Monte le répertoire de travail actuel (./) sur le container wordpress
            - "./uploads.ini:/usr/local/etc/php/conf.d/uploads.ini" #Monte le fichier uploads.ini sur le répertoire de configuration de php du container, note: si on choisit d'augmenter les limites d'upload, la limitation de mémoire,... dans un fichier htaccess ceci n'est pas nécessaire
    
    # Définit le container phpmyadmin
    phpmyadmin:
        depends_on:
            - db # php myadmin nécessite aussi d'être démarré après la bdd
        image: phpmyadmin:latest # On installe la dernière version de php admin
        ports:
            - "8080:8080" # On map notre port 8080 avec le port 8080 de docker, car wordpress utilise déjà le port 80 (8080 est un port alternatif pour le http)
        restart: always # On définit le paramètre de rédémarrage à toujours
        environment:
            PMA_HOST: db # Définit le nom du service de BDD à utiliser
            MYSQL_ROOT_PASSWORD: wordpress # Définit le mot de passe root à utiliser

volumes:
    db_data: # indique à docker qu'il faut créer le volume db_data depuis le volume définit dans le container MySql
```
- Si on choisit d'utiliser le fichier uploads.ini dans les volumes du service wordpress, il faut alors le créer à la racine du répertoire de travail:
```ini
# Dans uploads.ini
file_uploads = On
memory_limit = 64M
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 600
```
- Sinon si on ne souhaite pas changer ces paramètres dans le docker-compose (ce qui obligerait à rebuild le container si on veut les changer), on peut les ajouter à la fin du fichier htacces (en revanche si en prod on aura d'autres paramètres il faudra penser à les changer):
```
# END Wordpress
php_value memory_limit 256M
php_value upload_max_filesize 64M
php_value post_max_size 64M
php_value max_execution_time 300
```

## Créer les répertoires de travail si besoin
Il semble que (uniquement sous linux ?) si on ajoute notre docker-compose sur un nouveau projet il faut créer soi même une partie des dossiers (ceux où on va travailler), autrement docker va les créer en tant que sudo, et on ne pourra pas ajouter ou modifier de fichiers à moins de changer les droits, il faut donc créer ``themes`` et ``plugins`` dans ``wp-content``, et ajouter les dossiers de nos futurs themes ou plugins.

## Utilisation
- Il suffit ensuite de lancer la commande: ``docker-compose up -d`` pour lancer le container en arrière plan
- Si on souhaite arrêter le container en supprimant les différents container et volumes qui lui sont liés): ``docker-compose down``
- Il faudra faire attention à modifier le fichier ``wp-config.php`` avec les infos de connection du container
