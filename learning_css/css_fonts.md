# Fonts
+ pour la police: utiliser ``font-family``, puis ajouter dans l'ordre les polices qu'on veut utiliser (si l'ordi du visiteur ne possede la police souhaitée, le navigateur choisira la suivante et ainsi de suite), on ajoute une police safe en fin de liste au cas ou aucune autre n'est trouvée (généralement serif):
```css
{
	font-family: Impact, "Arial Black", Arial, serif
}
```
+ Nom de police utilisable par la plupart des appareils(pour etre sur qu'ils puissent etre lus):
	- Arial
	- Arial Black
	- Comic sans MS
	- Courrier New
	- Georgia
	- Impact
	- Times New Roman
	- Trebuchet MS
	- Verdana


+ Si on veut une police d'ecriture particulière on peut la faire telecharger au visiteur, pour cela il faut telecharger le font-face kit de la police sur un site (fontsquirrel par exemple), pui dézipper le fichier, mettre tous les fichier (avec les differents formats de fichier car certains navigateurs ne peuvent pas tous les avoir), dans le meme dossier que le html, ou dans un sous dossier (faire attention quand on reference le lien), prendre aussi le stylesheet css du dossier de la police d'ecriture et copier coller le code dans le css principal(``@font-face{codecss}``), ce style sheet reference deja les urls sources des differents fichiers de police pour que les navgateurs puissent choisir

+ les differents formats de fichier de polices:
	- ``.ttf``  : TrueType Font. Fonctionne sur IE9 et tous les autres navigateurs ;

	- ``.eot``  : Embedded OpenType. Fonctionne sur Internet Explorer uniquement, toutes versions. Ce format est propriétaire, produit par Microsoft ;

	- ``.otf``  : OpenType Font. Ne fonctionne pas sur Internet Explorer ;

	- ``.svg``  : SVG Font. Le seul format reconnu sur les iPhone et iPad pour le moment ;

	- ``.woff``  : Web Open Font Format. Nouveau format conçu pour le Web, qui fonctionne sur IE9 et tous les autres navigateurs.


+ Ajouter une nouvelle police
```css
@font-face {
	font-family: 'nom de la police';
	src: url('nom.eot') format('eot'),
		url('nom.woff') format('woff'),	
		url('nom.ttf') format('truetype'),
		url('nom.svg') format('svg');	
}	
```