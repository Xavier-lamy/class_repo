# Les principaux champs ACF

### Champs textes
+ Champs texte simple: pour toute donnée courte
+ Champs textarea : pour un texte plus long
    - réglage ligne pour régler la hauteur du champs
    - réglage pour les retours à la ligne: 
        - pas de formatage
        - balise ``<br>``
        - chaque ligne est un nouveau paragraphe (attention à ne pas alors entourer le champs avec des ``<p>`` dans le template)
+ champs éditeur de contenu (par défaut Tiny MCE)

### Champs nombres
+ Champ nombre, réglage:
    - valeur minimale
    - valeur maximale
    - pas (intervalle entre chaque incrémentation)
    - préfixe ou suffixe, uniquement pour l'interface administration (nécessite d'etre ajouté à la main dans le template)
+ Champ curseur (range): pour sélectionner une valeur dans un intervalle

### Champs URL, e-mail et mot de passe
+ champ URL: vérifie que le texte saisi est bien une url
+ champ e-mail: vérifie que le texte saisi est bien un e-mail
+ champ mot de passe : cache une valeur saisi, mais n'est pas chiffré à l'enregistrement, donc pas très sécurisé

### Champs médias
+ champ image : préférer le format de sortie "ID"
+ champ galerie (*ACF Pro*) : permet d'insérer plusierus images, cela permet d'en faire ensuite un diaporama ou une galerie photo par exemple
+ champ fichier : pour joindre un fichier, que le visiteur pourra télécharger, on peut choisir *url*, ou *données du fichier* en format de sortie
+ champ oEmbed : permet d'ajouter des contenu embarqués (des liens copiés depuis youtube, vimeo, twitter,... et qui apparaitront de manière interactive)

### Champs de choix
+ champ liste déroulante: dans le réglage *choix* on indique les valeurs de la liste sous forme clé: valeur, ex: "easy: Facile", "medium: Moyen",...; en format de sortie on peut récupérer la clé, la valeur ou les deux en array
+ case à cocher: on peut cocher plusieurs cases
+ bouton radio: on coche une case au choix
+ groupe de bouton: on peut choisir plusieurs valeurs qui se trouvent sur les boutons au lieu d'avoir des cases à cocher
+ vrai/faux: case à cocher, si coché=vrai, sinon=faux; en verion pro: interrupteur on/off; ce champs peut permettre de créer des logiques conditionnelles (ex: un autre champs apparait que si celui ci est coché)


### champs relationnels
+ champ de lien: 
    - classique: lien vers une url
    - lien interne : permet de créer un lien en choisissant une ressource du site dans un moteur de recherche
+ champ objet publication: renvoie l'**ID** ou un **objet** avec toutes les infos d'une publication, on peut s'en servir pour aficher par exemple l'identifiant et le contenu d'une publication 
+ champ relationnel (*ACF Pro*): permet de sélectionner des publications et de choisir dans quel ordre elles apparaissent
+ champ taxonomie: pour lister et choisir une catégorie ou une étiquette, peu utile, préférer l'interface native
+ champ utilisateur: pour choisir un utilisateur


### champs jQuery
+ champs date et heure: les 3 ont des sélecteurs pour choisir une date ou une heure, on peut choisir le format d'afichage dans l'admin et celui dans le modèle:
    - champ date
    - champ heure
    - champ date et heure
    - pour afficher le résultat on peut ensuite:
    ```php
    // sans manipulations:
    the_field( 'date' );

    // avec manipulations
    $date_string = get_field( 'date' );
    $date = DateTime::createFromFormat( 'Ymd' , $date_string );
    $date->modify( '+1 day' ); // exemple pour ajouter un jour
    echo $date->format( 'j M Y' );
    ```
+ Champ couleur: pour sélectionner une couleur par son code héxadécimal ou avec un sélecteur de couleur
+ champ google Map: pour afficher une carte google map avec des marqueurs de position:
    - récupérer une clé API valide sur **Google Cloud Platform**
    - dans **functions.php** ajouter:
    ```php
    function prefix_acf_google_map_api( $api ){
        $api['key'] = 'mettre_la_clé_api_ici';
        return $api;
    }
    add_filter( 'acf/fields/google_map/api', 'prefix_acf_google_map_api' );
    ```
    - Il faut utiliser un peu de JS pour afficher sur le site (voir doc)

### Version Pro
#### champs de répétition
+ champ répéteur: pour créer des sous-champs qui seront répétés quand on clique sur *Ajouter un élément* (modifiable), pour l'affichage il faut faire une boucle:
```php
if( have_rows( 'repeteur' ) ): while ( have_rows( 'repeteur' ) ) : the_row();
    the_sub_field( 'sous_champ' ); // au lieu de the_field()
endwhile; endif;
```
+ champ contenu flexible: permet de définir des petits groupes de champs appelables par le rédacteur dans l'ordre souhaité
+ champ groupe: permet de regrouper les champs
+ champ clone: permet de cloner des champs pour les réutiliser ailleurs

#### champs de disposition
+ message : pour donner des infos ou instructions aux rédacteurs
+ accordéons : pour regrouper des champs et pouvoir les afficher/cacher
+ onglets : permet aussi de regrouper les champs comme les accordéons mais de manière horizontale avec des onglets

#### options de mise en page
+ colonnes : permet d'afficher plusieurs champs sur une même ligne, en définissant une taille en pourcentage (tant que la somme est inférieur à 100% ils seront sr la même ligne)
+ logique conditionnelle: on peut par exemple s'en servir pour afficher des champs que si une condition est remplie (case cochée ou valeur sélectionnée)

