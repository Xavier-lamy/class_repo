# Les images

+ 3 formats d'image :
	- GIF: illustrations mais est aussi animé (que en 256 couleurs)

	- PNG: quasi tout le reste, illustration, logo, dessin, il permet de definir des zones transparentes, pratique pour un logo par exemple, n'altere pas la qualité de l'image
		png 8 bits= 256 couleurs (si pas trop de couleurs le privilégier sinon prendre le 24 bits), 
		png 24 bits= 16 millions de couleur mais un peu plus long pour charger des photos que le jpeg

	- JPEG: des que c'est une photo (.jpg ou .jpeg), peut altérer un peu l'image mais quasi imperceptible pour une photo

### Pour enregistrer une image (ou n'importe quel document):
- pas de majuscules
- pas d'accent
- pas d'espace
- utiliser ``_`` si besoin d'espace

### Pour ajouter une image:
```html
<img src="dossier/images/imagemontagne.jpg" alt="Image de montagne" />
```
+ balise ``<img/>`` il s'agit d'une balise orpheline donc on oublie pas le slash a lafin
+ 2 attributs: 
	- ``src=`` source de l'image, 
	- ``alt=`` texte alternatif: description de l'image, pour les aveugles, malvoyants ou les robots d'indexation

+ l'image doit se trouver a l'interieur de quelquechose generalement un paragraphe (mais ça peut etre une figure voir plus bas)

+ pour afficher une image aggrandi quand on clique sur l'image il faut placer l'image mini avec la balise image, dans un lien qui renvoie à l'image agrandie:
```html
<a href="grandeimage.jpg"><img src="petiteimage.jpg" alt="ceci est une image" /></a>
```

+ si on veut montrer que l'image est importante pour le contenu référencé (càd qu'elle ne sert pas juste d'illustration) et lui ajouter un libellé on utilise les balises ``<figure>`` (important) et ``<figcaption>`` (libellé) (les figures peuvent aussi afficher plusieurs images)
```html
<figure>
	<img src="image.png" alt="c'est une image" />
	<figcaption>Voici une image</figcaption>
</figure>
```

+ on peut aussi ajouter une infobulle comme pour les liens:
```html
<img src="source.png" alt="image" title="vas y clique" />
```