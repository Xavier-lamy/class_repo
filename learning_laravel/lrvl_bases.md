# Laravel
> Apprendre Laravel : formation complète Nord coders

MVC:
- Modèle = tables de la BDD
- Vue = template HTML
- Contrôleur = Pilote la logique avec les fonctions

## Divers
- Quand on a beaucoup de variable pour des routes en laravel on peut utiliser ``get_defined_vars()`` pour renvoyer toutes les variables définies dans la fonction

- laravel daily: chaine youtube

- penser au ``@csrf`` ppour les formulaires laravel, ajouter ``{{old('value')}}``

- le path de laravel est dans le dossier public (donc pas besoin d'ajouter ``public`` devant nos path)

- les templates des vues vont dans ``views``: on peut utiliser ``blade`` pour avoir accès à de nombreuses fonctionnalités: ``.blade.php``

- Quand on revient sur notre projet après avoir fermer vscode ne pas oublier de relancer le serveur (``php artisan serve``) et de relancer la compilation auto webpack (``npm run watch``)

- Quand on revient sur un projet après que d'autres aient apporté des modifs dessus, il ne faut pas oublier de faire un composer install

- Si on ajoute ou modifie certains types de fichiers à la main (exemple des Models, Seeders, Migrations,..) il faut penser à faire ``composer dumpautoload``, car quand on les ajoute avec ``php artisan make:`` celui ci les ajoute automatiquement à ``composer.json`` (s'il y a des changements dans les normes de nommage de fichiers PSR4 par exemple), donc quand on ajoute ou modifie à la main, ceci n'est pas fait

### Utilsation des fonctions avec @
Avec laravel on peut utiliser ``@`` pour intégrer des fonctions php ou des fonctions propres à laravel:
- ``@foreach/@end foreach``
- ``@yield``
- voir *views/blade* pour plus d'exemples

## Mélanger une boucle for avec un if/else
- On commence avec ``@forelse($items as $item)``
- Si dans le foreach il n'y a rien ($items est vide) on exécute du code par défaut dans ``@empty``
- On referme avec ``@endforelse``

## dd($var)
On peut utiliser ``dd($var_name)`` pour réaliser un ``Die and Dump`` càd qu'on arrete l'exécution du code à cet endroit et renvoie des infos sur la variable

## Configuration
+ L'option debug peut etre mise à true lors de la phase de dev
    - Elle doit toujours etre remise à false lors de la phase de prod

## Utiliser Carbon pour comparer ou formater des dates
```php
use Carbon\Carbon;
    /*....*/
    public static function check_product_expiry($date){
        $current = Carbon::now()->format('Y-m-d');
        //Force correct format for returned date:
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $diffInDays = $date->diffInDays($current);

        if($date->lt($current)){
            return $class_sufix='-warning';
        }
        elseif($diffInDays <= 10 && $diffInDays >= 1) {
            return $class_sufix='-message';
        }
        else {
            return $class_sufix='-success';
        }  
    }
```

## Utiliser phpmd (mess detector)
- php md mess detector pour etre sûr de faire du code php propre et détecter les problèmes de syntaxe, les codes trop verbeux ou inutilement compliqué :
    - Dans le dossier du projet laravel: ``composer require --dev phpmd/phpmd``
    - Puis on entre la commande: ``vendor/bin/phpmd app  html unusedcode,cleancode --reportfile phpmd.html``, après la commande ``vendor/bin/phpmd``, on a besoin des paramètres suivants:
        - le chemin du code source à examiner
        - l'extension du fichier du rapport
        - la règle que l'on souhaite tester parmi (on peut aussi créer les nôtres): ``cleancode``, ``codesize``, ``controversial``, ``design``, ``naming``, ``unusedcode`` (voir doc pour plus d'infos)
        - des options (ici ``--reportfile`` qui permet d'envoyer le rapport dans le fichier de rapport au lieu de l'output de la console par défaut)
        - Le nom du fichier du rapport d'erreur
        - Exemple pour run toutes les règles: ``vendor/bin/phpmd app  html unusedcode,cleancode,codesize,controversial,design,naming --reportfile phpmd.html``
        - On peut créer son propre fichier de règles custom pour laravel:
        ```xml
        <?xml version="1.0" encoding="UTF-8"?>
            <ruleset name="Laravel and similar phpmd ruleset"
                xmlns="http://pmd.sf.net/ruleset/1.0.0"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xsi:schemaLocation="http://pmd.sf.net/ruleset/1.0.0 http://pmd.sf.net/ruleset_xml_schema.xsd"
                xsi:noNamespaceSchemaLocation="http://pmd.sf.net/ruleset_xml_schema.xsd">
            <description>
                Inspired by https://github.com/phpmd/phpmd/issues/137
                using http://phpmd.org/documentation/creating-a-ruleset.html
            </description>
            <rule ref="rulesets/cleancode.xml">
                <exclude name="StaticAccess"/>
            </rule>
            <rule ref="rulesets/codesize.xml/CyclomaticComplexity"/>
            <rule ref="rulesets/codesize.xml/NPathComplexity"/>
            <rule ref="rulesets/codesize.xml/ExcessiveMethodLength"/>
            <rule ref="rulesets/codesize.xml/ExcessiveClassLength"/>
            <rule ref="rulesets/codesize.xml/ExcessiveParameterList"/>
            <rule ref="rulesets/codesize.xml/ExcessivePublicCount"/>
            <rule ref="rulesets/codesize.xml/TooManyFields"/>
            <rule ref="rulesets/codesize.xml/TooManyMethods">
                <properties>
                    <property name="maxmethods" value="30"/>
                </properties>
            </rule>
            <rule ref="rulesets/codesize.xml/ExcessiveClassComplexity"/>
            <rule ref="rulesets/controversial.xml">
                <exclude name="CamelCaseVariableName"/>
            </rule>
            <rule ref="rulesets/design.xml">
                <exclude name="CouplingBetweenObjects"/>
            </rule>
            <rule ref="rulesets/design.xml/CouplingBetweenObjects">
                <properties>
                    <property name="minimum" value="20"/>
                </properties>
            </rule>
            <rule ref="rulesets/naming.xml">
                <exclude name="ShortVariable"/>
            </rule>
            <rule ref="rulesets/naming.xml/ShortVariable"
                    since="0.2"
                    message="Avoid variables with short names like {0}. Configured minimum length is {1}."
                    class="PHPMD\Rule\Naming\ShortVariable"
                    externalInfoUrl="http://phpmd.org/rules/naming.html#shortvariable">
                <priority>3</priority>
                <properties>
                    <property name="minimum" description="Minimum length for a variable, property or parameter name" value="3"/>
                    <property name="exceptions" value="id,q,w,i,j,v,e,f,fp" />
                </properties>
            </rule>
            <rule ref="rulesets/unusedcode.xml"/>
        </ruleset>
        ```

## Test unitaires
- On peut utiliser ``php artisan test`` pour lancer les tests de laravel
- Ou ``vendor/bin/phpunit`` pour lancer les tests phpunit
