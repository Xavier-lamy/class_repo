# Bases Jquery

+ Bibliothèque

## Installation
Soit:
+ Télécharger les fichiers et les inclure:
    - soit la version compressée (pas d'espace entre les codes) pour une meilleure performance: à utiliser sur les sites live
    - version non compressée plus facile à comprendre : à utiliser quand on veut travailler sur un projet pour mieux comprendre, ou pour l'apprentissage
    - on ajoute ensuite le script jquery avant nos scripts JS:
    ```
    <script src="jquery3.4.1"></script>
    <script src="custom.js async"></script>
    ```
+ via un CDN (Content Delivery Network), plus performant en copiant le code fourni par le cdn

## utilisation
+ jQuery créé les propriétés ``jQuery`` et ``$``: des alias interchangeables, ce sont des propriétés de k'objet global ``window``
+ jQuery est un langage de requêtes
+ pour commencer les scripts jQuery:
```
//4 manières équivalentes en terme de résultats
window.jQuery();
jQuery();
window.$();
$(); //++
```
+ on peut utiliser les sélecteurs css:
```
$("p")
$("#p2")
```
+ jQuery retourne un ``objet jQuery`` à partir des éléments html ciblés par les sélecteurs css:
    - on peut attribuer des ``méthodes`` ou des ``propriétés`` à notre ``objet``
    - pour ça on peut utiliser le ``chainage``:
        - modèle: ``$(selecteur).action()``
        - ex: ``$("p").hide();`` : cache l'élément p
        - on peut chainer autant qu'on veut tant qu'on s'assure que chaque méthode renvoie bien un objet pour la méthode suivante

+ Pour attendre le chargement de la âge avnt d'exécuter les scripts on utilise l'évènement ``ready()`` qui se déclenche des que la page est prete à etre manipulée:
```
$(document).ready(function(){
    $("h2").hide();
});

//ou:
$(function(){
    $("h2").hide();
});
```