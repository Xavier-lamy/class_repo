# Tailwind

## Le principe des couches (layers)
- Tailwind utilise un système de couche pour déterminer quelle classe css doit etre prioritaire sur une autre:
  - ``@layer base``: définit les styles de bases (exemple la taille générale des titres, de la couleur du corps,...), tailwind aussi met à zéro un certain nombre de styles (exemeple il retire les styles des titres, les marges des différents éléments, les listes n'ont pas de bullet et pas de padding ou margin, les bordures sont retirées...), cela permet une unité entre tous les navigateurs, les style seront donc uniquement ceux qu'on a décidé
  - ``@layer components``: définit les styles des composants (généralement un groupe de plusieurs propriétés) qui seront donc prioritaires sur la base (exemple un bouton, une carte,...), mais pourront voir leur style écraser par les classes utilitaires
  - ``@layer utilities``: définit des styles individuels qui pourront écraser n'importe quel autre style
  - Note: les classes css qu'on ajoute dans ``@layer`` ne sont générées et chargées que si on les utilise dans le HTML, si on souhaite qu'une classe soit toujours chargée même si on ne l'utilise pas il faut donc la déclarer en dehors des ``@layer``, en faisant attention à l'endroit ou on la place (qui déterminera par quelles classes elle peut etre écrasée ou non)
  - Note: une liste avec ``list-style: none;`` n'est pas notifié en tant que list par VoiceOver le lecteur d'écran d'Apple, il faut donc préciser l'attribut ``role="list"`` si on souhaite que cela soit lu comme une liste
  - Note: on peut désactiver ``Preflight`` (le plugin qui reset le css dans bases), si par exemple on souhaite ajouter tailwind à un projet existant, dans tailwind.config.js il suffit d'ajouter:
  ```js
  module.exports = {
    corePlugins: {
      preflight: false,
    }
  }
  ```

## Ajouter du style custom
- On peut soit ajouter des classes à la balise html (exemple si on veut mettre une police à tout le document)
- Si on souhaite appliquer certains styles en fonction d'une balise (exemple on veut que tous les ``h1`` aient une police particulière sans avoir à le remettre sur chaque ``h1``), pour ça on utilise ``@layer base``
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
/*La ligne qui suit n'est pas obligatoire, elle définit où seront placés les éléments de variation (hover:, dark:, lg:, ..., par défaut ils seront placés à la toute fin du fichier de style, on doit donc ajouter cette ligne seulement si on souhaite changer leur emplacement*/
@tailwind variants;

@layer base {
  h1 {
    @apply text-2xl;
  }
  h2 {
    @apply text-xl;
  }
  /* ... */
}
```
- Note: quand on utilise la directive ``@apply``, les ``!important`` sont retirés par défaut, on peut les rajouter après pour spécifier qu'on souhaite bien le ``!important`` à la fin des propriétés:
```css
@layer base {
  .btn {
    @apply font-bold py-2 px-4 rounded !important;
  }
}
```
```scss
/*Si on utilise sass il faut interpoler le '!important'*/
@layer base {
  .btn {
    @apply font-bold py-2 px-4 rounded #{!important};
  }
}
```
- Si on souhaite créer des composants (comme des boutons), on peut utiliser ``@layer components``, attention cependant à ne pas créer des centaines de composants, le but de tailwind est de nous forcer à avoir des classes spécifiques, si on a vraiment besoin de réutiliser souvent la même série de classe (par exemple si on a souvent un ``bg-blue-500 border rouded text-white``), il faut d'abord se demander s'il n'est pas plus pertinent de créer un template html si on le réutilise plusieurs fois, si en effet créer une classe css custom semble être le plus pertinent alors on peut utiliser ``@layer components``, il est recommandé de l'utiliser sur des petits composants (bouton par exemple):
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer components {
  .btn-primary {
    @apply py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75;
  }

  /*On peut aussi directement des propriétés css et les variables du thème*/
    .card {
      background-color: theme('colors.white');
      border-radius: theme('borderRadius.lg');
      padding: theme('spacing.6');
      box-shadow: theme('boxShadow.xl');
  }
}

/*Note: si il ne s'agit pas de composants mais plutôt des "utilities" il faut utiliser:*/
@layer utilities {
  .filter-none {
    filter: none;
  }
}
```

## Customiser des polices
+ Customiser le thème dans le ``tailwind.config.js``:
```js
//tailwind.config.js
module.exports = {
  theme: {
    fontFamily: {
      //Tailwind base fonts (use `extend: {}` to keep them)
      'sans': ['ui-sans-serif', 'system-ui', ...],
      'serif': ['ui-serif', 'Georgia', ...],
      'mono': ['ui-monospace', 'SFMono-Regular', ...],
      //We can add our own fonts:
      'display': ['Oswald', ...],
      //If a font has an invalid character like space, we need to put doubles quotes or escape the character
      'body': ['"Open Sans"', ...],
    }
  }
}
```
+ Si on souhaite ajouter une police custom il faut l'intégrer:
```css
@font-face {
    font-family: "Orbitron";
    src: url("assets/fonts/Orbitron-Regular.woff");
}
```

## Tailwind modifiers
Tailwind possèdes des classes qui permettent de modifier le comportement des styles en fonction des modifications telles que les pseudo-classes, pseudo-éléments, media-queries, dark-mode,...  
Exemples:
- ``first:`` quand un élément enfant sera le premier enfant
- ``hover:`` quand on passe sur l'élément
- ``dark:`` quand on est en dark-mode
- ``md:`` quand on est au breakpoint ``md``
- ``dark:md:hover:`` quand on est en dark-mode au breakpoint ``md``, au hover

## Les breakpoints
### Breakpoints de base Tailwind:
| Breakpoint prefix	| Minimum width	| CSS |
|-------------------|---------------|-----|
| sm	| 640px	| @media (min-width: 640px) { ... } |
| md	| 768px	| @media (min-width: 768px) { ... } |
| lg	| 1024px	| @media (min-width: 1024px) { ... } |
| xl	| 1280px	| @media (min-width: 1280px) { ... } |
| 2xl	| 1536px	| @media (min-width: 1536px) { ... } |
+ Ils fonctionnent comme avec bootstrap (*mobile first*), et applique le style aux éléments qui ont une largeur au-dessus , exemple ``sm`` sélectionne au-dessus de 640px de largeur d'écran 

+ Si on a besoin d'ajouter du style dans notre css avec des breakpoints on peut les référencer par leur nom grâce à ``screen()``:
```css
@media screen(sm) {
  .btn {
    @apply px-2;
  }
}
```

### Customiser nos breakpoints
- On peut ajouter nos propres breakpoints exemple on pourrait avoir: ``text-center tablet:text-start``, pour cela il faut les ajouter dans ``tailwind.config.js``, on peut aussi modifier ceux de base
```js
//tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'tablet': '640px',
      // => @media (min-width: 640px) { ... }, 'tablet' is the name of the breakpoint for the class example

      'laptop': '1024px',
      // => @media (min-width: 1024px) { ... }

      'desktop': '1280px',
      // => @media (min-width: 1280px) { ... }
    },
  }
}
```

## Customiser le thème et nos classes
- Dans le fichier de config de tailwind on peut modifier ou ajouter de nombreuses valeurs pour customiser le thème, exemple:
```js
module.exports = {
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
    },
    colors: {
      'blue': '#1fb6ff',
      'pink': '#ff49db',
      'orange': '#ff7849',
      'green': '#13ce66',
      gray: {
        'dark': '#273444',
        DEFAULT: '#8492a6',
        'light': '#d3dce6',
        100: '#f7fafc',
      }
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  }
}
```
- Attention quand on ajoute les éléments tels que ``colors``, ``font-family``, cela écrase les réglages par défaut de tailwind, si on ne les met pas il prend ceux par défaut, si on souhaite garder des élements tout en ajoutant les notre il faut les mettre dans ``extend{}``
- Si on souhaite utiliser certains éléments de ce thème dans une classe on peut utiliser la fonction ``theme()``, en paramètre on utilise la notation pointée pour accéder aux différentes valeurs:
```css
.content-area {
  height: calc(100vh - theme('spacing.12'));
}
/*S'il y a des valeur décimales il faut les encadrer avec des crochets*/
.content-area {
  height: calc(100vh - theme('spacing[2.5]'));
}
/*Si on utilise les couleurs avec des variantes de tailwind (comme gray-light), il ne faut pas utiliser la notation avec des tirets (ex: ne pas utiliser 'colors.gray-light', sauf si le nom dans le fichier config est composé d'un tiret mais:*/
.btn-blue {
  background-color: theme('colors.gray.light');
  color: theme('colors.custom-green');/*Dans ce cas par contre on utilise le tiret si la couleur s'appelle custom-green*/
}
```

- Si on a besoin de créer des classes très spécifiques (exemple un endroit de notre html, ou on a besoin une seule fois d'une classe qui place notre div à 166px du haut d'un élément), on peut utiliser les crochets pour forcer tailwind à générer une classe, l'intérêt contrairement à du style css mis directement l'attribut style, c'est qu'on peut utiliser tous les utilitaires de tailwind, les breakpoints, les changements d'état comme le hover, les pseudo-elements...:
```html
<div class="top-[166px] lg:top-[666px]"></div>
```

- Si on a besoin de créer une propriété css vraiment particulière, là encore on peut forcer tailwind à la créer avec les crochets, exemple ici on souhaite créer une classe pour le type des éléments mask des svg:
```html
<div class="[mask-type:alpha]"></div>

<!--Cela marche aussi pour les variables css, là encore l'intéret par rapport à du css dans un attribut style, c'est l'utilisation des utilitaires -->
<div class="[--scroll-offset:56px] lg:[--scroll-offset:44px]"></div>
```

- Si on a besoin d'avoir des espaces dans nos classes css (exemple paramètres de la propriété grid), il faut utiliser les ``_``, tailwind les remplacera par des espaces quand il génère la classe, tailwind saura également repérer si les underscore ont besoin ou non d'être transformé en espaces (exemple pour des éléments courants comme des urls ou les underscore doivent rester il saura qu'il ne faut pas les modifier):
```html 
<div class="grid grid-cols-[1fr_500px_2fr]"></div><!--Ici tailwind changera les _ par des espaces pour générer le style-->
<div class="bg-[url('/what_a_rush.png')]"></div><!--Ici il saura qu'il ne doit pas changer les _-->

<!--Si on est dans un cas ou un espace ou un underscore pourrait etre considéré comme étant valide, il faut alors préciser à tailwind ce qu'on souhaite en échappant le underscore:-->
<div class="before:content-['hello\_world']"></div>
```

- Tailwind est également capable de comprendre le type de propriété qu'on cherche à avoir, par exemple les classes commençant par le préfixe ``text`` peuvent faire référence à des propriétés css de type ``color`` ou ``font-size```, mais tailwind analysera la valeur (selon si c'est une couleur ou une taille en px, rem,...), pour déterminer si notre style custom est de type couleur ou taille, on peut aussi lui préciser avec un préfixe le type de variable (css data type), car dans le cas des variables il ne saura pas forcément quel propriété choisir s'il peut y'en avoir plusieurs pertinentes:
```html
<!-- Dans ce cas il devinera qu'il s'agit de font-size -->
<div class="text-[22px]"></div>

<!-- Dans ce cas il devinera qu'il s'agit de color -->
<div class="text-[#bada55]"></div>

<!--Dans ce cas il ne peut pas savoir car la variable pourrait etre une couleur ou une taille-->
<div class="text-[var(--my-var)]"></div>

<!-- On préfixe avec le type de variable, et donc il saura qu'il s'agit de font-size -->
<div class="text-[length:var(--my-var)]"></div>

<!-- On préfixe avec le type de variable, et donc il saura qu'il s'agit de color -->
<div class="text-[color:var(--my-var)]"></div>
```

## Installations

### Installation avec vue.js
- Après avoir créé un projet vue.js avec:
```
npm init vite my-project
cd my-project
```
- Installer et exécuter le package de tailwind
```
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```
- Ajouter les *path* dans le fichier de config ``tailwind.config.js``
```js
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```
- Créer un fichier ``index.css`` dans ``src`` et ajouter les composants tailwind:
```css
@tailwind base;
@tailwind components;
@tailwind utilities;
``` 
- Ajouter le fichier css dans le js:
```js
import { createApp } from 'vue'
import App from './App.vue'
//Add this line
import './index.css'

createApp(App).mount('#app')
```
- On peut alors lancer ``npm run dev`` et utiliser les classes css
