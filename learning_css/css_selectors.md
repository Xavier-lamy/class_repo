# Les **sélecteurs**:
Il servent à définir à quel élément HTML on va appliquer une **propriété**:
> Référence: W3School

## Sélecteurs de base
| Sélecteur | Description |
|-----------|-------------|
| ``.class`` | Élément ayant cette classe |
| ``.class1.class2`` | Élément ayant ces deux classes |
| ``parent child`` | Élément à l'intérieur d'un élément parent |
| ``#id`` | Id |
| ``*`` | Tous les éléments |
| ``element`` | Élément de base correspondant à une balise |
| ``element.class`` | Élément avec une classe |
| ``element,element`` | Sélectionne ces différents éléments |
| ``parent>child`` | Élément enfant direct du parent |
| ``element1+element2`` | Élément 2 directement situé après le 1 |
| ``element1~element2`` | Élément 2 précédé par un élément 1 |	
| ``[attribute]`` | Avec un attribut |	
| ``[attribute=value]`` | Avec un attribut et une valeur |	
| ``[attribute~=value]`` | La valeur contient ce mot |	
| ``[attribute\|=value]`` | La valeur est égal à, ou commence par cette chaîne |	
| ``[attribute^=value]`` | La valeur commence par cette chaîne |
| ``[attribute$=value]`` | La valeur termine par cette chaîne |
| ``[attribute*=value]`` | La valeur contient cette chaîne |

## Pseudo-classes
Définissent un état particulier d'un élément:

| Sélecteur | Description |
|-----------|-------------|
| ``element:active`` | Élément actif |
| ``element:checked`` | Élément coché ( seulement: ``input type checkbox/radio`` et ``option``) |	
| ``element:default`` | Élément par défaut (seulement: ``button``, ``input type checkbox/radio`` et ``option``) |	
| ``element:disabled`` | Élément désactivé (généralement élément de formulaire) |	
| ``element:empty`` | Élément vide/sans enfant (y compris un noeud texte) |
| ``element:enabled`` | Élément n'ayant pas l'attribut ``disabled`` |	
| ``element:first-child`` | Premier enfant de son parent |	
| ``element:first-of-type`` | Premier élément de ce type par rapport au parent |
| ``element:focus`` | Élément ayant le focus |
| ``element:fullscreen`` | Élément en mode plein écran |	
| ``element:hover`` | Au survol |	
| ``input:in-range`` | Si la valeur ne dépasse pas les valeurs min et max |	
| ``input:out-of-range`` | Si la valeur dépasse les valeurs min et max |
| ``input:indeterminate`` | ``input type checkbox/radio`` et ``<progress>`` quand ils n'ont pas encore d'état déterminé |	
| ``input:valid`` |Si les valeurs entrées dans le formulaire sont valides |
| ``input:invalid`` | Si les valeurs entrées dans le formulaire ne sont pas valides |	
| ``element:lang(language)`` | Avec un attribut de langue de la valeur spécifiée |
| ``element:last-child`` | dernier enfant du parent |
| ``element:last-of-type`` | dernier élément de ce type par rapport au parent |
| ``element:link`` | Lien non visité |
| ``:not(selector)`` | Tout élément qui n'a pas ce sélecteur |
| ``element:nth-child(n)`` | Est le "n"ième enfant de son parent |
| ``element:nth-last-child(n)`` | Est le "n"ième enfant de son parent en partant de la fin |	
| ``element:nth-last-of-type(n)`` | Est le "n"ième élément de ce type par rapport à son parent et en partant de la fin |	
| ``element:nth-of-type(n)`` | Est le "n"ième élément de ce type par rapport à son parent |
| ``element:only-of-type`` | Seul élément de ce type |
| ``element:only-child`` | Seul enfant de son parent |
| ``input:optional`` | N'a pas d'attribut requis |
| ``input:read-only`` | Élément de formulaire avec l'attribut lecture seule |
| ``input:read-write`` | Élément de formulaire avec l'attribut lecture/écriture |
| ``input:required`` | Élément de formulaire requis |
| ``:root`` | Racine de l'élément HTML |
| ``element:target`` | Élément visé par une ancre |
| ``element:visited`` | Lien déjà visité |

## Pseudo-éléments
Permettent de styliser des parties spécifiques d'un élément:

| Sélecteur | Description |
|-----------|-------------|
| ``::selection	`` | Élément sélectionné par l'utilisateur (ne peut appliquer que: ``color``, ``background``, ``cursor``, ``outline``) |
| ``input::placeholder`` | Pour modifier le placeholder d'un input ou textarea |
| ``::marker`` | marqueurs des éléments de listes |
| ``element::first-letter`` | Première lettre de l'élément |
| ``element::first-line`` | Première ligne de l'élément |
| ``element::after`` | Pour ajouter du contenu après l'élément |	
| ``element::before`` | Pour ajouter du contenu avant l'élément |