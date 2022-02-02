# Design global
Pour créer un design cohérent:
- quand c'est possible définir une charte graphique
- trouver une inspiration sur d'autres sites sans faire de copier coller (par exemple des sites d'inspiration comme dribble.com ou collectui.com)
- définir une palette de couleurs: manuellement sur paletton.com ou colormind.io ou partir d'une image qui nous inspire et utiliser canva.com/color-palette pour générer automatiquement la palette correspondante 
- définir des polices de caractères (s'il le faut, prendre une police premium, mais dees gratuites peuvent très bien faire l'affaire), attention à ne pas utiliser une police trop exotique pour le "body"
- définir un "master visuel" càd une image qui représente la marque et qu'on utilise en priorité sur les supports de communication, des sites comme unsplash.com permettent d'avoir de belles photos gratuitement
- créer un logo, si on est pas graphiste il vaut mieux faire simple, faire en sorte qu'il se décline bien pour les versions foncés des sites, on peut trouver des icones gratuites sur: fr.freepik.com, ou créer des logos sur snappa.com ou canva.com 
- penser à créditer les designers ou photographes dont on emprunte els oeuvres pour notre travail.


Après avoir défini notre style graphique on doit alors paramétrer les options de notr thème en fonction de cette charte graphique:
- Dans le customizer (Apparence>>Personnaliser) on va modifier des options (il y en a maintenant beaucoup plus qu'avec le thème par défaut)
    - On désactive les styles par défaut d'Elementor, en effet ceux ci ne s'appliquent qu'au contenu créé avec elementor, si on veut plus de flexibilité il faut donc les désactiver: dans Elementor>>Réglages il faut cocher "désactiver les couleurs par défaut" et "désactiver els polices par défaut" (cela dépends du thème choisi, ici ce sont des options de OceanWP comme ddans l'exemple)
- On configure le logo: 
    - header>>Logo>>changer logo>>téléverser des fichiers, on prends alors notre logo dans les fichiers locaux , il faut aussi faire ça dans la section "logo retina" (dédiée aux ecranss retina doté d'une meilleur définition d'un écran classique, on doit donc si possible télécharger une image faisant le double de pixels pour les retina)
- On configure aussi le logo pour le footer, on peut en profiter pour ajouter des liens vers les profils de réseaux sociaux 

- On paramètre la palette de couleurs:
    - dans Réglages>> Central Color palette 
    - On coche les 4 checkbox 
    - On ajoute les couleurs et les noms de la palette qu'on a défini précédemment
    - on peux aussi ajouter les couleurs pour les textes gris sur fond clair (#333) et blanc (#fff)  pour lestextes sur fond sombre
        - Utiliser du noir sur les fonds clairs rend le contraste trop fort et peux faire un effet de "vibration des contours" des caractères 
    - On peut ensuite retourner dans le customizer et dans options générales on ajoute les couleurs de notre palette que l'on souhaite pour la couleur principale, celle des liens, celle principale et des liens au survol

- On paramètre les polices de caractères
    - dans typographie: on peut changer pour le corps de pages, les titres, les sous titres,... 

- On paramètre le layout (disposition) de page dnas options génrales >> réglages généraux >> on choisit le layout "100% pleine largeur"

- A propose d'elementor: 
    - L'écran d'édition possède deux paneaux:
        - A gauche le panneau pour gérer les paramètres globaux, ajouter ou modifier des éléments
        - A droite la prévisualisation

    - Il faut structurer le contenu à l'aide des balises HTML, utiliser les mots lcés seo dans les titres H1 h2 h3
    - Elementor permet de facilement adapter le design en fonction du support et de la taille d'écran 
    Avec wordpress on peut modifier simplement des images (rogner, symétrie) sans sortir du dashboard 
         