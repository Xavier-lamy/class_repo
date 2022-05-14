# Travailler avec les formulaires en php

+ Rappel sur les formulaires:
```html
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <title>Formulaires</title>
        <meta charset='utf-8' />
    </head>
    <body>
        <form method="POST" action="cible.php"> <!--Ici la méthode réfère à la manière d'envoyer le formulaire
    post= on envoie sans passer par l'url, on peut envoyer plus d'infos, get: on envoie en passant par l'url, plus limité
    action détermine quelle page de traitement php est appelée par le formulaire-->
            <fieldset>
                <legend>Infos Diverses</legend>
                <label>Votre nom: <input type="text" name="firstname" id="firstname" value="Bob" /></label> <!--Si on fait comme ça (l'input directement dans le label, on a alors pas besoin de l'attribut for="" dans lequel on
            met normalement le nom de l'id l'inconvénient c'est que c'est moins maléable en css je pense, label permet surtout de pouvoir cliquer sur le label pour valider la case à cocher dans le cas des cases à cocher par exemple name réfère au nom qui sera utilisé pour le php, notemment pour les variables (dans le $_POST par exemple)
            value permet de préremplir avec une valeur par défaut-->
                <input type="submit" value="Valider" /> <!--Enverra le formulaire à la page chosie dans action avec la méthode contenue dans method-->
            </fieldset>
        </form>
    </body>
</html>
```

+ Ensuite on peut traiter en php avec POST (un peu mieux que get), on imagine qu'on est sur une autre page
```html
<p>
    Vous vous appelez <?php echo $_POST['firstname']; ?>
</p>
``` 

+ Quand on fait le formulaire, l'attribut name="" définit à chaque fois la variable $_POST qui sera créée:
```html
<textarea></textarea> <!--Le texte tapé dans la zone-->

<select></select>   <!--le choix de l'utilisateur c'est à dire le value="" de <option></option>-->

<input type="checkbox" name="choix1" /><!-- si la case a été cochée $_POST[choix1] renverra "on", sinon $_POST[choix1] n'existera pas-->

<input type="radio" name="yesorno" value="oui" id="oui" checked="checked" /> <label for="oui">Oui</label>
<input type="radio" name="yesorno" value="non" id="non"/> <label for="non">Non</label>
<!--Les boutons d'options (radio) fonctionnent toujours par groupe, tous les boutons d'un meme groupe doit avoir le meme name="", la variable $_POST[yesorno] aura la valeur du bouton choisi par le visiteur -->

<!--Les champs cachés:-->
<input type="hidden" name="pseudo" value="Bobby66" />
<!--Ils ne seront pas visible par l'utilisateur et servent généralement à transmettre des infos fixes ainsi le contenu de l'input ne sera pas visible mais 
pourra quand meme etre envoyé par le formulaire à notre page.php, il faut tout de meme faire attention, malgré qu'ils soient cachés ils peuvent nénanmoins etre vu par quelqu'un qui lirait le code source, il faut donc leur accorder la meme importance de securite qu'a n'importe quel champs-->
``` 

+ Comme pour les transmissions de données avec ``_GET`` pour les url, ``POST`` peut avoir les memes failles de securité (un utilisateur mal intentionné pourrait transmettre des valeurs erronées pour faire planter le serveur, ou quelqu'un qui fait une erreur , pas besoin d'etre mal intentionné )

+ En effet un utilisateur pourrait envoyer dans le formulaire des balises html, notemment des balises script, ce qui lui permettrait de pouvoir exécuter un script sur notre site 
+ De plus un utilisateur ne peut certes pas modifier notre index.html (juste le lire), mais il peut créer son propre html malveillant qu'il reliera a notre php , lui permettant alors d'exécuter des scripts malveillants 


