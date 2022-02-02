# Les vues

Elle servent à afficher les pages, on les sépare des controleurs; on les trouves dans ``ressources/views`` on peut ajouter un dossier ``layout`` pour les templates (``app.blade.php``) et un ``partials`` pour les composants comme les menus ou autres parties

## Blade
+ Moteur de templates utilisé par laravel
+ On utilise des sortes de fonctions appelées *directives* avec ``@`` pour définir les blocs que l'on veut étendre:
+ On peut ajouter des commentaires avec ``{{--Le commentaire--}}``, il n'est pas rendu en html, ce qui peut être pratique quand on souhaite commenter sans que ce soit visible dans l'inspecteur

### @section et @yield pour créer des héritages
- dans app.blade.php
```php
<head>
    ...
</head>
<body>
    <header>
        ...
    </header>
    /*Contenu template général pour tous les fichiers*/
    ...
    // Contenu modifiable (blocs)
    @section("nom") // on donne un nom à la section pour pouvoir la retrouver plus tard 
    ...//On peut la préremplir et son contenu sera affiché sauf s'il est écrasé par du contenu nouveau
    @show           

    //Ou contenu modifiable (contenu individuel)
    @yield("content")

    //Contenu avec une valeur par défaut
    @yield("title", "default title if no other title")
</body> 
```

- Dans le fichier voulu
```php
@extends("layouts.app") //pas besoin de .blade.php et on remplace "/" par "."

//Ensuite on a juste besoin de rédiger le contenu des sections et des yields
@section("nom")
...
@endsection

//Ou pour les yields (cette fois il faut fermer le bloc)
@section("content")
    //le contenu du ici
@endsection

//On peut ne pas refermer la section du yield si on n'ajoute rien dedans, on peut alors utiliser la valeur par défaut ou la changer:
@section("title", "new default title")
```

### @parent
``@parent`` permet de ne pas écraser le contenu d'une section, par défaut si on appelle une section le contenu qu'on ajoute à l'intérieur écrase celui prévu par le template, donc avec ``@parent``, le contenu original est conservé et le contenu qu'on ajoute après ``@parent`` est ajouté à la suite
```php
@section
    @parent
    //Contenu ajouté
@endsection
```

### @include
+ Pour inclure des parties:
```php
@include("partials.navbar");
```

## Déterminer si un bloc doit hériter d'une section ou non

### ``@hasSection``:
Si un template a une certaine section

```php
@hasSection('navigation')
    //Si le template a le bloc section('navigation') alors on ajoute la navigation: 
    <div class="nav">
        @yield('navigation')
    </div>
@endif
```

### ``@sectionMissing``:
Si un template n'a pas une certaine section:
```php
@sectionMissing('navigation')
    //Si le template n'a pas le bloc navigation alors on appelle le bloc 'default-navigation
    <div class="nav">
        @include('default-navigation')
    </div>
@endif
```

