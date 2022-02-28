# Valider les données d'un formulaire

+ Un utilisateur peut entrer dee données erronées (même si on a mis le champs en requis avec des options du genre max:"255",...)

+ On utilise la fonction validate à l'intérieur de notre fonction de gestion des données du formulaire:
    - Avant d'ordonner le stockage de données dans notre bdd
    - On vérifie avec la fonction:
        - Si ça échoue laravel renvoie une erreur 'user friendly', dans une variable ``$error`` qu'on pourra récupérer et afficher
        - Si ça réussi laravel exécute le reste de la fonction de base
    - Voir la doc pour les règles de validation disponibles
    - On peut aussi créer ses propres règles

+ Exemple:
    - Ajout de la règle de validation dans le controleur:
    ```php
    $request->validate([
        'title' => ['required', 'unique:commands'], //Ici on détermine qu'on souhaite le titre unique dans la table commande (unique:nom_de_la_table)
        'quantity' => ['required', 'min:0', 'integer'],
        'useby_date' => ['required', 'date_format:Y-m-d', 'after:2000-01-01', 'before:2300-01-01'],
        'command_id' => ['required', 'integer', 'numeric', 'min:1' ],
    ]);
    ```
    - Affichage de l'erreur dans la vue:
    ```php           
    @if($errors->any())
        <ul class="alert--warning my--2 p--2 list--unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    ```

### Exemple de règles
- ``sometimes``: si un champ n'est pas assuré d'être toujours présent, il ne sera validé que quand il sera présent
- ``nullable``: si un champ est optionnel (toujour présent mais peut être vide)


## Créer une règle de validation customisable
+ Dans la console:
    - ``php artisan make:rule RuleName``
+ Ou alors créer un fichier ``RuleName.php`` dans ``app/rules``, le résultat est le même
+ Ensuite:
    - dans le fichier créé:
    ```php
        ...

    public function passes($attribute, $value){
        return strtoupper($value) === $value; //ici on vérifie par exemple que $value est en majuscule en forçant les majuscules et en comparant, doit retourner un booléen
    }
        ...
    public function message(){
        return 'customisable error message';
    }
    ```
+ On peut alors l'ajouter dans notre validation:
    ```php
    //En haut du fichier:
    use App\Rules\RuleName;

    $request->validate([
        'title' => ['required', new RuleName],
    ]);
    ```

## Traduire les messages d'erreur
+ Par défaut ils sont en anglais (langue locale de laravel), pour changer cela:
    - Dans ``app.php`` changer la valeur ``'locale' => 'en',`` à ``'locale' => 'fr',``
    - Dans ``resources/lang`` ajouter un dossier ``fr`` en plus du dossier ``en``, copier tous les fichiers de ``en`` et les retraduire dans ``fr``