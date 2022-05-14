# Sessions et cookies

## Les variables superglobales:
- générés automatiquement par php et donc existent sur toutes les pages et sont accessibles partout
- le nom commence toujours (à une exception près) par ``$_`` et est toujours en majuscule: ``$_NOMGLOBAL``
- ce sont des array qui contiennent généralement de nombreuses infos
- permettent de stocker des infos, exemple: 
    - pendant la durée de la visite (sessions), 
    - sur l'ordi du visiteur (cookies),
    
+ Pour en afficher le contenu on peut utiliser ``print_r``:
```php
print_r($_GET);
```

+ Des exemples de variables superglobales:
    - ``$_SERVER``: regroupe toutes les données renvoyées par le serveur, parmi ces données on peut retenir notamment:  
        + ``$_SERVER["REMOTE_ADDR"]``: qui permet de récupérer l'adresse ip du clien 

    - ``$_ENV``: variables d'environnement données par le serveur (le plus souvent linux), ce n'est généralement pas très utile pour nos sites we 

    - ``$_SESSION``: contient les variables de session, càd des variables stockées sur le serveur le temps de la présence du visiteur

    - ``$_COOKIE``: contient les valeurs des cookies enregistrées sur l'ordinateur du visiteur, cela permet de les stocker des mois durant, (ex: se rappeler le nom de l'utilisateur)

    - ``$_GET``: contient les données envoyées en paramètres dans l'URL

    - ``$_POST``: contient les données envoyées par un formulaire

    - ``$_FILES``: contient la liste des fichiers envoyés via un formulaire

## Les sessions: 
+ 3 étapes importantes:
    1. Quand un visiteur arrive sur un site on lui créé une session, php génère un "ID de session" (ou :PHPSESSID),
    cet ID est un grand nombre en hexadécimal qui est passé de page en page automatiquement généralement sous forme d'un cookie 

    2. une fois la session générée, on peut créer une infinité de variables conservées par le serveur dans la superglobale ``$_SESSION``:
    par exemple: ``$_SESSION['name']``, ``$_SESSION['age']``,... 

    3. Si le visiteur se déconnecte du site, la session est fermée et les variables de sessions sont alors "oubliées" par php, le plus souvent c'est un timeout qui déconnecte le visiteur,
    (après un certain temps d'inactivité sur le site on est déconnecté), mais on peut aussi créer un bouton déconnexion.
    
+ On a besoin de 2 fonctions pour les sessions:
    - ``session_start()`` : elle permet de démarrer la session, en générant un numéro de session quand il vient d'arriver sur le site,
    cette fonction doit etre utilisé ensuite sur toute page où l'on souhaite utiliser les variables de session, ``session_start()`` doit être appelée avant d'écrire la moindre ligne d'HTML (même avant <!DOCTYPE>)
    
    - ``session_destroy()`` : ferme la session du visiteur, automatiquement appelée si le visiteur ne charge plus de pages du site depuis plusieurs minutes (=timeout), on peut aussi créer un bouton déconnexion avec cette fonction 

+ Exemples de session:
```
<?php
//On démarre la session avant de créer le moindre HTML: 
session_start();

//On peut créer des variables de session (note: contrairement à session_start() on peut créer les varibales n'importe où)
$_SESSION['name'] = 'bob';
$_SESSION['age'] = 24;
$_SESSION['country'] = 'France';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <title>Titre</title>
    </head>
    <body>
        <!--On peut alors utiliser nos variables n'importe où sur le site tant que session_start est utilisé au début de chaque page où on souhaite utiliser la session-->
        <p>Bonjour <?php echo $_SESSION['name']; ?> !<br /></p>
    </body>
</html>
```

+ On peut utiliser les sessions pour:
    - créer un script qui demande un login et un mot de passe pour que le visiteur se connecte, on peut alors enregistrer son identifiant sur toutes les pages du site 
    - vu que le login est retenu et que la variable de session n'est retenue que s'il a réussi à se connecter on peut alors restreindre l'accès à certaines pages aux visiteurs non connectés, cela permet de protéger plusieurs pages automatiquement derrière un  mot de passe 
    - sur les ites de vente en ligne on peut utiliser les sessions pour gérer le panier des visiteurs et le retenir quelquesoit la page où se situe le visiteur 
    - ... 


## Les cookies:  
+ Un cookie est un petit fichier enregistré sur l'ordinateur du visiteur , il contient du texte et permet de retenir des infos, par exemple on peut retneir le pseudo du visiteur, son age,.. Chaque cookie ne stocke qu'une info à la fois généralement 
+ Sous mozilla on peut aller dans outils/options/vie privée et cliquer sur supprimer des cookies spécifiques si on souhaite en supprimer 

+ Chaque cookie a: 
    - un nom 
    - une valeur 
    - une date d'expiration
+ Ils ne peuvent stocker que quelques ko 

### Ecrire un cookie: 
+ On utilise ``setcookie()`` en lui donnant trois paramètres: son nom, sa valeur et sa date d'expiration sous la forme d'un timestamp:
    - le timestamp ou Unix Timestamp est le nombre de secondes écoulées depuis le 1er janvier 1970 00:00:00 UTC, pour obtenir le timestamp actuel on fait appel à ``time()``, si on veut supprimer le cookie dans un an à comter d'aujourd'hui on écrit donc:
        + ``<?php setcookie('name', 'bob', time() + 365*24*3600); ?>``

    - Il est également recommandé d'utiliser le mode httpOnly , cela rendra le cookie inaccessible en JavaScript pour les naviagteurs qui supportent cette fonctionnalité, cela réduit les risques de failles XSS si on a oublié d'utiliser htmlspecialchars, on écrit donc comme suit:
        + ``<?php setcookie('age', 22, time() + 365*24*3600, null, null, false, true); ?>``
        + Le dernier paramètre 'true' active le mode httpOnly, les trois paramètres rpécédents (null, null, false) sont des paramètres que l'on utilise pas, on doit donc leur atribuer null (et false) pour les "passer" et pouvoir mettre httpOnly (à cause de l'ordre des paramètres)

