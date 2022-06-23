# Créer un thème avec wordpress 6.0

Le theme.json des thèmes wordpress s'est bien amélioré, et on peut maintenant s'en servir pour mettre en place les styles généraux de notre thème, cela permet notamment de pouvoir choisir les styles pour les blocs gutenberg

> Le theme.json sert aussi pour les thèmes à blocs (qui ne contiennent plus la hiérarchie habituelle des templates wordpress), on peut bien sur aussi les utiliser sur

L'objectif du theme.json est de respecter le modèle du ***Design system***, c'est à dire créer une charte graphique et l'appliquer ensuite à notre thème/souhaite

> Il est aussi possible de mettre en place notre charte graphique avec la fonction ``add_theme_support`` dans ``functions.php``, mais le theme.json a pour objectif de remplacer cette fonction

### base du thème.json pour worpdress de base et le plugin gutenberg
- On peut changer les largeurs d'affichage (container et taille max) pour les images notamment cela permet de mettre l'image à 100% de la taille du container (``contentSize``), de la faire dépasser légèrement du container (``wideSize``) ou de la mettre à 100% de la largeur de l'écran:
```json
//Dans le fichier theme.json à la racine du thème
{
    "version": 2,
    "settings": {
        "layout": {
            //Définit la zone de contenu et la zone de contenu maximale
            "contentSize": "990px",
            "wideSize": "1190px"
        },
    }
}
```

- On peut définir les couleurs du thème, on peut aussi choisir:
    - de désactiver les couleurs de base gutenberg, ou non
    - de désactiver la possibilité d'ajouter des couleurs custom dans l'éditeur gutenberg
```json
{
    "version": 2,
    "settings": {
        "color": {
            "palette": [
                {
                    "name": "Black",
                    "slug": "black",
                    "color": "#000000"
                },
                {
                    "name": "White",
                    "slug": "white",
                    "color": "#ffffff"
                },
                {
                    "name": "Primary",
                    "slug": "primary",
                    "color": "#ec12ad"
                },
                {
                    "name": "Secondary",
                    "slug": "secondary",
                    "color": "#45EE13"
                }
                {
                    "name": "Tertiary",
                    "slug": "secondary",
                    "color": "#AA12D3"
                }
            ]
        }
    }
}
```
```css
/**Créera les propriétés custom css suivantes */
body {
    --wp--preset--color--black: #000000;
    --wp--preset--color--white: #ffffff;
    --wp--preset--color--primary: #ec12ad;
    --wp--preset--color--secondary: #45EE13;
    --wp--preset--color--tertiary: #AA12D3;
}
```

- il est aussi possible de créer des propriétés CSS custom:
```json
{
    "version": 2,
    "settings": {
        "custom": {
            "line-height": {
                "body": 1.4,
                "heading": 1.3
            }
        }
    }
}
```
```CSS
/** cela créera les propriétés custom css suivantes que l'on pourra ensuite utiliser avec var()  */
body {
    --wp--custom--line-height--body: 1.7;
    --wp--custom--line-height--heading: 1.3;
}
```

