# Optimisation de JS

4 programmes pour l'optimisation:

## Linter
+ analyse le code et détecte les erreurs:
    - les erreurs de syntaxe, 
    - variables non utilisées ou non existentes, 
    - mauvaise organisation du code
    - non respect des bonnes pratiques d'écriture
+ Exemple: JSLint ou ESLint


## Minifier: 
+ permet de minifier notre code, en le rendant le plus léger possible:
    - retire les espaces et retours à la ligne inutiles
    - renomme les variables ave des noms pluss courts
    - supprime le code non utilisé
    - supprime les commentaires
    - optimise des bouts de code en réécrivant avec une syntaxe plus légère
+ Exemple: node-minify et UglifyJS


## Bundler:
+ permet de packager nos fichiers en un seul, pour qu'on puisse coder sur plusieurs  fichiers mais que le navigateur n'en ai qu'un à charger
    - Exemple: webpack

## Transpiler: 
+ permet d'utiliser les fonctionnalités nouvelles de JS tout en restant compatible avec tous les navigateurs
    - Exemple: Babel
