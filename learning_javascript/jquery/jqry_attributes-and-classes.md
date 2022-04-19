# Les attributs et les classes 

## Manipuler les attributs des éléments
### Récupérer ou définir la valeur d'un attribut
- ``attr('attributeName')``: récupère la valeur de l'attribut
- ``attr('attributeName', 'attributeValue)``: définit la valeur de l'attribut (s'il n'existe pas, cla cré l'attribut et le définit)

### Modifier la valeur des propriétés
Les propriétés correspondent aux attributs dans le DOM (les attributs existent donc dans le document HTML, et les propriétés sont en quelque sorte leurs valeurs dans le DOM, exemple l'attribut checked sera toujours égal à true dans le html, en tant que propriété dans le dom, cela dépendra de si la ase est cochée ou non)
- ``prop('attributeName')``: récupère la valeur de la propriété (liée à l'attribut), ex: quand l'utilisateur décoche la case, l'attribut reste ``checked=true`` mais la propriété devient ``checked=false``

### Supprimer une propriété ou un attribut
- ``removeAttr('attrName')`` : Retire l'attribut
- ``removeProp('attrName')`` : Retire la propriété

### Mettre à jour la valeur
- ``val()`` : récupère ou met à jour la valeur d'un élément (exemple dans un formulaire), si l'élément a plusieurs valeurs (exemple select ou checkbox à choix multiples), ``val()`` renvoie un tableau avec les valeurs

### Gestion des classes
- ``hasClass(className)`` : Vérifie si l'élément possède cette classe
- ``addClass(className)`` : Ajoute la classe à l'élément
- ``removeClass(className)`` : Retire la class à l'élément
- ``toggleClass(className)`` : Bascule entre ajouter/supprimer la classe, si l'élément a la classe ça la retire, s'il ne l'a pas ça l'ajoute