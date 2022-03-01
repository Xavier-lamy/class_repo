# Les helpers
- Il s'agit d'un ensemble de fonctions PHP utilisées par laravel et qu'on peut utiliser nous même
- Exemple ``Arr::add`` permet d'ajouter une **valeur** ou une pair **clé/valeur** dans une array
- [Voir la liste des helpers pour laravel 9](https://laravel.com/docs/9.x/helpers)

## Custom helpers
On peut utiliser nos propres fonctions:
- créer un fichier ``helper.php`` dans le dossier ``app/Http/Helpers/``
- le déclarer dans ``composer.json`` puis lancer la commande: ``composer dump-autoload`` pour pouvoir l'utiliser dans toute l'appli
```json
"autoload": {
    "files":[
        "app/Http/Helpers/helper.php"
    ]
} 
```
- **Attention**: on peut déclarer nos fonctions de deux manières
    - Dans une classe (il faut alors ajouter un namespace)
    - Sans classe (dans ce cas il ne faut pas mettre de namespace et il faut déclarer le fichier dans composer.json), les fonctions seront automatiquement globales
- Il est recommandé de tester l'existence de la fonction avec ``if(!function_exists('function_name'))`` avant de la déclarer, sinon il risque d'y avoir des conflits