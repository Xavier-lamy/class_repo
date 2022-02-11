# Comment envoyer son site en ligne:
Il faut quelques éléments:
1. Un **nom de domaine**:
	+ il s'agit de l'adresse du site (exemple: openclassrooms.com), constitué :
		- du **nom de domaine** proprement dit, on peut le choisir librement, il doit etre unique et peut contenir chiffres et lettres (ainsi que certains charactères spéciaux, exemple le *ç*)
		- de l'**extension** (.com, .fr), ou TLD (Top Level Domain), environ une **extension** par pays (.fr, .be, .ca, ...), d'autres existent au niveau international: .com (originalement pour les sites commerciaux), .net, .org (originalement pour les organisations)

	+ note: www est un sous-domaine, il n'est pas obligatoire, bien que couramment utilisé

	+ Un **nom de domaine** coûte entre 7 et 12 euros par an (en fonction de l'**extension**, ``.info`` est moins cher par exemple), afin de réserver notre **nom de domaine** il existe 2 solutions:
		- passer par un **registrar**: organisme intermédiaire entre nous et l'**ICANN** (organisme qui gère internationalement les noms de domaine), exemple en france: *1&1*, *IONOS*, *OVH*, *Gandi*
		- commander le **nom de domaine** en meme temps que l'hébergement (recommandé)

2. Un hébergeur
	+ Une entreprise qui possède de nombreuses "baies" de "serveurs" dans des datacenters (on peut techniquement hébergé soi-même le site mais ce n'est pas recommandé, il faut une connexion très très haut débit et un ordinateur puissant qui peut tourner tout le temps)
	+ Il existe 4 types d'offres d'hébergement:
		- **hébergement mutualisé**: la base, placé sur un serveur gérant plusieurs sites, le moins cher et bien pour commencer
		- **hébergement dédié virtuel**: placé sur un serveur qui gère généralement moins d'une dizaine de sites, bon compromis entre le prix et la capacité d'accueil des visiteurs
		- **hébergement dédié** (ou serveur dédié): placé sur un serveur qui ne gère que le site, coûte cher et nécessite généralement des compétences en linux pour administrer le serveur.
		- **hébergement cloud**: site envoyé sur des serveurs virtuels, type un peu complexe (avantage virtuel du serveur dédié virtuel mais complexité du serveur dédié)

3. Un client FTP
	+ FTP (File Transfer Protocol), cela sert à envoyer nos dossiers du site sur le serveur loué:
		- FileZilla par exemple est un logiciel FTP

### Utilisation de filezilla 
+ il ya quatre grandes zones:
	- en haut : sert pour les infos de la console et les messages d'erreurs
	- à gauche: nos documments
	- à droite: les documents mis sur le serveur
	- en bas: les docs en court de transfert
+ Pour configurer le client ftp on a besoin de :
	- L'IP (adresse du serveur) généralement donné sous une forme: ftp.nomsite.com mais peut aussi exister en suite de nombre classique
	- Le login: l'identifiant
	- Le mot de passe (généralement attribué d'office)

+ ensuite il faut cliquer sur le gestionnaire de sites en haut à gauche puis sur nouveau site lui donner un nom, rnetrer les infos de connexion, et cliquer sur connexion
+ Ensuite on prends tous les fichiers du site (ne pas oublier les images, sons videos,...) et on les transfèrent à dorite: 
+ Important!: la page d'accueil du site doit s'appeler Index.html elle sera la première à etre chargée par le visiteur 


