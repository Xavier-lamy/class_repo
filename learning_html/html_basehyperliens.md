# Les hyperliens

- pour faire un lien: balise a + attribut href:
```html
<!--lien absolu:-->
<a href="https://openclassrooms.com">le nom qui figurera sur le lien</a>
```

- s'il y a des ``&`` dans l'adresse il faut les remplacer par : ``&amp;`` 

- pour un lien au sein d'un site, d'une page vers l'autre:
```html
<a href="page2.html">lien</a>
```

- si la page 2 se trouve dans un sous dossier, en indiquer le chemin d'accès:
```html
<a href="dossier/sousdossier/page2.html">
```


- si la page 2 se situe dans un dossier parent (situé avant):
```html
<a href="../page2.html">lien</a>
```

## Lien vers une ancre
+ l'ancre sert a faire un lien vers une partie de la meme page (comme sur wikipédia):

    - pour créer l'ancre ajouter l'attribut "id" à n'importe quelle balise qui servira alors de point de repere:
    ```html
    <h1 id="ancre1">Titre principal</h1>
    ```
    - puis créer le lien comme d'hab mais dans href mettre: ``#`` + ``id de l'ancre``:
    ```html
    <a href="#ancre1">lien</a>
    ```

+ on peut faire un mix des methodes par exemple pour envoyer sur une ancre mais sur une autre page:
```html
<a href="page2.html#ancre1">nomdulien</a>
```

+ pour ajouter un infobulle sur le lien (quand on pase avec la souris):
```html
<a href="https://site.fr" title="c'est un site">lien</a>
```

+ pour forcer l'ouverture du lien dans une nouvelle fenetre ou un nouvel onglet on utilise l'attribut ``target="_blank"`` (il est impossible de choisr fenetre ou onglet, et il est deconseillé d'utiliser cette methode afin de laisser le visiteur choisir lui meme, néanmoins c'est utile pour les paniers genre sur amazone):
```html
<a href="https://site.fr target="_blank>lien</a>
```

+ Pour faire en sorte que le visiteur accede directement à la possibilité d'envoyer un mail a votre adresse: utiliser ``mailto:+adressemail``
```html
<a href="mailto:adresse@mail.com">me contacter par email</a>
```

- pour faire télécharger un fichier placer ce fichier dans le meme dossier que la page web ou un sous dossier et faire un lien classique (vu que c'est pas une page web html, le navigateur telechargera le fichier):
```html
<a href="fichier.zip">telecharger</a>
```