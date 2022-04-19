# Vérifier quel élément d'un élément parent est celui cliqué
Dans le cas où on aurait plusieurs boutons avec le même nom et où on souhaite savoir lequel est celui qui a été cliqué, on peut utiliser la propriété ``target`` sur l'objet de l'event:

```js
//On active la fonction au chargement de la page
window.onload = checkClickedButton();

function checkClickedButton() {
    //On récupère le container dans lequel se trouve tous nos boutons (ceci crée un objet lié à l'évènement du clic)
    document.getElementById("addRecipeTable").onclick = clickedButton;
}

function clickedButton(e) {
    //On récupère l'id de l'élément (contenu dans le container) cible de l'évènement avec target (en vérifiant qu'il s'agisse bien du type de bouton qu'on souhaite)
    if (e.target.name == 'delete_row') {
        let targetId = e.target.id;
        let elementToDelete = document.getElementById(targetId);
        //On peut alors exécuter des méthodes sur cet élément (ici on supprime la ligne du tableau dans laquelle se trouve ce bouton)
        elementToDelete.closest('tr').remove();
    }
}
```