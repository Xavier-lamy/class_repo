# L'objet date en JS

## Méthodes de l'objet Date
- ``Date()``: date actuelle sous forme littérale
- ``Date.now()``: date actuelle sous forme de timestamp Unix (secondes depuis 1er Janvier 1970)
- Pour créer un objet date on peut le faire de plusieurs manières par **exemple**: on peut faire ``new Date()`` et on ajoute en arguments: 
    - L’année (argument obligatoire) de la date qu’on souhaite créer
    - Le numéro du mois (argument obligatoire) de la date qu’on souhaite créer, entre 0 (pour janvier) et 11 (pour décembre)
    - Le numéro du jour du mois (facultatif) de la date qu’on souhaite créer, entre 1 et 31
    - L’heure (facultatif) de la date qu’on souhaite créer, entre 0 et 23
    - Le nombre de minutes (facultatif) de la date qu’on souhaite créer, entre 0 et 59
    - Le nombre de secondes (facultatif) de la date qu’on souhaite créer, entre 0 et 59
    - Le nombre de millisecondes (facultatif) de la date qu’on souhaite créer, entre 0 et 999
- Les getters de l'objet date
    - ``getDay()`` renvoie le jour de la semaine sous forme de chiffre (avec 0 pour dimanche,...) pour la date spécifiée selon l’heure locale 
    - ``getDate()`` renvoie le jour du mois en chiffres pour la date spécifiée selon l’heure locale
    - ``getMonth()`` renvoie le numéro du mois de l’année (avec 0 pour janvier, 1 pour février, 11 pour décembre) pour la date spécifiée selon l’heure locale
    - ``getFullYear()`` renvoie l’année en 4 chiffres pour la date spécifiée selon l’heure locale
    - ``getHours()`` renvoie l’heure en chiffres pour la date spécifiée selon l’heure locale
    - ``getMinutes()`` renvoie les minutes en chiffres pour la date spécifiée selon l’heure locale
    - ``getSeconds()`` renvoie les secondes en chiffres pour la date spécifiée selon l’heure locale
    - ``getMilliseconds()`` renvoie les millisecondes en chiffres pour la date spécifiée selon l’heure locale
- Si on ajoute UTC aux getters précédent on obtient le résultat en heure UTC ex: ``getUTCDay()``, ``getUTCDate()``
- Setters de l'objet date
    - ``setDate()`` et ``setUTCDate()`` définissent le jour du mois en chiffres pour la date spécifiée selon l’heure locale ou l’heure UTC
    - ``setMonth()`` et ``setUTCMonth()`` définissent le numéro du mois de l’année (avec 0 pour janvier, 1 pour février, 11 pour décembre) pour la date spécifiée selon l’heure locale ou l’heure UTC
    - ``setFullYear()`` et ``setUTCFullYear()`` définissent l’année en 4 chiffres pour la date spécifiée selon l’heure locale ou l’heure UTC
    - ``setHours()`` et ``setUTCHours()`` définissent l’heure en chiffres pour la date spécifiée selon l’heure locale ou l’heure UTC
    - ``setMinutes()`` et ``setUTCMinutes()`` définissent les minutes en chiffres pour la date spécifiée selon l’heure locale ou l’heure UTC
    - ``setSeconds()`` et ``setUTCSeconds()`` définissent les secondes en chiffres pour la date spécifiée selon l’heure locale ou l’heure UTC
    - ``setMilliseconds()`` et ``setUTCMilliseconds()`` définissent les millisecondes en chiffres pour la date spécifiée selon l’heure locale ou l’heure UTC
- ``toLocaleString('locales', 'options')``, ``toLocaleTimeString('locales', 'options')``, ``toLocaleDateString('locales', 'options')``: renvoie  la date formatée à partir d'un objet date, ne fonctionne pas avec un timestamp (respectivement: date complète, que les heures-min-sec, que les jour-mois-année) en fonction d'une ``locale`` (la langue dns laquelle on formate ex: ``fr-FR`` pour la france) et d'``options``:
    - ``weekday`` qui représente le jour de la semaine. Les valeurs possibles sont ``narrow``, ``short`` et ``long``
    - ``day`` qui représente le jour du mois. Les valeurs possibles sont ``numeric`` et ``2-digit``
    - ``month`` qui représente le mois. Les valeurs possibles sont ``numeric`` et ``2-digit``
    - ``year`` qui représente l’année. Les valeurs possibles sont ``numeric`` et ``2-digit``
    - ``hour`` qui représente l’heure. Les valeurs possibles sont ``numeric`` et ``2-digit``
    - ``minute`` qui représente les minutes. Les valeurs possibles sont ``numeric`` et ``2-digit``
    - ``second`` qui représente les secondes. Les valeur possibles sont ``numeric`` et ``2-digit``
    - ``timeZone`` pour définir le fuseau horaire à utiliser
    - Exemples de combinaisons d'options:
    ```js
    const options = {weekday:"long", year:"numeric", month:"numeric", day:"numeric", hour:"2-digit", minute:"2-digit", second:"2-digit"}
    ```

