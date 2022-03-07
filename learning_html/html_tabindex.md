# L'Attribut tabindex

- Nombre entier indiquant si un élément peut avoir le ``focus`` (lors de la navigation au clavier) et dans quel ordre.
- En cas d'égalité de tabindex, la position dans le document prévaut
- Valeurs possibles:
    - négative: peut avoir le focus mais pas etre atteint par la navigation au clavier
    - 0 : l'ordre est défini par la position dans le document
    - positive: peut avoir le focus, être parcouru au clavier, et l'ordre est défini par la valeur de l'attribut