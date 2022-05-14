# Les bases de PHP
+ Site statique: site réalsié avec les standards HTML et CSS et qui n'offre pas de dynamisme (pas de personnalisation de la page en fonction du client)

+ Site dynamique : site réalisé avec HTML,CSS auxquels on ajoute des langages de POO et des langages serveurs (JS, PHP, SQL)
dans un site dynamique on peut par exemple réaliser un espace membre, un forum, un compteurs de visiteurs, un espace commentaires, des actualités, une newsletter, un formulaire de contact, ...

+ La différence entre les deux:
    - Statique: le client demande une page au serveur qui lui renvoie alors la page demandée
    - dynamique: le client demande la page au serveur, le serveur utilise PHP (ou autre langage serveur) pour générer la page (en HTML et CSS) sur mesure puis l'envoie au client

+ Il existe d'autres exemples de langages serveurs concurrents de PHP:
    - ASP.NET : de microsoft langage proche du C#.NET
    - Ruby on Rails : langage utilisant le Ruby
    - Django : similaire à ruby on rails mais basé sur du python
    - Java et JSP (Java Server Pages): ou JEE (Java EE), courant dans le monde professionnel

+ Le code PHP s'intègre directement au code HTML et permet de générer du code HTML, les parts de code en PHP seront les parties interactives, elles peuvent etre insérés entre deux balises html ou meme directemnt dans une balises, on écrit: ``<?php ?>``
    - généralement sur plusieurs lignes: 
    ```php
    <?php
    echo $random_var;
    "code php ici";
    "là aussi";
    "et ici ...";
    ?> //le tag de fermeture n'a pas besoin d'être mis si le fichier ne contient que du php
    ```
+ On peut aussi utiliser: 
    - ``<? ?>``
    - ``<% %>``
    - Ou d'autres mais la plus correcte reste ``<?php ?>``
    - ``<?= ?>`` remplace: ``<?php echo ?>``

## Include
On peut inclure des pages php dans d'autres ou dans des éléments HTML avec ``include()``:
```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon super site</title>
    </head>
 
    <body>
 
    <!-- L'en-tête -->
    <?php include("header.php"); //Il faut faire attention aux chemins d'accès, soit on met tout dans le meme dossier, soit on pense à mettre le path devant le nom de fichier ?> 
    
    <!-- Le menu ici on ajoute le path car on imagine que le fichier est dasn un dossier partials-->
    <?php include("partials/menu.php"); ?>
    
    <!-- Le corps (lui n'aura pas besoin de include car c'est ce qui sera différent sur chaque page) -->
    
    <div id="corps">
        <h1>Mon super site</h1>
        
        <p>
            Bienvenue sur mon super site !<br />
            Vous allez adorer ici, c'est un site génial qui va parler de... euh... Je cherche encore un peu le thème de mon site. :-D
        </p>
    </div>
    
    <!-- Le pied de page -->
    <?php include("footer.php"); ?>
    
    </body>
</html>
```


## Ternaire:
- 3 expressions sous la forme:
    - ``(expr1)`` ? ``(expr2)`` : ``(expr3)``;
    - si ``(expr1)`` = true alors le résultat est ``(expr2)`` si ``(expr1)`` = false alors le résultat est ``(expr3)``
    - ex: ``$result = ($produit == 2) ? A : B;`` , si $produit vaut effectivement 2 alors $result = A sinon = B

## Create a string from an array:
```php 
$array = array('lastname', 'email', 'phone');
$comma_separated = implode(",", $array); 
echo $comma_separated; // lastname,email,phone
```

## Opérateur spaceship
Utilisé pour comparer deux expressions selon les règles de comparaison habituelles de PHP, retourne: 
- -1 quand ``$a`` est inférieur à ``$b``
- 0 quand ``$a`` est égal à ``$b``
- 1 quand ``$a`` est supérieur à ``$b``
```php
//Integers
echo 1 <=> 1; // 0
echo 1 <=> 2; // -1
echo 2 <=> 1; // 1

//Floats
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1
 
//Strings
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1
```

## exemples d'instruction:
- ``<?php echo "Le texte ici"; ?>``
- Ne pas oublier le ``;`` à la fin de chaque instruction 
- l'instruction ``<?php print "text"; ?>`` fonctionne aussi pour insérer du texte, mais echo est plus utilisée

+ Si on souhaite afficher des guillemets à l'intérieur de nos guillemets on utilise:
    - les backslash: ``<?php echo "Du \"texte\" avec des guillemets à l'intérieur"; ?>``
    - d'autres styles de guillemets: ``<?php echo "Du 'texte' avec des guillemets à l'intérieur"; ?>``

+ exemples de serveurs web permettant de lire le php : apache, njinx 

## Corriger les erreurs et soigner son code
- php cs (coding standard): pour vérifier automatiquement que notre code suit les standards de programmation PHP (inclu de base dans vscode avec *php cs fixer*)
- php md mess detector pour etre sûr de faire du code php propre et détecter les problèmes de syntaxe, les codes trop verbeux ou inutilement compliqué :
    - Dans le dossier du projet: ``composer require phpmd/phpmd``
    - Puis on entre la commande: ``phpmd src/ html unusedcode --reportfile phpmd.html``, après la commande ``phpmd``, on a besoin des paramètres suivants:
        - le chemin du code source à examiner
        - l'extension du fichier du rapport
        - la règle que l'on souhaite tester parmi (on peut aussi créer les nôtres): ``cleancode``, ``codesize``, ``controversial``, ``design``, ``naming``, ``unusedcode`` (voir doc pour plus d'infos)
        - des options (ici ``--reportfile`` qui permet d'envoyer le rapport dans le fichier de rapport au lieu de l'output de la console par défaut)
        - Le nom du fichier du rapport d'erreur
    - Sous windows, par défaut un terminal powershell ne lance pas une commande locale, il  faut donc autoriser la commande : ``.\phpmd``

## Include vs require
+ ``require()`` : 
    - inclut le contenu d'un fichier appelé
    - provoque une erreur bloquante s'il n'est pas dispo ou n'existe pas
+ ``require_once()`` :
    - inclut le contenu d'un fichier appelé
    - inclut seulement une seule fois dans le document, si le fichier a déjà été appelé il ne le sera pas à nouveau
    - provoque une erreur bloquante s'il n'est pas dispo ou n'existe pas
+ ``include()`` : 
    - inclut le contenu d'un fichier appelé
    - sans provoquer d'erreur bloquante s'il n'est pas dispo ou n'existe pas
+ ``include_once()`` : 
    - inclut le contenu d'un fichier appelé
    - inclut seulement une seule fois dans le document, si le fichier a déjà été appelé il ne le sera pas à nouveau
    - sans provoquer d'erreur bloquante s'il n'est pas dispo ou n'existe pas

## php cli vs php web
+ **php-cli** pour faire fonctionner des scripts (généralement en console/terminal) 

+ **php-fpm** en quelque sorte la version pour le web, utilisée sur les serveurs

+ En cas de problème avec une des deux versions vérifier  que les chemins soient bien présent dans le system path