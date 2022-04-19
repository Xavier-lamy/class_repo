# Les regex avec JS

- L'objet RegExp permet de créer une regex qu'on pourra utiliser pour tester des chaines de caractères
- en premier paramètre la regex, en deuxième l'option de la regex (ex: i pour indifférence maj/min)
- on peut écrire la regex de 3 façons différentes:
```js
//Soit directement avec une regex littérale
const regex = /^[a-z]$/i;

//Soit en créant une nouvelle instance avec une string
const regex = new RegExp('^[a-z]$', 'i');
//Soit en créant une nouvelle instance avec une regex littérale
const regex = new RegExp(/^[0-9]$/, 'i');
```

+ On peut utiliser la méthode ``test()`` pour chercher si une string match notre regex
```js
const digits = new RegExp('^[0-9]$');
const isDigit = (value) => digits.test(value);
``` 

+ Le flag/option ``g`` à la fin indique qu'il faut chercher toutes les occurences de cette regex (par défaut cela s'arrête à la première):
```js
//Recherche toutes les occurences de caractère possédant entre 1 et 3 caractères
str.match(/.{1,3}/g);
```