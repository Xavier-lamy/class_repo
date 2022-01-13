# Les remises
Si on a modifié un fichier sur la branche principale au lieu de le faire dans une branche annexe, on peut mettre en attente nos modifs pour ensuite faire une **remise** et les replacer dans la bonne branche:
- ``git status`` (pour vérifier quels fichiers sont en staging mais sans avoir été commit)

- ``git stash`` pour créer la **remise** (cela met les modifs de côté)

- vérifier avec ``git status``, ``main`` n'affiche plus de changement en attente de commit

- créer la branche sur laquelle on veut le commit, puis basculer dessus: 
	- ``git checkout -b branchName``

- appliquer la **remise**:
	- on regarde d'abord la liste des remises, copie le nom de la remise qui nous intéresse, puis on applique:
		- ``git stash list``
		- ``git stash apply stash@{1}``
	- ou utilise directement ``git stash apply`` pour appliquer la dernière remise faite

Si jamais en plus d'indexer la modif en staging on l'a aussi commit sur le main il faut:
- Analyser les derniers commit avec: 
	- ``git log`` (qui liste par ordre chronologique inversé tous les commits, on peut alors récupérer l'ID du commit souhaité : le "hash")

- Vérifier qu'on est sur ``main`` et utiliser: 
	- ``git reset --hard HEAD^`` (qui supprime le dernier commit réalisé de "main", le HEAD indique qu'il s'agit bien du dernier)

- On créé la branche et on bascule dessus:
	- ``git branch brancheCommit``
	- ``git checkout brancheCommit``
	
- On renouvelle le git reset, pour l'appliquer cette fois à la nouvelle branche , on peut juste taper les 8 premiers caractères du "hash":
	- ``git reset --hard ca83a6df``