- Voici l'ensemble des fonctionnalités activable pour les presets avec le theme.json sur wordpress, les valeurs booléennes sont celles par défaut:
```json
{
    "version": 2,
    "settings": {
        "appearanceTools": false, //Ceci permet d'activer ou non dans l'éditeur gutenberg  les options de bordures, marges,... cela ne marche peut etre qu'avec le plugin
        "border": {
            "radius": false,
            "color": false,
            "style": false,
            "width": false
        },
        "color": {
            "custom": true, //Active ou non le sélecteur de couleur dans l'éditeur
            "customDuotone": true, //Active ou non le sélecteur de couleur pour les filtres duotone dans l'éditeur
            "customGradient": true, //Active ou non le sélecteur de couleur pour les dégradés dans l'éditeur
            "duotone": [
                {
                    "colors": [ "#000", "#FFF" ],
                    "slug": "black-and-white",
                    "name": "Black and White"
                }
            ],
            "gradients": [
                {
                    "slug": "blush-bordeaux",
                    "gradient": "linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%)",
                    "name": "Blush bordeaux"
                },
                {
                    "slug": "blush-light-purple",
                    "gradient": "linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%)",
                    "name": "Blush light purple"
                }
            ],
            "link": false,
            "palette": [], //Palette de couleur du thème
            "text": true, //Active ou non la possibilité de changer la couleur du texte dans l'éditeur
            "background": true, //Active ou non la possibilité de changer la couleur de l'arrière plan dans l'éditeur
            "defaultGradients": true, //Active ou non la palette de dégradés par défaut
            "defaultPalette": true //Active ou non la palette de couleurs par défaut
        },
        "custom": {},
        "layout": {
            "contentSize": "800px",
            "wideSize": "1000px"
        },
        "spacing": {
            "margin": false,
            "padding": false,
            "blockGap": null,
            "units": [ "px", "em", "rem", "vh", "vw" ]
        },
        "typography": {
            "customFontSize": true, //Active ou non la possibilité de déifnir une taille de police custom dans l'éditeur
            "lineHeight": false,
            "dropCap": true,
            "fontStyle": true,
            "fontWeight": true,
            "letterSpacing": true,
            "textDecoration": true,
            "textTransform": true,
            "fontSizes": [ //Choisit les différentes taille de police du theme (celles de bases seront conservées à moins qu'on utilise le même slug)
                {
                    "slug": "big",
                    "size": 32,
                    "name": "Big"
                },
                {
                    "slug": "x-large",
                    "size": 46,
                    "name": "Large"
                },
            ], 
            "fontFamilies": [ //Choisit les polices du theme
                {
                    "fontFamily": "Montserrat, sans-serif",
                    "slug": "system-font",
                    "name": "System Font"
                },
                {
                    "fontFamily": "Helvetica Neue, Helvetica, Arial, sans-serif",
                    "slug": "helvetica-arial",
                    "name": "Helvetica or Arial"
                }
            ], 
        },
        //Dans la section blocks, on peut pour chaque bloc créé (c'est valable pour les thèmes de blocs) ajuster les valeurs précédentes
        "blocks": {
            "core/paragraph": {
                "color": {},
                "custom": {},
                "layout": {},
                "spacing": {},
                "typography": {}
            },
            "core/heading": {},
            "etc": {}
        }
    }
}
```

- Pour les préréglages, dans ``settings``, certains génèrent des classes et propriété custom css, c'est le cas de:
    + des réglages ajoutés dans ``custom``:
    + des couleurs:
        - color.duotone ne génère pas de classe ou de propriété custom
        - color.gradients génère une classe et une propriété custom par valeur
        - color.palette génère:
            - Une classe pour background-color par valeur
            - une classe pour color par valeur
            - une classe pour border-color par valeur
            - une propriété custom par valeur
        - typography.fontSizes génère une classe et une propriété custom par valeur
        - typography.fontFamilies génère une propriété custom par valeur
    
- Les propriétés custom sont nommés de la manière suivante: ``--wp--preset--{category}--{slug}``, donc pour une couleur noire on aurait: ``--wp--preset--color--black``

- Les classes créées sont nommées de la manière suivante: ``.has-{slug}-{category}``, donc pour une couleur noire on aurait: ``.has-black-color``

- Pour les propriétés custom, elles seront nommées comme suit: ``--wp--custom--{variable}``, exemple si on a:
```json
{
    "version": 2,
    "settings": {
        "custom": {
            "baseFont": 16,
            "lineHeight": {
                "small": 1.2,
                "medium": 1.4,
                "large": 1.8
            }
        },
        "blocks": {
            "core/group": {
                "custom": {
                    "baseFont": 32
                }
            }
        }
    }
}
```
```css
/**Cela créera: */
body {
    --wp--custom--base-font: 16;
    /**Ce système ajoute un -- à chaque "couche", exemple ici on a small qui est une sous propriété de line-height, donc cela crée line-height--small */
    --wp--custom--line-height--small: 1.2;
    --wp--custom--line-height--medium: 1.4;
    --wp--custom--line-height--large: 1.8;
}

/* les propriétés contenues dans blocks.core/group correspondent à la classe wp-block-group */
.wp-block-group {
    --wp--custom--base-font: 32;
}

```
- Le nom des variables custom est obtenue en transformant les noms ``camelCase`` du theme.json en ``kebab-case`` et en ajoutant un double tiret entre les différentes couches

