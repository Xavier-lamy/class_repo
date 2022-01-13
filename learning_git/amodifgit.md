///////////////////Amodif/////////////////////////
Pour les erreurs sur le depot distant:
	git revert HEAD^ (au lieu de git reset), cela sert à annuler les changements sur une branche publique


Si notre accès à distance ne fonctionne pas, cela peut être du à un problème d'authentification du réseau, on peut le régler en créant une paire de clés SSH:
	Secure Shell: il s'agit d'un duo composé d'une clé privé et d'une clé publique, comme pour un chiffrement asymétrique, sauf qu'on utilise le chiffrement assymétrique que pour envoyer une clé symétrique chiffré entre le serveur et le client, puis seul cette nouvelle clé symétrique est utilisée pour communiquer, les deux l'ayant reçu de manière assymétrique, elle est safe)
Pour créer un duo de clés ssh:
	ssh-keygen -t rsa -b 4096 -C "exemple@email.com"
	On peut ensuite indiquer un nom de fichier, valider avec entrée, puis entrer un mot de passe et sa confirmation, puis on va dans users/lamyx et on affiche les dossiers masqués, il y'aura un dossier ssh, on y trouve la clé publique (id_rsa.pub) et la privée (id_rsa.txt), on copie la clé publique (en l'ouvrant dans un éditeur puis en copiant), ensuite on va sur github, sur notre avatar, dans settings, puis sur ssh/gpg, on clique sur "new ssh key", on choisit le titre et on colle la clé publique dans "key", on confirme le mot de passe et cela ajoute la nouvelle clé ssh au compte github


	Git reset peut être utilisé de 3 manières différentes (voir shéma: git_reset.png):
		git reset --soft : permet de se placer sur un commit spécifique pour voir le code d'une ancienne version, ou créer une branche qui part d'un ancien commit, sans suppprimer le moindre fichier ou commit

		git reset --mixed HEAD~: permet de revenir en arrière juste après le derneir commit ou le commit spécifié mais sans supprimer les modifs en cours, si les fichiers ont indexés mais pas commités cela les désindexent, HEAD est le pointeur qui référence notre position actuelle dans le répertoire de travail

		git reset -- hard: permet de revenir à n'importe quel commit mais en effaçant l'intégralité de ce qui a été créé après


Si on merge deux fichiers et qu'une même ligne a été changée de plusieurs façons, cela peut créer des conflits, il faudra alors ouvrir le fichier et à l'endroit du conflit supprimer les éléments inutiles, puis redire à git de "add" et "commit"


"Git revert HEAD" permet de revenir en arrière mais en créant un nouveau commit (donc en gardant les précécents) alors que "reset" revient en arrière mais ne créé pas de nouveau commit 



Si on a besoin de revenir à une ancienne version, on peut utiliser la "journalisation" (log file)
git log : permet de voir chaque fichier de l'arborescence et les commits qu'ils contiennent, énumère dans l'ordre chronologique inversé, chaque commit possède un identifiant SHA (secure hash algorithm, les grands codes d'idnetification super longs)

git reflog: permet de voir toutes les actions et commits effectués, c'est à dire en plus des commits , il peut nous afficher les merges, changement de messages,...
Ainsi si on veut revenir ç une action donné:
git checkout e789e7c (code SHA)

git blame: permet d'afficher pour chaque ligne modifié d'un doc commité: son ID, son auteur, l'horodatage, le numéro de ligne et le contenu de la ligne

git cherry-pick : si on souhiate uniquement sélectionner certains commmit d'une branche pour les migrer vers main sans fusionner les deux branches, on utilise cherry-pick puis les SHA des commits voulus, il est génralemtn peu recommandé d el'utiliser car cela duplique des commits existants
////////////////////////////////////