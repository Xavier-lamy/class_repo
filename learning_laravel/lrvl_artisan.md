# Php Artisan

Il s'agit d'une liste de commandes qu'on peut utiliser avec laravel et qui permet d'exécuter rapidement certaines actions (commme la migration des tables par exemple)

## Liste de commmandes utiles
- ``php artisan`` = liste des commandes possibles
- ``php artisan serve`` = Lance un serveur local pour tester le site
- ``php artisan make:migration name_of_migration`` (ex: ``remove_comments_table`` créera une migration ou on pourra ajouter une fonction pour supprimer une table )
- ``php artisan make:controller StockController --resource`` : crée un controlleur le flag --resource permet de créer les emplacements pour les méthodes de crud (index, create, store, show, edit, update, destroy)
- ``php artisan test`` = pour lancer les tests de laravel
- ``php artisan make:test RandomTest`` = pour créer un test laravel dans features
- ``php artisan make:test RandomTest --unit`` = pour créer un test laravel dans unit
- ``php artisan make:model Post -m`` = pour créer un modèle (``Post``) et la migration (avec une table ``posts``) qui va avec
