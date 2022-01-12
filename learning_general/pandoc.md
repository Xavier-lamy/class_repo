# Utiliser Pandoc pour transformer des fichiers
Pandoc peut par exemple servir à transformer des markdown en pdf

1. on va dans le dossier: ``cd folderpath``
2. ``pandoc filename.md -f markdown -t html -s -o filename.html``
    - ``filename.md`` : quel fichier convertir  
    - ``-f markdown`` : le format d'entrée (par défaut markdown, peut être omis dans ce cas)  
    - ``-t html``: le format de sortie (par défaut html, peut être omis dans ce cas)  
    - ``-s`` : créé un fichier "standalone" (avec header et footer, sans ça on a juste le contenu)  
    - ``-o filename.html`` : le nom du fichier de sortie (output)  
