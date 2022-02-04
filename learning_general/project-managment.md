# La gestion de projet
- Penser à s'inspirer de ce qui existe ailleurs, se réinventer rapidement en fonction de l'évolution des marchés ou des lois est important

- **Test and learn**: méthode qui consiste à analyser plusieurs choix (par exemple faire 2 versions d'un site et envoyer la moitié des gens sur l'une et l'autre moitié sur l'autre)

### Cahier des charges
- Penser à faire un **cahier des charges**: afin de définir les *besoins et attentes* du client, le *budget* et les *contraintes éventuelles*, la *deadline* si possible, 
- Le cahier des charges est dit contractuel, car il sert de base pour le contrat entre le prestataire et le client
- Dans un cahier des charges de projet important il peut y avoir les parties suivantes:
	- contexte: base ou genèse du projet, objectifs, responsables, procédures de validation
	- besoins fonctionnels, techniques et organisationnels et les contraintes
	- prestations attendues
	- contexte de la réponse (règles de sélection si il y a un appel d'offres)

## Deux types de gestion de projet:
### Gestion séquentielle:

- **maitrise d'ouvrage** = client, celui qui demande
- **maitrise d'oeuvre** = prestataire, celui qui réalise

#### Étapes
1. Définir le projet:
- la **maitrise d'ouvrage** écrit  les **spécifications fonctionnelles** (requirements) c'est à dire comment le projet est supposé fonctionner, être réalisé
- ces spécifications peuvent contenir:
	- des infos sur l'auteur ou le responsable du projet, 
	- les scénarios utilisateurs (ex: que se passe-t-il si quelqu'un oublie son mot de passe), 
	- un aperçu du projet, 
	- des détails
- on peut aussi y ajouter
	- une décharge disant qu'il ne sagit pas de la version finale, 
	- des non-buts (quelles fonctionnalités on ne développera pas), 
	- les questions restées en suspens pour le moment 
	- des annotations particulières adressées à certaines équipes, en fonction de leur role

2. Conception de l'architecture:
- càd recherche des **spécifications techniques** ou quels outils seront utilisés pour quelle fonctionnalité, on définira: 
	- l'architecture technique générale
	- batch(traitement par lots/interface:comment les données entrantes ou sortantes sont traitées (avec quelle base de données)
	- description des données (comment on utilise les données, comment on les modifie)
	- description du code (quel langage, quelles conventions d'écriture)
	- plateformme matérielle (pour quel type d'appareil ?, quelle puissance nécessaire)

3. Écriture du code: 
- nécessite de la collaboration entre les dev (github)
- on code d'abord en local (sur son pc) puis on envoie sur un serveur test (*staging ou préprod*)

4. Recette 
- càd tests du projet soit manuellement soit automatiquement à l'aide de:
	- **tests unitaires** qui ont pour but de tester chacun une partie du programme
	- **tests d'intégration** qui servent à vérifier que deux parties fonctionnent bien ensemble
	- il peut aussi exister des tests manuels mais plus rarement

Le problème de la **gestion séquentielle** est que l'on doit faire chaque étape à 100% avant de commencer la suivante **les méthodes agiles** permettent donc de gommer ce problème


### Méthodes agiles:
- apparaissent dans les usines toyota vers 1950
- se basent sur:
	- **l'itération**: pouvoir répeter plusieurs fois dans le but d'améliorer le résultat
	- **l'incrémentation**: vise à ajouter petit à petit des fonctionnalités en fonction des problèmes rencontrés 
	- **l'adaptation**
	- **la responsabilisation des equipes**: elles doivent etre actives dans le processus de création
	- **le cérémonial minimal**: des réunions plus courtes (voire chronométrées) mais plus régulières pour s'adapter facilement à n'importe quel problème
- Centrent le projet sur l'utilisateur et ses besoins

- Il existe un **manifeste agile** qui définit des **valeurs** et **principes** de bases:
	- **valeurs**:
		- les individus et leurs interactions sont plus importantes que les processus et les outils
		- mieux vaux un logiciel qui fonctionne qu'une documentation exhaustive
		- collaborer avec les clients est préférable à la négociation contractuelle
		- s'adapter au changement est mieux que de suivre un plan

	- les 12 **principes** du manifeste:

		1. Notre plus haute priorité est de satisfaire le client en livrant rapidement et régulièrement des fonctionnalités à grande valeur ajoutée.

		2. Accueillez positivement les changements de besoins, même tard dans le projet. Les processus Agiles exploitent le changement pour donner un avantage compétitif au client.

		3. Livrez fréquemment un logiciel opérationnel avec des cycles de quelques semaines à quelques mois et une préférence pour les plus courts.
		
		4. Les utilisateurs ou leurs représentants et les développeurs doivent travailler ensemble quotidiennement
		tout au long du projet.

		5. Réalisez les projets avec des personnes motivées. Fournissez-leur l’environnement et le soutien dont ils ont besoin et faites-leur confiance pour atteindre les objectifs fixés.
		
		6. La méthode la plus simple et la plus efficace pour transmettre de l’information à l'équipe de développement et à l’intérieur de celle-ci est le dialogue en face à face.
		
		7. Un logiciel opérationnel est la principale mesure d’avancement.

		8. Les processus Agiles encouragent un rythme de développement soutenable. Ensemble, les commanditaires, les développeurs et les utilisateurs devraient être capables de maintenir indéfiniment un rythme constant.
		
		9. Une attention continue à l'excellence technique et à une bonne conception renforce l’Agilité.
		
		10. La simplicité – c’est-à-dire l’art de minimiser la
		quantité de travail inutile – est essentielle. (*KISS: Keep It Simple, Stupid*)

		11.	Les meilleures architectures, spécifications et conceptions émergent d'équipes autoorganisées.
		
		12.	À intervalles réguliers, l'équipe réfléchit aux moyens de devenir plus efficace, puis règle et modifie son comportement en conséquence.
			

- Il existe de nombreuses pratiques agiles dont:
	- **user stories** : fonctionnalité écrite du point de vue de l'utilisatuer, sous forme d'une petite histoire (que fera l'utilisateur)

	- **pair programming**: programmation en binome, on se met d'accord sur comment on le fait puis on le fait en partageant nos compétneces

	- **continuous integration**: chaque fonctionnalité est intégrée à la précédente, en gros c'est un peu comme un early access on teste au fur et à mesure et on ajoute et rectifie au besoin

	- **acceptance testing**: les stories (décrivant une fonctionnalité) doivent etre validé par un test établit au préalable qui définit quelles conditions sont nécessaires pour valider une story et donc passer à la fonctionnalité suivante

	- **planning game** , un planning d'estimation des durées de réalisation des stories, qui est redéfini a chaque user story réalisée

	- **daily stand up meeting**: tout le monde se réunit chaque matin et présente ce qu'il a fait la veille, ce qu'il fera aujourd'hui et un problème rencontré, l'objectif est que ce la soit court (d'ou le standing, tout le monde reste debout comme ça on sait que ce sera pas long)

- Ces pratiques sont regroupées en méthodes (environ 8) dont voici les plus populaires:
	- *DSDM: Dynamic System Development Method*: approche incrémentale et itérative avec intégration constante du client

	- *FDD Feature Driven Development*: méthodologie légère dont l'objectif est de créer un logiciel qui s'adapte aux changements de demandes

	- *XP (Extreme Programming)*: une méthode pragmatique centrée sur les pratiques

	- *Scrum* la plus utilisée


#### Fonctionnement du Scrum (La plupart des autres méthodes fonctionnent de manière similaire)
##### Les rôles: 
- **product owner** (utilisateur ou client qui définit le contenu du produit, les priorités et les objectifs)
- **scrum master**: pas un chef de projet, il est juste la pour aider l'équipe et faire appliquer le scrum
- **l'équipe** qui réalise le produit, elle dit etre responsable, motivée et compétente.

- Le product owner peut créer des **personas** soit des petit portrait-robots d'utilisateurs qui servent à avoir des exemples plus parlant que M.X Mme Y, 
	- par exemple: bob *veut* faire ça *pour* faire ça 
	- Un **personna** s'écrit de cette manière:
	```
	en tant que(as) [utilisateur] 
	je veux(i want) [action]
	pour(so that) [résultat]
	```

##### Étapes
1. Au début du projet on le divise en **fonctionnalités** dans le **backlog**: 
	- le **scrum board**/**backlog** est un tableau utilisé quotidiennement pour définir 3 catégories:
		- à faire, 
		- en cours, 
		- terminé

	- On remplit le **backlog** avec toutes les fonctionnalités voulues qui seront ensuite sélectionnées, en fonction de leur importance, pour les sprints.

	- Le **sprint 0** est le nom donné à la période avant le 1er sprint, qui consiste à préparer le projet

	- La **vision** sert à répondre à la question **pourquoi** on va se servir du projet, elle est le fruit du **product owner**

2. On s'intéresse alors à la 1ere version qui sera mise en ligne et qui doit contenir les **fonctionnalitées essentielles** déclarées prioritaires dans le **backlog** 

3. Chaque mise en production est appelée **release** et est constituée de **sprints**:
	- Les **sprints** sont des cycles (ex: 3semaines) durant lesquels les développeurs sont divisés en équipe et travaillent sur des fonctionnalités découpées en **stories**

	- on peut éventuellement faire de cette **story** une **userstory** qui est constitué:
		- d'une **carte** qui la représente, 
		- d'une **conversation** qui raconte l'histoire, 
		- de la **confirmation** qui définit le résultat attendu pour valider la carte

	- Chaque **story** suit les étapes d'un projet séquentielle mais chacune à son échelle:
		- spécificités fonctionnelles ou manuel d'utilisateur
		- spécificités techniques (ou architecture technique)
		- code et tests (on peut aussi écrire le test puis coder ce qui permettrait de valider le test c'est le Test Driven Development TDD)

	- on définit un planning, qui définit le nombre de tâches à réaliser pendant un sprint, on peut utiliser la méthode du **planning poker**: 
		- le scrum master distribue un paquet de cartes à chaque dev, le paquet ne contient que les nombres de la suite de fibonacci (1,2,3,5,8,..) 
		- puis pour chaque story on définit un chiffre en fonction des estimations des dev
		- cela permet de classer les stories par difficulté
		- ensuite on établit un planning et un dev choisit la story et en devient responsable
		- il peut alors découper sa story en tâches qu'il devra faire à chaque jour de travail (une tâche par jour)

	- de manière régulière (ex=tous les matins), on fait le **scrum** (mêlée) qui est une réunion qui permet de faire le point sur les avancées et difficultées de chacun

	- Les tests de confirmation servent ensuite à vérifier que notre code correspond bien au résultat atendu pour la **story**.

	- on peut faire du code review qui consiste à faire relire notre code par un autre pour obtenir un autre avis et éventuellement le modifier	
	
	- Puis la story peut ensuite aller dans la collone **fini** du backlog
	
	- pour résumer les étapes d'une story sont:
		- proposition de la story
		- acceptation de la story et ajout au backlog
		- Estimation de la taille et du temps nécessaire à la réalisation
		- En attente de développemet
		- en cours de dev
		- fini

4. À la fin de chaque sprint on **inspecte** pour évaluer et avoir un feedback sur le sprint, puis on ajuste le **backlog** pour le **sprint** suivant.

5. Puis on passe au sprint suivant et ainsi de suite. 

### Méthode Kanban
Elle consiste à organiser les étapes de productions en 3 ou 4 étapes:
- Todo
- In progress
- (Test)
- Done

Les tâches dans in progress ne doivent pas être trop nombreuses, on attend qu'elles passent dans done (grâce à la validation par les tests s'il y en a) avant d'entamer une nouvelle tâche de la toDo list
##### Des idées d'outil pour l'agile:
- Jira
- Trello
- Pivotal Tracker
- IceScrum
