# Astuces diverses
Quand il y a assez d'infos sur une astuce, créer un fichier à part

## Outils:

#### Wappalyser 
extension de navigateur pour détecter les technologies utilisées par un site

#### Can I use 
pour vérifier la compatibilité des technologies

#### Pour tester la vitesse d'exécution d'un site: 
- *Google Page Speed*
- *GT Metrix*

#### utiliser un recaptcha 
- sur google recaptcha on demande une clée publique/privée 
- puis on utilise la clée publique pour afficher le recaptcha sur le site

#### Markdown 
- permet de faire des h1 h2 en italique en gras genre ## ou ** …, on peut le transformer en fichier word ou en html, sous linux on utilise **pandoc**

## Divers:
- pour une gestion de finances préférer exprimer les prix en centimes en bdd (nombre entiers) afin d'eviter les bugs liés au float (euros + centimes = décimal)

### Pour les images libre de droit
Image => outils => licence creative commons

### Nmap 
outil de sécurité...

### se connecter à un serveur via ssh
``ssh mail-address``
puis taper le mot de passe

### Linux
Ubuntu dérivé de Debian   
Apt: gestionnaire de paquets sous Ubuntu  
dev = devices

### proxy
Il s'agit d'une sorte de "serveur" qui sert d'intermédiare entre deux machines, il peut servir a créer des restrictions d'accès ou a les contourner


### Docker
se conneceter en ssh à un docker:  
``ssh -p 2222 docker@192.168.1.25`` 
``yes``
mdp ``docker``
sur le docker: dans SRC se trouveront les fichier bruts (html,css,...); dans DIST les fichiers dynamiques (sass à compiler, ....) docker est une émulation de serveur plus légère qu'une machine virtuelle car on ajoute les composants qu'on souhaite au fur et à mesure

### sur filezilla
- nouveau site
- nom du site 
- protocole: sftp
- identifiant et mdp (docker docker)
- connexion
- / var www html

### Offuscation de code
utiliser un logiciel pour *uglifier* , en gros rendre toutes les variables incomprehensibles avec des noms pas clairs pour rendre le code difficlement compréhensible et donc modifiable

### Gulp, grunt et WebPack
Ils servent à gérer les dossiers du projet avant la mise en ligne ( minifier le css, offusquer le js,...), webpack est plus souvent utilisé mais gulp et grunt sont des tasks manager ce qui leur permet d'etre plus maléable

### Uml (*Unified language modeling*)
//

### electron
sur base js, css,...  (vscode et figma sont fait avec ça)
pour faire du desktop

### VeraCript
pour crypter des fichiers ou dossiers on peut meme mettre un mot de passe pour detruire les données

### Story telling 
une partie importante de toute présentation, cela consiste a reprendre la structure de toute histoire un élément perturbateur (ou problématique) et comment le personnage (l'netreprise concerné) va s'en sortir (résolution du ou des problèmes)

### Créer un QEMU sous Ubuntu
- on s'ajoute dans les utilisateurs avec les droits
- on ajoute les biblio
- sur virtual manager:
    - créer un volume
    - lui attribuer une quantité de ram et une capacité de stockage

### Stimulus
Un framework JS, on écrit des controleurs qui peuvent permettre de réagir à des changements dans le dom (par exemple si un élément a été intégré à la page avec une requete AJAX la page n'est pas forcément rechargé, et donc cet élément peut ne pas etre disponible pour être manipulé en js; un contrôleur créé avec stimulus pourrait régler ce problème)