# Sélection d'éléments:
+ les sélecteurs css
+ les pseudos sélecteurs:
    - en fonction de l'attribut ``type``:
        - ``:text``
        - ``:password``
        - ``:checkbox``
        - ``:radio``
        - ``:submit``
        - ``:file``
        - ``:image``
        - ``:button``
        - ``:reset``
    - en fonction de l'état:
        - ``:input``  cible tous les éléments input, textarea, select et button
        - ``:checked``  cible les éléments cochés ou sélectionnés pour des input type="checkbox", input type="radio" et des éléments de liste select
        - ``:selected``  cible les éléments option sélectionnés dans une liste select
        - ``:disabled``  cible les éléments input qui possèdent un attribut disabled
        - ``:enabled``  cible tous les éléments qui ne possèdent pas d’attribut disabled
+ méthodes:
    - ``has()`` : les éléments qui possèdent les "child" spécifiés:
        - ``let pspan = $("p").has("span").css("color", "orange");``: applique une couleur orange à tous les éléméents ``p`` qui contiennent une ``span``
    - ``filter()`` : filtre les éléments qui satisfont le sélecteur passé en argument:
        - ``$("p").filter(".important").css("color", "orange");``: applique une couleur orange à tous les éléments ``p`` qui ont la classe ``important``
    - ``not()`` : soustrait d'une sélection  les éléments qui répondent au critère:
        - ``$("p").not(".important").css("color", "orange");``: applique une couleur orange à tous les éléments ``p`` qui n'ont pas la classe ``important``
    - ``first()``: sélectionne le premier élément de la sélection de départ 
    - ``last()``: sélectionne le dernier élément de la sélection de départ
    - ``eq(index)``: sélectionne que l'élément ayant l'index fourni: comme d'hab: **(0): 1**, **(1): 2**, **(-1): dernier élément**, **(-2): avant dernier élément**