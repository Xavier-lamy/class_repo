# Les vidéos et l'audio

+ Les différents formats d'audio:
	- ``Mp3``: lu par quasi tout les appareils, le plus ancien et l'un des plus compatibles
	- ``AAC``: utilisé par Apple pour Itunes
	- ``Ogg``: Ogg vorbis, principalement utilisé par linux ou tout autre logiciel libre de droit car le format lui même est libre
	- ``WAV`` (format non compressé) à éviter équivalent du bitmap des images

+ On peut utiliser caniuse.com pour voir lesquels sont supportés sur quels navigateurs.

### Pour le stockage de vidéos il faut:
+ Un format conteneur: (``AVI``,``MP4``,``MKV``)
+ Un codec audio: format du son de la vidéo (``MP3``, ``AAC``, ``OGG``)
+ Un codec vidéo: format de compression d'images:
	- ``H.264``, l'un des plus puissants et des plus utilisés mais pas 100% libre
	- ``Ogg Theora``: gratuit et libre de droit, un peu moins puisssant, nécessite d'instller des programmes pour le lire sous windows
	- ``WebM``: codec gratuit et libre de droits, proposé par google et concurrent de H.264
+ On peut également utiliser caniuse.com pour voir lesquels sont supportés sur quels navigateurs, on peut aussi utiliser ``Miro Video Converter`` pour convertir des vidéos dans d'autres formats

### La balise audio
```html
<audio src="nom.mp3" controls="" width="20" preload="metadata">Mettez à jour votre navigateur</audio>
```
La balise audio permet d'ajouter un son, on peut y trouver les attributs:
- ``src``: la source du son
- ``controls``: ajoute la barre de lecture, pause défilement
- ``width``: largeur de l'outil audio
- ``preload``: indique si la musique est chargé dès le chargement de la page, prends les valeurs: 
	- ``auto`` (par défaut) le naviagteur décide si il précharge ou non
	- ``metadata`` ne charge que les métadonnées
	- ``none``: pas de préchargement
- ``loop``: joue en boucle
- ``autoplay``: joue dès le démarrage de la page (à éviter par souci d'accessibilité)
- le message dans la balise ne sert que si le vsiteur à un navigateur trop ancien qui ne peut pas lire cette balise, dans ce cas il verra le message à la place du son , il existe aussi les attributs:

- Si le navigateur ne peut pas gérer le mp3 ou le format qu'on veut utiliser il faut afficher les balises suivante en plus (ainsi le navigateur prendra le format qu'il sait lire):
```html
<audio controls>
	<source src="nom.mp3" type="mp3">
	<source src="nom.ogg" type="ogg">
</audio>
```

### Insertion d'une vidéo
```html
<video src="nom.webm" controls="" poster="" width="500" height="150">Mettez à jour votre navigateur</video>
```
On trouve les attributs:
- ``controls``: meme chose que pour l'audio
- ``poster``: affiche une image à la place de la vidéo quand elle n'est pas lancé, (par défaut la première de la vidéo, générallement une image noir, que l'on peut changer
- ``width/height``: gère la largeur et la hauteur de la vidéo (garde les proportions)
- ``autoplay`` et ``loop``: comme pour l'audio (autoplay à éviter)
- ``preload``: comme pour l'audio, valeurs: 
	- auto
	- metadata
	- none
- Pour afficher plusieurs formats (sachant que les Iphones ne reconnaissent que le format h264 (format .mp4) il est recommandé de mettre celui ci en premier):
```html
<video controls poster="img.jpg" width="600">
	<source src="nom.mp4" type="mp4">
	<source src="nom.webm" type="webm">
	<source src="nom.ogv" type="ogv">
</video>
```