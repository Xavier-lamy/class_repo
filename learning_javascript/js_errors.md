# Les erreurs
Il existe trois grand types d'erreurs:
- Erreur de **syntaxe** (oubli de parenthèse, accolades,...)
- Erreur **logique**: erreur dans la logique du programme (valeur erronée pour une variable, mélage des conditions dans les instructions, ordre incorrect d'écriture des lignes de code)
- Erreur **d'exécution**: liée à des évènements externes au code, cvomme une base de données ou la connection internet

Pour gérer les erreurs on peut utiliser 2 methodes différentes:
- ``if/else``
```js
if (dataExists && dataIsValid) {
    //utiliser les données ici
} else {
    // gérer l'erreur ici
}
```

- ``try/catch``
```js
try {
    //code à tester
} catch (error) {
    //réaction à l'erreur ici
}
```