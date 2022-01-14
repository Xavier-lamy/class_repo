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