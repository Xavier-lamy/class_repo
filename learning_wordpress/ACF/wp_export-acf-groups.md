# Exporter les groupes ACF
+ Permet de les sauvegarder
+ permet de les réutiiser sur d'autres sites


## Exporter et importer manuellement
+ dans **ACF > Outils** il y a un outil d'import export, cela exporte au format JSON
+ exporter un seul groupe de champs à la fois: pour pouvoir les réutiliser séparément sur n'importe quel projet

## Export JSON automatique
+ cela permet une save auto à chaque fois qu'on modifie un groupe de champs

+ pour l'activer il suffit d'ajouter ce code dans functions.php
```php
function prefix_acf_export_json( $path ) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}
add_filter( 'acf/settings/save_json', 'prefix_acf_export_json' );
```

+ Penser à le faire au début de chaque projet comme ça les groupes se sauvegardent au fur et à mesure

+ On peut synchroniser les groupes de champ sur l'interface d'admin WP

## Export en PHP
+ c'est utile notemment pour des sites multilingues, car on peut *internationaliser* les strings, en revanche si on supprime le site local, les champs ne sont plus modifiables qu'en php, donc si on a pas besoin d'*internationaliser* il vaut mieux utiliser la méthode JSON
+ dans **ACF > Outils** mais cette fois cliquer sur générer le php puis:
    - copier le code généré
    - le coller dans des sous-fichiers de fonction (qu'on appelle dans functions.php avec ``require_once``)
+ Pour *internationaliser* les strings on utilise la fonction WP: ``__()``, ne pas l'utiliser sur les slugs, s'ils sont traduit ça ne fonctionnera plus.
