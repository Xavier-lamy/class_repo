# Les url en php

+ ``Url`` : Uniform Ressource Locator, sert à représenter une adresse sur le web
+ dans une URL les infos après le ``?`` sont des paramètres que l'on peut envoyer avec l'url afin de les transmettre à une autre page :
+ dans cet exemple on cherche à aller sur la page "bonjour.php" de "monsite.com": ``https://www.monsite.com/bonjour.php?name=Razowski&first_name=Bob``
    - on lui envoie au passage les paramètres "name" avec la valeur razowski et "first_name" avec la valeur bob

+ On peut techniquement envoyer autant de paramètres qu'on veut tant qu'on les sépare par ``&`` (``&amp;``dans un doc html)
    - néanmoins il est déconseillé de dépasser 256 caractères de longueur pour une urldecode

+ On pourrait donc avoir le lien suivant:
    ```html
    <a href="bonjour.php?name=Razowski&amp;first_name=Bob">Say hello to my little friend !</a>
    ```
    - note: "&" doit etre remplacé par "&amp;" dans les doc html 
    - Ce lien appelle la page "bonjour.php" et envoie les paramètres name et first_name

+ Dans la page bonjour.php, si on veut récupérer nos infos, elles sont stockées dans une array nommée ``$_GET``,
    - si on veut récupérer le nom on fera donc: ``$_GET['name']`` , pour le prénom: $_GET[first_name],
    - On peut donc utiliser ``$_GET`` pour écrire un message sur bonjour.php avec les infos envoyées par l'url du lien:
    ```html
    <p>
    <?php
        echo 'Bonjour' . $_GET['name'] . ' ' . $_GET['first_name'] . ' !'; 
    ?>
    </p>
    ```

+ Il faut bien se rappeler de **_NE JAMAIS FAIRE CONFIANCE AUX DONNEES SAISIES PAR L'UTILISATEUR_**.
    - Il peut en effet modifier les paramètres de l'url dns la barre de recherche, et par exemple enlever un parmètre nécessaire à la réalisation du code (ce qui le ferait planter), ou mettre un nombre de répétition particulièrement haut (faisant également planter)

+ Pour empêcher cela il va falloir faire des vérifications, pour s'assurer que les infos saisies sont des infos valides que notre code peut traiter sans planter et que toutes les infos nécessaires sont bien présentes:

+ Pour cela on peut utiliser la fonction ``isset($nom_de_la_variable)``, qui vérifie que la variable est bien déclarée, si elle existe:
```php 
if (isset($_GET['name']) AND isset($_GET['first_name'])) //On vérifie que nos deux variables sont bel et bien présentes
{
    echo 'Bonjour' . $_GET['name'] . ' ' . $_GET['first_name'] . ' !';
}
else //Si une ou les deux variables n'est pas présente il faut alrs retourner un message d'erreur:
{
    echo 'Le prénom et le nom doivent être renseignés !';
}
```

+ Pour l'instant les erreurs possibles ne sont pas si graves, mais dans le cas suivant on ajoute le nombre de répétitions (combien de fois on veut dire bonjour)
    - Dans ce cas si l'utilisateur met un très grand nombre en paramètre le site pourrait planter, il pourrait aussi mettre des éléments non valides comme des string, des nombre négatifs,... 

+ Pour vérifier qu'une variable contient bien un nombre on peut utiliser le TRANSTYPAGE = convertir une variable dans le type de donnée souhaité, par exemple avec (int), on la transforme en ``integer``:
```php
if (isset($_GET['name']) AND isset($_GET['first_name']) AND isset($_GET['repeat']))
{
    //1. On oblige 'repeat'  à être un nombre entier, ainsi si l'utilisateur envoie une donnée erronée comme une string, cela retournera 0, si il envoie un entier, cela ne fera rien et retournera l'entier qu'il a envoyé:
    $_GET['repeat'] = (int) $_GET['repeat'];

    //2. Ensuite il faut s'assurer que le nombre entier n'est pas un nombre négatif, égal à zéro ou trop grand:
    /*Commenté car génère une erreur , à revoir:
    if (1 <= $_GET['repeat'] <= 100)
    {
        for ($iteration = 0, $iteration < $_GET['repeat'], $iteration++)
        {
            echo '<p>Bonjour' . $_GET['name'] . ' ' . $_GET['first_name'] . ' !</p>';
        }  
    } */    
}
else //Si toutes les conditions ne sont pas présnetes alors on envoie un message d'erreur (on peu en envoyer des différents pour chaque erreur)
{
    echo 'Le prénom et le nom doivent être renseignés !';
}
```

+ Il faut donc toujours s'assurer que :
    - tous les paramètres attendus sont bien présentes
    - tous les paramètres attendus contiennent les valeurs correctes et comprises dans l'intervalle souhaité
