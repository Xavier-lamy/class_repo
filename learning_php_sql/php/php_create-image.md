# Créer des images en php

- En php, à l'aide d'extensions, on peutfaire de nombreuses choses comme générer des PDF ou des images.
- Pour les images on peut utiliser l'extension spécialisée pour la génération d'images: la bibliothèque GD
    - Elle est activée de base si on travaille avec MAMP (au besoin modifier le php.ini), avec un hébergeur cela dépend, certiasn hébergeurs désacitve cette bibliothèque car elle consomme beaucoup de ressources sur le processeur. 

On peut générer des images de deux façons:
- le script php renvoie une image au lieu d'une page web
- php enregistre l'image dans un fichier au lieu de l'afficher

1. pour que le script renvoie une image:
    - le header : on envoie en premier lieu un **header** avec la fonction ``header()`` afin de préciser qu'on est en train d'envoyer une image 
    - **IL FAUT METTRE L'HEADER AVANT D'ECRIRE LA MOINDRE LIGNE D'HTML**
    ```php
        <?php
        header('Content-type: image/png'); //cela annonce au navigateur qu'on lui envoie une image et non pas une page web
        ?>
    ```
    - Ensuite il y a deux possibilités: 
        - On crée une image vide:
        ```php
            header('Content-type: image/png');
            $image = imagecreate(200,50); //La fonction "imagecreate()" créé une image dans la variable choisie en paramètres on indique le nombre de pixels de large (200) et le nombre de pixels de haut (50)
            //cette variable est une ressource, càd une variable un peu spéciale qui contient toutes les infos sur un objet (image, pdf, fichier,...)
        ```
        - On crée à partir d'une image existante:
            * à partir d'un JPEG: 
            ```php
            header('Content-type: image/jpeg');
            $image = imagecreatefromjpeg("nomimage.jpeg");
            ```
            * à partir d'un png:
            ```php
            header('Content-type: image/png');
            $image = imagecreatefrompng("nomimage.png");
            ```

    - Pour afficher l'image:
        * JPEG : imagejpeg($image)
        * png : imagepng($image)
        ```php
        header('Content-type: image/jpeg');
        $image = imagecreate(1920,1080);
        imagejpeg($image);
        ```
    - Ensuite si on souhaite afficher cette image dans une page web, on utilise tout simplement:
        - ``<img src="image.php" />`` (en effet notre page php dans laquelle on vient de créer une image, est considérée comme une image étant donné son header)

2. Si on souhaite enregistrer l'image au lieu de la sauvegarder:
    on enlève le ``header`` (qui ne sert plus à rien) et on ajoute en paramètre de ``imagepng()`` ou ``imagejpeg()``, le chemin de sauvegarde de l'image et son nom:
    ```php
    $image = imagecreate(1920,1080);
    imagepng($image, "images/nomimage.png"); //Elle sera alors sauvegardée dans images
    ```

    
