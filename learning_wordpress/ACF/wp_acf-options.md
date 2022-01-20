# Créer une page d'options ACF
> Ne marche qu'en version pro !!
+ Elles servent à créer des paramètres globaux non rattachés à une page particulière
+ Déclarer la page d'options
```php
//Dans functions.php 

// On test l'existence de la fonction, si un jour ACF est désactivé on aura ainsi pas d'erreur php:
if( function_exists( 'acf_add_options_page' ) ) {
	
    // déclarer la page parente
	acf_add_options_page( array(
		'page_title' 	=> 'Options du thème',
		'menu_title'	=> 'Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'position'    	=> 2
	) );
	
    // déclarer un sous-menu lié à la page parente
	acf_add_options_sub_page( array(
		'page_title' 	=> 'Couleurs du thème',
		'menu_title'	=> 'Couleurs',
		'parent_slug'	=> 'theme-general-settings',
	) );
	
}
```
+ On crée des champs ACF pour notre page d'options
+ Pour afficher dans le template il faut juste ajouter un second paramètre ``'option'`` après le slug du champs:
    - ``the_field( 'slug-name', 'option' )``: si on ne le fait pas ``the_field()`` va chercher dans la page en cours au lieu de chercher dans les options globales du site
