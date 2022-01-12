# Raccourcis d'écriture Emmet
<style>
    * {
        color: black;
        background-color: white;
        font-size: 1.2rem;        
    }
    h1 {
        text-decoration: underline;
        text-align: center;
        font-size: 1.6rem;
    }
    ul {
        list-style: none;
    }
    strong {
        color: black;
    }
    li {
        margin-top: 1rem;
    }
</style>
- __div__ : crée une div
- __div>ul>li__ : nest les éléments (un item dans une liste, dans une div)
- __div+p+div__ : place les éléments au même niveau
- __div>p+span^p__ : ^ monte l'élément d'un niveau (^^:2niv,...) p sera donc au même rang que div
- __div*5__ : affiche 5 div
- __div>(p>ul>li)+footer>p__ : () groupe les éléments
- __#idName__ : id
- __.className__ : classe (si laissé sans balise = div)
- __div[attr title]__ : ajoute des attributs à une balise
- __div[attr:"..." title:"..."]__ : ajoute des attributs et une valeur à une balise
- __ul>li.item$*5__ : $ est remplacé par un nombre indenté en fonction du nombre d'item (ex: item1, item2,...)
- __.item$$$*5__ : chaque dollar en trop est remplacé par un zéro (item001, ..., item005)
- __.item$@-*5__ : l'ordre d'intentation est inversé
- __a{content}__ : ajoute du texte entre les balises
- __ul>.item__ : si on ne précise pas la balise elle peut être "devinée" par emmet (ici li)
- __p*4>lorem40__ : génère 4 paragraphes avec différents lorem ipsum (40 mots par paragraphe, par défaut 30)
