# Les tableaux ou array en php:

## tableaux numérotés: 
- chaque valeur de l'array est numérotée par une "clée" (on commence à zéro comme d'hab)
```php
$names = array ('Jack', 'Bob', 'Ben', 'Maria', 'Sarah');
//On peut aussi les créer étape par étape (ou rajouter des valeurs):
$names[0] = 'Jack'; 
$names[1] = 'Bob';
$names[2] = 'Ben';
/*Remarque pour créer une array de cette manière on est pas obligé de mettre une clé entre crochet, 
php les attribuera automatiquement , il suffit simplement de metttre les crochets,
et les valeurs seront rangés dans l'ordre de déclaration*/

//Si on souhaite afficher un élément du tableau:
echo $names[0]; //Affiche le 1er élément
```

## Tableaux associatifs
- pour découper une donnée en plusieurs sous-éléments
- On associe une "clé" qui sert "d'étiquette" à chaque valeur:
```php
$weapon = array (
    'name' => 'AK47',
    'damage' => 100,
    'accuracy' => 20,
    'stability' => 45,); //Là aussi on peut créer le tableau case par case avec le nom d'étiquette entre crochet et la valeur après le =

$weapon['total_ammo'] = 120;
$weapon['ammo'] = 30;

//Pour afficher:
echo $weapon['name']; //Renvoie AK47
```

## Parcourir un tableau
+ On peut utiliser une boucle ``for``, pour parcourir un tableau, mais le mieux est d'utiliser une boucle ``foreach``:
```php
foreach($names as $element) //A chaque tour de boucle la valeur de l'élément suivant est mise dans la variable $element et on peut donc l'afficher, cela permet d'utiliser une boucle dans un tableau, quand on ne connait pas le nombres de valeurs (pas besoin de condition d'arrêt ni d'incrémentation)
{
    echo $element . '<br />'; //Affichera les noms dans l'ordre
}
```

+ Cela fonctionne aussi pour les tableaux associatifs:
```php
foreach($weapon as $weapon_attribute) //foreach fonctionne prend donc comme argument: le nom de l'array, le mot clé "as" (en tant que), le nom de la variable dans lequel on stock tour à tour chaque élément de l'array
{
    echo $weapon_attribute . '<br />'; //ceci affichera les valeurs (mais pas les clés)
}
//Si on veut également récupérer la clé de l'élément:
foreach($weapon as $attr_name => $weapon_attribute)
{
    echo 'weapon\'s' . $attr_name . 'is' . $weapon_attribute . '.<br />';
}
```

+ Si on souhaite afficher rapidement le contenu total d'un array dans un but de test développement on peut utiliser ``print_r()`` une sorte de ``echo`` pour les array:
    - Vu que ``print_r`` ne renvoie pas les codes html tels que ``<br />`` par exemple il faut soit les ajouter nous meme soit ecrire notre ``print_r`` entre deux balises ``<pre>``:
    ```php
        echo '<pre>';
            print_r($weapon);
        echo '</pre>';
    ```

## Pour rechercher dans un tableau:
3 fonctions importantes:
+ ``array_key_exists('cle', $array);``: 
    - cette fonction nous dit si l'array contient la clé recherché, 
    - en argument: la clé recherchée, le nom de l'array, 
    - cette fonction renvoie un booléen on peut donc facilement l'utiliser dans un bloc ``if``

+ ``in_array('value', $array);``: 
    - Cette fonction nous indique si la valeur est présente dans l'array,
    - prend en argument: valeur recherchée, nom de l'array,
    - Renvoie un booléen

+ ``array_search('value', $array);``: 
    - elle travaille aussi sur la valeur, mais renvoie la clé correspondante ou **false** si elle ne l'a pas trouvé,
    - prend la valeur et le nom de l'array en arguments
