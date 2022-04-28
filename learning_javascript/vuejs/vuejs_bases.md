# Vue.js

## Extensions utiles
Vetur: ajoute des fonctionnalités à vs code pour l'utilisation de vue (auto-complétion, auto-import,...)

## Vue.js 3
Vue.js 3 ajoute:
- la **Composition API**, cela ajoute une fonction `setup()` pour les `components`
- La possibilité d'avoir plusieurs ``root elements`` dans l'élément ``<template>`` d'un ``component``


## Deux utilisations principales
Vue peut être utilisé pour:
- Créer des SPA (Single Page Application), çad une application qui ne contient qu'une seule page, le contenu est mis à jour à chaque demande de l'utilisateur sans avoir à recharger la page
- Créer des widgets indépendants qu'on peut utiliser dans d'autres applis

## Installations:
+ On peut simplement utiliser le lien CDN de la doc, c'est la méthode à retenir notamment dans le cas d'un widget indépendant (histoire d'éviter de charger tous les nodes_modules dans le projet) :
```html
<!--On intègre vue.js via un CDN, on peut utiliser @next au lieu du numéro de version si on souhaite toujours avoir la dernière version-->
<script src="https://unpkg.com/vue@3"></script>
```

## Bases
+ Vue n'utilise pas les ``;`` à la fin des lignes de JS, mais on peut choisir de les mettre ou non

+ Vue peut être utilisé avec deux styles API différents depuis la version 3
    - Le mode **options**: définit un composant par un objet avec des méthodes (comme ``data``, ``methods``, ``mounted``), mode recommandé pour des petites applications, ou des applications simples, par défaut la suite de ces notes concernera le mode **options**
    - Le mode **composition**: utilise des fonctions importées, on peut l'utiliser pour des applications full vue.js, notamment avec les SFC:
    ```vue
    <script setup>
    import { ref, onMounted } from 'vue'
    //...
    ```

### Les SFC
``Single File Component``: termine par l'extension ``.vue``, comprend les 3 éléments (html, script et style) en un seul fichier, ce qui permet d'avoir un fichier pour chaque composant de l'appli:
```vue
<script>
export default {
  data() {
    return {
      count: 0
    }
  }
}
</script>

<template>
  <button @click="count++">Count is: {{ count }}</button>
</template>

<style scoped>
button {
  font-weight: bold;
}
</style>
```

### Declarative rendering
Cela signifie que le html est mis à jour en direct en fonction des changements d'état du JS

### Reactive state
On attribue ce terme aux éléments qui peuvent déclencher un changement de contenu en fonction de leur état

- Pour déclarer un *reactive state*, on utilise l'option ``data()``:
```js
export default {
  data() {
    return {
      message: 'coucou'
    }
  }
}
```

- Une fois un *reactive state* déclaré on peut utiliser la notation en *moustaches* (un peu à la manière de blade dans les templates laravel), cela ne sert que pour l'interpolation de texte:
```html
<p>{{ message }}</p>
```

### Les directives
Elles commencent par ``v-`` et ont accès à l'état du composant

#### V-bind
On peut lier une valeur dynamique à un attribut HTML avec la directive ``v-bind:attrName="componentProperty"`` (raccourci en ``:attrName="componentProperty"``):
```html
<!--Dans ce cas l'id sera rendu dynamiquement en fonction de la valeur de la propriété 'dynamicId' du composant-->
<div v-bind:id="dynamicId"></div>

<!--ou:-->
<div :id="dynamicId"></div>
```

#### V-on
- Pour ajouter un event listener, on utilise ``v-on:eventName="componentMethod"`` que l'on peut raccourcir en ``@:eventName="componentMethod"``:
```html
<button v-on:click="increment">{{ count }}</button>
<!--Ou:-->
<button @click="increment">{{ count }}</button>
```
- Les méthodes sont déclarées après ``methods`` dans notre composant, on peut utiliser ``this`` pour faire référence à l'instance du composant et récupérer les propriétés définies par ``data()``
```js
export default {
  data() {
    return {
      count: 0
    }
  },
  
  methods: {
    increment() {
      this.count++
    }
  }
}
```

#### Two ways binding et v-model
- On peut utiliser ``v-on`` et ``v-bind`` ensemble afin d'update automatiquement le contenu entré dans un input, ainsi si le contenu d'un input est modifié, les autres éléments qui utilisent cette valeur seront update en temps réel également:
```vue
<template>
    <input v-bind:value="text" v-on:input="onInput">
    <p>{{ text }}</p>
</template>

<script>
export default {
  data() {
    return {
      text: ''
    }
  },
  methods: {
    onInput(e) {
        this.text = e.target.value
    }
  }
}
</script>
```
- On peut utiliser ``v-model`` à la place de ``v-on`` + ``v-bind``, ``v-model`` synchronise automatiquement la valeur de l'input avec la propriété du composant qui lui est lié, cela fonctionne pour la plupart des types d'input (``text``, ``select``, ``checkbox``, ``radio``,...):
```vue
<template>
    <input v-model="text">
    <p>{{ text }}</p>
</template>

<script>
export default {
  data() {
    return {
      text: ''
    }
  }
}
</script>
```

#### v-if
On peut faire apparaitre du contenu conditionnellement avec ``v-if="condition"``, si la condition vaut ``true``,ou est considéré ``truthy`` (çàd non égale à: ``false``, ``0``, ``-0``, ``0n``, ``""``, ``null``, ``undefined``, ou ``NaN``), l'élément sera rendu, sinon il ne le sera pas:
```vue
<template>
    <h1 v-if="condition1">{{ text }}</h1>
    <h1 v-elseif="condition2">{{ text2 }}</h1>
    <h1 v-else>Défaut</h1>
</template>

<script>
export default {
  data() {
    return {
      text1: 'Coucou'
      condition1: true
      text2: 'ne sera pas rendu car la condition qui l\'afficherait est équivalente à false'
      condition2: null
    }
  }
}
</script>
```

#### ``v-for``
Pour boucler sur une liste d'items on utilise ``v-for``, il faut bind l'id de l'item dans l'attribut ``key``:
```vue
<template>
    <ul>
    <li v-for="todo in todos" :key="todo.id">
        {{ todo.text }}
    </li>
    </ul>
</template>

<script>
let id = 0

export default {
  data() {
    return {
      newTodo: '',
      todos: [
        { id: id++, text: 'Learn HTML' },
        { id: id++, text: 'Learn JavaScript' },
        { id: id++, text: 'Learn Vue' }
      ]
    }
  },
}
</script>
```
+ On peut ensuite utiliser des méthodes pour:
    - ajouter un nouvel item dans la liste: 
    ```js
    this.todos.push(newTodo)
    ```
    - remplacer par une nouvelle liste avec filter: 
    ```js
    this.todos = this.todos.filter(todo => todo.id > 3)
    ```
+ On peut ainsi créer une fonction pour ajouter un item, ou pour en retirer:
```js
  methods: {
    addTodo() {
      this.todos.push({ id: id++, text: this.newTodo })
      this.newTodo = ''
    },
    removeTodo(todo) {
      this.todos = this.todos.filter((t) => t !== todo)
    }
  }
```

#### Computed Property
........
