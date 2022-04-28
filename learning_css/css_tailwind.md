# Tailwind


## Ajouter du style custom
- On peut soit ajouter des classes à la balise html (exemple si on veut mettre une police à tout le document)
- Si on souhaite appliquer certains styles en fonction d'une balise (exemple on veut que tous les ``h1`` aient une police particulière sans avoir à le remettre sur chaque ``h1``), pour ça on utilise ``@layer base``
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

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

### Customiser nos breakpoints
```js
//tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'tablet': '640px',
      // => @media (min-width: 640px) { ... }

      'laptop': '1024px',
      // => @media (min-width: 1024px) { ... }

      'desktop': '1280px',
      // => @media (min-width: 1280px) { ... }
    },
  }
}
```