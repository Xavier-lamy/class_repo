# Réaliser un header fixe

Pour avoir un header fixé (qui reste en haut de l'écran au scroll):
+ Le HTML
```html
<header>
    <div class="inner">
        <!--Contenu du header, c'est le bloc inner qui doit prendre le fixed-top-->
    </div>
</header>
```

+ Le CSS
```css
header {
    /*On ajoute une hauteur fixe au header*/
    height: 100px;
}

.inner {
    position: fixed;
    top: 0;
}
```

+ Le JS
```js
let innerHeight = document.getElementByClassName('inner').clientHeight(); //offsetHeight() si on souhaite aussi récupérer la barre de scroll et les bordures en plus du padding dans la hauteur

let header = document.getElementByTagName('header');

header.style.height = innerHeight;
````