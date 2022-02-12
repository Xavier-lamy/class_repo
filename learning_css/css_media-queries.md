# Media Queries
+ les **mediaqueries** servent a faire du design responsive, c'est à dire qu'en fonction des caractéristiques du média sur lequel le visituer regarde le site on pourra afficher unne mise ne page differente
+ Il existe deux façons d'amener le code css en fonction du type de média
	- la première est d'ajouter un (ou des) autre lien vers un autre fichier css dans le fichier html:
	```html
	<link rel="stylesheet" media="screen and (max-width: 1280px)" href="petiteresolution.css">
	```
	- la deuxième (et probablement la meilleure) est d'ajouter nos règles directement dans le fichier css de base comme suit:
	```css
	p /*paragraphes de base*/
	{
		color: blue;
	}

	@media screen and (max-width: 1024px) /*quand l'écran est inférieur à 1024px*/
	{
		p
		{
			color: red;
		}
	}
	```

+ les différentes règles pour les **mediaqueries** sont:
	- ``color``: en fonction de la couleur en bit ou pixels (exemple si l'écran n'affiche que 20 couleurs alors on chanegra certianes règles)
	- ``height``: en fonction de la hauteur de la fenêtre
	- ``width``: en fonction de la largeur de la fenêtre
	- ``device-height``: en fonction de la hauteur de l'appareil/périphérique
	- ``device-width``: en fonction de la largeur de l'appareil/périphérique
	- ``orientation``: portrait ou paysage
	- ``media``: le type d'écran de sortie:
		* ``screen``: classique
		* ``handheld``: mobile
		* ``print``: impression
		* ``tv``: tele
		* ``projection``: projecteur
		* ``all``: tous types

+ en plus de cela on peut rajouter des préfixes:
	- ``min-`` : pour la valeur minimale
	- ``max-`` : pour la valeur maximale

+ on peut combiner les règles avec:
	- ``only``: seulement pour un type
	- ``and``: pour cumuler des regles
	- ``not``: pour exclure un type

+ Exemples:
```css
/*Tous les écrans quand la largeur de la fenetre est inférieure à 1280px*/
@media screen and (max-width: 1280px)
{

}
/*Tous les écrans quand la largeur de la fenetre est comprise entre 1024px et 1280px*/
@media screen and (min-width: 1024px) and (max-width: 1280px)
{

}
/*tous les téléviseurs*/
@media tv
{

}
/*tous les écrans orientés verticalement*/
@media all and (orientation: portrait)
{

}
```