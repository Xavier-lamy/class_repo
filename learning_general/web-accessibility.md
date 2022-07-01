# Accessibilité

+ Les principes essentiels pour un site en ligne accessible:
    - perceptible: pouvoir percevoir l'interface via différents sens
    - utilisable: pouvoir interagir avec l'interface
    - compréhensible: contenu et fonctionnement de l'interface facilement compréhensibles
    - robuste: contenu et interface compatibles avec différents moyens d'affichage et technologies d'assistance

+ Référentiels pour aider a trouver les bonnes pratiques:
    - À l'international: la *Web Accessibilité Initiative (WAI)*
    - En France: le *Référentiel Général d'Accessibilité pour les Administrations (RGAA)*


## Fondamentaux
Globalement les mêmes que pour un site classique, il s'agit avant tout d'éléments de bon sens pour produire un site de qualité
- Respecter les standards de code W3C.
- Privilégier la simplicité, dans la conception et le discours.
- Conserver les comportements natifs comme:
    - possibilité de zoomer
    - naviguer par tabulation
    - affichage textuel au survol
    - ...
- Le site doit être responsive:
    - L'information proposée reste la même
    - Elle peut quand même être affichée différemment ou simplifiée
- S'appuyer sur des codes existants et majoritairement maîtrisés par les utilisateurs, pour que ce soit intuitif:
    - ex: option de recherche symbolisée par un pictogramme loupe
- Les outils externes auxquels on fait appel doivent être eux-mêmes accessibles.

## Lisibilité et compréhension
- Architecture de navigation structurée et cohérente
- Plan du site
- Fil d'ariane sur chaque page
- Structurer et hiérarchiser le contenu de manière claire et aérée
    - chaque page doit avoir un titre principal puis différents niveaux de titre cohérents
- Contenu suffisamment explicite, éviter:
    - les abréviations
    - les mots à plusieurs connotations
    - le jargon
    - les mots peu employés
    - ...
- La taille des textes et des éléments interactifs doit être suffisante
- La police doit être lisible, et il faut faire attention à:
    - l'interlettrage
    - aux espacements
    - au découpage syllabique.
- L'utilisateur doit pouvoir agrandir le texte et zoomer en évitant de devoir basculer vers un défilement vertical
- Les contenus doivent être suffisamment contrastés:
- Possibilité de modifier les couleurs des textes
- La couleur d'un élément ne doit pas être utilisée comme seule indication de son utilité:
    - Par exemple les liens cliquables sont souvent affichés dans une couleur différente, mais également soulignés.
- Éviter l'affichage de tableaux ou de représentations complexes
- Proposer un résumé ou un équivalent textuel à tout contenu non textuel.

## Visuel et animation
- Chaque contenu visuel nécessaire à la compréhension du contenu global doit comprendre une légende représentative et un texte alternatif explicite:
    - Ce n'est par contre pas nécessaire pour les visuels décoratifs qui peuvent être ignorés par les outils d'assistance à la navigation
- Pour le contenu en mouvement, il doit:
    - être contrôlable par l'utilisateur
    - pouvoir être arrêté ou relancé
    - pouvoir être caché ou affiché
    - pouvoir être affiché sans mouvement
    - ne pas dépasser 5 secondes d'animation idéalement
    - être limité à une partie de la surface de l'écran seulement
- Il faut éviter:
    - de lancer une animation sans prévenir l'utilisateur ou sans qu'il l'ai déclenchée lui même
    - de créer des animations susceptibles de provoquer des crises d'épilepsie, comme des contenus clignotants

## Contenu audio et vidéo
- Éviter la diffusion d'un arrière-plan sonore ou le paramétrer à faible volume
- Utiliser un player son ou vidéo accessible avec un dispositif qui permet de contrôler le volume et la lecture
- Éviter les déclenchements automatiques.
- Chaque contenu audio et vidéo doit:
    - pouvoir être consulté à l'aide de sous-titres et d'une audiodescription
    - être accompagné d'une transcription textuelle.

## Interaction
- Éviter les limitations de temps pour consulter un contenu ou réaliser une action, ou laisser la possibilité de modifier ou de suspendre le décompte.
- Prévoir des intitulés explicites pour les éléments interactifs et les placer dans un contexte qui permet d'en comprendre aisément la fonction.
- Pour le téléchargement de document, indiquer le format, le poids et la langue du contenu téléchargeable.
- Pour proposer des documents accessibles, vous pouvez privilégier des fichiers en format .doc ou .pdf.
- Prévoir des liens d'accès rapide dans la structure du site et du contenu.
- Rendre toutes les fonctionnalités accessibles au clavier.
- Faire en sorte que les pages et interactions fonctionnent de manière prévisible, en s'appuyant sur les standards usuels.
- Proposer une fonctionnalité d'annulation d'une action afin d'éviter une activation accidentelle.

## Formulaires
- Regrouper les champs associés par thématique.
- Pour chaque champ, indiquer un label visible et explicite, le format demandé, un exemple de complétion, et s'il est obligatoire ou non.
- Proposer l'autocomplétion des champs lorsque la donnée est disponible.
- Indiquer de manière visible le succès ou l'échec de soumission.
- En cas d'erreur, prévoir des messages d'erreurs explicites et aider l'utilisateur à l'aide de suggestions de correction.
- Éviter les captchas.
- L'utilisateur doit pouvoir annuler, corriger ou supprimer les informations fournies.

