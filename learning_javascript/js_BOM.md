# BOM

Le BOM est une API (interface de programmation applicative), qui contient elle meme plusieurs API:
- "L'objet" **Window** objet de base qui fait partie de l'interface **Window** (fenetre de navigateur) base du BOM, qui contient:
    - L'objet **Navigator**: état et identité du navigateur
    - L'objet **History**: manipuler l'historique de navigation
    - L'objet **Location**: informations sur l'url de la page courante
    - L'objet **Screen**: propriété de l'écran de la page courante
    - L'objet **Document** et le **DOM**

## Objet Window 
1. propriétés:
    - innerHeight: hauteur de la fenetre en comptant les options du navigateur
    - innerWidth: largeur de la fenetre en comptant les options du navigateur
    - outerHeight: hauteur de la fenetre sans compter les options du navigateur (là où le code est rendu)
    - outerWidth: largeur de la fenetre sans compter les options du navigateur (là où le code est rendu)
2. Méthodes:
    - window.open('url', 'nom', 'options'): ouvre la ressource (url) dans une fenetre, un onglet ou un élément iframe ('nom', si vide créé une nouvelle fenetre), en options on peut déterminer sa position (left, top,..) sa taille (width, height),..
    - Après avoir créé une fenetre on peut utiliser:
        - resizeBy(): redimensionner en enlevant un certain nombre de pixels
        - resizeTo(): redimensionner en donnant une nouvelle taille qui écrase l'ancienne
        - moveBy(): déplace relativement à la position de départ
        - moveTo(): déplace en absolu par rapport à l'angle supérieur gauche
        - scrollBy(): défilement relatif
        - scrollTo(): défilement absolu
        - close(): ferme la fenetre
    - alert(): (pas besoin de mettre window devant): affiche une boite d'alerte
    - prompt(): (pas besoin de mettre window devant): affiche une boite de dialogue (l'utilisateur peut envoyer du texte)
    - confirm(): (pas besoin de mettre window devant): affiche une boite avec un message facultatif et deux boutons (cancel et ok)


## Objet Navigator
Donne des infos sur les préférences du visiteur (langue, cookies, ..), on parle aussi de **user agent**
1. propriétés
    - language: langue définie du navigateur
    - geolocation: retourne un objet Geolocation  utilisable pour définir la localisation
    - cookieEnabled: cookie autorisés ou non
    - platform: plateforme du navigateur

## Objet Geolocation
L’interface Geolocation n’implémente et n’hérite d’aucune propriété. En revanche, elle a trois méthodes disponibles que dans des contextes sécurisés (contextes utilisant l’HTTPS) pour des raisons de sécurité :
- La méthode getCurrentPosition() permet d’obtenir la position actuelle de l’appareil en retournant un objet Position
- La méthode watchPosition() permet de définir une fonction de retour qui sera appelée automatiquement dès que la position de l’appareil change. Cette méthode retourne une valeur (un ID) qui va pouvoir être utilisé par la méthode clearWatch() pour supprimer la fonction de retour définie avec watchPosition()
- La méthode clearWatch() est utilisée pour supprimer la fonction de retour passée à watchPosition()  
La méthode getCurrentPosition() retourne un objet Position. L’interface Position ne dispose d’aucune méthode mais implémente deux propriétés :
- Une propriété coords qui retourne un objet Coordinates avec les cordonnées de position de l’appareil ;
- Une propriété timestamp qui représente le moment où la position de l’appareil a été récupérée.
L’interface Coordinates ne possède pas de méthodes mais implémente les propriétés suivantes :
- latitude qui représente la latitude de l’appareil ;
- longitude qui représente la longitude de l’appareil ;
- altitude qui représente l’altitude de l’appareil ;
- accuracy qui représente le degré de précision (exprimé en mètres) des valeurs renvoyées par les propriétés latitude et longitude ;
- altitudeAccuracy qui représente le degré de précision de la valeur renvoyée par la propriété altitude ;
- heading qui représente la direction dans laquelle l’appareil se déplace. La valeur renvoyée est une valeur en degrés exprimée par rapport au Nord ;
- speed qui représente la vitesse de déplacement de l’appareil ; vitesse exprimée en mètres par seconde.

## Propriétés et méthodes de History
1. Propriétés:
    - length: retourne le nombre d’éléments dans l’historique (en comptant la page actuelle), c’est-à-dire le nombre d’URL parcourues durant la session
2. Méthodes
    - go(): charge une page depuis l’historique de session. On va lui passer un nombre en argument qui représente la place de la page qu’on souhaite atteindre dans l’historique par rapport à la page actuelle (ex: -1 pour la page précédente et 1 pour la page suivante)
    - back(): charge la page précédente dans l’historique de session par rapport à la page actuelle. Utiliser back() est équivalent à utiliser go(-1)
    - forward(): charge la page suivante dans l’historique de session par rapport à la page actuelle. Utiliser forward() est équivalent à utiliser go(1).

## Propriétés et méthode de l’objet Location
Donne des infos sur l'url = localisation de la page
1. Propriétés (rarement utilisées)
- hash: qui retourne la partie ancre d’une URL si l’URL en possède une
- search: qui retourne la partie recherche de l’URL si l’URL en possède une
- pathname: qui retourne le chemin de l’URL précédé par un /
- href: qui retourne l’URL complète
- hostname: qui retourne le nom de l’hôte
- port: qui retourne le port de l’URL
- protocole: qui retourne le protocole de l’URL
- host: qui retourne le nom de l’hôte et le port relatif à l’URL
- origin: qui retourne le nom de l’hôte, le port et le protocole de l’URL
2. Méthodes
- assign(): charge une ressource à partir d’une URL passée en argument, (la page de départ est sauvegardée dans l'historique donc on peut y revenir, ce qui n'est pas le cas avec replace())
- reload(): recharge le document actuel
- replace(): remplace le document actuel par un autre disponible à l’URL fournie en argument

## Propriétés de l'objet Screen
- width: retourne la largeur totale de l’écran
- availWidth: retourne la largeur de l’écran moins celle de la barre de tâches
- height: retourne la hauteur totale de l’écran
- availHeight: retourne la hauteur de l’écran moins celle de la barre de tâches
- colorDepth: retourne la profondeur de la palette de couleur de l’écran en bits, renvoie 24 si le navigateur ne peut pas la déterminer (pour raisons de sécurité ou autres)
- pixelDepth: retourne la résolution de l’écran en bits par pixel, renvoie 24 si le navigateur ne peut pas la déterminer (pour raisons de sécurité ou autres)
