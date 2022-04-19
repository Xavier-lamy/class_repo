# Les fonctions
Une fonction est un bloc de code exécutant une tache précise que l'on peut appeler à tout moment
```js
function nomDeLaFonction(argument1, argument2) {
    return effetDelaFonction;
}
```

+ Quand on **déclare** une fonction on indique ses **paramètres**, càd les **variables** dont elle a besoin pour fonctionner

+ Puis quand on **appelle** la fonction on attribue des valeurs à ces paramètres, ce sont les **arguments** d'appel

+ Quand la fonction est exécuté elle renvoie une **valeur de retour**


## Méthodes d'instances et propriété
+ rappel: une **propriété** (on parle aussi d'**attribut**) de classe est une variable interne à une classe qui peut être défini par défaut puis évoluer lors de l'exécution du code

+ Une **méthode d'instance** est une fonction qui fait partie d'une classe, et qui agira sur une instance de cette classe
```js
class BankAccount {
    constructor(owner, balance) {
        this.owner = owner; //Propriété ou attribut
        this.balance = balance;
    }
    showBalance() {
        console.log("Solde total: " + this.balance + " EUR"); //méthode d'instance
    }
    deposit(amount) {
        console.log("Dépôt de " + amount + " EUR");
        this.balance += amount;
        this.showBalance();
    }
    withdraw(amount) {
        if (amount > this.balance) {
            console.log("Retrait impossible");
        } else {
            console.log("Retrait de " + amount + " EUR");
            this.balance -= amount;
            this.showBalance();
        }
    }
}

const newAccount = new BankAccount("Bob", 500);

newAccount.showBalance(); //On appelle la "méthode" showBalance définie dans la classe
```

+ Les méthodes de classe statique (il s'agit en gros du même principe que quand sur python on utilise ``random.randint`` : 
    - randint est une méthode statique (méthode utilitaire) de la classe ``random`` 
    - on a cependant pas besoin d'instancier un objet de la classe random, on peut utiliser directement sa méthode statique)
    - sous JS on peut également créer des classes avec des méthodes statiques qui n'auront pas besoin de constructeur car elles ne seront pas instanciées
    - cela peut permettre de regrouper les méthodes statiques (qui agiront comme des fonctions) au sein d'un groupe (la classe)
    - Exemple l'objet ``Math`` contient de nombreuses méthodes:
    ```js
    const randomNumber = Math.random(); //(crée un nombre aléatoire)
    const roundMeDown = Math.floor(495.966); //Arrondi à l'entier inférieur (495)
    ```
    - On constate bien que pour utiliser ces méthodes on a pas eu besoin de créer d'instance de ``Math``, on les a directement déclarer sur l'objet global "Math"

//On peut créer nos propres méthode avec le mot clé ``static``:
```js
class Greetings {
    static sayHi() {
        console.log("Hi");
    }

    static sayHelloTo(name) {
        console.log("Hello " + name);
    }
}

Greetings.sayHello("Bob"); //renvoie "Hello Bob" en console
Greetings.sayHi(); //renvoie "Hi" en console
```

+ On peut aussi écrire les fonctions d'une manière raccourcie (fonctions fléchées), dans une constante par exemple:
```js
const fonctionFonction = (argument) => {
    //Contenu de la fonction
}
```
