# Vue.js

## Extensions utiles
- ~~Vetur pour Vue version 2~~
- **Volar** recommandé pour Vue.js version 3: ajoute des fonctionnalités à vs code pour l'utilisation de vue (auto-complétion, auto-import,...)

## Vue.js 3
Vue.js 3 ajoute:
- la **Composition API**, cela ajoute une fonction `setup()` pour les `components`
- La possibilité d'avoir plusieurs ``root elements`` dans l'élément ``<template>`` d'un ``component``


## Deux utilisations principales
Vue peut être utilisé pour:
- Créer des SPA (Single Page Application), càd une application qui ne contient qu'une seule page, le contenu est mis à jour à chaque demande de l'utilisateur sans avoir à recharger la page
- Créer des widgets indépendants qu'on peut utiliser dans d'autres applis

## Installations:
### Via un cdn
On peut simplement utiliser le lien CDN de la doc, c'est la méthode à retenir notamment dans le cas d'un widget indépendant (histoire d'éviter de charger tous les nodes_modules dans le projet) :
```html
<!--On intègre vue.js via un CDN, on peut utiliser @next au lieu du numéro de version si on souhaite toujours avoir la dernière version-->
<script src="https://unpkg.com/vue@3"></script>
```

### Installation en local
Pour installer un projet en local (avec le framework entier, comme pour un projet laravel par exemple):
  - ``npm init vue@latest``: Va exécuter create-vue, projet officiel qui sert à mettre en place une appli vue de base, on peut choisir quelles extensions on voudra, et le nom du projet
  - Ensuite dans le répertoire du projet on peut ajouter les dépendances avec NPM et lancer le serveur de dev:
  ``` 
    npm install
    npm run dev
  ```
  - Quand on veut passer en prod:
  ```
  npm run build
  ```

#### Démarrage
- On commence par créer l'app dans le main.js on appelle le composant App.vue de base:
```js
import { createApp } from 'vue'

//On importe le SFC App.vue
import App from './App.vue'

const app = createApp(App)
```
- Ensuite il faut **monter** l'app c'est à dire définir quel est le composant racine qui contiendra tous les autres composants, il faut utiliser uniquement après avoir configurer la constante de notre ``app``:
```js
//On fait référence à l'élément HTML qui contiendra notre SPA
app.mount('#app')
```


## Bases
+ Vue n'utilise pas les ``;`` à la fin des lignes de JS, mais on peut choisir de les mettre ou non

+ Vue peut être utilisé avec deux styles API différents depuis la version 3
    - Le mode **options**: définit un composant par un objet avec des méthodes (comme ``data``, ``methods``, ``mounted``), mode recommandé pour des petites applications, ou des applications simples, par défaut la suite de ces notes concernera le mode **options**
    - Le mode **composition**: utilise des fonctions importées, on peut l'utiliser pour des applications full vue.js, notamment avec les SFC:
    ```html
    <script setup>
      import { ref, onMounted } from 'vue'
    </script>
    ```

### Les SFC
``Single File Component``: termine par l'extension ``.vue``, comprend les 3 éléments (html, script et style) en un seul fichier, ce qui permet d'avoir un fichier pour chaque composant de l'appli:
```html
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
```html
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
```html
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
```html
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
```html
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

### Computed Property
Certaines valeurs peuvent être dynamiquement calculées en fonction de la valeur d'autres propriétés, on utilise pour ça l'option ``computed``:
```html
<script>
let id = 0

export default {
  data() {
    return {
      newTodo: '',
      hideCompleted: false,// -> On ajoute une propriété hideCompleted, à false par défaut
      todos: [
        { id: id++, text: 'Write this markdown', done: true }, // -> on ajoute une propriété done pour les todos
        { id: id++, text: 'Make a todolist', done: false },
        { id: id++, text: 'Mastering Vue', done: false }
      ]
    }
  },
  computed: {
    //On ajoute notre nouvelle méthode filteredTodos
    filteredTodos() {
      return this.hideCompleted // -> Si hideCompleted est égal à true 
        ? this.todos.filter((t) => !t.done) // -> alors on renvoie une nouvelle liste filtrée, avec les éléments qui on la propriété done=true retirés
        : this.todos // -> sinon on renvoie toute la liste
    }
  },
  methods: {
    addTodo() {
      this.todos.push({ id: id++, text: this.newTodo, done: false })
      this.newTodo = ''
    },
    removeTodo(todo) {
      this.todos = this.todos.filter((t) => t !== todo)
    }
  }
}
</script>

<template>
  <form @submit.prevent="addTodo"><!--On oublie pas de mettre '.prevent' à la directive submit, afin d'éviter le comportement par défaut qui est d'envoyer vers une autre page-->
    <input v-model="newTodo" />
    <button>Add Todo</button>
  </form>
  <ul>
    <li v-for="todo in filteredTodos" :key="todo.id">
      <input type="checkbox" v-model="todo.done"><!--Ici on bind la checkbox à la propriété done de todo, si on coche cela passe done à true-->
      <span :class="{ done: todo.done }">{{ todo.text }}</span><!--Si on a done=true, on ajoute la classe done-->
      <button @click="removeTodo(todo)">X</button>
    </li>
  </ul>
  <button @click="hideCompleted = !hideCompleted"><!--Ici on spécifie ce qui se passe au click, hideCompleted sera passé à sa valeur opposé: donc false si c'est égal à true et inversement-->
    {{ hideCompleted ? 'Show all' : 'Hide completed' }}
  </button>
</template>

<style>
.done {
  text-decoration: line-through;
}
</style>
```

### Référencer un élément du template
+ Si on a besoin de faire référence *manuellement* à un élément Html du template on peut utiliser l'attribut ``ref="selector"``, pour pouvoir l'utiliser il faut que l'instance du composant soit *montée* (``mounted``), pour ça on utilise l'option ``mounted()``:
  - ``mounted`` est un des **hooks** du cycle de vie d'un composant, il correspond au moment ou le rendu du composant est initialisé et ou les différents ``nodes`` du DOM sont insérés
  - Parmi les autres hooks il y a notamment ``created`` et ``updated``
+ Pour accéder à un élément référencé par ``ref="selector"`` on utilise ``this.$refs.selector``:
```html
<script>
export default {
  mounted() {
    let greeting: 'coucou'
    this.$refs.p.textContent = greeting
  }
}
</script>

<template>
  <p ref="p">hello</p>
</template>
```

### Utiliser les watchers
+ Les watchers permettent de réaliser des opérations secondaires en parallèle d'une action principale lorsque cette dernière change dynamiquement, càd que quand on observe le changement d'état d'un élément suite à une action on peut utiliser un watcher (option ``watch``) pour réaliser une autre opération en parallèle:
```html
<script>
export default {
  data() {
    return {
      todoId: 1,
      todoData: null
    }
  },
  methods: {
    async fetchData() {
      this.todoData = null
      const res = await fetch(
        `https://jsonplaceholder.typicode.com/todos/${this.todoId}`
      )
      this.todoData = await res.json()
    }
  },
  mounted() {
    this.fetchData()
  },
  //On utilise l'option watch
  watch: {
    todoId(newId) { // -> On crée une fonction callback dans watch qui reprend le nom de la propriété qu'on souhaite watch
      this.fetchData(newId) // -> On précise quelle fonction on veut réaliser quand le watcher détecte un changement
      //Note: Dans le cas présent il n'est pas réellement nécessaire de préciser newId on peut laisser vide, par défaut cela prendra en compte un changement d'id
    }
  }
}
</script>

<template>
  <p>Todo id: {{ todoId }}</p>
  <button @click="todoId++">Fetch next todo</button>
  <p v-if="!todoData">Loading...</p>
  <pre v-else>{{ todoData }}</pre>
</template>
```

### Composants et composants enfants
On peut importer des composants à l'intérieur d'autres composants:
1. On importe le composant
2. On utilise l'option ``components`` pour déclarer le(s) composant(s) utilisé(s)
3. On utilise une balise HTML avec le nom du composant enfant pour l'afficher dans le composant parent
```html
<script>
// 1. Importer 
import ChildComp from './ChildComp.vue'
  
export default {
  // 2. Déclarer les composants utilisés
  components: {
    ChildComp
  }
}
</script>

<template>
  <!-- 3. Afficher le composant à l'endroit souhaité-->
  <ChildComp />
</template>
```

#### Les ``props`` de l'éléments enfant
+ Pour passer des données du composant parent à l'enfant, on peut utiliser l'option ``props`` pour l'enfant:
```html
<script>
//Dans le fichier du composant enfant ChildComp.vue
export default {
  //On déclare les props
  props: {
    //On donne un nom à la prop et on définit le type de variable qu'elle peut prendre
    message: String
  }
}
</script>

<template>
  <!--On définit ensuite ou cette valeur sera passé, ici on met aussi une valeur par défaut si rien n'est passé-->
  <h2>{{ message || 'Pas de valeur pour le moment' }}</h2>
</template>
```
```html
<script>
import ChildComp from './ChildComp.vue'

export default {
  components: {
    ChildComp
  },
  data() {
    return {
      greeting: 'Coucou de ton composant papa !'
    }
  }
}
</script>

<template>
  <!--On bind la 'prop' message avec v-bind, et on lui attribue une des données de l'élément parent-->
  <ChildComp :message="greeting" />
</template>
```

#### Les ``emits`` de l'élément enfant
+ Un élément enfant peut aussi passer des évènements à l'élément parent avec ``emit``:
```html
<script>
export default {
  // On déclare tous les évènements émissibles par l'enfant
  emits: ['response'],
  created() {
    //dans le hook created on déclare chaque évènement avec en 1er argument le nom de l'event, les autres arguments passés seront envoyés au parent lorsque cet évènement sera écouté
    this.$emit('response', 'Coucou papounet !')
  }
}
</script>
```
+ Ensuite dans le composant parent on utilise ``v-on:eventName`` (ou ``@eventName``):
```html
<script>
import ChildComp from './ChildComp.vue'

export default {
  components: {
    ChildComp
  },
  data() {
    return {
      childMsg: 'Pas de message pour le moment'
    }
  }
}
</script>

<template>
  <ChildComp @response=" message => childMsg = message" />
  <p>{{ childMsg }}</p>
</template>
```

### les ``slots``
+ Si on souhaite passer des éléments du parent à l'enfant on peut utiliser les ``slots``, il suffit d'entrer du contenu entre les balises du composant:
```html
<!--App.vue-->
<template>

  <ChildComp>
    Contenu ajouté depuis l'élément parent dans les slots
  </ChildComp>

</template>
```
+ Dans le fichier de l'élément enfant il suffit d'ajouter une balise ``<slot/>``, pour déterminer à quel endroit le contenu du parent sera injecté dans l'élément enfant (titre), on peut insérer du contenu entre les balises, il sert de fallback tant qu'aucun contenu ne provient du parent
```html
<!--ChildComp.vue-->
<template>

<slot>Contenu fallback si besoin</slot>

<!--Si on a pas besoin d'ajouter du contenu fallback, on peut juste mettre une balise orpheline-->
<slot/>

</template>
```