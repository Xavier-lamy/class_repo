# La pagination et la navigation entre les articles

La pagination est utile pour le **maillage interne** utilisé pour faciliter la navigation entre les pages pour les internautes, et la compréhension de l'architecture du site pour les robots de référencement

## Ajouter une pagination simple:
- Dans le fichier **archive.php** après la boucle WP (afin d'éviter les problèmes de répétition):
    - ``posts_nav_link()``
- Problème: pas très personnalisable

## Ajouter une pagination plus personnalisable
- toujours dans archive, on créé un bloc de pagination en utilisant deux fonctions (avec en argument facultatif le texte qu'on veut, si le texte par défaut ne nous convient pas):
    - ``previous_posts_link( 'Page précédente' )``
    - ``next_posts_link( 'Page suivante' )``
```html
<div class="site__navigation">
    <div class="site__navigation__prev">
        <?php previous_posts_link(); ?>
    </div>
    <div class="site__navigation__next">
        <?php next_posts_link(); ?> 
    </div>
</div>
```
- Il existe une version ``get_`` si on veut seulement récupérer sans afficher (pas très intéressant car renvoie la balise ``<a>`` entière,pas juste l'url):
    - ``$prev_posts = get_previous_posts_link();``
    - ``$next_posts = get_next_posts_link();``

## Pagination numérotée
- toujours après la boucle WP:
``the_posts_pagination()`` : créé une pagination numérotée: qui ajoute par défaut un lien précédent, un lien suivant, les numéros des pages précédentes, et 5 pages plus loin (séparé par des "...")

## Pagination avec une extension:
Par exemple **WP-PageNavi**, il suffit d'ajouter ``wp_pagenavi()`` à la place des fonctions des précédents paragraphes

## Pagination entre articles:
On peut aussi ajouter des liens vers les articles précédents et suivants directement au sein de **single.php**, après la boucle WP:
- Lien précédent: ``previous_post_link( 'Article précédent<br>%link' )``
- Lien suivant: ``next_post_link( 'Article suivant<br>%link' )``
- Les fonctions sont quasi identiques à part le "s" à "post", ``%link`` sera remplacé par le lien de l'article
