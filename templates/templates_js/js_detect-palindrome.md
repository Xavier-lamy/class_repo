# Test de palindrome

Objectif de l'exercice:
- Réfléchir soi même à l'algorithme sans regarder sur internet
- Le réaliser de la manière la plus concise (possible en 4 lignes de code ?)
- ne pas utiliser de fonction reverse

+ Idées avant réalisation
    - transformer la chaine pour virer les majuscules, et tout ce qui n'est pas une lettre ou un chiffre
    - Calculer la longueur ``len`` de la chaine
    - Diviser par deux cette longueur en arrondissant à l'entier inférieur (``n``)
        - ainsi même en cas de nombre impair on aura toujours un nombre égal à la longueur d'une moitié de chaine, en effet si on a une longueur impaire le nombre du milieu n'a pas besoin d'etre comparé
    - On se sert ensuite de ce nombre, il servira à:
        - Déterminer le nombre d'itération nécessaire pour comparer les lettres miroirs, et donc la limite de la boucle for
        - Additionner ou soustraire à l'index afin de déterminer les index des lettre à comparer


+ brouillon:
exemple avec une string de 11 caractères ou 10
azert treza
azert y treza

divise par deux arrondi à l'entier inférieur (comme ça si j'ai un nombre impair comme 11 cela arrondira à 5)

je regarde ensuite avec une boucle for( i = 0 ; i < 5; i++), 

je compare les lettres qui ont les index suivants, j'utilise charAt() pour js
1ere itération, comparer: 5 - 0  avec 5 + 1 (+1 si impair)
2eme itération, comparer: 5 - 1  avec 5 + 2 (+1 si impair)
3eme itération, comparer: 5 - 2  avec 5 + 3 (+1 si impair)
4eme itération, comparer: 5 - 3  avec 5 + 4 (+1 si impair)
5eme itération, comparer: 5 - 4  avec 5 + 5 (+1 si impair)

ceci revient à écrire:
1ere itération, comparer: 5 - 0  avec 5 + 0 + 1 de décalage (+1 si impair)
2eme itération, comparer: 5 - 1  avec 5 + 1 + 1 de décalage (+1 si impair)
3eme itération, comparer: 5 - 2  avec 5 + 2 + 1 de décalage (+1 si impair)
4eme itération, comparer: 5 - 3  avec 5 + 3 + 1 de décalage (+1 si impair)
5eme itération, comparer: 5 - 4  avec 5 + 4 + 1 de décalage (+1 si impair)

donc on a:
- le 5 qui correspond au nombre trouvé par la division
- un nombre qui s'incrément de 0 à le nombre trouvé par la division (ça correspond donc à i)
- un nombre 1 de décalage (toujours égal à 1)
- un nombre optionnel de décalage si on a une longueur impaire (afin d'exclure le nombre central)

+ Pseudo code:
```
stringToTest = 'Aze rt ytr eza'

function isPalindrom(stringToTest) {

    rawString = stringToTest.slugify //Should return 'azertytreza'

    len = rawString.getLength

    n = (len / 2).roundToInferiorInteger

    shiftNum = (len % 2 == 0) ? 1 : 2 //Si len est pair on décale que de 1 sinon on décale de 2

    for ( i = 0 ; i < n; i++ ) {

        leftIndex = n - i
        rightIndex = n + i + shiftNum

        leftChar = rawString.getCharByIndex(leftIndex - 1)
        rightChar = rawString.getCharByIndex(rightIndex - 1)

        if(leftChar != rightChar){
            //Early return (il suffit d'une seule comparaison sans égalité pour considérer que ce n'est pa sun palindrome )
            return false
        }

        //Sinon si c'est vrai on passe à l'itération suivante
        continue

    }

    //Si on à pas quitter plus tôt avec le return false on est alors arrivé jusque là
    return true
}
```

+ Tests: tester avec des palindromes connus -> ça fonctionne !

+ Réalisation en JS: [version fonctionnelle](https://codepen.io/Xavier_xl/pen/xxYQgze)
```js
let simplePalindrome = 'kayak';
let phrasePalindrome = 'Karine alla en Irak';

let notAPalindrome = 'Bobby';

const treatString = (string) => {
  return string.replace(/\W/g, '').toLowerCase();
}

const testPalindrome = (string) => {
  
  //Treat string, to remove any whitespace, specialchars, uppercase and every non letter/digit type character
  let rawString = treatString(string);
  
  //Get string length
  let len = rawString.length;
  
  //Divide length by 2 and round it down to integer, this way if length is odd the middle character will not be used for comparison
  let n = Math.floor(len / 2);
  
  //If length is odd, shift 2 position, otherwise only one is needed
  let shiftNum = (len %  2 == 0) ? 1 : 2;
  
  for( let i = 0; i < n; i++ ){
    

    let leftIndex = n - i; //Compare the one just left from the middle, then substract one every iteration until end
    let rightIndex = n + i + shiftNum; //Compare the one just right from the middle, by adding 1 to it and 1 more if even, then add one every iteration until end
    
    //Remove 1 from index (because charAt first index is 0)
    let leftChar = rawString.charAt(leftIndex - 1);
    let rightChar = rawString.charAt(rightIndex - 1);
    
    if(leftChar !== rightChar){
        //If one comparison is false exit the function by returning false, this means this can't be a palindrome
        return false;
    }
    
  }
  
  //If no comparisons have been evaluated to false:
  return true;
}

const compactTestPalindrome = string => {
  let rawString = string.replace(/\W/g, '').toLowerCase();
  let len = rawString.length;
  let n = Math.floor(len / 2);
  let shiftNum = (len %  2 == 0) ? 1 : 2;

  for( let i = 0; i < n; i++ ){   

    let leftChar = rawString.charAt((n - i) - 1);
    let rightChar = rawString.charAt((n + i + shiftNum) - 1);
    
    if(leftChar !== rightChar){
        return false;
    }  
    
  }
  
  return true;
  
}

console.clear();
console.log("Test with big function:");
console.log(`${simplePalindrome} is a palindrome: ${testPalindrome(simplePalindrome)}, expected: true`);
console.log(`${phrasePalindrome} is a palindrome: ${testPalindrome(phrasePalindrome)}, expected: true`);
console.log(`${notAPalindrome} is a palindrome: ${testPalindrome(notAPalindrome)}, expected: false`);

console.log('---------------------------------------------------------------------')

console.log("Test with short function:");
console.log(`${simplePalindrome} is a palindrome: ${compactTestPalindrome(simplePalindrome)}, expected: true`);
console.log(`${phrasePalindrome} is a palindrome: ${compactTestPalindrome(phrasePalindrome)}, expected: true`);
console.log(`${notAPalindrome} is a palindrome: ${compactTestPalindrome(notAPalindrome)}, expected: false`);

```