- En plus des presets de settings on peut définir des styles pour certains blocs ou sélecteurs avec ``styles``:
```json
//Voici des exemples de propriétés utilisables avec styles
{
    "version": 2,
    "styles": {
        "border": {
            "radius": "value",
            "color": "value",
            "style": "value",
            "width": "value"
        },
        "filter": {
            "duotone": "value"
        },
        "color": {
            "background": "value",
            "gradient": "value",
            "text": "value"
        },
        "spacing": {
            "blockGap": "value",
            "margin": {
                "top": "value",
                "right": "value",
                "bottom": "value",
                "left": "value",
            },
            "padding": {
                "top": "value",
                "right": "value",
                "bottom": "value",
                "left": "value"
            }
        },
        "typography": {
            "fontSize": "value",
            "fontStyle": "value",
            "fontWeight": "value",
            "letterSpacing": "value",
            "lineHeight": "value",
            "textDecoration": "value",
            "textTransform": "value"
        },
        //Elements permet de définir les styles pour les titres et les liens, ici elements est au plus haut niveau dans styles, il s'appliquera donc directement au sélecteur, (h1, h2,...)
        "elements": {
            "link": {
                "border": {},
                "color": {},
                "spacing": {},
                "typography": {}
            },
            "h1": {},
            "h2": {},
            "h3": {},
            "h4": {},
            "h5": {},
            "h6": {}
        },
        "blocks": {
            "core/group": {
                "border": {},
                "color": {},
                "spacing": {},
                "typography": {},
                //ici elements est dans un bloc les styles seront donc uniquement appliqués au bloc correspondant
                "elements": {
                    "link": {},
                    "h1": {},
                    "h2": {},
                    "h3": {},
                    "h4": {},
                    "h5": {},
                    "h6": {}
                }
            },
        }
    }
}
```
- Les styles de premier rang (ceux directement après styles, et donc pas dans un bloc) sont appliqués au sélecteur ``body``, donc on aura
```json
//Si on ajoute cette propriété dans le json
{
    "version": 2,
    "styles": {
        "color": {
            "text": "var(--wp--preset--color--primary)"
        }
    }
}
```
```css
/**En css on aura: */
body {
    color: var(--wp--preset--color--primary);
}

```

- Les styles dans ``elements`` et de premier rang sont appliqués au sélecteur correspondant (``elements.h1`` correspond donc au sélecteur ``h1``):
```json
//Si on ajoute cette propriété dans le json
{
    "version": 2,
    "styles": {
        "elements": {
            "h1": {
                "typography": {
                    "fontSize": "var(--wp--preset--font-size--x-large)"
                }
            },
        }
    }
}
```
```css
/**En css on aura: */
h1 {
    font-size: var(--wp--preset--font-size--x-large);
}

```

- Les styles à  l'intérieur d'un bloc sont appliqués dans ce bloc:
    - Le nom des blocs dans le css correspond au nom dans le json sans le namespace précédé de ``.wp-block``, c'est à dire de la forme: ``.wp-block-{name-without-namespace}``, donc un bloc nommé: ``core/group``, correspond à ``.wp-block-group``
    >- ``core/paragraphe`` correspondra simplement au sélecteur ``p`` dans le css:
```json
//Si on a ceci en json
{
    "version": 2,
    "styles": {
        "color": {
            "text": "var(--wp--preset--color--primary)"
        },
        "blocks": {
            "core/paragraph": {
                "color": {
                    "text": "var(--wp--preset--color--secondary)"
                }
            },
            "core/group": {
                "color": {
                    "text": "var(--wp--preset--color--tertiary)"
                }
            }
        }
    }
}
```
```css
/**Alors les classes crées dans le css seront: */
body { /**La propriété json de top niveau est ajouté dans body */
    color: var( --wp--preset--color--primary );
}
p { /**core/paragraph ne suit pas la logique de base et correspond au sélecteur p */
    color: var( --wp--preset--color--secondary );
}
.wp-block-group { /**core/group devient .wp-bloc-group */
    color: var( --wp--preset--color--tertiary );
}
```

### Les ajouts du plugin gutenberg
- Le plugin gutenberg ajoute plusieurs fonctionnalités, certaines seront par la suite ajouté au coeur de wordpress
- Pour l'instant je laisse ça de côté, le plugin n'est pas très bien noté, et il est possible que des éléments soient donc retirés complètement par la suite, de plus les éléments qu'il ajoute concerne surtout les thème par blocs
- Voici le [lien](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/#customtemplates) vers la doc des ajouts du plugin

### Utilisation du theme.json
Il existe pour certains éditeurs de code, un schéma qui peut nous aider à écire notre thème.json, grâce à l'autocomplétion, la validation d'erreur,...:
- Sous VSCode il faut utiliser ``$schema": "https://schemas.wp.org/trunk/theme.json"`` au début du thème.json