+ Pour modifier cette image ainsi créée:
    - Créer une couleur: on utilise ``imagecolorallocate()`` avec en paramètre le nom de l'image, la quantité de rouge, de vert, et de bleu:
    ```php 
    $orange = imagecolorallocate($image, 255, 128, 0);
    $black = imagecolorallocate($image, 0, 0, 0)
    //La première couleur créée avec la fonction imagecolorallocate() devient la couleur de fond de l'image, donc dans ce cas il s'agirait du orange, qui est la première fois qu'on a fait appel de la fonction
    ```

    - Ecrire du texte:
    ```php
    imagestring($image, $police, $x, $y, $string, $couleur); // permet d'écrire du texte sur l'image
    imagestringup($image, $police, $x, $y, $string, $couleur); //permet d'écrire du texte verticalement au lieu d'horizontalement
    /*Les paramètres sont:
    $image: l'image sur laquelle on travaille
    $police: la police de caractères souhaité elle est représentée par des nombres de 1 (petit) à 5 (grand), on peut aussi utiiser des polices personnalisées, mais c'est bien plus complexe
    $x et $y: les coordonnées de l'endroit où on souhaite placer notre texte
    $string: le texte que l'on souhaite écrire
    $couleur: la couleur du texte (que l'on a défini avant)
    */
    ```

    - Dessiner des formes:
    ```php
    ImageSetPixel ($image, $x, $y, $couleur); //créé un pixel aux coordonnées x,y
    ImageLine ($image, $x1, $y1, $x2, $y2, $couleur); //créé une ligne entre les deux points de coordonnées (x1,y1) et (x2,y2)
    ImageEllipse ($image, $x, $y, $largeur, $hauteur, $couleur); //créé une ellipse de centre ($x,$y) de largeur $largeur, de hauteur $hauteur et de couleur $couleur
    ImageRectangle ($image, $x1, $y1, $x2, $y2, $couleur); //créé un rectangle dont le coin supérieur gauche est en (x1,y1) et le coin inférieur droit en (x2,y2)
    $points = array(10, 40, 120, 55, 140, 60); ImagePolygon ($image, $points, $nombre_de_points, $couleur) //créé un polygone (en paramètre: l'image sur laquelle on souhaite créé, les coordonnées de tous le spoints sous la forme d'un array (défini auparavant), le nombre total de points et la couleur)
    ```

    - Rendre une image transparente: **CELA FONCTIONNE UNIQUEMENT SUR LES PNG**, les JPEG ne peuvent être transparents:
    ```php
    imagecolortransparent($image, $couleur); // sur l'image (paramètre1) on rends la couleur du paramètre 2 transparente
    ```

    - Mélanger deux images: Par exemple on peut se servir de cette méthode pour ajouter un copyright sur toutes les images automatiquement, on utilise pour cela ``imagecopymerge()`` qui prend beaucoup de paramètres:
    ```php
    header('Content-type: image/jpeg'); //on indique qu'on créé un jpeg
    //On charge les images:
    $source = imagecreatefrompng('logo.png'); //le logo est la source aka ce qu'on va coller sur l'autre image
    $destination = imagecreatefromjpeg('nomimage.jpeg'); //la destination est l'image sur laquelle on veut coller le logo

    //On utilise imagesx() et imagesy() qui renvoie respectivement la largeur et la hauteur d'une image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    $largeur_destination = imagesx($destination);
    $hauteur_destination = imagesy($destination);

    //Dans le cas ou on souhaite mettre le logo tout en bas à droite on calcule les coordonnées où on doit placer le logo:
    $destination_x = $largeur_destination - $largeur_source;
    $destination_y = $hauteur_destination - $hauteur_source;

    //On peut alors merge les deux, càd mettre le logo dans l'image:
    imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 60);
    //Les deux 0 sont l'abscisse et l'ordonnée de la source on mettra d'autres valeurs que 0 si on souhaite uniquement garder une partie de l'image du logo
    //Remarque si on voulait mettre en haut à gauche les calculs destination_x et _y ne sont pas nécesaires, on peut juste mettre 0
    //la dernière valeur est le degré de transparence, de 0=invisible/totalement transparent à 100=visible/totalement opaque
    //On affiche alors l'image de destination fusionnée avec le logo:
    imagejpeg($destination);
    ```

    - Si on souhaitait se servir de tout ça pour crééer une page qui copyright toutes nos images on pourrais écrire: ``<img src="copyright.php?image_name=nom.jpg" />`` 
        - On appelle notre page copyright qui se chargera d'ajouter le logo de copyrigth à notre image nom.jpg, pour cela, la page copyright prendra la valeur contenu dans ``image_name`` dans une variable ``$_GET['image']``


    - Redimensionner une image: Afin de créer une miniature d'une image on peut utiliser: ``imagecopyresampled()``:
    ```php
    //Pas besoin de header car on va sauvegarder notre image directement:
    $source = imagecreatefromjpeg("nomdelimage.jpg"); //la photo source à redimensionner
    $destination = imagecreatetruecolor(200, 150); //On créé une image vide pour la miniature avec imagecreatetruecolor() cette fonction est un peu comme imagecreate mais permet de contenir beaucoup plus de couleurs
    
    //On réutilise imagesx() et imagesy() pour les largeurs et hauteurs
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    $largeur_destination = imagesx($destination);
    $hauteur_destination = imagesy($destination);

    //On créé alors la miniature:
    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
    //Les 4: 0 correspondent aux valeurs suivantes: abscisse du point où se place la miniature sur l'image $destination, l'ordonnée de ce même point, l'abscisse du point de la source et l'ordonnée du point de la source, en général on met ces 4 paramètres à zéro pour créer une miniature, puisque celle ci devra occuper toute la plce de l'image $destination

    //On enregistre la miniature sous le nom "mini_image.jpg"
    imagejpeg($destination, "mini_image.jpg");
    ```