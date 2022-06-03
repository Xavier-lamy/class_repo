# l'internationalisation et le multilangue

+ L'internationalisation (parfois raccourci en **i18n**) permet de rendre des chaines normalement statique de nos modèles de pages traduisible, cela permet à n'importe qui d'utiliser le thème avec la langue de son site (pratique quand on veut faire un thème pour le répertoire officiel de thèmes WP)

+ Le multilangue permet de proposer plusieurs langues au visiteur de son site

## Internationaliser un thème
+ Déclarer le TextDomain:
    - ``load_theme_textdomain('textdomain_name', get_template_directory() . '/languages');``
    - en 1er param, l'id unique pour ce thème, en 2eme le chemin où trouver les fichiers de traduction
+ Les fonctions de traduction (commencent toutes par ``_``):
    - ``_e('original-string', 'textdomain_name')`` : fait référence à **echo** permet de traduire et d'afficher
    - ``__('original-string', 'textdomain_name')`` : permet de traduire sans afficher
    - ``_n('1 comment', '%comments, $comment_count)`` : permet de gérer les singuliers et les pluriels, avec en arguments:
        + forme au singulier
        + forme au pluriel avec un ``%`` qui sera remplacé par le 3eme paramètre
        + nombre d'éléments (ici des commentaires, dont le nombre aura été récupéré avant avec un ``get_comments_number()``)`
    - ``_x('Update', 'verb', 'textdomain_name')`` : permet de proposer un contexte pour guider le traducteur, ici *update* peut etre un verbe ou un nom on précise donc de quel type il s'agit
    - ``_nx()`` : permet de gérer à la fois le contexte et le singulier/pluriel

## Traduire:
+ On peut utiliser différentes extensions qui permettent d'affihcer toutes les string à traduire, pour nous permettre de choisir les équivalents dans la langue souhaitée:
    - **Poedit** (c'est un logiciel à part, pas une extension)
    - **Loco Translate** pour faire les traductions directement depuis l'interface d'admin de WP
+ Si on souhaite publier notre thème sur le répertoire officiel (thème gratuit), on peut utiliser la plateforme **translate.wordpress.org**

## Fonctionnement des traductions
+ Quelque soit l'outil, génère 3 formats de fichiers:
    - ``.pot`` : catalogue avec la liste des string traduisibles
    - ``.po`` : contient les traductions d'une langue en particulier
    - ``.mo`` : version compilée du ``.po``