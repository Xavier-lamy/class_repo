<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
    <header class="header">
        <?php wp_nav_menu( 
            array( 
                'theme_location' => 'main',
                'container' => 'ul',
                'menu_class' => 'header__menu' 
            ) 
        ); ?>
    </header>
        
    <?php wp_body_open(); ?>