## Se former à l'accessibilité et faire reconnaître son expertise:
- certifications Access 42, Opquast et Accessiweb
- évènement annuel ParisWeb (conférences)
- labels Accessiweb, E-accessible, AnySurfer et Euracert attribuables aux sites et administrations ayant entrepris une démarche de mise en conformité aux standards d'accessibilité

## Taux de conformité au RGAA
- Audit réalisé sur un échantillon de pages du site, il consiste à vérifier que le site passe les 106 critères du référentiel RGAA
- Les sites concernés par l'obligation d'accessibilité numérique doivent publier une déclaration d'accessibilité, on peut notamment afficher le taux de conformité au RGAA en bas de page

## Bases du RGAA
- [Site du gouvernement](https://www.numerique.gouv.fr/publications/rgaa-accessibilite/)
- Le RGAA est le Règlement Général d'Amélioration de l'Accessibilité
- il définit un ensemble de règles et d'éléments à mettre en place pour que le service (site, appli, mobilier urbain numérique,...) soit accessible au plus grand nombre
- Il doit obligatoirement être respecté par:
    - les entreprises publics ou affiliés (privé mais qui travaille pour le secteur publique)
    - les entreprises de plus de 250millions d'euros de CA annuel (donc les très grosses entreprises)
- Toutes les autres entreprises peuvent bien entendu tenter le plus possible de le respecter, mais n'y sont pas obligé
- Il existe quelques exceptions notamment:
    - pénibilité de mise en oeuvre, si la mise en place des mesures nécessaire est trop complexe par rapport à la structure de l'entreprise ou que le bénéfice apporté n'est pas assez grand par rapport à cette difficulté de mise en oeuvre, il peut y avoir dérogation
    - certains types de contenu mis en lignes avant certaines dates (ex: contenus audio mis en lignes avant septembre 2020), les éléments d'archive de site qui n'ont pas été mis à jour après septembre 2019 et qui ne sont pas nécessaire pour des démarches administrative (par exemple un article de 2018 archivé et non mis à jour depuis), ...

### Cadre du RGAA
Quand on souhaite réaliser un audit RGAA, il y a certaines règles:
- Doit être fiable: généralement réalisé par un prestataire externe si possible, ou plusieurs audit croisés
- Doit être représentatif: donc sur assez de pages du site et notamment:
    - Page accueil
    - Page contact
    - Page mentions légales
    - Page de déclaration d'accessibilité
    - Page plan du site
    - Page d'aide
    - Page d'authentification
    - les pages contenant un processus (exemple formulaires)
    - au moins un exemple de chaque type de page (exemple ça ne sert à rien de faire un audit sur tous les articles de blog d'un site, on peut le faire que sur un article)
    - document téléchargeable si présent (exemple un PDF)
- Dans le cas ou un critère peut etre soumis à dérogation pour charge disproportionné, si celui ci (exemple tableau ou graphique) comporte aussi une alternative en texte alors il pourra ne pas passer les critères d'accessibilité
- Le résultat d'un test de conformité est un taux qui prend en compte la conformité moyenne des pages et éléments du site

### La déclaration
Elle doit comporter:
- l'état de conformité:
    - Total si tout est respecté
    - partielle si au moins 50% des critères
    - non-conforme si moins de 50% ou pas d'audit réalisé
- Le signalement des contenus non accessible, ainsi que les solutions et les raisons de l'inaccessibilité
- Un mécanisme de contact pour pouvoir signaler un élément inaccessible
- La mention de la possibilité pour une personne de saisir le défenseur des droits en cas de manquement non résolu

- la page d'acceuil doit aussi comporter les mentions d'accessibilité:
    - `` Accessibilité : totalement conforme`` si tous les critères de contrôle du RGAA sont respectés
    - `` Accessibilité : partiellement conforme`` si au moins 50 % des critères de contrôle du RGAA sont respectés
    - `` Accessibilité : non conforme`` s’il n’existe aucun résultat d’audit en cours de validité permettant de mesurer le respect des critères ou si moins de 50 % des critères de contrôle du RGAA sont respectés

### Les critères
La méthode du RGAA permet de valider la conformité d'une page web avec les 50 critères de la norme internationale ***WCAG 2.1*** (***Web Content Accessability Guidelines***)
- Elle contient elle même 106 critères (en 2022) répartis en plusieurs catégories (certains critères sont rassemblés en 1 dans ce résumé):

#### Images
- Les images porteuses d'information (donc pas uniquement pour décorer) doivent avoir une alternative textuelle pertinente, et si nécessaire une description détaillée et pertinente
- Les images de décoration sont ignorés par les technologies d'assistance

#### Cadres
- Les cadres ont un titre de cadre, qui doit être pertinent

#### Couleurs
- L'information ne doit pas etre donné uniquement par la couleur
- Le contraste entre le texte et le background est suffisant
- Les couleurs sont assez contrastés

#### Multimédia
//////////////A continuer//////////