+ Comme pour ``session_start()`` , ``setcookie()`` doit être écrit avant le code html , donc si je veux créer un cookie qui retient le nom de mon pays pendant un an, et un autre mon nom pendant 6 mois, je dois écrire:
```
<?php 
setcookie('country', 'France', time() + 365*24*3600, null, null, false, true);
setcookie('name', 'bob', time() + (365*24*3600)/2, null, null, false, true);
//Seulement après les cookies on peut commencer à écrire du code html 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <title>Titre</title>
    </head>
    <body>
        On peut récupérer les valeurs des cookies contenues dans la superglobale: $_COOKIE:
        <p>Bonjour <?php echo $_COOKIE['name']; ?> !<br /></p>
    </body>
</html>
```

+ Si le cookie n'existe pas, la variable superglobale n'existe pas également, il faut donc utiliser ``isset()`` pour s'assurer que le cookie existe ou non 
Comme n'importe quelle info envoyée par un visiteur, les cookies ne sont pas sûrs, il faut donc faire des vérifications pour vérifier qu'ils ne contiennent pas d'éléments malveillants.

+ Si on veut modifier un cookie existant on a juste besoin de changer la valaur du cookie en gardant le nom, afin d'en écraser le contenu, cela aura aussi pour effet de remettre le temps d'expiration à zéro:
    - ``<?php setcookie('name', 'robert', time() + (365*24*3600)/2, null, null, false, true); ?>``
    - dans cet exemple, le cookie nom passera de la valeur 'bob' à la valeur 'robert', le temps avant expiration sera remis à zéro.

## Générer un message d'erreur grâce à $_SESSION
```
<?php
//On initialise la session avant toute chose, sur les pages où on en aura besoin
session_start();

//Ensuite si au sein du code on veut renvoyer un message d'erreur:
if(condition){
    do_something();
}
else {
    //ON retourne l'erreur en créant une variable de session "error" et en l'initialisant avec le nom de notre erreur:
    $_SESSION["error"] = "There is an error, try again";
}
?>

//Ensuite à l'endroit où on souhaite l'afficher:
<?php if( !empty($_SESSION("error")) ): ?>
    <div class="alert--red" role="alert">
        <?php echo $_SESSION("error); ?>
    </div>
<?php 
    //Vider la variable erreur
    $_SESSION("error") = '';
    endif; 
?>
```
