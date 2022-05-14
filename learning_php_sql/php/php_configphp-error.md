# Gestion des erreurs
Par défaut les erreurs en php ne sont as montrés pour des raisons de sécurité, si on veut néanmoins afficher les erreurs à la place de notre page web quand celle ci plante il faut:
+ localiser le fichier de configuration du serveur web soit:
    - en allant sur le menu TOOLS/PHPINFO sur la page d'accueil de MAMP
    - en tapant la fonction phpinfo() dans un fichier php puis en affichant sur le serveur
    ```php
    phpinfo();
    ```
+ Ensuite dans loaded configuration file on peut accéder au fichier de config 
    - il faut alors s'assurer qu'on a bien ``"error_reporting = E_ALL"`` et ``"display_errors = On"``
