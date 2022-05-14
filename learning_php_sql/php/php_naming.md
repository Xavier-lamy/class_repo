# Nommage en php

Il existe des conventions (recommandées):

+ Les classes : **PascalCase (UpperCamelCase)**
    - On peut utiliser un  ``_`` pour montrer la séparation dans le chemin de fichier, ex: si on a une classe fichier nommé Car.php dans le chemin ``/Models/Car.php`` alors le nom de la classe devra être ``Models_Car``.  

+ Les interfaces : **PascalCase (UpperCamelCase)**
    - Là aussi on peut utiliser un  ``_`` pour montrer la séparation dans le chemin de fichier

+ Les fonctions et méthodes : **camelCase (lowerCamelCase)**
    - Les méthodes déclarées avec un modificateur **privé** ou **protégé** de visibilité doit commencer par un ``_``

+ Les variables : **snake_case**
    - Les variables déclarées avec un modificateur **privé** ou **protégé** de visibilité doit commencer par un ``_``

+ Les constantes : **ALL_CAPS**

+ **kebab-case** non utilisé en php et dans la majorité des langages de programmation, sert par contre pour les urls par exmple