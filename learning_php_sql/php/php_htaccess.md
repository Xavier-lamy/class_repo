# htaccess

Quand on réalise un site en php, on a généralement une zone admin, pour l'administartion du site:
cette zone admin doit etre protégée , pour cela on peut créer deux fichier particuliers:
- ``.htaccess`` : contient l'adresse du ``.htpasswd`` et d'autres options 
- ``.htpasswd`` : contient la liste des login:mot de passe des eprsonnes autorisées à accèder aux pages 

Ces fichiers n'ont pas de nom, seulement une extension 

- dans le .htaccess on écrit:
```
AuthName "Page d'administration protégée"
AuthType Basic
AuthUserFile "/home/site/www/admin/.htpasswd"
Require valid-user
```
- dans authname on peut changer la valeur du texte, ce sera le texte affiché pour demander de se connecter à l'utilisateur 
- dans authuserfile on écrit le chemin absolu

- Pour trouver le chemin absolu on peut faire comme suit:
    1. Créer un fichier appelé  ``chemin.php``

    2. Inscrire juste cette ligne à l'intérieur :  ``<?php echo realpath('chemin.php'); ?>``

    3. Envoyer ce fichier sur le serveur avec le logiciel FTP, et le placer dans le dossier qu'on veut protéger.

    4. Ouvrir le navigateur et regarder le fichier PHP. Il donne le chemin absolu, par exemple:  ``/home/site/www/admin/chemin.php``

    5. Copier ce chemin dans le  ``.htaccess``  , et remplacer le  ``chemin.php``  par  ``.htpasswd``, par exemple :  ``/home/site/www/admin/.htpasswd``

    6. Supprimer le fichier ``chemin.php``  de votre serveur

- Attention ça ne marche pas de la même façon chez tous les hébergeurs

- Puis on peut créer le ``.htpasswd`` qui comprends la liste des logins et mot de passe pour chaque personne autorisée (une persone par ligne):
    - sous la forme: ``login:mot_de_passe_crypté`` 

- pour le crypter on peut utiliser:
    ```php 
    echo crypt('mot_de_passeàcrypter', $salt);
    //$salt est une chaine aléatoire qui servira de "sel" pour crypter le mot de passe
    ``` 

- On envoie ensuite ces deux ficheir sur le serveur avec le logiciel FTP

- Une fois ceci fait toute personne cherchant à se connecter aux dossiers d'admin devra utiliser un login et mot de passe 
