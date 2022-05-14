# php Documentor

- Il s'agit d'un projet permettant de documenter nos classes et fonctions dans le commentaire au dessus de leur déclaration

- un doc comment doit obligatoirement etre de la forme (d'autre types de commentaires seront ignorés):
```php
/**
 * 
 */
```

- Exemple pour une fonction:
```php
/**
 * Description de la fonction
 * 
 * @param string $string : un paramètre
 * @param integer $number : un autre paramètre
 * 
 * @throws ExceptionClass : Exception renvoyée
 * @author Nom de l'auteur
 * 
 * @return Status : ce qui est retourné
 */
public function functionName($string, $number) {
    try {
        return $string . $number;
    }
    catch (ExceptionClass $e){
        echo 'Exception: ' . $e->getMessage();
    }
}
```