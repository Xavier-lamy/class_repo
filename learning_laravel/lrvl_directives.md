# Les directives blades

Ce sont des sortes de raccourci pour les structures php de bases

## If et dérivées
```php
//Standard if block
@if (count($condition) < 1)
    doSomething();
@elseif (count($condition) > 1)
    doSomethingElse();
@else
    doSomethingButBetter();
@endif
```
```php
//Unless
@unless (count($condition) === 1)
    doSomething();
@endunless
```
```php
//if isset
@isset ($condition)
    doSomething();
@endisset
```
```php
//if empty
@empty ($condition)
    doSomething();
@endempty
```

## Authentification
```php
@auth('admin') //On peut préciser le "guard" utilisé (optionnel)
    // Authentifié
@endauth
 
@guest('admin')
    // Non authentifié
@endguest
```

## Environnement
```php
@production
    // Production specific content...
@endproduction
```
```php
@env('staging')
    //Environnement staging (reproduction d'un environnement de prod afin de tester)
@endenv
 
@env(['staging', 'production'])
    //Environnement staging ou production
@endenv
```

## Include
```php
//Standard
@include('view.name', ['status' => 'complete'])

//Si la vue peut exister ou non
@includeIf('view.name', ['status' => 'complete'])

//Inclure si condition
@includeWhen($boolean, 'view.name', ['status' => 'complete'])

//Inclure sauf si condition
@includeUnless($boolean, 'view.name', ['status' => 'complete'])

//Inclure la première vue disponible de la liste
@includeFirst(['custom.admin', 'admin'], ['status' => 'complete'])
```

## Foreach
Dans un ``@foreach`` de blade, une variable $loop est disponible, ce qui permet d'avoir accès à certaines infos sur la boucle , comme l'index par exemple:
```php
@foreach ($users as $user)
    @if ($loop->first)
        //This is the first iteration.
    @endif
 
    @if ($loop->last)
        //This is the last iteration.
    @endif
 
    <p>This is user {{ $user->id }}</p>
@endforeach

//Pour accéder à la boucle parente dans une boucle enfant:
@foreach ($users as $user)
    @foreach ($user->posts as $post)
        @if ($loop->parent->first)
            //This is the first iteration of the parent loop.
        @endif
    @endforeach
@endforeach
```

## Formulaires
```php
//Indiquer que l'élément est coché si la condition est vraie
@checked(old('active', $user->active))

//Indiquer que l'élément est sélectionné si la valeur est bien celle recherchée
@selected(old('version') == $version)

//Désactiver si condition est vraie
@disabled($errors->isNotEmpty())
```

## Autres
```php
//Die and dump
@dd($condition)
```

```php
//Pour n'afficher quelquechose qu'une seule fois (lors de passages dans une boucle, cela n'affichera qu'au premier passage)
@once
    @push('scripts')
        <script>
            let me = becomingTheBest();
        </script>
    @endpush
@endonce

//Version raccourci (car @once est souvent utilisé avec @prepend ou @push)
@pushOnce('scripts')
    <script>
        let me = becomingTheBest();
    </script>
@endPushOnce
```