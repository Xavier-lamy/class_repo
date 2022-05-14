# PhpMyAdmin

+ Si on veut avoir une vue d'ensemble rapide de nos bases de données SQL on peut utiliser 
**phpMyAdmin**, il est livré avec MAMP ou XAMPP (on a donc pas besoin de l'installer si on a déjà l'un des deux)

+ **phpMyAdmin** est un ensemble de pages php qui permettent de gagner du temps, on peut ainsi créer et manipuler des bases de données 

## ajouter une nouvelle base de données: 
+ on entre un nom pour la base de données puis on clique sur create 
+ On peut alors créer une nouvelle table à l'intérieur
  - on ajoute un nom et un nombre de colonnes et on clique sur create  
+ on doit alors créer le nom des champs:
  - il est recommandé de créer un champ ID, dans lequel on entre des données de type INT, puis on lui ajoute un ``"index: primary"`` ce qui permet de le définir comme étant une "clé primaire" elle permettra de d'identifier facilement chaque entrée et doit donc absolument être différente pour chaque entrée 
  - on peut cocher A_I (Auto_Increment) ce qui permet d'incrémenter automatiquement la valeur de ID (ainsi on aura pas besoin de rentrer l'ID à chaque entrée, ce sera automatique)
  - on créé ensuite nos autres champs: les informations nécessaires à remplir sont: 
    + champ: nom du champ 
    + type: le type de données stockées dans le champ, il en existe de nombreuses avec MyAdmin, mais on utilisera toujours les plus importantes:
      - INT : nombre entier
      - VARCHAR : texte court entre 1 et 255 caractères, nécessite d'indiquer la longueur voulue dans taille/valeur   
      - TEXT : texte long 
      - DATE : date (jour/mois/année)
      - Il en existe beaucoup d'autres moins utilisés (divisés en catégories: NUMERIC, DATE and TIME, STRING et SPATIAL: pour les bases de données spatiales, pour la cartographie notemment)
    + taille/valeur : permet d'indiquer la taille max du champs, surtout utile pour le type VARCHAR 
    + index : active l'indexation du champ (pour faciliter les recherches), on utilise surtout PRIMARY sur un champ ID de type INT
    + A_I : Auto_Increment: pour incrémenter automatiquement la valeur de l'index 

+ Une fois notre table créée elle apparait à gauche dans la liste, si on clique sur le nom le contenu s'affiche, si on clique sur le logo de tableau la structure s'affiche 

+ Dans l'onglet "INSERT" on peut ajouter des entrées aux tableau en les ajoutant dans "value" puis en validant
+ On a pas besoin de remplir notre champs ID car il s'auto-incrémente (on peut ne pas mettre une des clés, mais aucune ne doit être identique à une autre, PRIMARY s'en occupe automatiquement)

## Opérations possibles: 
+ ``BROWSE`` : affiche le contenu de la table 
+ ``STRUCTURE`` : affiche la structure de la table 
+ ``INSERT`` : insère une entrée 
+ ``SQL`` : affiche une zone qui permet de faire des requetes SQL 
+ ``IMPORT`` : permet d'importer un fichier de requetes SQL (si on veut envoyer un grand nombre de requetes, c'est plus efficace que l'onglet SQL)
+ ``EXPORT`` : permet de récupérer notre base de données sur l'ordinateur sous forme de fichier .sql qui ne contient que la méthode de recréation de notre base de données (avec des requetes SQL),cela permet de:
  - transmettre notre base de données, le fichier sql généré permettra de reconstruire la base de données sur le serveur
  - faire une copie de sauvegarde de la base de données
  il faut choisir pour options: "enregistrer vers un fichier" auquel on donne un nom, on peut choisir aussi d'exporter uniquement la structure, uniquement les données ou les deux, on peut compresser au format zip.
+ ``SEARCH`` : pour faire une recherche dans la base de données 
+ ``OPERATIONS`` : permet de : changer le nom de la table, la déplacer, la copier, l'optimiser, vider ou supprimer la table 