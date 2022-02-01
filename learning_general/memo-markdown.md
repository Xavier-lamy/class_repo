# Syntaxe du markdown

## Italique

*texte en italique*

_Texte en italique_


## Gras

**Texte en gras**

__Texte en gras__


## Italique et gras

***Texte en italique et en gras***

___Texte en italique et en gras___


## Barré

~~Texte barré.~~  
Texte non barré


## Titres

#  Titre 1
## Titre 2
###  Titre 3
#### Titre 4
#####  Titre 5
###### Titre 6


## Citations

>Citation et retour à la ligne  
>La citation continue  
La citation continue tant qu'on ne saute pas une ligne (pas besoin de remettre un chevron à chaque ligne)

Pas une citation


## Listes

#### Non ordonnées
- Liste1
- Liste 2
- Liste 3

#### Ordonnées
1. Liste 1
2. Liste 2
3. Liste 3

#### listes indentés
* group1
    * item1
    * item1
    * item1
    * item1
* group2
    * item2
    * item2
    * item2
    * item2


## Cases à cocher
#### Avec GFM (Github Flavored Markdown)
- [ ] A
- [x] B
- [ ] C

#### Avec les caractères unicode
&#9744; case décochée  
&#9745; case cochée  


## Code

Du `code` dans du texte.

`Une ligne de code`

``Une ligne de `code` qui permet de quand même utiliser les guillemets inversés.``

#### Bloc de code (optionnel: préciser le langage)

```html
<section>
    <div>
        <p>voici du code html</p>
    </div>
</section>
```


## Liens

[Lien](https://example.com/ "titre de lien optionnel")

#### Lien avec ancre
- [Lien vers le titre "Exemple de diagramme" du fichier Mermaid](memo-mermaid.md/#exemples-de-diagrammes)
- [Lien vers un titre de ce fichier](#code) 
- Attention: 
    - Fonctionne mal avec les caractères spéciaux (car le slug n'est pas correct)
    - ne fonctionne pas avec tous les plugins de rendu markdown

#### Lien explicite

<https://example.com>

#### Lien échappé

`https://example.com`

## Image

![Ceci est un exemple d’image](https://www.google.fr/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png)

#### combinaison image/hyperlien
[![Ceci est un exemple d’image](https://www.google.fr/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png)](https://google.com)


## Tableau

|cellule 1|cellule 2|
|---------|---------|
|    A    |    B    |
|    C    |    D    |

#### Un tiret minimum pour la ligne de séparation (pas obligé d'aligner les "|"):
|cellule 1|cellule 2|
|-|-|
|    A    |    B    |
|    C    |    D    |


## Notes bas de page (fonctionne uniquement sur GitLab)

Texte du paragraphe, [^1], avec des notes de bas de page intégrées [^2]. 

[^1]: Texte de la note de bas de page 1.  
[^2]: **Note de page de page 2** peut aussi être *formatée*.


## Echappement

barre oblique:

Ceci est un \*exemple avec des astérisques\*.


## Affichage Markdown sous visual studio

`ctrl+shift+v`: pour l'affichage dans un nouvel onglet

`ctrl+k v` (`ctrl+k` puis relâcher et appuyer sur `v`, raccourci pas très pratique) pour l'affichage sur le côté 


## Retour à la ligne 
Un double espace  
permet de retourner à la ligne (sans sauter de ligne)


## Mettre en exposant ou en indice:
on peut utiliser les balises html (pour n'importe quelle autre action d'ailleurs):

2<sup>7</sup>  
2<sub>7</sub>


## Faire une ligne (``<hr>``)
Au choix:   
* * *

***

*****

- - -

---------------------------------------

_ _ _

## Discord
Discord supporte aussi une partie du markdown (notamment les blocs de code)
Et ajoute aussi:
- ||Spoiler|| : les éléments entre || seront cachés par une balise spoiler

## Mermaid (diagrammes pour markdown)
Permet de faire des diagrammes dans un fichier Markdown-->[Voir memo Mermaid](memo-mermaid.md)


## Présentations en Markdown avec Marp
Configurer du style dans une balise metadata markdown
--- règles horizontales
outil: Marp
Permet de faire des mises en page avancés genre powerpoint
permet aussi de transformer en pdf 