+ **Faille XSS** (Cross-site Scripting): méthode qui consiste à injecter de l'HTML avec du javascript à l'intérieur, dans une page, pour le faire exécuter aux visiteurs, il pourra par exemple demander l'accès aux cookies et récupérer alors toutes les infos 
    - Pour corriger cette faille il faut protéger le code HTML en "l'échappant", càd en affichant les balises (comme quand on veut les afficher pour un tableau récapitulatif de balises ou en les retirant:
    - Pour cela on utilise ``htmlspecialchars($_POST['name'])`` qui permettra de transformer les chevrons ``<>`` des balises html en ``&lt;`` et ``&gt;`` ce qui permet d'afficher les balises au lieu de les lire pour les exécuter 
    ```php 
    echo htmlspecialchars($_POST['name']) //Dans ce cas meme si des balises on été tapés elle s'afficheront au lieu d'etre interprétées
    ```

+ Il faut utiliser cette méthode pour tout texte entré par un utilisateur et amené à etre affiché sur le site (message d'utilisateurs, pseudo, signatures,...) 

+ Pour les retirer carrément plutot que de les afficher on peut utiliser ``strip_tags($_POST["name"])`` , mais la doc php recommande de ne pas utiliser ceci pour combattre les attaques XSS 


## ENVOI DE FICHIERS AVEC LES FORMULAIRES:

1. créer le formulaire d'envoi de fichier:
```php
    <form action="cible_envoi.php" method="POST" enctype="multipart/form-data"> <!--enctype="" est un attribut à ajouter à un formulaire, quand l'un des input permet d'envoyer un formulaire, ainsi le navigateur sait qu'il devra envoyer des fichiers-->
        <p>
            Glissez vos fichiers ici:<br />
            <input type="file" name="myfile" /><br /> <!--l'input type="file" permet à l'utilisateur d'envoyer des fichiers-->
            <input type="submit" value="Envoyer" /> <!--On fait un bouton submit bien entendu-->
        </p>
    </form>
```

2. le traitement de l'envoi et l'upload: le fichier n'est de base pas envoyé tout de suite il faut donc traiter son envoi, le fichier est stocké dans un dossier temporaire du serveur en attendant d'etre traité, quand on envoie un fichier au lieu de ``GET`` ou ``POST``, une variable ``$_FILES`` est créée elle contient les infos sur le doc:
    - ``$_FILES['myfile']['name']`` : contient le nom du fichier du visiteur 
    - ``$_FILES['myfile']['type']`` : indique le type de fichier, ex: pour une image gif: image/gif
    - ``$_FILES['myfile']['size']`` : indique la taille du fichier en octets , par défaut en php impossible d'envoyer un fichier de plus de 8 Mo 
    - ``$_FILES['myfile']['tmp_name']`` : indique le nom  et l'emplacmetn du répertoire temporaire créé par php pour le fichier, en attendant qu'il soit traité 
    - ``$_FILES['myfile']['error']`` : contient le code d'erreur pour savoir si l'envoi s'est bien effectué ou s'il y a eu un problème (et lequel), renvoie 0 s'il n'y a pas d'erreur

    - Dans notre fichier ``cible_envoi.php`` on va donc vérifier que le fichier a été envoyé et si l'envoi s'est fait correctmtn:

```php
//On teste qu'un fichier a bien été envoyé et s'il n'ya pas d'erreur d'envoi:
if (isset($_FILES['myfile']) AND $_FILES['myfile']['error'] == 0)
{
    //On teste la taille du fichier, ici on ne veut pas qu'il épasse 1Mo
    if ($_FILES['myfile']['size'] <= 1000000)
    {
        //On récupère l'extension du fichier:
        $infosfichier = pathinfo($_FILES['myfile']['name']); //ici on utilise pathinfo() qui renvoie une array contenant des infos, notemment l'extension de fichier
        $extension_upload = $infosfichier['extension']; //ici on récupère l'info de l'extension dans une variable
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png'); //On créé une array qui liste toutes les extensions autorisées
        if (in_array($extension_upload, $extensions_autorisees)) //on vérifie si notre extension est comprise dans la liste d'extensions autorisées avec in_array() qui prend en paramètres: l'extension recherchée, la liste où rechercher
        {
            //On peut alors valider le fichier et le stocker définitivement:
            move_uploaded_file($_FILES['myfile']['tmp_name'], 'uploads/' . basename($_FILES['myfile']['name']));
            /*cette fonction prend en paramètre: le nom temporaire sous lequel le fichier est stocké, le nouveau nom (chemin d'accès compris) qu'on souhaite lui donner, ici on souhiate le mettre dans un dossier 'uploads/'
            puis on utilise la fonction basename pour récupérer uniquement le nom du fichier et son extension (autrement on aurait le path complet; c:/dossier/fichier.ext, là on aura que fichier.ext)*/
            echo 'L\'envoi a bien été effectué !';
        }
    }
}
```
+ Quelques précisions supplémentaires: quand on utilise un logiciel FTP  pour mettre le script sur internet il faut vérifier que le dossier uploads sur le serveur existe avec les droits d'écriture, pour ce faire sous filezilla: clic droit sur le dossier, "attributs du fichier", on peut alors éditer les droits du dossier (CHMOD) On met alors les droits à 733 pour que php puisse placer les fichiers uploadés dans ce dossier 

+ Si plusieurs personnes ont choisi le meme nom de fichier le dernier ajouté écrasera l'ancien, dans ce cas on peut ajouter une boucle qui créé et incrément un nom de fichier pour chaque fichier (ex: 1.jpg, 2.jpg, 3.jpg)

**_TOUJOURS ETRE VIGILANT POUR EVITER QUE QUELQU'UN ENVOIE DES INFOS MALVEILLANTES OU DU CODE PHP, JAVASCRIPT,... SUR NOTRE PAGE_** 
