# Algorithmique

## Définitions:

#### Algorithme: 
Ensemble d'actions que va exécuter un programme et qui permettront de résoudre un problème.

Les actions exécutées par un programme sont des instructions on distingue:
- les opérations de base (+-*/)
- l'exécution conditionnelle (si ... alors...)
- L'itération (pour chaque... faire ...)

#### Paradigme: 
Façon de concevoir une situation en prenant en compte ses problématiques et ses solutions

#### Variable: 
Le nom ou l'étiquette d'un objet

#### Fonction: 
Un bloc contenant une suite d'actions à réaliser, créer une fonction s'appelle **déclarer** l'utiliser s'appelle **exécuter**

#### Boucles: 
Structure qui répète plusieurs fois de suite la même action jusqu'à ce qu'une **condition d'arrêt** y mette fin

## Concepts
### Types de boucle:
- Jusqu'à (until): faire l'action jusqu'à la condition d'arrêt
- tant que (while): faire l'action tant que la condition d'arret n'est pas vraie
- pour chaque (for): faire l'action pour chaque élément de la liste

### Structures conditionnelles: 
#### If/Else
Si... faire... sinon ...

#### Switch: 
Le switch permet d'évaluer l'expression qui lui est donné afin d'aiguiller vers le bon cas:
```
Switch ...
	cas 1
	cas 2
	cas 3
	cas par défaut
```

### Types de données
#### Trois grand types de données:
- Les nombres entiers (integer) ou à virgule (float)
- Les chaines de caractères (string)
- Les booléens (booleans, ex:vrai ou faux)

#### Les structures de données
Les différents types de données définis et utilisés dans un programme sont appelés structure de données:
* **Tableaux**, **listes chainées** et **dictionnaires**:
	- les **tableaux**: chaque élément du tableau est référencé par un "index"= sa position dans la liste, le premier élément prend le numéro 0

	- **listes chainées**: un ensemble de valeurs enregistrées à des endroits différents de la mémoire, plus souple que le tableau car on peut ajouter ou supprimer des éléments à notre guise, les valeurs sont appelées "cellule" et  sont reliées entre elle par des "pointeurs", en gros le premier élément (cellule d'en-tête) contient le pointeur pour aller au deuxième, qui contient le pointeur pour le 3eme et ainsi de suite jusqu'au dernier (cellule de queue) dont le pointeur est de valeur nulle

	- **tables de hachage** ou **dictionnaires**, chaque valeur à une clé qui y fait référence

* **Piles** et **files**
	- les **piles** sont des structures en *LIFO (last in, first out)*, les opérations courantes sont:
		- initialiser
		- estvide
		- estpleine
		- acceder au sommet
		- empiler
		- dépiler
		- vider
		- détruire

	- les **files** sont des structures en *FIFO (First in first out)*, les opérations courantes sont:
		- initialiser
		- estvide
		- estpleine
		- acceder tête
		- empiler
		- dépiler
		- vider
		- détruire

* **Arbre binaire** et **graphe**:
	- **arbre binaire**: structure de données qui ressemble à un arbre, il est proche d'une liste chainée, sauf que pour un arbre binaire chaque élément peut etre relié à deux autres eux même pouvant etre chacun relié à deux autres (d'où la forme d'arbre), chaque cellue mère peut avoir deux celleules filles (fils gauche et fils droit), elle peut aussi en avoir une ou zéro selon la valeur du "pointeur", la racine est la cellule mère qui n'a pas de cellule mère (en "haut" de l'arbre)

	- **graphe**: il s'agit d'un réseau dont les données ("sommet") sont reliés par une relation ("arc") un sommet peut etre relié à beaucoup d'autres par des arcs


### Algorithmes de recherche
#### Recherche dichotomique
- En anglais binary search
- Dans un tableau trié, pour trouver la position d'un élément ``n``, on compare cet élément avec l'élément ``c`` du milieu du tableau, si n > c on cherche dans la deuxième moitié du tableau et on recommence l'opération jusqu'à ce que ``n = c`` (si ``n < c``, on cherche dans la première moitié) 

### Algorithmes de tri
#### Le tri à bulle: 
l'algorithme tri les infos 2 par deux il choisi la plus grande (ou autre critère de sélection), puis la rapproche de la fin de la liste en les inversant , cette dernière est ensuite comparée a la doonée suivante et la plus grande des deux se rapproche alors de la fin de la liste, quand elle arrive en fin de liste on sait que la plus grande est à la fin, il reste alors à recommencer pour tous les autres valeurs pour déterminer la 2eme plus grande, la 3eme...


### Complexité algorithmique:
La **complexité algorithmique** se note avec la notation de landau (0(n)), il existe:

- **complexité linéaire**: les combinaisons possible s'enchaine, exemple pour un cadenas de 4 chiffres si on a un moyen d'ecouter les clics du cadenas on pourra analyser chaque chiffre séparément et donc avoir 10*4 possibilités

- **complexité exponantielle**: les combinaisons possibles sont multipliés entre elles et croissent de manière exponentielle , exemple pour le cadena à quatre chiffre il faut tester chaque chifrre avec toute les combinaisons des autres 10 exposant 4 = 10000 possibilités

- **complexité en tant constant**: quelquesoit le nombre de possibilités on les trouve toujours dans le meme temps, le temps nécessaire n'augment pas

- **complexité temporel**: le temps nécessaire à l'algo pour résoudre

- **complexité spaciale**: la place nécessaire à l'algo pour stocker les données pendant le calcul


### Fonctions
#### Fonction récursive:
- Une fonction qui s'utilise/qui fait appelle à elle-même, jusqu'à une condition d'arret
- Une fonction récursive a des sous-problèmes (résolus par les appels récursifs: appel de la fonction à l'intérieur de la fonction) qui arrêteront de se calculer lorsque la condition d'arret est remplie

#### Fonction factorielle: 
La factorielle d'un entier naturel est le produit des nombres entiers positifs, egaux ou inférieur à ce nombre, on la note: ``n! = (n-1)*n``, 
- exemple pour 10: 1\*2\*3\*4\*5\*6\*7\*8\*9\*10= 3628800

- **Fonction factorielle itérative**:
```
def factorielle(n):
	x=1
	for i in range(2 " car sinon on fait 1*1 c'est inutile, n+1"car le sinon n est exclu"):
		x *= i
	return x
```

- **Fonction factorielle récursive**:
```
def factorielle(n)
	if n <= 1
		return: 1 (cela permet d'arreter la boucle des qu'on atteint 1) 
	else: 
		return n*factorielle(n-1)
```

#### Suite de fibonacci:
Commence généralement par 0 et 1 ou 1 et 1, chaque terme est la somme des deux précédents
```
def fibo(n)
	a,b = 0,1
	for i in range(1, n+1)
	c = a + b
	print(b)
	a = b
	b = c
```

### Piles d'appels
Les piles d'appels (stack) l'ordi retiens le résultat de tous les calculs récursifs avant de finir la boucle, par exemple pour la factorielle de 10 en fonction récursive il va calculer n (10), n-1 (9),.. et les multiplier entre eux
