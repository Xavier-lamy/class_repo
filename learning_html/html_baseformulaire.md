# Les formulaires HTML

Pour les balises voir [html_balises.md](html_balises.md#balises-de-formulaire)

## Attributs

### Les attributs de ``<form>``
```html
<form method="post" action="traitement.php">
```
- ``method`` peut contenir les valeurs: "post" qui permet de stocker un grand nombre de données, et "get" beaucoup moins utilisé car limité à 255 caractères, car les données sont envoyés dans la bar d'adresse) 
- ``action`` (qui prend en valeur l'adresse de la page, en php ou autre langage de traitemnt, qui va récupérer les données et les enregistrer, si on ne précise pas action, c'est la page actuelle qui sera chargée lors de l'envoi de données

### ``for``
```html
<label for="pseudo">Votre pseudo</label>
```
- ``for`` permet de définir l'input lié à ce label (en fonction de son Id)

### Les attributs d'input et textarea
#### Attributs de base
```html
<input type="text" name="pseudo" id="pseudo">
``` 
+ ``type`` contient le type de zone de saisi que l'on veut:
	- ``text`` pour une zone basique
	- ``password`` cache les caractères lorsqu'ils sont tapés
	- ``email`` pour taper un email, la différence n'est pas flagrante, mais si le texte entré ne correspond pas à un email certains navigateurs pourront l'indiquer au visiteur, de plus sur certains navigateurs mobiles, cela fourni directement un clavier destiné à taper des emails au visiteur
	- ``url`` pour taper un url, sur certains navigateurs mobiles, cela fourni directement un clavier destiné à taper des urls au visiteur
	- ``tel`` pour taper un numéro de téléphone, sur certains navigateurs mobiles, cela fourni directement un clavier destiné à taper des numéros au visiteur
	- ``number`` pour taper un nombre, 
	- ``range`` créé un curseur pour sélectionner un nombre
	- ``color`` pour sélectionner une couleur, attention: pas encore reconnu par tous les navigateurs
	- ``date`` pour sélectionner une date, attention: pas encore reconnu par tous les navigateurs
	- ``search`` pour créer un champ de recherche
	- ``checkbox`` pour créer une case à cocher
	- ``radio`` pour créer une case à cocher, à choix unique cette fois, pour cela toutes les options doivent avoir le même nom, cette fois on ajoute l'attribut ``value`` qui change pour chaque choix
	- ``submit`` crée le bouton de validation qui permet ensuite de traiter les informations envoyés au ``.php``, et d'envoyer le visiteur sur la page contenue dans ``action``
	- ``reset`` remet à zéro le formulaire
	- ``type="image" src="images/nom.png"``similaire à submit mais permet d'ajouter une image sur le bouton (dans "src")
	- ``button` bouton générique sans effet par défaut, on peut utilisé un script javascript pour exécuter des fonctionnalités quand on clique dessus
	
+ ``name`` sert à rentrer une valeur qui servira à nommer le champ pour qu'il soit reconnu lors du traitement en php, chaque champ doit donc avoir un nom différent

+ ``id`` permet de lier l'input à son label

#### Attributs avancés
On peut préciser les caractéristiques des données que l'on souhaite
- ``maxlength="6"`` permet d'ajouter une limite au nombre de caractères qu'on peut taper
- ``value="value"`` permet de préremplir la valeur du champs de saisi 
- ``readonly`` la zone de saisie ne peut qu'être lue
- ``autofocus`` ne peut etre utilisé que une fois par page et permet d'afficher le curseur à cet endroit au chargement de la page
- ``placeholder="ex:"`` prérempli avec une valeur grisé qui sert d'exemple de ce qu'il faut taper et disparait quand on tape du texte
- ``required`` oblige le visiteur à remplir le champ avant de valider le formulaire, certains navigateurs feront savoir que le champs n'est pas rempli (exemple cadre en rouge)
- ``min="2"`` et ``max="4"`` pour indiquers les valeurs minimales et maximales d'un type ``nombre`` ou ``range``
- ``step="2"`` pour régler le "pas" (par exemple: les nombres augmentent de 2 en 2)
- ``checked`` pour que la case (radio ou checkbox) soit coché par défaut

```html
<textarea rows="5" cols="20" name="texterandom" id="text">Voici un texte prérempli</textarea>
```
- Les attributs ``rows`` et ``cols`` indiquent le nombre de lignes et colonnes, à l'intérieur de la balise text area (balise block) on peut préremplir du texte

###  Select
```html
<label for="category">À quelle catégorie socio-professionnelle appartenez-vous ?:</label><br />
<select name="category" id="category">
	<optgroup label="Hôtellerie Restauration">
		<option value="Boulangerie Pâtisserie">Boulangerie Pâtisserie</option>
		<option value="Métiers du service">Métiers du service</option>
		<option value="Cuisine">Cuisine</option>
	</optgroup>
	<optgroup label="Bâtiment et Travaux Publics">
		<option value="Charpentier">Charpentier</option>
		<option value="Plombier">Plombier</option>
		<option value="Autres" selected>Autres</option>
	</optgroup>
</select>
```
Pour créer une liste déroulante (comme les liste de sélection du pays ou on vit) on utilise:
- ``select`` avec en attribut un nom de catégorie
- auquel on intègre plusieurs options avec ``option`` (qui prends un attribut ``value``)
- on peut regrouper des réponses au sein de groupes avec ``optgroup`` et l'attribut ``label`` pour les nommer:
