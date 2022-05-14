# Utiliser les dates en SQl
+ Différents types de dates que l'on peut stocker dans MySQL:
    - ``DATE`` : stocke la date sous la forme AAAA-MM-JJ (Année-Mois-Jour)
    - ``TIME`` : stocke le temps sous la forme HH:MM:SS
    - ``DATETIME`` : combine les deux précedents sous la forme AAAA-MM-JJ HH:MM:SS 
    - ``TIMESTAMP`` : sotcke le nombre de seconde passées depuis le 1er janvier 1970 à 00:00:00
    - ``YEAR`` : stocke l'année sous la forme AA ou AAAA 

+ Avec ça on peut créer un champs sql nommé par exemple creation_date
    - il est en effet recommandé d'éviter de nommer ses champs avec des termes comme "date" ou "text" car ceux-ci sont aussi des mots clés sql et risqueraient d'être mal interprété lors des requêtes
    - dans le type on pourra mettre ``DATETIME`` ou ``DATE`` par exemple et dans valeur par défaut on choisit ``CURRENT_TIMES`` ce qui remplit le champs automatiquement avec la valeur actuelle.

+ Un champs de type date, s'utilise comme une string, on doit donc l'entourer de guillemets, exemple:
```sql
    SELECT pseudo, message, date FROM minichat WHERE date = '2021-05-26 15:56:30'
```

+ On peut ainsi s'en servir pour sélectionner une liste de message situé entre deux temps précis, exemple pour retourner les pseudos, messages et date de tous les messages du mois de janvier 2000:
```sql
    SELECT pseudo, message, date FROM minichat WHERE date >= '2000-01-01 00:00:00' AND date <= '2000-01-31 23:59:59' 
```

+ Pour récupérer des dates entre deux intervalles il existe une méthode plus simple avec le mot clé ``BETWEEN`` (fonctionne aussi pour les nombres d'une manière générale):
```sql
    SELECT pseudo, message, date FROM minichat WHERE date BETWEEN '2000-01-01 00:00:00' AND '2000-01-31 23:59:59'
```

+ Pour insérer une date le principe est le même:
```sql
    INSERT INTO minichat(pseudo, message, date) VALUES('Bob', 'message.... ?', '2021-04-26 00:12:35')
```

+ Fonctions avec les dates:
    - ``NOW()``: récupère la date et l'heure actuelles au format ``AAAA-MM-JJ HH:MM:SS``
    ```sql 
        INSERT INTO minichat(pseudo, message, date) VALUES('Bobby', 'bonjour !', NOW())
    ```

    - ``CURDATE()`` : comme ``NOW()`` mais ne récupère que la date actuelle ``AAAA-MM-JJ``

    - ``CURTIME()`` : comme ``NOW()`` mais ne récupère que l'heure actuelle ``HH:MM:SS``

+ Si on souhaite extraire uniquement le jour, le mois, l'année, l'heure, les minutes ou les secondes d'une date on peut faire comme suit:
    - au lieu de récupérer toute la date on ne récupère que le jour, dans un **alias** nommé ``jour``
    ```sql
        SELECT pseudo, message, DAY(date) AS jour FROM minichat 
    ```

+ cela fonctionne avec:
    - ``DAY(date)``: pour le jour
    - ``MONTH(date)``: pour le mois 
    - ``YEAR(date)``: pour l'année 
    - ``HOUR(date)``: pour l'heure 
    - ``MINUTE(date)``: pour les minutes 
    - ``SECOND(date)``: pour les secondes 

+ On pourrait alors se servir de ça pour afficher la date sous le format qu'on veut (par exmeple on récupère tous les éléments de la date de cette manière puis on peut concaténer une chaine de caractères avec nos variables obtenues)

+ Pour afficher la date selon un format voulu:
    - ``DATE-FORMAT`` : ``DATE-FORMAT(date, '%d %m %Y %H %i %s')`` on écrit sous ce format les symboles pourcent suivi d'une lettre seront remplacés par respectivement le jour, mois, année, heure, minutes, secondes
    - cela permet d'ajouter du texte entre également puisque les autres caractères restent tels quels , par exemple:
    ```sql
        SELECT pseudo, message, DATE-FORMAT(date, '%d/%m/%Y %Hh%imin%ss') AS current_date FROM minichat
    ```
    - l'exemple précédent retourne dans un **alias** ``current_date``, la date et l'heure sous la forme suivante: ``24/mm/aaaa 00h00min00s``

+ ``DATE_ADD`` ou ``DATE_SUB``: permet d'ajouter ou de soustraire des heures, minutes, jours,... à une date, on utilise deux paramètres: 
    - la date que l'on souhaite modifier
    - le nombre à ajouter et son type (``DAY``, ``MONTH``, ``YEAR``, ``HOUR``, ``MINUTE``, ``SECOND``)
    ```sql
        SELECT pseudo, message, DATE_ADD(date, INTERVAL 2 MONTH) AS expiration_date FROM minichat
    ```
