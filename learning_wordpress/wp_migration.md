# Migration

Quand on souhaite migrer notre site sur un serveur (ex: passer du dev à la prod):

+ On a besoin des identifiants du serveur en question
+ utiliser duplicator:
    - créer un paquet avec nos documents, cela crée ``une archive compressé`` et un fichier ``installer.php``
+ sur l'hébergement on place ``installer.php`` et ``l'archive`` à la racine dans htdoc ou html 
+ on se connecte à la base de données