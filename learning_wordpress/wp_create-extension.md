# Créer des extensions wordpress (compte rendu meetup Nantes du 5 mai 2022)

## Intro
Par Daniel Roch de SEOMIX
Pas de code, plus retour expérioence, de leur parcours,...
En exemple notemment SEOKEY

## Planification:
+ POurquoi faire une extension ?: 
    - si les extenions présentes ne répondent pas a notre besoin
+ Pourquoi la diffuser ?:
+ Questions a se poser:
    - Besoin
    - Concurrence: regarder qu'il n'y ai pas déjà trop d'extensions similaires
    - Différenciation: ques-ce que j'apporte de mieux, (pas forcément plus, on peut faire moins mais plus propre ou mieux) ?, savoir faire des choix
    - Planification: bien prévoir son projet en amont, il y aura de toutes façon beaucoup de modifs dans les fonctionnnalités, mais il faut bien délimiter le produit et ce qu'on compte y ajouter plus tard

## Stratégie
+ Gratuit:
    - Héberger du wordpress.org
    - Il y a un qcm sur wp.org qui permet de savoir si notre plugin correspond bien au type de plugins diffusables
    - Puis il sera vérifier par une équipe pour voir si le code respecte bien les standards de code, de respect, de sécurité
    - Pas  le droit d'utiliser le nom *wordpress* dans le nom de notre extension
    - Tester notre plugin avant de le diffuser, notamment en fonction des différentes versions de php (attention à la rétrocompatibilité)
    - SVN pour les mises à jour, permet de faire du versionnement comme git (apparemment c'est pas du tout pratique à utiliser, notamment si on push sur les serveurs de wordpress.org personne vérifie notre code), malheureusement c'est forcément SVN sur wp.org

---------------------------VS----------------------

+ Payant:
    - Pas spécialement de règles pour le système d'abonnement (on peut faire au mois à l'année, au nombre de sites,....)
    - Attention wordpress est sous licence GPL, donc les plugins sont aussi sous licence GPL, quand on vend  on ne vend donc pas vraiment le code, mais par exemple le support qu'on apporte aux clients, les mises à jour, service au client

## Outils
+ IDE
+ Serveurs de dev variés (genre du local, de la prod sous des env différents,...)
+ LocalByFlyWheel pour des serveurs d'environnement locaux avec wordpress

+ Prévoir des solutions de ticket/suivi genre trello, helpscout, excel,..
+ Jira, notion pour les todo lists
+ Reveal it pour que le client puisse partager ses accès backoffice sans risque en cas de support (pour que l'accès soit que temporaire, sans garder de traces)
 


## Bonnes pratiques de développement
+ utiliser Git ou autre versionnement, on peut utiliser github desktop pour voir les modifs git
+ Se faire aider:
    - Pas réinventer la roue
    - Communauté (stackoverflow, slack [wordpressFR](https://capitainewp.io/rejoindre-slack-wordpress-fr/), ...)
    - Prestataires
+ Dans le code:
    - Commenter
    - Où on est dans le code ?: quand il y a beaucoup de fichiers , indiquer quelle fonction ou quel hook permet d'arriver à un fichier dans le commentaire d'en tête
    -  Ranger ses fichiers (anticiper l'arborescence)
    - Préfixer (les fonctions, variables) pour éviter les conflits avec les fonctions d'autres plugins ou de wordpress de base
    - Utiliser les bons hooks
    - Faire attention à la sécurité:
        - Sur la [doc wordpress](https://codex.wordpress.org/Data_Validation) pour voir les fonctions utilisables pour sécuriser les inputs des visiteurs notamment 
        - Nonces de sécurité (jetons de validations des formulaires,...)

## Debug et outils
- WP-config
- Avoir ses propres fonctions de debug
- Par exemple créer un site exprès pour les tests avec debug
- Query Monitor, extension de wordpress (permet d'affihcer pleins déléments liées aux query, les hooks, les scripts.... )
- Extension Postmeta Inspector, JSM's show term MetaDATA, JSM's Show USer MetaData pour voir les metas associées aus users, posts,...
- User Switching
- Rewrite Rules Inspector
- Snitch: enregistre les appels aux api
- Switch To: pour passer d'un utilisateur à l'autre sans avoir leurs accès , juste pour voir ce qu'ils voient
- simply show hooks: pour montrer les hooks 

## UX
+ Se mettre à la place de l'utilisateur: partir du principe que l'utilisateur ne saura pas forcément utiliser ou comprendre tous les éléments, se rappeler que quand on arrive sur une nouvelle interface on doit apprendre à l'utiliser
+ faire des choix (ne pas mettre tout ce qui nous passe par la tête), ne pas forcméent mettre quelquechose juste parce que c'est dans d'autres applis
+ Itérer: collercter les retours et voir ce qui peut etre changé/amélioré


## problèmes qu'on peut rencontrer
- bugs et cas particuliers (certains bugs n'apparaitront que sur très peu de client)
- Vérifier si besoin qu'on soit compatible avec les extensions les plus populaires, on peut utiliser wphive.com pour trier les extensions par popularité, si notre plugin n'est pas compatible avec yoast c'est potentillement 5 millions de site sur lesquelles personne n'instalelra notre plugin ou aura des problèmes
- Gutenberg (par exemple la nouvelle version de gutenberg a changé certains hooks)
- Ce que wordpress fait en arrière plan (par exemple il y a des post_types cachés en plus des 2 de base)
- Scalabalité (doit fonctionner quelque soit la taille du site, ou du serveur, par exemple un plugin d'audit SEO pourrait crasher si on lance un audit sur un site avec trop de contenu)
